function new_blog() {
    var url = 'dashboard/blog/load';
    location.href = site + url;
}
function edit_blog(course_id) {
    var url = 'dashboard/blog/load/' + course_id;
    location.href = site + url;
}
function cancel_blog() {
    var url = 'dashboard/blog';
    location.href = site + url;
}
function delete_blog(blog_id) {
    bootbox.confirm({
        message: "¿Confirma que desea eliminar el Blog?",
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
                    url: site + "dashboard/blog/delete",
                    dataType: "json",
                    data: {blog_id: blog_id},
                    success: function (data) {
                        if (data.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Blog Eliminado',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.setTimeout(function () {
                                window.location = site + "dashboard/blog";
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
function upload_img2(){
  var input = document.getElementById('image_file2').value;
    if(input != null){
        $("#respose_img2").html();
            var texto = "";
            texto = texto+'Seleccionado: ';
            texto = texto+ input;
            $("#respose_img2").html(texto);
            $("#label_img2").removeClass("invalid").addClass("valid");
    }else{
        $("#label_img2").removeClass("valid").addClass("invalid");
    }
}

