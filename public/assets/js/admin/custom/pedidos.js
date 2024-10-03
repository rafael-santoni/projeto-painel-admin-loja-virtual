$(document).ready(function() {

    var content = $(".content");
    var btn_listar_pedidos = content.find(".btn-listar-pedidos");

    btn_listar_pedidos.on("click", function(event) {

        event.preventDefault();

        var id = $(this).attr("data-id");

        $.ajax({
            url: "/adminPedidosProdutos",
            data: "id="+id,
            type: "post",
            dataType: "json",
            success: function (retorno) {

                // console.log(retorno);

                var produtos = "";

                produtos += "<table class='table table-striped'>";

                    produtos += "<thead>";
                        produtos += "<tr>";
                            produtos += "<td>Produto</td>";
                            produtos += "<td>Quantidade</td>";
                            produtos += "<td>Valor</td>";
                        produtos += "</tr>";    
                    produtos += "</thead>";
                        
                    produtos += "<tbody>";
                    $.each(retorno.produtos, function (key, value) {
                        produtos += "<tr>";
                            produtos += "<td>"+value.produto_nome+"</td>";
                            produtos += "<td>"+retorno.quantidade[value.id]+"</td>";
                            produtos += "<td>"+value.produto_valor+"</td>";
                        produtos += "</tr>";
                    });
                    produtos += "</tbody>";

                produtos += "</table>";

                swal({
                    title: "Produtos do pedido",
                    text: produtos,
                    html: true
                });
                
                
            }
        });
        
    });

});