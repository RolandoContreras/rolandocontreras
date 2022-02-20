function save(){
    titulo_home = document.getElementById("titulo_home").value;
    description_home = CKEDITOR.instances.description_home.getData();
    boton_home = document.getElementById("boton_home").value;
    titulo_cursos = document.getElementById("titulo_cursos").value;
    boton_cursos = document.getElementById("boton_cursos").value;
    titulo_boletin = document.getElementById("titulo_boletin").value;
    description_boletin = CKEDITOR.instances.description_boletin.getData();
    boton_boletin = document.getElementById("boton_boletin").value;
    nosotros_footer = document.getElementById("nosotros_footer").value;
    text_nosotros_footer = CKEDITOR.instances.text_nosotros_footer.getData();
    titulo_contacto_footer = document.getElementById("titulo_contacto_footer").value;
    email_footer = document.getElementById("email_footer").value;
    phone_footer = CKEDITOR.instances.phone_footer.getData();
    address_footer = CKEDITOR.instances.address_footer.getData();
    bootbox.confirm({
    message: "¿Confirma que desea guardar los cambios?",
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
        if(result == true){
            $.ajax({
                   type: "post",
                   url: site+"dashboard/textos/inicio/validate",
                   dataType: "json",
                   data: {titulo_home : titulo_home,
                          description_home : description_home,
                          boton_home : boton_home,
                          titulo_cursos : titulo_cursos,
                          boton_cursos : boton_cursos,
                          titulo_boletin : titulo_boletin,
                          description_boletin : description_boletin,
                          boton_boletin:boton_boletin,
                          nosotros_footer : nosotros_footer,
                          text_nosotros_footer : text_nosotros_footer,
                          titulo_contacto_footer : titulo_contacto_footer,
                          email_footer : email_footer,
                          phone_footer : phone_footer,
                          address_footer : address_footer,
                },
                   success:function(data){                             
                     if(data.status == true){
                           Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              title: 'Texto Cambiado.',
                              showConfirmButton: false,
                              timer: 1500
                            });
                            setTimeout('document.location.reload()',1500);
                       }else{
                           Swal.fire({
                              icon: 'error',
                              title: 'Ups...',
                              text: 'Sucedió un error',
                            });
                       }
                   }         
           });
        }
    }
    });
}
function save_contacto(){
    titulo_contacto = document.getElementById("titulo_contacto").value;
    web = document.getElementById("web").value;
    titulo_mensaje = document.getElementById("titulo_mensaje").value;
    boton_contacto = document.getElementById("boton_contacto").value;
    bootbox.confirm({
    message: "¿Confirma que desea guardar los cambios?",
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
        if(result == true){
            $.ajax({
                   type: "post",
                   url: site+"dashboard/textos/contacto/validate",
                   dataType: "json",
                   data: {titulo_contacto : titulo_contacto,
                          web : web,
                          titulo_mensaje : titulo_mensaje,
                          boton_contacto : boton_contacto
                },
                   success:function(data){                             
                     if(data.status == true){
                           Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              title: 'Texto Cambiado.',
                              showConfirmButton: false,
                              timer: 1500
                            });
                            setTimeout('document.location.reload()',1500);
                       }else{
                           Swal.fire({
                              icon: 'error',
                              title: 'Ups...',
                              text: 'Sucedió un error',
                            });
                       }
                   }         
           });
        }
    }
    });
}