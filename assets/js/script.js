$(document).ready(function(){

    $('#auth').submit(send);
    $('#reg').submit(send);
    $('#update').submit(send);
    $('#del').submit(send);

    function send(e) {
        e.preventDefault();
        var $form = $(this);

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            dataType: 'json',
            data: $form.serialize()
        }).done(function(data) {
            if(data.status){
                window.location.href = "/";
            }
            else{
                console.log(data);
            }
        }).fail(function() {
            console.log('fail');
        });
    }

});