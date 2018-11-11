
//ejemplo:: http://brolik.com/blog/how-to-create-a-jquery-plugin/


(function($, window, document, undefined) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.fn.modalHandler = function(options) {

        // Establish our default settings
        var settings = $.extend({
            path : '',
            fileNameId : '',
            documentId : '',
        }, options);

        this.each(function(key, inputAttr) {
            new $.showModal($(this), settings);
            new $.hiddenModal($(this), settings);
            new $.clickButtonAceptar($(this), settings);
        });

        return;

    };

    $.showModal = function(context, settings) {
        context.on('show.bs.modal', function (event) {
            //var button = $(event.relatedTarget); // Button that triggered the modal
            context.find('.modal-body').load(settings.path, function(responseText, statusText, xhr)
            {

            });
        });

        // allow jQuery chaining
        return this;
    };

    $.hiddenModal = function(context, settings) {
        context.on('hidden.bs.modal', function (e) {
            context.find('.modal-body').html('');
        });

        // allow jQuery chaining
        return this;
    };

    $.clickButtonAceptar = function(context, settings) {

        return context.find('#btn-aceptar').click(onClick);
        function onClick(){

            var radioValue = context.find('#radio-value').val();
            new $.setData(context, settings, radioValue);
            context.modal('hide');

            // allow jQuery chaining
            return this;

        }

        // allow jQuery chaining
        return this;
    };

    $.setData = function(context, settings, radioValue) {

        var arr = radioValue.split('#');
        var fileId = arr[0];
        var fileName = arr[1];

        $('#' + settings.documentId).find('option:selected').removeAttr('selected');
        $('#' + settings.documentId + ' option[value=' + fileId + ']').attr('selected','selected');
        $('#' + settings.fileNameId).val(fileName);

        console.log('setData radioValue :: ' + radioValue);
        console.log('setData fileId :: ' + fileId);
        console.log('setData fileName :: ' + fileName);


        // allow jQuery chaining
        return this;
    };

    $.clearData = function(context, settings) {

        $('#' + settings.fileNameId).val();

        // allow jQuery chaining
        return this;
    };

}(jQuery, window, document));

