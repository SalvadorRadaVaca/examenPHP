$(document).ready(function() {
    $('#agregar').on('click', function(e) {
        e.preventDefault();
        agregarDatos();
    });

    $('#modificar').on('click', function(e) {
        e.preventDefault();
        editarDatos();
    });
});

function agregarDatos() {
    var datos = $('#frm_registrar').serialize();

    $.ajax({
        method: "POST",
        url: "../seccion/crear.php",
        data: datos,
        success: function(response) {
            if(response) {
                alert("Los datos se registraron correctamente");
            } else {
                alert("Error al insertar los datos");
            }
        }
    });
    return false;
}

function editarDatos() {
    var datos = $('#frm_registrar').serialize();

    $.ajax({
        method: "POST",
        url: "../seccion/editar.php",
        data: datos,
        success: function(response) {
            if(!response) {
                alert("Los datos se actualizaron correctamente");
            } else {
                alert("Error al actualizar los datos");
            }
        }
    });
    return false;
}