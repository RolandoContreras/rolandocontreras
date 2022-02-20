function masterclass() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    $.ajax({
        type: "post",
        url: site + "paso2",
        dataType: "json",
        data: {name: name,
            email: email},
        success: function (data) {
            document.getElementById("reservar_boton").innerHTML = "...";
            if (data.status == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Felicidades',
                    showConfirmButton: false,
                    timer: 1500
                });
                window.setTimeout(function () {
                    window.location = site + "gracias";
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
function masterclass2() {
    var name = document.getElementById("name2").value;
    var email = document.getElementById("email2").value;
    $.ajax({
        type: "post",
        url: site + "paso2",
        dataType: "json",
        data: {name: name,
            email: email},
        success: function (data) {
            document.getElementById("reservar_boton2").innerHTML = "...";
            if (data.status == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Felicidades',
                    showConfirmButton: false,
                    timer: 1500
                });
                window.setTimeout(function () {
                    window.location = site + "gracias";
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