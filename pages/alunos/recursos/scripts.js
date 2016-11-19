/*

function eliminarProduto(id) {
    $.ajax({
        url: '../backoffice/modulos/loja/tratarProdutos.php?acao=eliminarProduto',
        type: 'post',
        data: {id: id},
        success: function (result) {
            if (result == true) {
                $.notify("Produto eliminado com sucesso","success");
                $('#notificacaoGeralOk').modal('hide');
                tbl_alunos.ajax.reload(null, false);

            } else {
                $.notify("Erro ao eliminar produto","error");
                $('#notificacaoGeralOk').modal('hide');
                tbl_alunos.ajax.reload(null, false);
            }
        }
    });
}
 */

function format ( d ) {
    // `d` is the original data object for the row

    return '<div>'+d.tabela+'</div>';
}




$(document).ready(function() {

    var tbl_alunos = $('#tbl_alunos').DataTable({
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
        "sAjaxSource": "pages/alunos/tratarAlunos.php?acao=preencherTabela",

        "aoColumns": [

            {mData: 'foto'},

            {mData: 'nome'},

            {mData: 'telefone'},

            // {mData: 'mail'},

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

    $("#tbl_alunos_length").addClass('hidden-xs');
    $("#tbl_alunos_info").addClass('hidden-xs');
    $("span[name='legenda']").addClass('hidden-xs');

    $('#tbl_alunos tbody').on('click', '.detail', function () {


        var tr = $(this).closest('tr');
        var row = tbl_alunos.row( tr );

        if ( row.child.isShown() ) {
            $(this).children().removeClass('fa-arrow-circle-up').addClass('fa-arrow-circle-down');
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            $(this).children().removeClass('fa-arrow-circle-down').addClass('fa-arrow-circle-up');
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });


    $('#tbl_alunos tbody').on('click', '.editar', function () {

        var id = $(this).attr('id');

        $.ajax({
            url: 'pages/alunos/formEditarAluno.php',
            type: 'post',
            data: {id: id },
            success: function(result){

                $(".modal-header .modal-title").html("<b> Editar aluno </b>");
                $(".modal-body").html(result);
                $(".modal-footer").html('<button type="button" id="'+id+'" class="apagar_aluno btn btn-sm btn-warning pull-left" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar Aluno</button> <button type="button" id="'+id+'" class="btn btn-sm btn-primary editar_aluno" data-dismiss="modal"><i class="fa fa-check" aria-hidden="true"></i> Alterar</button> <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>');
                $('#modal_editar_aluno').modal('show');
            }
        });
    });

    $('#tbl_alunos tbody').on('click', '.inscrever', function () {

        var id = $(this).attr('id');
        var nome = $(this).attr('name');

        $.ajax({
            url: 'pages/alunos/inscreverAluno.php',
            type: 'post',
            data: {id: id },
            success: function(result){

                $(".modal-header .modal-title").html("<b> Inscrever </b> <h3 style='color:red'>"+nome+"</h3>");
                $(".modal-body").html(result);
                $(".modal-footer").html('<button type="button" id="'+id+'" class="btn btn-sm btn-primary inscrever_aluno" data-dismiss="modal"><i class="fa fa-check" aria-hidden="true"></i> Inscrever</button> <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>');
                $('#modal_editar_aluno').modal('show');
            }
        });
    });

    $('#modal_editar_aluno .modal-footer').on('click', '.editar_aluno', function () {
        var id = $(this).attr('id');
        $("#form_editar_aluno").ajaxSubmit({
            url: 'pages/alunos/tratarAlunos.php?acao=alterarAluno&id='+id,

            beforeSubmit: function () {

            },
            error: function () {

            },
            uploadProgress: function (evento, posicao, total, completo) {

            },
            success: function (result) {
                $.notify("Aluno inserido com sucesso","success");
                tbl_alunos.ajax.reload(null,false);
                console.log(result);
            },
            complete: function () {

            }

        });
        // });
    });

    $('#modal_editar_aluno .modal-footer').on('click', '.apagar_aluno', function () {

        var id = $(this).attr('id');

        $.ajax({
            url: 'pages/alunos/tratarAlunos.php?acao=apagarAluno',
            type: 'post',
            data: {id: id },
            success: function(result){
                $.notify("Aluno eliminado !","success");
                tbl_alunos.ajax.reload(null,false);
            }
        });
    });

    $('#tbl_alunos tbody').on('click', '.activar', function () {
        var valor = $(this).val();
        var id = $(this).attr('id');
        
        $.ajax({
            type: "post",
            url: "pages/alunos/tratarAlunos.php?acao=desactivarAlunos",
            data: {id:id, activo: valor},
            success: function (result) {

                if (valor == 1 && result != null) {
                    $.notify("Aluno desativado","success");
                    tbl_alunos.ajax.reload(null, false);
                }else if (valor == 0 && result != null){
                    $.notify("Aluno activado","success");
                    tbl_alunos.ajax.reload(null, false);
                }else{
                    $.notify("Impossivel realizar acção","warning");
                    tbl_alunos.ajax.reload(null, false);
                }
                tbl_alunos.ajax.reload(null, false);

            }
        });
    });


    $('#modal_editar_aluno .modal-footer').on('click', '.inscrever_aluno', function () {
        var id_aluno = $(this).attr('id');
        $("#form_inscrever_aluno").ajaxSubmit({
            url: 'pages/alunos/tratarAlunos.php?acao=inscreverAluno',
            data: {id_aluno: id_aluno},
            beforeSubmit: function () {

            },
            error: function () {

            },
            uploadProgress: function (evento, posicao, total, completo) {

            },
            success: function (result) {
                $.notify("Aluno inscrito com sucesso","success");
                tbl_alunos.ajax.reload(null,false);
                console.log(result);
            },
            complete: function () {

            }

        });
        // });
    });


    $("#inserir_aluno").click(function () {
        // $("#form_editar_aluno").submit(function (){
            $("#form_editar_aluno").ajaxSubmit({
                url: 'pages/alunos/tratarAlunos.php?acao=inserirAluno',

                beforeSubmit: function () {

                },
                error: function () {

                },
                uploadProgress: function (evento, posicao, total, completo) {

                },
                success: function (result) {
                    $.notify("Aluno inserido com sucesso","success");
                    tbl_alunos.ajax.reload(null,false);
                    console.log(result);
                },
                complete: function () {

                }

            });
        // });
    });


    // $("#inserir_aluno").click(function () {
    //     var formData = new FormData($("form#form_editar_aluno")[0]);
    //
    //     $.ajax({
    //         url: 'pages/alunos/tratarAlunos.php?acao=inserirAluno',
    //         type: 'POST',
    //         data: formData,
    //         async: false,
    //         success: function (data) {
    //             $.notify("Aluno inserido com sucesso","success");
    //             $("#myModal").modal("hide");
    //         },
    //         cache: false,
    //         contentType: false,
    //         processData: false
    //     });
    //
    //     return false;
    // });

});

