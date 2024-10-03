$(document).ready(function() {

    var btn_promocao = $(".btn-promocao");

    btn_promocao.on("click", function(event) {

        event.preventDefault();

        var id = $(this).attr("data-id");
        var td = $(this).closest("td");

        var input = "<input type='text' data-id='"+id+"' class='input-promocao' /><button class='btn btn-xs btn-success btn-colocar-promocao'>Colocar</button>";

        td.html(input);
        
        
    });

    $(".row-promocao").on("click", ".btn-colocar-promocao", function(event) {

        event.preventDefault();

        alert('Ativar a promoção');
        
        
    });

});