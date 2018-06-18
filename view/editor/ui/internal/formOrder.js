lp.formControls = {};

lp.formControls.field = teacss.ui.composite.extend({
    tpl_label: function (val) {
        var star_required, show_desc;
        if (val.required) {star_required = "<i>*</i>"};
        if (val.desc) {show_desc = $('<div class="desc">').text(val.desc)} else {show_desc=""};
        return $('<div class="field_title">').toggleClass('hidden',val.label.trim() ? false:true).text(val.label).append(star_required).add(show_desc);
    }
},{})

lp.formControls.text = lp.formControls.field.extendOptions({
    selectLabel: _t("Text"),
    selectIcon: "fa fa-font",
    tpl: function (val) {
        return $('<div class="form_field">').append(
            $('<label>').append(
                this.tpl_label(val),
                $('<input class="form_field_text" type="text">').attr("placeholder",val.placeholder || ''),
                $('<div class="error">')
            )
        );
    }
},{
    items: [
        _t("Field label"),
        { type: "text", name: "label" },
        _t("Field description"),
        { type: "text", name: "desc" },
        _t("Field placeholder"),
        { type: "text", name: "placeholder" },
        { type: "checkbox", name: "required", label: _t("Is required?"), margin:"0" },
    ]
});

lp.formControls.textarea = lp.formControls.text.extend({
    selectLabel: _t("Text area"),
    selectIcon: "fa fa-bars",
    tpl: function (val) {
        return $('<div class="form_field">').append(
            $('<label>').append(
                this.tpl_label(val),
                $('<textarea class="form_field_textarea" rows="3">').attr("placeholder",val.placeholder || ''),
                $('<div class="error">')
            )
        );
    }
},{});

lp.formControls.file = lp.formControls.text.extend({
    selectLabel: _t("File"),
    selectIcon: "fa fa-paperclip",
    tpl: function (val) {
        return $('<div class="form_field">').append(
            $('<label>').append(
                this.tpl_label(val),
                $('<input class="form_field_file" type="file" multiple="multiple">'),
                $('<div class="error">')
            )
        );
    }
},{});

lp.formControls.select = lp.formControls.field.extendOptions({
    selectLabel: _t("Select"),
    selectIcon: "fa fa-toggle-down",
    default: { options: _t("Option 1\nOption 2\nOption 3") },
    tpl: function (val) {
        var select;
        var ret = $('<div class="form_field">').append(
            $('<label>').append(
                this.tpl_label(val),
                $('<div class="form_field_select_wrap">').append(
                    select =  $('<select class="form_field_select">')
                ),
                $('<div class="error">')
            )
        );
        $.each(val.options.split("\n"),function(){
            select.append($("<option>").text(this));
        });
        return ret;
    }
},{
    items: [
        _t("Field label"),
        { type: "text", name: "label" },
        _t("Field description"),
        { type: "text", name: "desc" },
        _t("Options"),
        { type: "textarea", name: "options", height: 55, width: 448 }
    ]
});

lp.formControls.radio = lp.formControls.select.extend({
    selectLabel: _t("Radio"),
    selectIcon: "fa fa-dot-circle-o",
    tpl: function (val, field) {
        var radio;
        var ret = $('<div class="form_field">').append(
            $('<label>').append(
                this.tpl_label(val),
                radio = $('<div class="form_field_radio_values">'),
                $('<div class="error">')
            )
        );
    
        $.each(val.options.split("\n"),function(){            
            radio.append(
                $('<div class="form_field_radio_value">').append(
                    $('<label>').text(this).prepend('<input name="'+field+'" class="form_field_radio" type="radio" value="'+this+'"/>')
                )
            )            
        });
        $(radio.find("input")[0]).prop("checked",true);
        return ret;
    }
},{});

lp.formControls.checkbox = teacss.ui.composite.extendOptions({
    selectLabel: _t("Checkbox"),
    selectIcon: "fa fa-check-square-o",
    tpl: function (val) {
        return $("<div class='form_field'>").append(
            $('<label>').append(
                '<input class="form_field_checkbox" type="checkbox">',
                '<span class="field_title">'+val.label+'</span>'
            )
        )
    }
},{
    items: [
        _t("Field label"),
        { type: "text", name: "label" }
    ]
});


lp.formOrder = lp.cover.extendOptions({
},{
    change: function(){
        var val = this.getValue();
        var fields_div = this.element.find(".form_fields").empty();
        $.each(val.fields,function(f,field){
            var sub = lp.formControls[field.type];
            fields_div.append(sub.tpl(field,'field_'+f));
        });

        this.element.find(".form_submit .form_field_submit")
            .attr("class","form_field_submit "+val.button.color)
            .find("span").text(val.button.label);
    },
    configForm: {
        title: _t("Form"),
        items: [
            {
                name: "fields", 
                repeaterClass: "lp-field-repeater",
                type:  teacss.ui.repeater.extend({
                    init: function (o) {
                        this._super(o);
                        var me = this;
                        this.addCombo = teacss.ui.combo({
                            label: _t("Add Field"),
                            comboWidth: 300,
                            itemTpl: function (item) {
                                return $("<div>")
                                    .addClass("lp-add-field "+item.sub.selectIcon)
                                    .text(item.sub.selectLabel)
                                    .mousedown(function(){
                                        me.addElement($.extend(
                                            item.sub.default || {},
                                            { type: item.type, label: item.sub.selectLabel }
                                        ));
                                        me.trigger("change");
                                    });
                            },
                            items: function () {
                                var items = [];
                                $.each(lp.formControls,function (key,sub){
                                    if (sub && sub.selectLabel) {
                                        items.push({ value: key, sub: sub, type: key });
                                    }
                                });
                                return items;
                            }
                        });
                        this.addButton.replaceWith(this.addCombo.element);
                    },
                    itemTemplate: function (el) {
                        var ret = this._super(el);
                        var content = ret.find(".ui-repeater-item-content").hide();
                        ret.find(".ui-repeater-item-title").css({cursor:"pointer"})
                        .prepend($("<span>"))
                        .click(function(){
                            var visible = content.is(":visible");
                            ret.parent().find(".ui-repeater-item-content").hide();
                            content.toggle(!visible);
                        });
                        return ret;
                    },                    
                    updateLabel: function (el) {
                        var val = el.getValue();
                        var title = el.itemContainer.find(".ui-repeater-item-title").addClass(lp.formControls[val.type].selectIcon);
                        title.children("span").eq(0).text(val.label || ('['+val.placeholder+']'));
                    },
                    addElement: function (val) {
                        val = val || {};
                        var el = lp.formControls[val.type]();
                        el.setValue(val);
                        var me = this;
                        el.bind("change",function(){
                            me.updateLabel(el);
                            me.trigger("change");
                        });
                        this.push(el);
                        this.updateLabel(el);
                        return el;
                    }
                })
            },
            { type: "label", value: _t("Button text:"), width: "53%", margin: "0 0 5px" },
            { type: "label", value: _t("Button color:"), width: "47%", margin: "0 0 5px" },
            { type: "text", name: "button.label", width: "50%", margin: "0 3% 12px 0" },
            { 
                type: lp.color, name: "button.color", width: "47%", iconSize: 15,
                items: [
                    { value: 'blue', color: '#0187BC' },
                    { value: 'green', color: '#3E9802' },
                    { value: 'orange', color: '#FD6F00' },
                    { value: 'purple', color: '#8C33D2' },
                    { value: 'purple_light', color: '#9581BF' },
                    { value: 'rose', color: '#F372A4' },
                    { value: 'red', color: '#CE0707' },
                    { value: 'yellow', color: '#FFC415' }
                ]
            },
            { 
                type: "button", label: _t("Show success window"), width: 'auto',  margin: "0 0 10px 0px", click: function () {
                    lp.formOrder.showFormSuccess();
                }
            }
        ]
    }
})



