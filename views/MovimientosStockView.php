<?php

namespace PHPMaker2025\project1;

// Page object
$MovimientosStockView = &$Page;
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
<form name="fmovimientos_stockview" id="fmovimientos_stockview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { movimientos_stock: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fmovimientos_stockview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmovimientos_stockview")
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
<input type="hidden" name="t" value="movimientos_stock">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_movimientos_stock_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_movimientos_stock_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->stock_id->Visible) { // stock_id ?>
    <tr id="r_stock_id"<?= $Page->stock_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_movimientos_stock_stock_id"><?= $Page->stock_id->caption() ?></span></td>
        <td data-name="stock_id"<?= $Page->stock_id->cellAttributes() ?>>
<span id="el_movimientos_stock_stock_id">
<span<?= $Page->stock_id->viewAttributes() ?>>
<?= $Page->stock_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tipo_movimiento->Visible) { // tipo_movimiento ?>
    <tr id="r_tipo_movimiento"<?= $Page->tipo_movimiento->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_movimientos_stock_tipo_movimiento"><?= $Page->tipo_movimiento->caption() ?></span></td>
        <td data-name="tipo_movimiento"<?= $Page->tipo_movimiento->cellAttributes() ?>>
<span id="el_movimientos_stock_tipo_movimiento">
<span<?= $Page->tipo_movimiento->viewAttributes() ?>>
<?= $Page->tipo_movimiento->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cantidad->Visible) { // cantidad ?>
    <tr id="r_cantidad"<?= $Page->cantidad->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_movimientos_stock_cantidad"><?= $Page->cantidad->caption() ?></span></td>
        <td data-name="cantidad"<?= $Page->cantidad->cellAttributes() ?>>
<span id="el_movimientos_stock_cantidad">
<span<?= $Page->cantidad->viewAttributes() ?>>
<?= $Page->cantidad->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->motivo->Visible) { // motivo ?>
    <tr id="r_motivo"<?= $Page->motivo->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_movimientos_stock_motivo"><?= $Page->motivo->caption() ?></span></td>
        <td data-name="motivo"<?= $Page->motivo->cellAttributes() ?>>
<span id="el_movimientos_stock_motivo">
<span<?= $Page->motivo->viewAttributes() ?>>
<?= $Page->motivo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fecha->Visible) { // fecha ?>
    <tr id="r_fecha"<?= $Page->fecha->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_movimientos_stock_fecha"><?= $Page->fecha->caption() ?></span></td>
        <td data-name="fecha"<?= $Page->fecha->cellAttributes() ?>>
<span id="el_movimientos_stock_fecha">
<span<?= $Page->fecha->viewAttributes() ?>>
<?= $Page->fecha->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_movimientos_stock_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_movimientos_stock_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
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
