function send_message() {
    document.getElementById("contact_boton").innerHTML = "Enviando...";
    var form = $('#contactForm');
    $.ajax({
        type: "post",
        url: site + "contacto/send_messages",
        dataType: "json",
        data: form.serialize(),
        success: function (data) {
//            var data = JSON.parse(data);
            if (data.status == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Mensaje enviado',
                    footer: 'En breves minutos nos comunicaremos con usted.',
                    showConfirmButton: false,
                    timer: 2500
                });
                window.setTimeout(function () {
                    window.location = site + "contacto";
                }, 1500);
            } else if (data.status == "false2") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Capcha no verificado',
                    showConfirmButton: false,
                    timer: 1000
                });
                window.setTimeout(function () {
                    window.location = site + "contacto";
                }, 1000);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Sucedio un error',
                    footer: 'Intente Nuevamente'
                });
            }
        }
    });

}
grecaptcha.ready(function () {
    grecaptcha.execute('6Ld1reMZAAAAAH7vlrl4cRnb9LMmKaNF-5v3GeHl', {action: 'homepage'})
            .then(function (token) {
                $('#google-response-token').val(token);
            });
});
