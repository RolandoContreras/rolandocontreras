function validate_invoices() {
    var invoice_id = document.getElementById("invoice_id").value;
    var course_id = document.getElementById("course_id").value;
    var total = document.getElementById("total").value;
    var active = document.getElementById("active").value;
    $.ajax({
        type: "post",
        url: site + "dashboard/facturas/validate",
        dataType: "json",
        data: {invoice_id: invoice_id,
            course_id: course_id,
            total: total,
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
                    window.location = site + "dashboard/facturas";
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
function edit_invoices(invoice_id) {
    var url = 'dashboard/facturas/load/' + invoice_id;
    location.href = site + url;
}
function cancelar_invoice() {
    var url = 'dashboard/facturas';
    location.href = site + url;
}
function delete_invoices(invoice_id) {
    bootbox.confirm({
        message: "¿Confirma que desea eliminar la factura?",
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
                    url: site + "dashboard/facturas/delete",
                    dataType: "json",
                    data: {invoice_id: invoice_id},
                    success: function (data) {
                        if (data.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'La factura fue eliminada',
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
