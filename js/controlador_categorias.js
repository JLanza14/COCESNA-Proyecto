var CodigoCategoriaActualizar;//guarda el codigo de la categoria que se va a editar
var CodigoPreguntaActualizar;//guarda el codigo de la pregunta que se va a editar

//funcion para agregar una nueva categoria
$(document).ready(
    function(){
	$("#btn-GuardarCat").click(
        function(){
           var nombreCategoria = $("#txtNombreCat").val();
           var descripcionCategoria = $("#txtDescripcionCat").val();

           if(nombreCategoria==""
              ||descripcionCategoria==""){
 
             if(nombreCategoria==""){
                $("#mensaje1").fadeIn();
                
             }else{
                $("#mensaje1").fadeOut();
             }
             if(descripcionCategoria==""){
                $("#mensaje2").fadeIn();
                
             }else{
                $("#mensaje2").fadeOut();
             }
 
           } else{
           var nuevaCategoria ="txtNombreCat="+$("#txtNombreCat").val()+
                               "&txtDescripcionCat="+$("#txtDescripcionCat").val();
           $.ajax({
             data:nuevaCategoria,
             url: "ajax/acciones.php?accion=1",
             method: "POST",
             success:function(Categoria){
                    alert("Categoria Ingresada Con exito");
                    $("#mensaje1").fadeOut();
                    $("#mensaje2").fadeOut();
                    window.location.reload();
                  
             },

             error:function(){
                alert("No se registro el Usuario");
             }
           }) 
          }
         }) 

});

//funcion para guardar preguntas dentro de una categoria
$("#btn-GuardarPreguntaCat").click(
        function(){
           var Pregunta = $("#txtPregunta").val();
           var TipoRespuesta = $("#tipo-respuesta").val();
           var IDCategoria = $("#Categoriaid").val();

           if(Pregunta==""){
 
             if(Pregunta==""){
                $("#mensaje1").fadeIn();
                
             }else{
                $("#mensaje1").fadeOut();
             }
 
           } else{
           var nuevaPregunta ="txtPregunta="+$("#txtPregunta").val()+
                               "&tipo-respuesta="+$("#tipo-respuesta").val()+
                               "&Categoriaid="+$("#Categoriaid").val();
           $.ajax({
             data:nuevaPregunta,
             url: "ajax/acciones.php?accion=2",
             method: "POST",
             success:function(PreguntaCat){
                    alert("Pregunta ingresada con exito");
                    $("#mensaje1").fadeOut();
                    window.location.reload();
             },

             error:function(){
                alert("No se registro el Usuario");
             }
           }) 
         }

});

//Funcion para eliminar preguntas dentro de una categoria
function eliminarPregunta(idPregunta){
  var eliminarPregunta = "idPregunta= " + idPregunta;
  $.ajax({
    url:"ajax/acciones.php?accion=3",
    method:"POST",
    data: eliminarPregunta,
    success:function(resultado){
        alert("pregunta eliminada con exito")
        window.location.reload();
      },
      error:function(){
    }
  }) 
}

//funcion para eliminar categorias y sus preguntas
function eliminarCategoria(idCategoria){
  var eliminarCategoria = "idCategoria= " + idCategoria;
  $.ajax({
    url:"ajax/acciones.php?accion=4",
    method:"POST",
    data: eliminarCategoria,
    success:function(resultado){
        alert("Categoria y sus preguntas asociadas eliminadas con exito")
        window.location.reload();
      },
      error:function(){
    }
  }) 
}

//obtiene datos para modal actualizar, categoria ademas asigna el id de la categoria que se va a actualizar 
actualizarCategoria = function(idCategoria){
  CodigoCategoriaActualizar=idCategoria;
  var info = "idCategoria= " + idCategoria;
  $.ajax({
  url:"ajax/json.php?accion=1",
    data: info,
    method: "POST",
    dataType: 'json',
    success:function(resultado){
        $("#txt-editarNombreCat").val(resultado.nombre_cat);
        $("#txt-editarDescripcionCat").val(resultado.descripcion);
      }
  });  
}

//Actualiza los datos en la base actualizar categoria
$("#btn-editarCat").click(
        function(){

           var nombreCategoria = $("#txt-editarNombreCat").val();
           var descripcionCategoria = $("#txt-editarDescripcionCat").val();

           if(nombreCategoria==""
              ||descripcionCategoria==""){
 
             if(nombreCategoria==""){
                $("#mensaje3").fadeIn();
                
             }else{
                $("#mensaje3").fadeOut();
             }
             if(descripcionCategoria==""){
                $("#mensaje4").fadeIn();
                
             }else{
                $("#mensaje4").fadeOut();
             }
 
           } else{

           var ActualizarCategoria ="txt-editarNombreCat="+$("#txt-editarNombreCat").val()+
                               "&txt-editarDescripcionCat="+$("#txt-editarDescripcionCat").val()+
                               "&CodigoCategoriaActualizar="+CodigoCategoriaActualizar;
           $.ajax({
             data:ActualizarCategoria,
             url: "ajax/acciones.php?accion=5",
             method: "POST",
             success:function(Categoria){
                    alert("Categoria Actualizada con exito");
                    window.location.reload();
                  
             },

             error:function(){
                alert("No se registro el Usuario");
             }
           }) 
          }
});

//obtiene datos para modal actualizar pregunta ademas asigna el ID de la pregunta que se va a actualizar
actualizarPregunta = function(idPregunta){
  CodigoPreguntaActualizar=idPregunta;
  var info = "idPregunta= " + idPregunta;
  $.ajax({
  url:"ajax/json.php?accion=2",
    data: info,
    method: "POST",
    dataType: 'json',
    success:function(resultado){
        $("#txt-editarPregunta").val(resultado.pregunta);
      }
  });  
}

//Actualiza los datos en la base actualizar Pregunta
$("#btn-EditarPreguntaCat").click(
        function(){

           var Pregunta = $("#txt-editarPregunta").val();
           var TipoRespuesta = $("#tipo-respuesta").val();
           var IDCategoria = $("#Categoriaid").val();

             if(Pregunta==""){
 
             if(Pregunta==""){
                $("#mensaje2").fadeIn();
                
             }else{
                $("#mensaje2").fadeOut();
             }
 
           } else{
           var ActualizarPregunta ="txt-editarPregunta="+$("#txt-editarPregunta").val()+
                               "&tipo-respuestaA="+$("#tipo-respuestaA").val()+
                               "&select-categoria="+$("#select-categoria").val()+
                               "&CodigoPreguntaActualizar="+CodigoPreguntaActualizar;
           $.ajax({
             data:ActualizarPregunta,
             url: "ajax/acciones.php?accion=6",
             method: "POST",
             success:function(Pregunta){
                    alert(Pregunta);
                    $("#mensaje2").fadeOut();
                    window.location.reload();
                  
             },

             error:function(){
                alert("No se registro la pregunta");
             }
           }) 
         }

});

//Actualiza la pregunta filtro
$("#btn-actualizarFiltro").click(
        function(){

           var Pregunta = $("#txt-actualizarFiltro").val();
           var IDfiltro = 1;

           if(Pregunta==""){
 
             if(Pregunta==""){
                $("#mensaje1").fadeIn();
                
             }else{
                $("#mensaje1").fadeOut();
             }
 
           } else{

           var ActualizarPreguntafiltro ="txt-actualizarFiltro="+$("#txt-actualizarFiltro").val()+
                                         "&CodigoPreguntaActualizar="+1;
           $.ajax({
             data:ActualizarPreguntafiltro,
             url: "ajax/acciones.php?accion=7",
             method: "POST",
             success:function(Pregunta){
                    alert("Pregunta Actualizada con exito");
                    $("#mensaje1").fadeOut();
                    window.location.reload();
                  
             },

             error:function(){
                alert("No se registro la pregunta");
             }
           }) 
         }

});

//Muesta las preguntas de cada categoria en la encuesta
function mostrarPreguntasCategoria(idCategoria){
  var MPCategoria = "idCategoria= " + idCategoria;
  $.ajax({
    url:"ajax/acciones.php?accion=8",
    method:"POST",
    data: MPCategoria,
    success:function(resultado){
        $("#PreguntasCategoriaX").html(resultado);
      },
      error:function(){
    }
  }) 
}

//Muesta las preguntas de cada categoria en la encuesta
function EjecutarPEncuesta(Superv){
  var Supervisor = "Superv= " + Superv;
  $.ajax({
    url:"ajax/acciones.php?accion=12",
    method:"POST",
    data: Supervisor,
    success:function(resultado){
      },
      error:function(){
        alert("no funciona");
    }
  }) 
}
