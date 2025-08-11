<?php

namespace PHPMaker2025\project1;

// Page object
$CooperativasDelete = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { cooperativas: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fcooperativasdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcooperativasdelete")
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
<form name="fcooperativasdelete" id="fcooperativasdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cooperativas">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_cooperativas_id" class="cooperativas_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nombre->Visible) { // nombre ?>
        <th class="<?= $Page->nombre->headerCellClass() ?>"><span id="elh_cooperativas_nombre" class="cooperativas_nombre"><?= $Page->nombre->caption() ?></span></th>
<?php } ?>
<?php if ($Page->departamento->Visible) { // departamento ?>
        <th class="<?= $Page->departamento->headerCellClass() ?>"><span id="elh_cooperativas_departamento" class="cooperativas_departamento"><?= $Page->departamento->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ciudad->Visible) { // ciudad ?>
        <th class="<?= $Page->ciudad->headerCellClass() ?>"><span id="elh_cooperativas_ciudad" class="cooperativas_ciudad"><?= $Page->ciudad->caption() ?></span></th>
<?php } ?>
<?php if ($Page->direccion->Visible) { // direccion ?>
        <th class="<?= $Page->direccion->headerCellClass() ?>"><span id="elh_cooperativas_direccion" class="cooperativas_direccion"><?= $Page->direccion->caption() ?></span></th>
<?php } ?>
<?php if ($Page->telefono->Visible) { // telefono ?>
        <th class="<?= $Page->telefono->headerCellClass() ?>"><span id="elh_cooperativas_telefono" class="cooperativas_telefono"><?= $Page->telefono->caption() ?></span></th>
<?php } ?>
<?php if ($Page->email->Visible) { // email ?>
        <th class="<?= $Page->email->headerCellClass() ?>"><span id="elh_cooperativas_email" class="cooperativas_email"><?= $Page->email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_cooperativas_created_at" class="cooperativas_created_at"><?= $Page->created_at->caption() ?></span></th>
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
<?php if ($Page->nombre->Visible) { // nombre ?>
        <td<?= $Page->nombre->cellAttributes() ?>>
<span id="">
<span<?= $Page->nombre->viewAttributes() ?>>
<?= $Page->nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->departamento->Visible) { // departamento ?>
        <td<?= $Page->departamento->cellAttributes() ?>>
<span id="">
<span<?= $Page->departamento->viewAttributes() ?>>
<?= $Page->departamento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ciudad->Visible) { // ciudad ?>
        <td<?= $Page->ciudad->cellAttributes() ?>>
<span id="">
<span<?= $Page->ciudad->viewAttributes() ?>>
<?= $Page->ciudad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->direccion->Visible) { // direccion ?>
        <td<?= $Page->direccion->cellAttributes() ?>>
<span id="">
<span<?= $Page->direccion->viewAttributes() ?>>
<?= $Page->direccion->getViewValue() ?></span>
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
