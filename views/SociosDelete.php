<?php

namespace PHPMaker2025\project1;

// Page object
$SociosDelete = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { socios: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fsociosdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsociosdelete")
        .setPageId("delete")
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fsociosdelete" id="fsociosdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="socios">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_socios_id" class="socios_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cooperativa_id->Visible) { // cooperativa_id ?>
        <th class="<?= $Page->cooperativa_id->headerCellClass() ?>"><span id="elh_socios_cooperativa_id" class="socios_cooperativa_id"><?= $Page->cooperativa_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nombre_completo->Visible) { // nombre_completo ?>
        <th class="<?= $Page->nombre_completo->headerCellClass() ?>"><span id="elh_socios_nombre_completo" class="socios_nombre_completo"><?= $Page->nombre_completo->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cedula->Visible) { // cedula ?>
        <th class="<?= $Page->cedula->headerCellClass() ?>"><span id="elh_socios_cedula" class="socios_cedula"><?= $Page->cedula->caption() ?></span></th>
<?php } ?>
<?php if ($Page->telefono->Visible) { // telefono ?>
        <th class="<?= $Page->telefono->headerCellClass() ?>"><span id="elh_socios_telefono" class="socios_telefono"><?= $Page->telefono->caption() ?></span></th>
<?php } ?>
<?php if ($Page->email->Visible) { // email ?>
        <th class="<?= $Page->email->headerCellClass() ?>"><span id="elh_socios_email" class="socios_email"><?= $Page->email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fecha_ingreso->Visible) { // fecha_ingreso ?>
        <th class="<?= $Page->fecha_ingreso->headerCellClass() ?>"><span id="elh_socios_fecha_ingreso" class="socios_fecha_ingreso"><?= $Page->fecha_ingreso->caption() ?></span></th>
<?php } ?>
<?php if ($Page->activo->Visible) { // activo ?>
        <th class="<?= $Page->activo->headerCellClass() ?>"><span id="elh_socios_activo" class="socios_activo"><?= $Page->activo->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_socios_created_at" class="socios_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while ($Page->fetch()) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = RowType::VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->CurrentRow);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->cooperativa_id->Visible) { // cooperativa_id ?>
        <td<?= $Page->cooperativa_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->cooperativa_id->viewAttributes() ?>>
<?= $Page->cooperativa_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nombre_completo->Visible) { // nombre_completo ?>
        <td<?= $Page->nombre_completo->cellAttributes() ?>>
<span id="">
<span<?= $Page->nombre_completo->viewAttributes() ?>>
<?= $Page->nombre_completo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->cedula->Visible) { // cedula ?>
        <td<?= $Page->cedula->cellAttributes() ?>>
<span id="">
<span<?= $Page->cedula->viewAttributes() ?>>
<?= $Page->cedula->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->telefono->Visible) { // telefono ?>
        <td<?= $Page->telefono->cellAttributes() ?>>
<span id="">
<span<?= $Page->telefono->viewAttributes() ?>>
<?= $Page->telefono->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->email->Visible) { // email ?>
        <td<?= $Page->email->cellAttributes() ?>>
<span id="">
<span<?= $Page->email->viewAttributes() ?>>
<?= $Page->email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fecha_ingreso->Visible) { // fecha_ingreso ?>
        <td<?= $Page->fecha_ingreso->cellAttributes() ?>>
<span id="">
<span<?= $Page->fecha_ingreso->viewAttributes() ?>>
<?= $Page->fecha_ingreso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->activo->Visible) { // activo ?>
        <td<?= $Page->activo->cellAttributes() ?>>
<span id="">
<span<?= $Page->activo->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->activo->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <td<?= $Page->created_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
}
$Page->Result?->free();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
