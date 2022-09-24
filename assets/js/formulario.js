$(document).ready(function(){
    $(document).on('submit','#formulario',function(event){
        event.preventDefault();
        var dados=$(this).serialize();

        $.ajax({
            url: 'cadastro.php',
            method: 'post',
            dataType: 'html',
            data: dados,
            success: function(data){
                $('#resultado').html(data);
            }
        });
    });
});