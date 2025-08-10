<?php

namespace PHPMaker2025\project1;

// Page object
$CooperativasView = &$Page;
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
<form name="fcooperativasview" id="fcooperativasview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { cooperativas: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fcooperativasview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcooperativasview")
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
<input type="hidden" name="t" value="cooperativas">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cooperativas_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_cooperativas_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nombre->Visible) { // nombre ?>
    <tr id="r_nombre"<?= $Page->nombre->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cooperativas_nombre"><?= $Page->nombre->caption() ?></span></td>
        <td data-name="nombre"<?= $Page->nombre->cellAttributes() ?>>
<span id="el_cooperativas_nombre">
<span<?= $Page->nombre->viewAttributes() ?>>
<?= $Page->nombre->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->direccion->Visible) { // direccion ?>
    <tr id="r_direccion"<?= $Page->direccion->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cooperativas_direccion"><?= $Page->direccion->caption() ?></span></td>
        <td data-name="direccion"<?= $Page->direccion->cellAttributes() ?>>
<span id="el_cooperativas_direccion">
<span<?= $Page->direccion->viewAttributes() ?>>
<?= $Page->direccion->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->telefono->Visible) { // telefono ?>
    <tr id="r_telefono"<?= $Page->telefono->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cooperativas_telefono"><?= $Page->telefono->caption() ?></span></td>
        <td data-name="telefono"<?= $Page->telefono->cellAttributes() ?>>
<span id="el_cooperativas_telefono">
<span<?= $Page->telefono->viewAttributes() ?>>
<?= $Page->telefono->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->email->Visible) { // email ?>
    <tr id="r_email"<?= $Page->email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cooperativas_email"><?= $Page->email->caption() ?></span></td>
        <td data-name="email"<?= $Page->email->cellAttributes() ?>>
<span id="el_cooperativas_email">
<span<?= $Page->email->viewAttributes() ?>>
<?= $Page->email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cooperativas_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_cooperativas_created_at">
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
