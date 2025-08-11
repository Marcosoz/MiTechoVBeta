<?php

namespace PHPMaker2025\project1;

// Page object
$ActividadLogEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="factividad_logedit" id="factividad_logedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { actividad_log: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var factividad_logedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("factividad_logedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["usuario_id", [fields.usuario_id.visible && fields.usuario_id.required ? ew.Validators.required(fields.usuario_id.caption) : null, ew.Validators.integer], fields.usuario_id.isInvalid],
            ["cooperativa_id", [fields.cooperativa_id.visible && fields.cooperativa_id.required ? ew.Validators.required(fields.cooperativa_id.caption) : null, ew.Validators.integer], fields.cooperativa_id.isInvalid],
            ["accion", [fields.accion.visible && fields.accion.required ? ew.Validators.required(fields.accion.caption) : null], fields.accion.isInvalid],
            ["detalles", [fields.detalles.visible && fields.detalles.required ? ew.Validators.required(fields.detalles.caption) : null], fields.detalles.isInvalid],
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
<input type="hidden" name="t" value="actividad_log">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->getFormOldKeyName() ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_actividad_log_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_actividad_log_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->getEditValue()))) ?>"></span>
<input type="hidden" data-table="actividad_log" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->usuario_id->Visible) { // usuario_id ?>
    <div id="r_usuario_id"<?= $Page->usuario_id->rowAttributes() ?>>
        <label id="elh_actividad_log_usuario_id" for="x_usuario_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->usuario_id->caption() ?><?= $Page->usuario_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->usuario_id->cellAttributes() ?>>
<span id="el_actividad_log_usuario_id">
<input type="<?= $Page->usuario_id->getInputTextType() ?>" name="x_usuario_id" id="x_usuario_id" data-table="actividad_log" data-field="x_usuario_id" value="<?= $Page->usuario_id->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->usuario_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->usuario_id->formatPattern()) ?>"<?= $Page->usuario_id->editAttributes() ?> aria-describedby="x_usuario_id_help">
<?= $Page->usuario_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->usuario_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cooperativa_id->Visible) { // cooperativa_id ?>
    <div id="r_cooperativa_id"<?= $Page->cooperativa_id->rowAttributes() ?>>
        <label id="elh_actividad_log_cooperativa_id" for="x_cooperativa_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cooperativa_id->caption() ?><?= $Page->cooperativa_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cooperativa_id->cellAttributes() ?>>
<span id="el_actividad_log_cooperativa_id">
<input type="<?= $Page->cooperativa_id->getInputTextType() ?>" name="x_cooperativa_id" id="x_cooperativa_id" data-table="actividad_log" data-field="x_cooperativa_id" value="<?= $Page->cooperativa_id->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->cooperativa_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->cooperativa_id->formatPattern()) ?>"<?= $Page->cooperativa_id->editAttributes() ?> aria-describedby="x_cooperativa_id_help">
<?= $Page->cooperativa_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cooperativa_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->accion->Visible) { // accion ?>
    <div id="r_accion"<?= $Page->accion->rowAttributes() ?>>
        <label id="elh_actividad_log_accion" for="x_accion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->accion->caption() ?><?= $Page->accion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->accion->cellAttributes() ?>>
<span id="el_actividad_log_accion">
<input type="<?= $Page->accion->getInputTextType() ?>" name="x_accion" id="x_accion" data-table="actividad_log" data-field="x_accion" value="<?= $Page->accion->getEditValue() ?>" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->accion->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->accion->formatPattern()) ?>"<?= $Page->accion->editAttributes() ?> aria-describedby="x_accion_help">
<?= $Page->accion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->accion->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->detalles->Visible) { // detalles ?>
    <div id="r_detalles"<?= $Page->detalles->rowAttributes() ?>>
        <label id="elh_actividad_log_detalles" for="x_detalles" class="<?= $Page->LeftColumnClass ?>"><?= $Page->detalles->caption() ?><?= $Page->detalles->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->detalles->cellAttributes() ?>>
<span id="el_actividad_log_detalles">
<input type="<?= $Page->detalles->getInputTextType() ?>" name="x_detalles" id="x_detalles" data-table="actividad_log" data-field="x_detalles" value="<?= $Page->detalles->getEditValue() ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->detalles->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->detalles->formatPattern()) ?>"<?= $Page->detalles->editAttributes() ?> aria-describedby="x_detalles_help">
<?= $Page->detalles->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->detalles->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_actividad_log_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_actividad_log_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="actividad_log" data-field="x_created_at" value="<?= $Page->created_at->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["factividad_logedit", "datetimepicker"], function () {
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
        "factividad_logedit",
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="factividad_logedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="factividad_logedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("actividad_log");
});
</script>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
