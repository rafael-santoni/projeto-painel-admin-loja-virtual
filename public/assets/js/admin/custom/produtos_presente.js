$(document).ready(function() {

    var check_presente = $(".check-presente");

    check_presente.on("click", function(event) {

        event.preventDefault();

        var id = $(this).attr("data-id");

        $.ajax({
            url: "/adminProdutosPresente",
            type: "post",
            data: "id="+id,
            success: function(retorno) {

                if(retorno == "updated") {                    
                    swal("Atualizado", "O status foi alterado", "success");
                }

                setTimeout(function() {
                    location.reload();
                },1500);
                
            }
        });

    });

});