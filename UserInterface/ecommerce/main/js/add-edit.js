"use strict";
$(function() {
// Basic
$('.dropify').dropify();

// Translated
$('.dropify-fr').dropify({
messages: {
default: 'Glissez-déposez un fichier ici ou cliquez',
replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
remove: 'Supprimer',
error: 'Désolé, le fichier trop volumineux'
}
});

// Used events
var drEvent = $('#input-file-events').dropify();

drEvent.on('dropify.beforeClear', function(event, element) {
return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
});

drEvent.on('dropify.afterClear', function(event, element) {
alert('File deleted');
});

drEvent.on('dropify.errors', function(event, element) {
console.log('Has Errors');
});

var drDestroy = $('#input-file-to-destroy').dropify();
drDestroy = drDestroy.data('dropify')
$('#toggleDropify').on('click', function(e) {
e.preventDefault();
if (drDestroy.isDropified()) {
drDestroy.destroy();
} else {
drDestroy.init();
}
})
});

$(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
var radioswitch = function() {
var bt = function() {
$(".radio-switch").on("switch-change", function() {
$(".radio-switch").bootstrapSwitch("toggleRadioState")
}), $(".radio-switch").on("switch-change", function() {
$(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
}), $(".radio-switch").on("switch-change", function() {
$(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
})
};
return {
init: function() {
bt()
}
}
}();
$(function() {
radioswitch.init()
});