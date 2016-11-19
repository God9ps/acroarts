
$(document).ready(function() {

    var tbl_aulas = $('#tbl_aulas').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Portuguese.json"
        },
        "order": [0, 'asc'],
        "scrollX": true,
        "bScrollCollapse": true,
        "bRetrieve": true,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Todas"]],
        "iDisplayLength": 5,
        "bProcessing": true,
        "sAjaxSource": "pages/aulas/tratarAulas.php?acao=preencherTabela",

        "aoColumns": [

            {mData: 'aula'},

            {mData: 'mensalidade'},

            {mData: 'functions'}
        ],
        "oLanguage": {
            "oPaginate": {
                "sFirst":       "<i class='fa fa-caret-left' aria-hidden='true'></i>",
                "sPrevious":    "",
                "sNext":        "",
                "sLast":        "<i class='fa fa-caret-right' aria-hidden='true'></i>"
            },
            "sSearch": "Pesquisar",
            "sLengthMenu":    "Registos por página: _MENU_",
            "sInfo":          "Total de _TOTAL_ registos (Mostrar _START_ até _END_)",
            "sInfoFiltered":  "(filtrados _MAX_ registos)"
        }
    });

    $("#tbl_aulas_length").addClass('hidden-xs');
    $("#tbl_aulas_info").addClass('hidden-xs');
    $("span[name='legenda']").addClass('hidden-xs');



    $('#tbl_aulas tbody').on('click', '.editarAula', function () {

        var id = $(this).attr('id');

        $.ajax({
            url: 'pages/aulas/formEditarAulas.php',
            type: 'post',
            data: {id: id },
            success: function(result){

                $(".modal-header .modal-title").html("<b> Editar aula </b>");
                $(".modal-body").html(result);
                $(".modal-footer").html('<button type="button" data-id="'+id+'" id="apagar_aula" class="btn btn-sm btn-warning apagar_aula pull-left" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar aula</button> <button type="button" data-id="'+id+'" id="editar_aula" class="btn btn-sm btn-primary editar_aula" data-dismiss="modal"><i class="fa fa-pencil" aria-hidden="true"></i> Alterar</button> <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>');
                $('#modal_editar_aula').modal('show');
            }
        });
    });

    $('#modal_editar_aula .modal-footer').on('click', '.apagar_aula', function () {

        var id = $(this).attr('data-id');

        $.ajax({
            url: 'pages/aulas/tratarAulas.php?acao=apagarAula',
            type: 'post',
            data: {id: id },
            success: function(result){
                $.notify("Aula eliminada !","success");
                tbl_aulas.ajax.reload(null,false);
            }
        });
    });

    $("#modal_editar_aula").on('click', '.editar_aula', function () {
        var id = $(this).attr('data-id');
        $("#form_editar_aula").ajaxSubmit({
            url: 'pages/aulas/tratarAulas.php?acao=editarAula',
            data: {id: id},
            beforeSubmit: function () {

            },
            error: function () {

            },
            uploadProgress: function (evento, posicao, total, completo) {

            },
            success: function (result) {
                $.notify("Aula alterara com sucesso","success");

                console.log(result);
            },
            complete: function () {
                tbl_aulas.ajax.reload(null,false);
            }
        });
    });



    $('#tbl_aulas tbody').on('click', '.activarAula', function () {
        var valor = $(this).val();
        var id = $(this).attr('id');

        $.ajax({
            type: "post",
            url: "pages/aulas/tratarAulas.php?acao=desactivarAulas",
            data: {id:id, activo: valor},
            success: function (result) {

                if (valor == 1 && result != null) {
                    $.notify("Aula desativada","success");
                    tbl_aulas.ajax.reload(null, false);
                }else if (valor == 0 && result != null){
                    $.notify("Aula activada","success");
                    tbl_aulas.ajax.reload(null, false);
                }else{
                    $.notify("Impossivel realizar acção","warning");
                    tbl_aulas.ajax.reload(null, false);
                }
                tbl_aulas.ajax.reload(null, false);

            }
        });
    });


    $("#inserir_aula").click(function () {

            $("#form_inserir_aula").ajaxSubmit({
                url: 'pages/aulas/tratarAulas.php?acao=inserirAula',

                beforeSubmit: function () {

                },
                error: function () {

                },
                uploadProgress: function (evento, posicao, total, completo) {

                },
                success: function (result) {
                    $.notify("Aula inserida com sucesso","success");

                },
                complete: function () {
                    tbl_aulas.ajax.reload(null,false);
                }

            });
        // });
    });

    // $('#tbl_aulas tbody').on('click', '.editar_aula', function () {
    //
    //     var id = $(this).attr('data-id');
    //     console.log("data id : " + id);
    //     $("#form_editar_aula").ajaxSubmit({
    //      url: 'pages/aulas/tratarAulas.php?acao=editarAula',
    //
    //      beforeSubmit: function () {
    //
    //      },
    //      error: function () {
    //
    //      },
    //      uploadProgress: function (evento, posicao, total, completo) {
    //
    //      },
    //      success: function (result) {
    //      $.notify("Aula alterara com sucesso","success");
    //
    //      console.log(result);
    //      },
    //      complete: function () {
    //      tbl_aulas.ajax.reload(null,false);
    //      }
    //
    //      });
    //
    // });
});


