function validate_points() {
    var point_id = document.getElementById("point_id").value;
    var point = document.getElementById("point").value;
    var status_value = document.getElementById("status_value").value;
    $.ajax({
        type: "post",
        url: site + "dashboard/puntos/validate",
        dataType: "json",
        data: {point_id: point_id,
            point: point,
            status_value: status_value
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
                    window.location = site + "dashboard/puntos";
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

function edit_points(binaries_id){    
     var url = 'dashboard/puntos/load/'+binaries_id;
     location.href = site+url;   
}
function cancel_points(){
	var url= 'dashboard/puntos';
	location.href = site+url;
}
function delete_points(point_id) {
    bootbox.confirm({
        message: "¿Confirma que desea eliminar los puntos?",
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
                    url: site + "dashboard/puntos/delete",
                    dataType: "json",
                    data: {point_id: point_id},
                    success: function (data) {
                        if (data.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Puntos eliminados',
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

