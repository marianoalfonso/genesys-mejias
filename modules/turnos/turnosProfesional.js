// cada vez que carga la pagina, se ejecuta document.ready y ejecuta la opcion 4
// asignando a la tablaUsuarios el select de la tabla
$(document).ready(function() {
    var user_id, opcion;
    opcion = 4;
        
    tablaUsuarios = $('#example').DataTable({  
        "ajax":{            
            "url": "turnosProfesionalCrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "id"},
            {"data": "dni"},
            {"data": "title"},
            {"data": "description"},
            {"data": "start"},
            {"data": "end"},
            {"data": "estado"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-light btn-sm btnEditar'><img src='../../assets/icons/editar.png' alt='modificar'></button><button class='btn btn-light btn-sm btnBorrar'><img src='../../assets/icons/borrar.png' alt='borrar'></button><button class='btn btn-success btn-sm btnCerrar'><img src='../../assets/icons/editar.png' alt='modificar'></button><button class='btn btn-light btn-sm btnCerrar'><img src='../../assets/icons/cerrar.png' alt='cerrar'></button></div></div>"}
        ]
    });
    // tratando de colorear la tabla
    tablaUsuarios.on("init", function(){
        // alert('fuera del for');
        for(var i = 0; i < tablaUsuarios.rows().count(); i++) {
            var row = tablaUsuarios.row(i);
            // console.log(row);
            // alert('fuera del if');
            if(title == "Messi Lionel") {
                // alert('dentro del if');
                $(row.node()).css("background-color","#FF0000");   
                alert();    
            }
        }
    });

    // capturo el click del boton btnEditar
    $(document).on("click", ".btnEditar", function(){		
        opcion = 2;//editar
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        const url = "turnosProfesionalEdit.php?id=" + encodeURIComponent(id);
        window.location.href = url;
    });

    // capturo el click del boton btnBorrar
    $(document).on("click", ".btnBorrar", function(){		        
        opcion = 3;//editar
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        var respuesta = confirm("¿Está seguro de borrar el paciente seleccionado ?");                
            if (respuesta) { 
                const url = "turnosProfesionalDelete.php?id=" + encodeURIComponent(id);
                window.location.href = url;
            }
    });

    // capturo el click del boton btnCerrar
    $(document).on("click", ".btnCerrar", function(){		        
        opcion = 3;//editar
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        const url = "turnosProfesionalClose.php?id=" + encodeURIComponent(id);
        window.location.href = url;
    });







    var fila; //captura la fila, para editar o eliminar
    //submit para el Alta y Actualización
    $('#formPersona').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        apellido = $.trim($('#apellido').val());    
        nombre = $.trim($('#nombre').val());
        dni = $.trim($('#dni').val());
        direccion = $.trim($('#direccion').val());
            $.ajax({
              url: "crud.php",
              type: "POST",
              datatype:"json",    
              data:  {apellido:apellido, nombre:nombre, dni:dni, direccion:direccion, opcion:opcion},    
              success: function(data) {
                // tablaPersonas.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');											     			
    });


//para limpiar los campos antes de dar de Alta una Persona
$("#btnNuevo").click(function(){
    opcion = 1; //alta           
    user_id=null;
    $("#formUsuarios").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("alta de paciente");
    $('#modalCRUD').modal('show');	    
});

//Editar        
// $(document).on("click", ".btnEditar", function(){		        
//     opcion = 2;//editar
//     fila = $(this).closest("tr");
//     var respuesta = confirm("¿Está seguro de editar el registro "+user_id+"?"); 	        
//     id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
//     apellido = fila.find('td:eq(1)').text();
//     nombre = fila.find('td:eq(2)').text();
//     dni = fila.find('td:eq(3)').text();
//     direccion = fila.find('td:eq(4)').text();
//     $("#apellido").val(apellido);
//     $("#nombre").val(nombre);
//     $("#dni").val(dni);
//     $("#direccion").val(direccion);
//     $(".modal-header").css("background-color", "#007bff");
//     $(".modal-header").css("color", "white" );
//     $(".modal-title").text("Editar Usuario");		
//     $('#modalCRUD').modal('show');		   
// });




//Borrar
// $(document).on("click", ".btnBorrar", function(){
//     fila = $(this);           
//     idPersona = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;
//     opcion = 3; //eliminar        
//     var respuesta = confirm("¿Está seguro de borrar el paciente seleccionado ?");                
//     if (respuesta) {            
//         $.ajax({
//           url: "crud.php",
//           type: "POST",
//           datatype:"json",    
//           data:  {opcion:opcion, user_id:idPersona},    
//           success: function() {
//               tablaUsuarios.row(fila.parents('tr')).remove().draw();                  
//            }
//         });	
//     }
//  });
     


});    