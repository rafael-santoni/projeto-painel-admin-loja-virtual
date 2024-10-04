$(document).ready(function() {

    var check_destaque = $(".check-destaque");

    check_destaque.on("click", function(event) {

        event.preventDefault();

        var id = $(this).attr("data-id");

        $.ajax({
            url: "/adminProdutosDestaque",
            type: "post",
            data: "id="+id,
            success: function(retorno) {

                if(retorno == "updated") {                    
                    swal("Atualizado", "Esse preduto foi alterado o destaque", "success");
                }

                setTimeout(function() {
                    location.reload();
                },1500);
                
            }
        });

    });

});