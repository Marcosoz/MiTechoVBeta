<?php

namespace PHPMaker2025\project1;

// Page object
$HorasTrabajadasEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fhoras_trabajadasedit" id="fhoras_trabajadasedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { horas_trabajadas: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fhoras_trabajadasedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fhoras_trabajadasedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["socio_id", [fields.socio_id.visible && fields.socio_id.required ? ew.Validators.required(fields.socio_id.caption) : null, ew.Validators.integer], fields.socio_id.isInvalid],
            ["fecha", [fields.fecha.visible && fields.fecha.required ? ew.Validators.required(fields.fecha.caption) : null, ew.Validators.datetime(fields.fecha.clientFormatPattern)], fields.fecha.isInvalid],
            ["horas", [fields.horas.visible && fields.horas.required ? ew.Validators.required(fields.horas.caption) : null, ew.Validators.float], fields.horas.isInvalid],
            ["tarea", [fields.tarea.visible && fields.tarea.required ? ew.Validators.required(fields.tarea.caption) : null], fields.tarea.isInvalid],
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
<input type="hidden" name="t" value="horas_trabajadas">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->getFormOldKeyName() ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_horas_trabajadas_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_horas_trabajadas_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->getEditValue()))) ?>"></span>
<input type="hidden" data-table="horas_trabajadas" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->socio_id->Visible) { // socio_id ?>
    <div id="r_socio_id"<?= $Page->socio_id->rowAttributes() ?>>
        <label id="elh_horas_trabajadas_socio_id" for="x_socio_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->socio_id->caption() ?><?= $Page->socio_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->socio_id->cellAttributes() ?>>
<span id="el_horas_trabajadas_socio_id">
<input type="<?= $Page->socio_id->getInputTextType() ?>" name="x_socio_id" id="x_socio_id" data-table="horas_trabajadas" data-field="x_socio_id" value="<?= $Page->socio_id->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->socio_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->socio_id->formatPattern()) ?>"<?= $Page->socio_id->editAttributes() ?> aria-describedby="x_socio_id_help">
<?= $Page->socio_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->socio_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fecha->Visible) { // fecha ?>
    <div id="r_fecha"<?= $Page->fecha->rowAttributes() ?>>
        <label id="elh_horas_trabajadas_fecha" for="x_fecha" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fecha->caption() ?><?= $Page->fecha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fecha->cellAttributes() ?>>
<span id="el_horas_trabajadas_fecha">
<input type="<?= $Page->fecha->getInputTextType() ?>" name="x_fecha" id="x_fecha" data-table="horas_trabajadas" data-field="x_fecha" value="<?= $Page->fecha->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->fecha->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->fecha->formatPattern()) ?>"<?= $Page->fecha->editAttributes() ?> aria-describedby="x_fecha_help">
<?= $Page->fecha->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fecha->getErrorMessage() ?></div>
<?php if (!$Page->fecha->ReadOnly && !$Page->fecha->Disabled && !isset($Page->fecha->EditAttrs["readonly"]) && !isset($Page->fecha->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["fhoras_trabajadasedit", "datetimepicker"], function () {
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
        "fhoras_trabajadasedit",
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
<?php if ($Page->horas->Visible) { // horas ?>
    <div id="r_horas"<?= $Page->horas->rowAttributes() ?>>
        <label id="elh_horas_trabajadas_horas" for="x_horas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->horas->caption() ?><?= $Page->horas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->horas->cellAttributes() ?>>
<span id="el_horas_trabajadas_horas">
<input type="<?= $Page->horas->getInputTextType() ?>" name="x_horas" id="x_horas" data-table="horas_trabajadas" data-field="x_horas" value="<?= $Page->horas->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->horas->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->horas->formatPattern()) ?>"<?= $Page->horas->editAttributes() ?> aria-describedby="x_horas_help">
<?= $Page->horas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->horas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tarea->Visible) { // tarea ?>
    <div id="r_tarea"<?= $Page->tarea->rowAttributes() ?>>
        <label id="elh_horas_trabajadas_tarea" for="x_tarea" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tarea->caption() ?><?= $Page->tarea->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tarea->cellAttributes() ?>>
<span id="el_horas_trabajadas_tarea">
<input type="<?= $Page->tarea->getInputTextType() ?>" name="x_tarea" id="x_tarea" data-table="horas_trabajadas" data-field="x_tarea" value="<?= $Page->tarea->getEditValue() ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->tarea->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tarea->formatPattern()) ?>"<?= $Page->tarea->editAttributes() ?> aria-describedby="x_tarea_help">
<?= $Page->tarea->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tarea->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_horas_trabajadas_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_horas_trabajadas_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="horas_trabajadas" data-field="x_created_at" value="<?= $Page->created_at->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["fhoras_trabajadasedit", "datetimepicker"], function () {
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
        "fhoras_trabajadasedit",
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fhoras_trabajadasedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fhoras_trabajadasedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("horas_trabajadas");
});
</script>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
