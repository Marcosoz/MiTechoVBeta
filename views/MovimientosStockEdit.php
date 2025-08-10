<?php

namespace PHPMaker2025\project1;

// Page object
$MovimientosStockEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fmovimientos_stockedit" id="fmovimientos_stockedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { movimientos_stock: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fmovimientos_stockedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmovimientos_stockedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["stock_id", [fields.stock_id.visible && fields.stock_id.required ? ew.Validators.required(fields.stock_id.caption) : null, ew.Validators.integer], fields.stock_id.isInvalid],
            ["tipo_movimiento", [fields.tipo_movimiento.visible && fields.tipo_movimiento.required ? ew.Validators.required(fields.tipo_movimiento.caption) : null], fields.tipo_movimiento.isInvalid],
            ["cantidad", [fields.cantidad.visible && fields.cantidad.required ? ew.Validators.required(fields.cantidad.caption) : null, ew.Validators.float], fields.cantidad.isInvalid],
            ["motivo", [fields.motivo.visible && fields.motivo.required ? ew.Validators.required(fields.motivo.caption) : null], fields.motivo.isInvalid],
            ["fecha", [fields.fecha.visible && fields.fecha.required ? ew.Validators.required(fields.fecha.caption) : null, ew.Validators.datetime(fields.fecha.clientFormatPattern)], fields.fecha.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid]
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
            "tipo_movimiento": <?= $Page->tipo_movimiento->toClientList($Page) ?>,
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
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="movimientos_stock">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->getFormOldKeyName() ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_movimientos_stock_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_movimientos_stock_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->getEditValue()))) ?>"></span>
<input type="hidden" data-table="movimientos_stock" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stock_id->Visible) { // stock_id ?>
    <div id="r_stock_id"<?= $Page->stock_id->rowAttributes() ?>>
        <label id="elh_movimientos_stock_stock_id" for="x_stock_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stock_id->caption() ?><?= $Page->stock_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->stock_id->cellAttributes() ?>>
<span id="el_movimientos_stock_stock_id">
<input type="<?= $Page->stock_id->getInputTextType() ?>" name="x_stock_id" id="x_stock_id" data-table="movimientos_stock" data-field="x_stock_id" value="<?= $Page->stock_id->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->stock_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->stock_id->formatPattern()) ?>"<?= $Page->stock_id->editAttributes() ?> aria-describedby="x_stock_id_help">
<?= $Page->stock_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->stock_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tipo_movimiento->Visible) { // tipo_movimiento ?>
    <div id="r_tipo_movimiento"<?= $Page->tipo_movimiento->rowAttributes() ?>>
        <label id="elh_movimientos_stock_tipo_movimiento" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tipo_movimiento->caption() ?><?= $Page->tipo_movimiento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tipo_movimiento->cellAttributes() ?>>
<span id="el_movimientos_stock_tipo_movimiento">
<template id="tp_x_tipo_movimiento">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="movimientos_stock" data-field="x_tipo_movimiento" name="x_tipo_movimiento" id="x_tipo_movimiento"<?= $Page->tipo_movimiento->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_tipo_movimiento" class="ew-item-list"></div>
<selection-list hidden
    id="x_tipo_movimiento"
    name="x_tipo_movimiento"
    value="<?= HtmlEncode($Page->tipo_movimiento->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_tipo_movimiento"
    data-target="dsl_x_tipo_movimiento"
    data-repeatcolumn="5"
    class="form-control<?= $Page->tipo_movimiento->isInvalidClass() ?>"
    data-table="movimientos_stock"
    data-field="x_tipo_movimiento"
    data-value-separator="<?= $Page->tipo_movimiento->displayValueSeparatorAttribute() ?>"
    <?= $Page->tipo_movimiento->editAttributes() ?>></selection-list>
<?= $Page->tipo_movimiento->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tipo_movimiento->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cantidad->Visible) { // cantidad ?>
    <div id="r_cantidad"<?= $Page->cantidad->rowAttributes() ?>>
        <label id="elh_movimientos_stock_cantidad" for="x_cantidad" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cantidad->caption() ?><?= $Page->cantidad->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cantidad->cellAttributes() ?>>
<span id="el_movimientos_stock_cantidad">
<input type="<?= $Page->cantidad->getInputTextType() ?>" name="x_cantidad" id="x_cantidad" data-table="movimientos_stock" data-field="x_cantidad" value="<?= $Page->cantidad->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->cantidad->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->cantidad->formatPattern()) ?>"<?= $Page->cantidad->editAttributes() ?> aria-describedby="x_cantidad_help">
<?= $Page->cantidad->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cantidad->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->motivo->Visible) { // motivo ?>
    <div id="r_motivo"<?= $Page->motivo->rowAttributes() ?>>
        <label id="elh_movimientos_stock_motivo" for="x_motivo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->motivo->caption() ?><?= $Page->motivo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->motivo->cellAttributes() ?>>
<span id="el_movimientos_stock_motivo">
<input type="<?= $Page->motivo->getInputTextType() ?>" name="x_motivo" id="x_motivo" data-table="movimientos_stock" data-field="x_motivo" value="<?= $Page->motivo->getEditValue() ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->motivo->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->motivo->formatPattern()) ?>"<?= $Page->motivo->editAttributes() ?> aria-describedby="x_motivo_help">
<?= $Page->motivo->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->motivo->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fecha->Visible) { // fecha ?>
    <div id="r_fecha"<?= $Page->fecha->rowAttributes() ?>>
        <label id="elh_movimientos_stock_fecha" for="x_fecha" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fecha->caption() ?><?= $Page->fecha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fecha->cellAttributes() ?>>
<span id="el_movimientos_stock_fecha">
<input type="<?= $Page->fecha->getInputTextType() ?>" name="x_fecha" id="x_fecha" data-table="movimientos_stock" data-field="x_fecha" value="<?= $Page->fecha->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->fecha->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->fecha->formatPattern()) ?>"<?= $Page->fecha->editAttributes() ?> aria-describedby="x_fecha_help">
<?= $Page->fecha->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fecha->getErrorMessage() ?></div>
<?php if (!$Page->fecha->ReadOnly && !$Page->fecha->Disabled && !isset($Page->fecha->EditAttrs["readonly"]) && !isset($Page->fecha->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["fmovimientos_stockedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker(
        "fmovimientos_stockedit",
        "x_fecha",
        ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options),
        {"inputGroup":true}
    );
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_movimientos_stock_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_movimientos_stock_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="movimientos_stock" data-field="x_created_at" value="<?= $Page->created_at->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["fmovimientos_stockedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker(
        "fmovimientos_stockedit",
        "x_created_at",
        ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options),
        {"inputGroup":true}
    );
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmovimientos_stockedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmovimientos_stockedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
<?php
$Page->showPageFooter();
?>
<script<?= Nonce() ?>>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("movimientos_stock");
});
</script>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
