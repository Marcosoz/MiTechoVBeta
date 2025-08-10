<?php

namespace PHPMaker2025\project1;

// Page object
$StockView = &$Page;
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
<form name="fstockview" id="fstockview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { stock: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fstockview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fstockview")
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
<input type="hidden" name="t" value="stock">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_stock_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nombre_material->Visible) { // nombre_material ?>
    <tr id="r_nombre_material"<?= $Page->nombre_material->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_nombre_material"><?= $Page->nombre_material->caption() ?></span></td>
        <td data-name="nombre_material"<?= $Page->nombre_material->cellAttributes() ?>>
<span id="el_stock_nombre_material">
<span<?= $Page->nombre_material->viewAttributes() ?>>
<?= $Page->nombre_material->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unidad->Visible) { // unidad ?>
    <tr id="r_unidad"<?= $Page->unidad->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_unidad"><?= $Page->unidad->caption() ?></span></td>
        <td data-name="unidad"<?= $Page->unidad->cellAttributes() ?>>
<span id="el_stock_unidad">
<span<?= $Page->unidad->viewAttributes() ?>>
<?= $Page->unidad->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cantidad->Visible) { // cantidad ?>
    <tr id="r_cantidad"<?= $Page->cantidad->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_cantidad"><?= $Page->cantidad->caption() ?></span></td>
        <td data-name="cantidad"<?= $Page->cantidad->cellAttributes() ?>>
<span id="el_stock_cantidad">
<span<?= $Page->cantidad->viewAttributes() ?>>
<?= $Page->cantidad->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->descripcion->Visible) { // descripcion ?>
    <tr id="r_descripcion"<?= $Page->descripcion->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stock_descripcion"><?= $Page->descripcion->caption() ?></span></td>
        <td data-name="descripcion"<?= $Page->descripcion->cellAttributes() ?>>
<span id="el_stock_descripcion">
<span<?= $Page->descripcion->viewAttributes() ?>>
<?= $Page->descripcion->getViewValue() ?></span>
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
