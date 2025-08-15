<?php

namespace PHPMaker2025\project1;

// Page object
$SociosView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fsociosview" id="fsociosview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { socios: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fsociosview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsociosview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script<?= Nonce() ?>>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="socios">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_socios_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_socios_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cooperativa_id->Visible) { // cooperativa_id ?>
    <tr id="r_cooperativa_id"<?= $Page->cooperativa_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_socios_cooperativa_id"><?= $Page->cooperativa_id->caption() ?></span></td>
        <td data-name="cooperativa_id"<?= $Page->cooperativa_id->cellAttributes() ?>>
<span id="el_socios_cooperativa_id">
<span<?= $Page->cooperativa_id->viewAttributes() ?>>
<?= $Page->cooperativa_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nombre_completo->Visible) { // nombre_completo ?>
    <tr id="r_nombre_completo"<?= $Page->nombre_completo->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_socios_nombre_completo"><?= $Page->nombre_completo->caption() ?></span></td>
        <td data-name="nombre_completo"<?= $Page->nombre_completo->cellAttributes() ?>>
<span id="el_socios_nombre_completo">
<span<?= $Page->nombre_completo->viewAttributes() ?>>
<?= $Page->nombre_completo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cedula->Visible) { // cedula ?>
    <tr id="r_cedula"<?= $Page->cedula->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_socios_cedula"><?= $Page->cedula->caption() ?></span></td>
        <td data-name="cedula"<?= $Page->cedula->cellAttributes() ?>>
<span id="el_socios_cedula">
<span<?= $Page->cedula->viewAttributes() ?>>
<?= $Page->cedula->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->telefono->Visible) { // telefono ?>
    <tr id="r_telefono"<?= $Page->telefono->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_socios_telefono"><?= $Page->telefono->caption() ?></span></td>
        <td data-name="telefono"<?= $Page->telefono->cellAttributes() ?>>
<span id="el_socios_telefono">
<span<?= $Page->telefono->viewAttributes() ?>>
<?= $Page->telefono->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->email->Visible) { // email ?>
    <tr id="r_email"<?= $Page->email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_socios_email"><?= $Page->email->caption() ?></span></td>
        <td data-name="email"<?= $Page->email->cellAttributes() ?>>
<span id="el_socios_email">
<span<?= $Page->email->viewAttributes() ?>>
<?= $Page->email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fecha_ingreso->Visible) { // fecha_ingreso ?>
    <tr id="r_fecha_ingreso"<?= $Page->fecha_ingreso->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_socios_fecha_ingreso"><?= $Page->fecha_ingreso->caption() ?></span></td>
        <td data-name="fecha_ingreso"<?= $Page->fecha_ingreso->cellAttributes() ?>>
<span id="el_socios_fecha_ingreso">
<span<?= $Page->fecha_ingreso->viewAttributes() ?>>
<?= $Page->fecha_ingreso->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->activo->Visible) { // activo ?>
    <tr id="r_activo"<?= $Page->activo->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_socios_activo"><?= $Page->activo->caption() ?></span></td>
        <td data-name="activo"<?= $Page->activo->cellAttributes() ?>>
<span id="el_socios_activo">
<span<?= $Page->activo->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->activo->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_socios_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_socios_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contrasena->Visible) { // contraseña ?>
    <tr id="r_contrasena"<?= $Page->contrasena->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_socios_contrasena"><?= $Page->contrasena->caption() ?></span></td>
        <td data-name="contrasena"<?= $Page->contrasena->cellAttributes() ?>>
<span id="el_socios_contrasena">
<span<?= $Page->contrasena->viewAttributes() ?>>
<?= $Page->contrasena->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
</main>
<?php
$Page->showPageFooter();
?>
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
