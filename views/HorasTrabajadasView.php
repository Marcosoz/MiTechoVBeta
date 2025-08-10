<?php

namespace PHPMaker2025\project1;

// Page object
$HorasTrabajadasView = &$Page;
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
<form name="fhoras_trabajadasview" id="fhoras_trabajadasview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { horas_trabajadas: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fhoras_trabajadasview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fhoras_trabajadasview")
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
<input type="hidden" name="t" value="horas_trabajadas">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_horas_trabajadas_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_horas_trabajadas_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->socio_id->Visible) { // socio_id ?>
    <tr id="r_socio_id"<?= $Page->socio_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_horas_trabajadas_socio_id"><?= $Page->socio_id->caption() ?></span></td>
        <td data-name="socio_id"<?= $Page->socio_id->cellAttributes() ?>>
<span id="el_horas_trabajadas_socio_id">
<span<?= $Page->socio_id->viewAttributes() ?>>
<?= $Page->socio_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fecha->Visible) { // fecha ?>
    <tr id="r_fecha"<?= $Page->fecha->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_horas_trabajadas_fecha"><?= $Page->fecha->caption() ?></span></td>
        <td data-name="fecha"<?= $Page->fecha->cellAttributes() ?>>
<span id="el_horas_trabajadas_fecha">
<span<?= $Page->fecha->viewAttributes() ?>>
<?= $Page->fecha->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->horas->Visible) { // horas ?>
    <tr id="r_horas"<?= $Page->horas->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_horas_trabajadas_horas"><?= $Page->horas->caption() ?></span></td>
        <td data-name="horas"<?= $Page->horas->cellAttributes() ?>>
<span id="el_horas_trabajadas_horas">
<span<?= $Page->horas->viewAttributes() ?>>
<?= $Page->horas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tarea->Visible) { // tarea ?>
    <tr id="r_tarea"<?= $Page->tarea->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_horas_trabajadas_tarea"><?= $Page->tarea->caption() ?></span></td>
        <td data-name="tarea"<?= $Page->tarea->cellAttributes() ?>>
<span id="el_horas_trabajadas_tarea">
<span<?= $Page->tarea->viewAttributes() ?>>
<?= $Page->tarea->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_horas_trabajadas_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_horas_trabajadas_created_at">
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
