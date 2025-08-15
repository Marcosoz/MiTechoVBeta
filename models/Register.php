<?php

namespace PHPMaker2025\project1;

use DI\ContainerBuilder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Psr\Cache\CacheItemPoolInterface;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Result;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Cache\QueryCacheProfile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Dflydev\FigCookies\FigRequestCookies;
use Dflydev\FigCookies\FigResponseCookies;
use Dflydev\FigCookies\SetCookie;
use Slim\Interfaces\RouteCollectorProxyInterface;
use Slim\App;
use League\Flysystem\DirectoryListing;
use League\Flysystem\FilesystemException;
use Closure;
use DateTime;
use DateTimeImmutable;
use DateInterval;
use Exception;
use InvalidArgumentException;

/**
 * Page class
 */
class Register extends Socios
{
    use MessagesTrait;
    use FormTrait;

    // Page ID
    public string $PageID = "register";

    // Project ID
    public string $ProjectID = PROJECT_ID;

    // Page object name
    public string $PageObjName = "Register";

    // View file path
    public ?string $View = null;

    // Title
    public ?string $Title = null; // Title for <title> tag

    // CSS class/style
    public string $CurrentPageName = "register";

    // Page headings
    public string $Heading = "";
    public string $Subheading = "";
    public string $PageHeader = "";
    public string $PageFooter = "";

    // Page layout
    public bool $UseLayout = true;

    // Page terminated
    private bool $terminated = false;

    // Page heading
    public function pageHeading(): string
    {
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading(): string
    {
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        return "";
    }

    // Page name
    public function pageName(): string
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl(bool $withArgs = true): string
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader(): void
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<div id="ew-page-header">' . $header . '</div>';
        }
    }

    // Show Page Footer
    public function showPageFooter(): void
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<div id="ew-page-footer">' . $footer . '</div>';
        }
    }

    // Constructor
    public function __construct(Language $language, AdvancedSecurity $security)
    {
        parent::__construct($language, $security);
        global $DashboardReport;
        $this->TableVar = 'socios';
        $this->TableName = 'socios';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-register-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Table object (socios)
        if (!isset($GLOBALS["socios"]) || $GLOBALS["socios"]::class == PROJECT_NAMESPACE . "socios") {
            $GLOBALS["socios"] = &$this;
        }

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();
    }

    // Is lookup
    public function isLookup(): bool
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill(): bool
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest(): bool
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup(): bool
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated(): bool
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string|bool $url URL for direction, true => show response for API
     * @return void
     */
    public function terminate(string|bool $url = ""): void
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }
        DispatchEvent(new PageUnloadedEvent($this), PageUnloadedEvent::NAME);
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (HasJsonResponse()) { // Has JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!IsDebug() && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                WriteJson(["url" => $url]);
            } else {
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from result set
    protected function getRecordsFromResult(Result|array $result, bool $current = false): array
    {
        $rows = [];
        if ($result instanceof Result) { // Result
            while ($row = $result->fetchAssociative()) {
                $this->loadRowValues($row); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($row);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        } elseif (is_array($result)) {
            foreach ($result as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray(array $ar): array
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (isset($this->Fields[$fldname]) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (IsEmpty($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DataType::BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->uploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->uploadPath() . $file)));
                                    if (!IsEmpty($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue(array $ar): string
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit(): void
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup(array $req = [], bool $response = true): array|bool
    {
        // Get lookup object
        $fieldName = $req["field"] ?? null;
        if (!$fieldName) {
            return [];
        }
        $fld = $this->Fields[$fieldName];
        $lookup = $fld->Lookup;
        $name = $req["name"] ?? "";
        if (ContainsString($name, "query_builder_rule")) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $req["ajax"] ?? "unknown";
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $req["q"] ?? $req["sv"] ?? "";
            $pageSize = $req["n"] ?? $req["recperpage"] ?? 10;
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $req["q"] ?? "";
            $pageSize = $req["n"] ?? -1;
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $req["start"] ?? -1;
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $req["page"] ?? -1;
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($req["s"] ?? "");
        $userFilter = Decrypt($req["f"] ?? "");
        $userOrderBy = Decrypt($req["o"] ?? "");
        $keys = $req["keys"] ?? null;
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $req["v0"] ?? $req["lookupValue"] ?? "";
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $req["v" . $i] ?? "";
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, $response); // Use settings from current page
    }
    public string $FormClassName = "ew-form ew-register-form";
    public bool $IsModal = false;
    public bool $IsMobileOrModal = false;

    /**
     * Page run
     *
     * @return void
     */
    public function run(): void
    {
        global $ExportType, $CurrentLanguage, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = IsModal();
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));
        $this->CurrentAction = Param("action"); // Set up current action

        // Global Page Loading event (in userfn*.php)
        DispatchEvent(new PageLoadingEvent($this), PageLoadingEvent::NAME);

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;

        // Set up Breadcrumb
        Breadcrumb()->add("register", "RegisterPage", CurrentUrl(), "", "", true);
        $this->Heading = $this->language->phrase("RegisterPage");

        // Load default values
        $this->loadRowValues();

        // Get action
        $action = "";
        if (IsApi()) {
            $action = "insert";
        } elseif (Post("action") != "") {
            $action = Post("action");
        }

        // Check action
        if ($action != "") {
            // Get action
            $this->CurrentAction = $action;
            $this->loadFormValues(); // Get form values

            // Validate form
            if (!$this->validateForm()) {
                if (IsApi()) {
                    WriteJson([
                        "success" => false,
                        "validation" => $this->getValidationErrors(),
                        "error" => $this->getFailureMessage()
                    ]);
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        } else {
            $this->CurrentAction = "show"; // Display blank record
        }

        // Insert record
        if ($this->CurrentAction == "insert") {
            // Check for duplicate User ID
            $user = LoadUserByIdentifier($this->cedula->CurrentValue);
            if ($user) {
                $this->restoreFormValues(); // Restore form values
                $this->setFailureMessage($this->language->phrase("UserExists")); // Set user exist message
            }
            if (!$user) {
                if ($this->addRow()) { // Add record
                    CleanUploadTempPaths(SessionId());

                    // Get new user
                    $user = LoadUserByIdentifier($this->cedula->CurrentValue);

                    // Send registration email
                    $email = $this->prepareRegisterEmail($user);
                    $emailSent = false;
                    $args = ["user" => $user, "row" => $user->toArray()];
                    if ($this->emailSending($email, $args)) {
                        $emailSent = $email->send();
                    }

                    // Send email failed
                    if (!$emailSent) {
                        $this->setFailureMessage($email->LastError);
                    }
                    $returnPage = "";
                    if (IsEmpty($returnPage)) {
                        $returnPage = Config("REGISTER_AUTO_LOGIN") ? "index" : "login";
                    }
                    if (Config("REGISTER_ACTIVATE") && !IsEmpty(Config("USER_ACTIVATED_FIELD_NAME"))) {
                        if (!$this->peekSuccessMessage()) {
                            $this->setSuccessMessage($this->language->phrase("RegisterSuccessActivate")); // Activate success
                        }
                    } else {
                        if (!$this->peekSuccessMessage()) {
                            $this->setSuccessMessage($this->language->phrase("RegisterSuccess")); // Register success
                        }

                        // Auto login user after registration
                        if (Config("REGISTER_AUTO_LOGIN")) {
                            try {
                                SecurityHelper()->login(
                                    $user,
                                    Config("FORCE_TWO_FACTOR_AUTHENTICATION") ? FormLogin1faAuthenticator::class : "form_login"
                                );
                                $this->security->login();
                                $this->terminate($returnPage);
                                return;
                            } catch (\Exception $e) {
                                $this->setFailureMessage($e->getMessage()); // Set auto login failure message
                            }
                        }
                    }
                    if (
                        Config("REGISTER_AUTO_LOGIN")
                        && Config("USE_TWO_FACTOR_AUTHENTICATION")
                        && Config("FORCE_TWO_FACTOR_AUTHENTICATION")
                    ) { // Force 2fa
                        Session(SESSION_STATUS, "loggingin2fa");
                        $returnPage = "login2fa"; // Go to two factor authentication
                    } else { // Clear status
                        Session()->remove(SESSION_STATUS);
                        Session()->remove(SESSION_USER_PROFILE_USER_NAME);
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnPage); // Return
                        return;
                    }
                } else {
                    $this->restoreFormValues(); // Restore form values
                }
            }
        }

        // API request, return
        if (IsApi()) {
            $this->terminate();
            return;
        }

        // Render row
        if ($this->isConfirm()) { // Confirm page
            $this->RowType = RowType::VIEW; // Render view
        } else {
            $this->RowType = RowType::ADD; // Render add
        }
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            DispatchEvent(new PageRenderingEvent($this), PageRenderingEvent::NAME);

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles(): void
    {
    }

    // Load default values
    protected function loadDefaultValues(): void
    {
        $this->activo->DefaultValue = $this->activo->getDefault(); // PHP
        $this->activo->OldValue = $this->activo->DefaultValue;
    }

    // Load form values
    protected function loadFormValues(): void
    {
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'id' before field var 'x_id'
        $val = $this->getFormValue("id", null) ?? $this->getFormValue("x_id", null);

        // Check field name 'cooperativa_id' before field var 'x_cooperativa_id'
        $val = $this->getFormValue("cooperativa_id", null) ?? $this->getFormValue("x_cooperativa_id", null);
        if (!$this->cooperativa_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->cooperativa_id->Visible = false; // Disable update for API request
            } else {
                $this->cooperativa_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'nombre_completo' before field var 'x_nombre_completo'
        $val = $this->getFormValue("nombre_completo", null) ?? $this->getFormValue("x_nombre_completo", null);
        if (!$this->nombre_completo->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nombre_completo->Visible = false; // Disable update for API request
            } else {
                $this->nombre_completo->setFormValue($val);
            }
        }

        // Check field name 'cedula' before field var 'x_cedula'
        $val = $this->getFormValue("cedula", null) ?? $this->getFormValue("x_cedula", null);
        if (!$this->cedula->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->cedula->Visible = false; // Disable update for API request
            } else {
                $this->cedula->setFormValue($val);
            }
        }

        // Check field name 'email' before field var 'x_email'
        $val = $this->getFormValue("email", null) ?? $this->getFormValue("x_email", null);
        if (!$this->email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->email->Visible = false; // Disable update for API request
            } else {
                $this->email->setFormValue($val);
            }
        }

        // Check field name 'contraseña' before field var 'x_contrasena'
        $val = $this->getFormValue("contraseña", null) ?? $this->getFormValue("x_contrasena", null);
        if (!$this->contrasena->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contrasena->Visible = false; // Disable update for API request
            } else {
                $this->contrasena->setFormValue($val);
            }
        }

        // Note: ConfirmValue will be compared with FormValue
        if (Config("ENCRYPTED_PASSWORD")) { // Encrypted password, use raw value
            $this->contrasena->ConfirmValue = $this->getFormValue("c_contrasena");
        } else {
            $this->contrasena->ConfirmValue = RemoveXss($this->getFormValue("c_contrasena"));
        }
    }

    // Restore form values
    public function restoreFormValues(): void
    {
        $this->cooperativa_id->CurrentValue = $this->cooperativa_id->FormValue;
        $this->nombre_completo->CurrentValue = $this->nombre_completo->FormValue;
        $this->cedula->CurrentValue = $this->cedula->FormValue;
        $this->email->CurrentValue = $this->email->FormValue;
        $this->contrasena->CurrentValue = $this->contrasena->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return bool
     */
    public function loadRow(): bool
    {
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from result set or record
     *
     * @param array|bool|null $row Record
     * @return void
     */
    public function loadRowValues(array|bool|null $row = null): void
    {
        $row = is_array($row) ? $row : $this->newRow();

        // Call Row Selected event
        $this->rowSelected($row);
        $this->id->setDbValue($row['id']);
        $this->cooperativa_id->setDbValue($row['cooperativa_id']);
        $this->nombre_completo->setDbValue($row['nombre_completo']);
        $this->cedula->setDbValue($row['cedula']);
        $this->telefono->setDbValue($row['telefono']);
        $this->email->setDbValue($row['email']);
        $this->fecha_ingreso->setDbValue($row['fecha_ingreso']);
        $this->activo->setDbValue($row['activo']);
        $this->created_at->setDbValue($row['created_at']);
        $this->contrasena->setDbValue($row['contraseña']);
    }

    // Return a row with default values
    protected function newRow(): array
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['cooperativa_id'] = $this->cooperativa_id->DefaultValue;
        $row['nombre_completo'] = $this->nombre_completo->DefaultValue;
        $row['cedula'] = $this->cedula->DefaultValue;
        $row['telefono'] = $this->telefono->DefaultValue;
        $row['email'] = $this->email->DefaultValue;
        $row['fecha_ingreso'] = $this->fecha_ingreso->DefaultValue;
        $row['activo'] = $this->activo->DefaultValue;
        $row['created_at'] = $this->created_at->DefaultValue;
        $row['contraseña'] = $this->contrasena->DefaultValue;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow(): void
    {
        global $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->RowCssClass = "row";

        // cooperativa_id
        $this->cooperativa_id->RowCssClass = "row";

        // nombre_completo
        $this->nombre_completo->RowCssClass = "row";

        // cedula
        $this->cedula->RowCssClass = "row";

        // telefono
        $this->telefono->RowCssClass = "row";

        // email
        $this->email->RowCssClass = "row";

        // fecha_ingreso
        $this->fecha_ingreso->RowCssClass = "row";

        // activo
        $this->activo->RowCssClass = "row";

        // created_at
        $this->created_at->RowCssClass = "row";

        // contraseña
        $this->contrasena->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;

            // cooperativa_id
            $this->cooperativa_id->ViewValue = $this->cooperativa_id->CurrentValue;

            // nombre_completo
            $this->nombre_completo->ViewValue = $this->nombre_completo->CurrentValue;

            // cedula
            if ($this->security->canAdmin()) { // System admin
                if (strval($this->cedula->CurrentValue) != "") {
                    $this->cedula->ViewValue = $this->cedula->optionCaption($this->cedula->CurrentValue);
                } else {
                    $this->cedula->ViewValue = null;
                }
            } else {
                $this->cedula->ViewValue = $this->language->phrase("PasswordMask");
            }

            // telefono
            $this->telefono->ViewValue = $this->telefono->CurrentValue;

            // email
            $this->email->ViewValue = $this->email->CurrentValue;

            // fecha_ingreso
            $this->fecha_ingreso->ViewValue = $this->fecha_ingreso->CurrentValue;
            $this->fecha_ingreso->ViewValue = FormatDateTime($this->fecha_ingreso->ViewValue, $this->fecha_ingreso->formatPattern());

            // activo
            if (ConvertToBool($this->activo->CurrentValue)) {
                $this->activo->ViewValue = $this->activo->tagCaption(1) != "" ? $this->activo->tagCaption(1) : "Yes";
            } else {
                $this->activo->ViewValue = $this->activo->tagCaption(2) != "" ? $this->activo->tagCaption(2) : "No";
            }

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());

            // contraseña
            $this->contrasena->ViewValue = $this->language->phrase("PasswordMask");

            // id
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // cooperativa_id
            $this->cooperativa_id->HrefValue = "";
            $this->cooperativa_id->TooltipValue = "";

            // nombre_completo
            $this->nombre_completo->HrefValue = "";
            $this->nombre_completo->TooltipValue = "";

            // cedula
            $this->cedula->HrefValue = "";
            $this->cedula->TooltipValue = "";

            // email
            $this->email->HrefValue = "";
            $this->email->TooltipValue = "";

            // contraseña
            $this->contrasena->HrefValue = "";
            $this->contrasena->TooltipValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // id
            $this->id->EditValue = $this->id->CurrentValue;

            // cooperativa_id
            $this->cooperativa_id->setupEditAttributes();
            $this->cooperativa_id->EditValue = $this->cooperativa_id->CurrentValue;
            $this->cooperativa_id->EditValue = RemoveHtml($this->cooperativa_id->EditValue);
            $this->cooperativa_id->PlaceHolder = RemoveHtml($this->cooperativa_id->caption());

            // nombre_completo
            $this->nombre_completo->setupEditAttributes();
            $this->nombre_completo->EditValue = !$this->nombre_completo->Raw ? HtmlDecode($this->nombre_completo->CurrentValue) : $this->nombre_completo->CurrentValue;
            $this->nombre_completo->PlaceHolder = RemoveHtml($this->nombre_completo->caption());

            // cedula
            $this->cedula->setupEditAttributes();
            if (!$this->security->canAdmin()) { // System admin
                $this->cedula->EditValue = $this->language->phrase("PasswordMask");
            } else {
                $this->cedula->EditValue = $this->cedula->options(true);
                $this->cedula->PlaceHolder = RemoveHtml($this->cedula->caption());
            }

            // email
            $this->email->setupEditAttributes();
            $this->email->EditValue = !$this->email->Raw ? HtmlDecode($this->email->CurrentValue) : $this->email->CurrentValue;
            $this->email->PlaceHolder = RemoveHtml($this->email->caption());

            // contraseña
            $this->contrasena->setupEditAttributes();
            $this->contrasena->PlaceHolder = RemoveHtml($this->contrasena->caption());

            // Add refer script

            // id
            $this->id->HrefValue = "";

            // cooperativa_id
            $this->cooperativa_id->HrefValue = "";

            // nombre_completo
            $this->nombre_completo->HrefValue = "";

            // cedula
            $this->cedula->HrefValue = "";

            // email
            $this->email->HrefValue = "";

            // contraseña
            $this->contrasena->HrefValue = "";
        }
        if ($this->RowType == RowType::ADD || $this->RowType == RowType::EDIT || $this->RowType == RowType::SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != RowType::AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm(): bool
    {
        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
            if ($this->id->Visible && $this->id->Required) {
                if (!$this->id->IsDetailKey && IsEmpty($this->id->FormValue)) {
                    $this->id->addErrorMessage(str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->id->FormValue)) {
                $this->id->addErrorMessage($this->id->getErrorMessage(false));
            }
            if ($this->cooperativa_id->Visible && $this->cooperativa_id->Required) {
                if (!$this->cooperativa_id->IsDetailKey && IsEmpty($this->cooperativa_id->FormValue)) {
                    $this->cooperativa_id->addErrorMessage(str_replace("%s", $this->cooperativa_id->caption(), $this->cooperativa_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->cooperativa_id->FormValue)) {
                $this->cooperativa_id->addErrorMessage($this->cooperativa_id->getErrorMessage(false));
            }
            if ($this->nombre_completo->Visible && $this->nombre_completo->Required) {
                if (!$this->nombre_completo->IsDetailKey && IsEmpty($this->nombre_completo->FormValue)) {
                    $this->nombre_completo->addErrorMessage(str_replace("%s", $this->nombre_completo->caption(), $this->nombre_completo->RequiredErrorMessage));
                }
            }
            if ($this->cedula->Visible && $this->cedula->Required) {
                if ($this->security->canAdmin() && !$this->cedula->IsDetailKey && IsEmpty($this->cedula->FormValue)) {
                    $this->cedula->addErrorMessage($this->language->phrase("EnterUserName"));
                }
            }
            if ($this->email->Visible && $this->email->Required) {
                if (!$this->email->IsDetailKey && IsEmpty($this->email->FormValue)) {
                    $this->email->addErrorMessage(str_replace("%s", $this->email->caption(), $this->email->RequiredErrorMessage));
                }
            }
            if ($this->contrasena->Visible && $this->contrasena->Required) {
                if (!$this->contrasena->IsDetailKey && IsEmpty($this->contrasena->FormValue)) {
                    $this->contrasena->addErrorMessage($this->language->phrase("EnterPassword"));
                }
            }
            if (!$this->contrasena->Raw && Config("REMOVE_XSS") && CheckPassword($this->contrasena->FormValue)) {
                $this->contrasena->addErrorMessage($this->language->phrase("InvalidPasswordChars"));
            }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow(?array $oldRow = null): bool
    {
        // Get new row
        $newRow = $this->getAddRow();

        // Update current values
        $this->Fields->setCurrentValues($newRow);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($oldRow);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($oldRow, $newRow);
        if ($insertRow) {
            $addRow = $this->insert($newRow);
            if ($addRow) {
            } elseif (!IsEmpty($this->DbErrorMessage)) { // Show database error
                $this->setFailureMessage($this->DbErrorMessage);
            }
        } else {
            if ($this->peekSuccessMessage() || $this->peekFailureMessage()) {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($this->language->phrase("InsertCancelled"));
            }
            $addRow = $insertRow;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($oldRow, $newRow);

            // Call User Registered event
            $this->userRegistered($newRow);
        }

        // Write JSON response
        if (IsJsonResponse() && $addRow) {
            $row = $this->getRecordsFromResult([$newRow], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_ADD_ACTION"), $table => $row]);
        }
        return $addRow;
    }

    /**
     * Get add row
     *
     * @return array
     */
    protected function getAddRow(): array
    {
        $newRow = [];

        // cooperativa_id
        $this->cooperativa_id->setDbValueDef($newRow, $this->cooperativa_id->CurrentValue, false);

        // nombre_completo
        $this->nombre_completo->setDbValueDef($newRow, $this->nombre_completo->CurrentValue, false);

        // cedula
        $newRow['cedula'] = 0; // Set default User Level

        // email
        $this->email->setDbValueDef($newRow, $this->email->CurrentValue, false);

        // contraseña
        if (!IsMaskedPassword($this->contrasena->CurrentValue)) {
            $this->contrasena->setDbValueDef($newRow, $this->contrasena->CurrentValue, false);
        }
        return $newRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb(): void
    {
        $breadcrumb = Breadcrumb();
    }

    // Setup lookup options
    public function setupLookupOptions(DbField $fld): void
    {
        if ($fld->Lookup && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_cooperativa_id":
                    break;
                case "x_cedula":
                    break;
                case "x_activo":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $qb = $fld->Lookup->getSqlAsQueryBuilder(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $qb != null && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($qb, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }

                // Get lookup cache Id
                $sql = $qb->getSQL();
                $lookupCacheKey = "lookup.cache." . Container($fld->Lookup->LinkTable)->TableVar . ".";
                $cacheId = $lookupCacheKey . hash("xxh128", $sql); // Hash value of SQL as cache id

                // Use result cache
                $cacheProfile = new QueryCacheProfile(0, $cacheId, Container("result.cache"));
                $rows = $conn->executeCacheQuery($sql, [], [], $cacheProfile)->fetchAllAssociative();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad(): void
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload(): void
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(string &$url): void
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'
    public function messageShowing(string &$message, string $type): void
    {
        // Example:
        //if ($type == "success") $message = "your success message";
    }

    // Page Render event
    public function pageRender(): void
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(string &$header): void
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(string &$footer): void
    {
        // Example:
        //$footer = "your footer";
    }

    // Email Sending event
    public function emailSending(Email $email, array $args): bool
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Form Custom Validate event
    public function formCustomValidate(string &$customError): bool
    {
        // Return error message in $customError
        return true;
    }

    // User Registered event
    public function userRegistered(array $row): void
    {
        //Log("User_Registered");
    }
}
