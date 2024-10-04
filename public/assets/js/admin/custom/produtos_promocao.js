$(document).ready(function() {

    var btn_promocao = $(".btn-promocao");
    var btn_tirar_promocao = $(".btn-tirar-promocao");

    btn_promocao.on("click", function(event) {

        event.preventDefault();

        var id = $(this).attr("data-id");
        var td = $(this).closest("td");

        var input = "<input type='text' data-id='"+id+"' class='input-promocao' /><button class='btn btn-xs btn-success btn-colocar-promocao'>Colocar</button>";

        td.html(input);
        
        
    });

    $(".row-promocao").on("click", ".btn-colocar-promocao", function(event) {

        event.preventDefault();

        var td = $(this).closest("td");
        var id = td.find(".input-promocao").attr("data-id");
        var input_promocao = td.find(".input-promocao").val();

        if(input_promocao.length <= 0) {

            swal("Alerta!", "Você precisa colocar um valor para a promoção", "warning");

            return false;

        }

        $.ajax({
            url: "/adminProdutosPromocao",
            type: "post",
            data: "id="+id+"&valor="+input_promocao,
            success: function (retorno) {

                if(retorno == "updated") {
                    swal("Atualizado", "Você colocou o produto em promoção pelo valor de R$ "+input_promocao, "success");
                }

                setTimeout(function() {
                    location.reload();
                },1500);

            }
        });

    });

    btn_tirar_promocao.on("click", function(event) {

        event.preventDefault();

        var id = $(this).attr("data-id");        

        $.ajax({
            url: "/adminProdutosPromocao",
            type: "post",
            data: "id="+id,
            success: function (retorno) {                

                if(retorno == "updated") {                    
                    swal("Atualizado", "Você tirou o produto da promoção", "success");
                }

                setTimeout(function() {
                    location.reload();
                },1500);

            }
        });        
        
    });

});