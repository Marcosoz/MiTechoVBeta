<?php

namespace PHPMaker2025\project1;

// Page object
$HorasTrabajadasDelete = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { horas_trabajadas: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fhoras_trabajadasdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fhoras_trabajadasdelete")
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
<form name="fhoras_trabajadasdelete" id="fhoras_trabajadasdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="horas_trabajadas">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_horas_trabajadas_id" class="horas_trabajadas_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->socio_id->Visible) { // socio_id ?>
        <th class="<?= $Page->socio_id->headerCellClass() ?>"><span id="elh_horas_trabajadas_socio_id" class="horas_trabajadas_socio_id"><?= $Page->socio_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fecha->Visible) { // fecha ?>
        <th class="<?= $Page->fecha->headerCellClass() ?>"><span id="elh_horas_trabajadas_fecha" class="horas_trabajadas_fecha"><?= $Page->fecha->caption() ?></span></th>
<?php } ?>
<?php if ($Page->horas->Visible) { // horas ?>
        <th class="<?= $Page->horas->headerCellClass() ?>"><span id="elh_horas_trabajadas_horas" class="horas_trabajadas_horas"><?= $Page->horas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tarea->Visible) { // tarea ?>
        <th class="<?= $Page->tarea->headerCellClass() ?>"><span id="elh_horas_trabajadas_tarea" class="horas_trabajadas_tarea"><?= $Page->tarea->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_horas_trabajadas_created_at" class="horas_trabajadas_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cooperativa_id->Visible) { // cooperativa_id ?>
        <th class="<?= $Page->cooperativa_id->headerCellClass() ?>"><span id="elh_horas_trabajadas_cooperativa_id" class="horas_trabajadas_cooperativa_id"><?= $Page->cooperativa_id->caption() ?></span></th>
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
<?php if ($Page->socio_id->Visible) { // socio_id ?>
        <td<?= $Page->socio_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->socio_id->viewAttributes() ?>>
<?= $Page->socio_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fecha->Visible) { // fecha ?>
        <td<?= $Page->fecha->cellAttributes() ?>>
<span id="">
<span<?= $Page->fecha->viewAttributes() ?>>
<?= $Page->fecha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->horas->Visible) { // horas ?>
        <td<?= $Page->horas->cellAttributes() ?>>
<span id="">
<span<?= $Page->horas->viewAttributes() ?>>
<?= $Page->horas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tarea->Visible) { // tarea ?>
        <td<?= $Page->tarea->cellAttributes() ?>>
<span id="">
<span<?= $Page->tarea->viewAttributes() ?>>
<?= $Page->tarea->getViewValue() ?></span>
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
<?php if ($Page->cooperativa_id->Visible) { // cooperativa_id ?>
        <td<?= $Page->cooperativa_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->cooperativa_id->viewAttributes() ?>>
<?= $Page->cooperativa_id->getViewValue() ?></span>
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
