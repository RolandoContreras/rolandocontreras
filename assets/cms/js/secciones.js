function validate_section() {
    oData = new FormData(document.forms.namedItem("form-section"));
    $.ajax({
        url: site + "dashboard/secciones/validate",
        method: "POST",
        data: oData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            var res = JSON.parse(data);
            if (res.status == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Cambios Guardado',
                    footer: res.message,
                    showConfirmButton: false,
                    timer: 2500
                });
                window.setTimeout(function () {
                    window.location = site + "dashboard/secciones";
                }, 1500);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Ups! Sucedio un error ',
                    footer: res.message
                });
            }
        }
    });
}
function new_section() {
    var url = 'dashboard/secciones/load';
    location.href = site + url;
}
function edit_section(category_id) {
    var url = 'dashboard/secciones/load/' + category_id;
    location.href = site + url;
}
function cancel_section() {
    var url = 'dashboard/secciones';
    location.href = site + url;
}
function delete_section(category_id) {
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
                    url: site + "dashboard/secciones/delete",
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
function upload_img() {
    var input = document.getElementById('image_file').value;
    if (input != null) {
        $("#respose_img").html();
        var texto = "";
        texto = texto + 'Seleccionado: ';
        texto = texto + input;
        $("#respose_img").html(texto);
        $("#label_img").removeClass("invalid").addClass("valid");
    } else {
        $("#label_img").removeClass("valid").addClass("invalid");
    }
}
