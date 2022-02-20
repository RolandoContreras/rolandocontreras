function validate_category() {
    var category_id = document.getElementById("category_id").value;
    var name = document.getElementById("name").value;
    var active = document.getElementById("active").value;
    $.ajax({
        type: "post",
        url: site + "dashboard/categorias/validate",
        dataType: "json",
        data: {category_id: category_id,
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
                    window.location = site + "dashboard/categorias";
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
function new_category() {
    var url = 'dashboard/categorias/load';
    location.href = site + url;
} 
function edit_category(category_id) {
    var url = 'dashboard/categorias/load/' + category_id;
    location.href = site + url;
}
function cancel_category() {
    var url = 'dashboard/categorias';
    location.href = site + url;
}
function delete_category(category_id) {
    bootbox.confirm({
        message: "¿Confirma que desea eliminar la categoría?",
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
                    url: site + "dashboard/categorias/delete",
                    dataType: "json",
                    data: {category_id: category_id},
                    success: function (data) {
                        if (data.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Categoría eliminada',
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
