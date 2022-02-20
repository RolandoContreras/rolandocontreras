function validate_tag() {
    var tag_id = document.getElementById("tag_id").value;
    var name = document.getElementById("name").value;
    var active = document.getElementById("active").value;
    $.ajax({
        type: "post",
        url: site + "dashboard/tags/validate",
        dataType: "json",
        data: {tag_id: tag_id,
            name: name,
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
                    window.location = site + "dashboard/tags";
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
function new_tag() {
    var url = 'dashboard/tags/load';
    location.href = site + url;
}
function edit_tag(tag_id) {
    var url = 'dashboard/tags/load/' + tag_id;
    location.href = site + url;
}
function cancel_tag() {
    var url = 'dashboard/tags';
    location.href = site + url;
}
function delete_tag(tag_id) {
    bootbox.confirm({
        message: "¿Confirma que desea eliminar el Tag?",
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
                    url: site + "dashboard/tags/delete",
                    dataType: "json",
                    data: {tag_id: tag_id},
                    success: function (data) {
                        if (data.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'El Tag fue eliminado',
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
