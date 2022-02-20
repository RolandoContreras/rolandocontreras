function validate_teacher() {
    var customer_id = document.getElementById("customer_id").value;
    var name = document.getElementById("name").value;
    var last_name = document.getElementById("last_name").value;
    var password = document.getElementById("password").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var bio = document.getElementById("bio").value;
    var facebook = document.getElementById("facebook").value;
    var twitter = document.getElementById("twitter").value;
    var instagram = document.getElementById("instagram").value;
    var google = document.getElementById("google").value;
    var pais = document.getElementById("pais").value;
    var active = document.getElementById("active").value;
    $.ajax({
        type: "post",
        url: site + "dashboard/clientes/validate",
        dataType: "json",
        data: {customer_id: customer_id,
            name: name,
            last_name: last_name,
            password: password,
            email: email,
            phone: phone,
            bio: bio,
            pais: pais,
            facebook: facebook,
            twitter: twitter,
            instagram: instagram,
            google: google,
            active: active
        },
        success: function (data) {
            if (data.status == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Cambios Guardado',
                    showConfirmButton: false,
                    timer: 1500
                });
                window.setTimeout(function () {
                    window.location = site + "dashboard/clientes";
                }, 1500);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Sucedio un error',
                    footer: 'Comunique a soporte'
                });
            }
        }
    });
}
function edit_teacher(teacher_id) {
    var url = 'dashboard/instructores/load/' + teacher_id;
    location.href = site + url;
}
function cancelar_teacher() {
    var url = 'dashboard/instructores';
    location.href = site + url;
}
function delete_teacher(customer_id) {
    bootbox.confirm({
        message: "¿Confirma que desea eliminar al cliente?",
        buttons: {
            confirm: {
                label: 'Confirmar',
                className: 'btn-success'
            },
            cancel: {
                label: 'Cerrar',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result == true) {
                $.ajax({
                    type: "post",
                    url: site + "dashboard/instructores/delete",
                    dataType: "json",
                    data: {customer_id: customer_id},
                    success: function (data) {
                        if (data.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Cliente fue eliminado',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Sucedio un error',
                                footer: 'Comunique a soporte'
                            });
                        }
                    }
                });
            }
        }
    });
}
function upload_img(){
  var input = document.getElementById('image_file').value;
    if(input != null){
        $("#respose_img").html();
            var texto = "";
            texto = texto+'Seleccionado: ';
            texto = texto+ input;
            $("#respose_img").html(texto);
            $("#label_img").removeClass("invalid").addClass("valid");
    }else{
        $("#label_img").removeClass("valid").addClass("invalid");
    }
}
