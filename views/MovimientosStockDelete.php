<?php

namespace PHPMaker2025\project1;

// Page object
$MovimientosStockDelete = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { movimientos_stock: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fmovimientos_stockdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmovimientos_stockdelete")
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
<form name="fmovimientos_stockdelete" id="fmovimientos_stockdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="movimientos_stock">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_movimientos_stock_id" class="movimientos_stock_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->stock_id->Visible) { // stock_id ?>
        <th class="<?= $Page->stock_id->headerCellClass() ?>"><span id="elh_movimientos_stock_stock_id" class="movimientos_stock_stock_id"><?= $Page->stock_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tipo_movimiento->Visible) { // tipo_movimiento ?>
        <th class="<?= $Page->tipo_movimiento->headerCellClass() ?>"><span id="elh_movimientos_stock_tipo_movimiento" class="movimientos_stock_tipo_movimiento"><?= $Page->tipo_movimiento->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cantidad->Visible) { // cantidad ?>
        <th class="<?= $Page->cantidad->headerCellClass() ?>"><span id="elh_movimientos_stock_cantidad" class="movimientos_stock_cantidad"><?= $Page->cantidad->caption() ?></span></th>
<?php } ?>
<?php if ($Page->motivo->Visible) { // motivo ?>
        <th class="<?= $Page->motivo->headerCellClass() ?>"><span id="elh_movimientos_stock_motivo" class="movimientos_stock_motivo"><?= $Page->motivo->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fecha->Visible) { // fecha ?>
        <th class="<?= $Page->fecha->headerCellClass() ?>"><span id="elh_movimientos_stock_fecha" class="movimientos_stock_fecha"><?= $Page->fecha->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_movimientos_stock_created_at" class="movimientos_stock_created_at"><?= $Page->created_at->caption() ?></span></th>
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
<?php if ($Page->stock_id->Visible) { // stock_id ?>
        <td<?= $Page->stock_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->stock_id->viewAttributes() ?>>
<?= $Page->stock_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tipo_movimiento->Visible) { // tipo_movimiento ?>
        <td<?= $Page->tipo_movimiento->cellAttributes() ?>>
<span id="">
<span<?= $Page->tipo_movimiento->viewAttributes() ?>>
<?= $Page->tipo_movimiento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->cantidad->Visible) { // cantidad ?>
        <td<?= $Page->cantidad->cellAttributes() ?>>
<span id="">
<span<?= $Page->cantidad->viewAttributes() ?>>
<?= $Page->cantidad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->motivo->Visible) { // motivo ?>
        <td<?= $Page->motivo->cellAttributes() ?>>
<span id="">
<span<?= $Page->motivo->viewAttributes() ?>>
<?= $Page->motivo->getViewValue() ?></span>
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
