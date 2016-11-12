$(document).ready(function () {
    $('#newsletter').submit(function () {
        var $this     = $(this),
            $response = $('#response'),
            $mail     = $('#signup-email'),
            testmail  = /^[^0-9][A-z0-9._%+-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/,
            hasError  = false;

        $response.find('p').remove();

        if (!testmail.test($mail.val())) {
            $response.html('<p class="error">Por favor entre com um email valido!</p>');
            hasError = true;
        }

        if (hasError === false) {

            $response.find('p').remove();
            $response.addClass('loading');

            $.ajax({
                type: "POST",
                dataType: 'json',
                cache: false,
                url: $this.attr('action'),
                data: $this.serialize()
            }).done(function (data) {
                $response.removeClass('loading');
                $response.html('<p>'+data.message+'</p>');
            }).fail(function() {
                $response.removeClass('loading');
                $response.html('<p>Um erro ocorreu, tente novamente.</p>');
            })
        }


        return false;
    });
});