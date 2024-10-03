$(document).ready(function() {

    var content = $('.content');
    var btn_listar_pedidos = content.find('.btn-listar-pedidos');

    btn_listar_pedidos.on('click', function(event) {

        event.preventDefault();

        var id = $(this).attr('data-id');

        $.ajax({
            url: '/adminPedidosProdutos',
            data: 'id='+id,
            type: 'post',
            dataType: 'json',
            success: function (retorno) {

                console.log(retorno);
                
                
            }
        });
        
    });

});