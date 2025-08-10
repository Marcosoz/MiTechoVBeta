<?php

namespace PHPMaker2025\project1;

// Page object
$StockAdd = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { stock: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fstockadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fstockadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["nombre_material", [fields.nombre_material.visible && fields.nombre_material.required ? ew.Validators.required(fields.nombre_material.caption) : null], fields.nombre_material.isInvalid],
            ["unidad", [fields.unidad.visible && fields.unidad.required ? ew.Validators.required(fields.unidad.caption) : null], fields.unidad.isInvalid],
            ["cantidad", [fields.cantidad.visible && fields.cantidad.required ? ew.Validators.required(fields.cantidad.caption) : null, ew.Validators.float], fields.cantidad.isInvalid],
            ["descripcion", [fields.descripcion.visible && fields.descripcion.required ? ew.Validators.required(fields.descripcion.caption) : null], fields.descripcion.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)
                    // Your custom validation code in JAVASCRIPT here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
        })
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
<form name="fstockadd" id="fstockadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="stock">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->getFormOldKeyName() ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nombre_material->Visible) { // nombre_material ?>
    <div id="r_nombre_material"<?= $Page->nombre_material->rowAttributes() ?>>
        <label id="elh_stock_nombre_material" for="x_nombre_material" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nombre_material->caption() ?><?= $Page->nombre_material->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nombre_material->cellAttributes() ?>>
<span id="el_stock_nombre_material">
<input type="<?= $Page->nombre_material->getInputTextType() ?>" name="x_nombre_material" id="x_nombre_material" data-table="stock" data-field="x_nombre_material" value="<?= $Page->nombre_material->getEditValue() ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nombre_material->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nombre_material->formatPattern()) ?>"<?= $Page->nombre_material->editAttributes() ?> aria-describedby="x_nombre_material_help">
<?= $Page->nombre_material->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nombre_material->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->unidad->Visible) { // unidad ?>
    <div id="r_unidad"<?= $Page->unidad->rowAttributes() ?>>
        <label id="elh_stock_unidad" for="x_unidad" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unidad->caption() ?><?= $Page->unidad->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unidad->cellAttributes() ?>>
<span id="el_stock_unidad">
<input type="<?= $Page->unidad->getInputTextType() ?>" name="x_unidad" id="x_unidad" data-table="stock" data-field="x_unidad" value="<?= $Page->unidad->getEditValue() ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->unidad->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->unidad->formatPattern()) ?>"<?= $Page->unidad->editAttributes() ?> aria-describedby="x_unidad_help">
<?= $Page->unidad->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->unidad->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cantidad->Visible) { // cantidad ?>
    <div id="r_cantidad"<?= $Page->cantidad->rowAttributes() ?>>
        <label id="elh_stock_cantidad" for="x_cantidad" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cantidad->caption() ?><?= $Page->cantidad->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cantidad->cellAttributes() ?>>
<span id="el_stock_cantidad">
<input type="<?= $Page->cantidad->getInputTextType() ?>" name="x_cantidad" id="x_cantidad" data-table="stock" data-field="x_cantidad" value="<?= $Page->cantidad->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->cantidad->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->cantidad->formatPattern()) ?>"<?= $Page->cantidad->editAttributes() ?> aria-describedby="x_cantidad_help">
<?= $Page->cantidad->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cantidad->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->descripcion->Visible) { // descripcion ?>
    <div id="r_descripcion"<?= $Page->descripcion->rowAttributes() ?>>
        <label id="elh_stock_descripcion" for="x_descripcion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->descripcion->caption() ?><?= $Page->descripcion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->descripcion->cellAttributes() ?>>
<span id="el_stock_descripcion">
<input type="<?= $Page->descripcion->getInputTextType() ?>" name="x_descripcion" id="x_descripcion" data-table="stock" data-field="x_descripcion" value="<?= $Page->descripcion->getEditValue() ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->descripcion->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->descripcion->formatPattern()) ?>"<?= $Page->descripcion->editAttributes() ?> aria-describedby="x_descripcion_help">
<?= $Page->descripcion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->descripcion->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fstockadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fstockadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
?>
<script<?= Nonce() ?>>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("stock");
});
</script>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
