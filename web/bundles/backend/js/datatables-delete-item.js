
//ejemplo:: http://brolik.com/blog/how-to-create-a-jquery-plugin/

(function($, window, document, undefined) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;
    var settings = [];

    $.fn.displayDeleteModal = function(options) {

        // Establish our default settings
        settings = $.extend({
            path : '',
        }, options);

        new $.appendModal();
        new $.hiddenModal();
        new $.clickOpenModal();
        new $.clickDeleteItem();

        // allow jQuery chaining
        return this;

    };

    $.appendModal = function() {
        var modal = '<div class="modal modal-danger" id="modal-delete">' +
            '<div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> ' +
            '<h4 class="modal-title">Delete item <span id="delete-id-span" class="badge bg-red">-</span></h4> </div> ' +
            '<div class="modal-body"> <p>esta seguro?</p> </div> <div class="modal-footer"> ' +
            '<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button> ' +
            '<button id="delete-item" type="button" class="btn btn-outline">Eliminar</button> </div> </div> </div> </div>';

        $('body').append(modal);

        // allow jQuery chaining
        return this;
    };

    $.hiddenModal = function() {
        $(this).on('hidden.bs.modal', function (e) {
            console.log('hiddenModal ;:: ');
        });

        // allow jQuery chaining
        return this;
    };

    $.clickOpenModal = function() {

        $(document).on('click', '.open-modal-delete', function(){
            var idRow = $(this).data('id');
            $('#delete-id-span').html(idRow);
        });

        // allow jQuery chaining
        return this;

    };

    $.clickDeleteItem = function() {

        $(document).on('click', '#delete-item', function(){
            var idRow = $('#delete-id-span').text();

            $.ajax({
                type: 'post',
                url: settings.path,
                data: {
                    'id': idRow
                },
                success: function(data) {
                    var Data = $.parseJSON(data);

                    if(Data.status == 'ok') {
                        $('#modal-delete').modal('hide');
                        $('#id_increment_' + idRow).hide("slow", function () {
                            // Animation complete.
                        });
                    }else if(Data.status == 'access-denied') {
                        alert('Acceso denegado: no tiene permisos para eliminar');
                    }else{
                        alert('no se borro item con id: '+ id);
                    }
                }
            });

        });

        // allow jQuery chaining
        return this;

    };

}(jQuery, window, document));


