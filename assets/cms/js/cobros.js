function validate_pagos() {
    var pay_id = document.getElementById("pay_id").value;
    var amount = document.getElementById("amount").value;
    var status_value = document.getElementById("status_value").value;
    $.ajax({
        type: "post",
        url: site + "dashboard/pagos/validate",
        dataType: "json",
        data: {pay_id: pay_id,
            amount: amount,
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
                    window.location = site + "dashboard/pagos";
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
function edit_pay(pay_id){
        var url= 'dashboard/pagos/load/'+pay_id;
	location.href = site+url;
}
function cancel_pay(){
        var url= 'dashboard/pagos';
	location.href = site+url;
}
function delete_pay(pay_id) {
    bootbox.confirm({
        message: "¿Confirma que desea eliminar el cobro?",
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
                    url: site + "dashboard/pagos/delete",
                    dataType: "json",
                    data: {pay_id: pay_id},
                    success: function (data) {
                        if (data.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'El Cobro fue eliminado',
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
