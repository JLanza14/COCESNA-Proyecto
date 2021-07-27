var CodigoUsuarioActualizar;//guarda el codigo del usuario que se va actualizar

$(document).ready(
    function(){
	$("#btn-GuardarUsuario").click(
        function(){
           var nombreUsuario = $("#txtNombreUsuario").val();
           var contrasenia = $("#txtContrasenia").val();
           var correo = $("#txtCorreo").val();
           var nombrePersonal = $("#txtNombrePersonal").val();
           var apellidoPersonal = $("#txtApellidosPersonal").val();
           var sexo = $("#txtSexo").val();
           var numEmpleado = $("#txtNumEmpleado").val();
           var fechaNacimiento = $("#dte-fecha-nacimiento").val();
           var fechaIngreso = $("#dte-fecha-ingreso").val();
           var TipoUsuario = $("#tipo-usuario").val()

            if(nombreUsuario==""
              ||contrasenia==""||correo==""
              ||nombrePersonal==""||apellidoPersonal==""
              ||sexo==""||numEmpleado==""){
 
             if(nombreUsuario==""){
                $("#mensaje1").fadeIn();
                
             }else{
                $("#mensaje1").fadeOut();
             }
             if(contrasenia==""||!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(contrasenia)){
                $("#mensaje2").fadeIn();
                
             }else{
                $("#mensaje2").fadeOut();
             }
             if(correo==""||!/[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/.test(correo)){
                $("#mensaje3").fadeIn();
                
             }else{
                $("#mensaje3").fadeOut();
             }
             if(nombrePersonal==""){
                $("#mensaje4").fadeIn();
                
             }else{
                $("#mensaje4").fadeOut();
             }
             if(apellidoPersonal==""){
                $("#mensaje5").fadeIn();
                
             }else{
                $("#mensaje5").fadeOut();
             }
             if(sexo==""){
                $("#mensaje6").fadeIn();
                
             }else{
                $("#mensaje6").fadeOut();
             }
             if(numEmpleado==""){
                $("#mensaje7").fadeIn();
                
             }else{
                $("#mensaje7").fadeOut();
             }
 
           } else{

           var nuevoPersonal ="txtNombrePersonal="+$("#txtNombrePersonal").val()+
                               "&txtApellidosPersonal="+$("#txtApellidosPersonal").val()+
                               "&dte-fecha-nacimiento="+$("#dte-fecha-nacimiento").val()+
                               "&dte-fecha-ingreso="+$("#dte-fecha-ingreso").val()+
                               "&txtSexo="+$("#txtSexo").val()+
                               "&txtNumEmpleado="+$("#txtNumEmpleado").val()+
                               "&txtNombreUsuario="+$("#txtNombreUsuario").val()+
                               "&txtContrasenia="+$("#txtContrasenia").val()+
                               "&txtCorreo="+$("#txtCorreo").val()+
                               "&tipo-usuario="+$("#tipo-usuario").val();
           $.ajax({
             data:nuevoPersonal,
             url: "ajax/acciones.php?accion=10",
             method: "POST",
             success:function(Usuario){
                    alert("Usuario Registrado con exito");
                    window.location.reload();
                  
             },

             error:function(){
                alert("No se registro el Usuario");
             }
           }) 

}
         })

         
});

function logInUsuario(){
	var datos = "usuario="+$("#user").val()+"&"+
			    "contrasena="+$("#pass").val();
	var nombre = $("#user").val()  	
	$.ajax({
			url:"ajax/json.php?accion=3",
			method: "POST",
			data: datos,
			dataType: 'json',
			success:function(resultado){
					if(resultado.nombre_usuario == nombre && resultado.posicion == 1){
						location.href ="pregunta_clave.php";
					}else if(resultado.nombre_usuario == nombre && resultado.posicion == 2){
            location.href ="index_supervisor.php";
          }else if(resultado.nombre_usuario == nombre && resultado.posicion == 3){
            location.href ="reportes.php";
          }else if(resultado.nombre_usuario == nombre && resultado.posicion == 4){
						location.href ="index_admin.php";
					}

			},

             error:function(){
                $("#mensaje1").fadeIn();
             }
		})
} 

function eliminarUsuario(id){
  var eliminarUsuario = "id= " + id;
  $.ajax({
    url:"ajax/acciones.php?accion=9",
    method:"POST",
    data: eliminarUsuario,
    success:function(resultado){
        alert("Usuario eliminado con exito")
        window.location.reload();
      },
      error:function(){
    }
  }) 
}

//Obtener el usuario que se va Actualizar y los datos
actualizarUsuario = function(idUsuario){
  CodigoUsuarioActualizar=idUsuario;
  var info = "idUsuario= " + idUsuario;
  $.ajax({
  url:"ajax/json.php?accion=4",
    data: info,
    method: "POST",
    dataType: 'json',
    success:function(resultado){
        $("#txteditarNombreUsuario").val(resultado.username);
        $("#txteditarCorreo").val(resultado.email);
        $("#txteditarNombrePersonal").val(resultado.nombres);
        $("#txteditarApellidosPersonal").val(resultado.apellidos);
        $("#txteditarNumeroEmpleado").val(resultado.no_empleado);
      }
  });  
}

$("#btn-EditarUsuario").click(
  function(){

     var nombreUsuario = $("#txteditarNombreUsuario").val();
     var correo = $("#txteditarCorreo").val();
     var numEmpleado = $("#txteditarNumeroEmpleado").val();
     var nombres = $("#txteditarNombrePersonal").val();
     var apellidos = $("#txteditarApellidosPersonal").val();

     if(nombreUsuario==""||correo==""
              ||nombres==""||apellidos==""
              ||numEmpleado==""){
 
             if(nombreUsuario==""){
                $("#mensaje8").fadeIn();
                
             }else{
                $("#mensaje8").fadeOut();
             }
             if(correo==""||!/[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/.test(correo)){
                $("#mensaje9").fadeIn();
                
             }else{
                $("#mensaje9").fadeOut();
             }
             if(nombres==""){
                $("#mensaje11").fadeIn();
                
             }else{
                $("#mensaje11").fadeOut();
             }
             if(apellidos==""){
                $("#mensaje12").fadeIn();
                
             }else{
                $("#mensaje12").fadeOut();
             }
             if(numEmpleado==""){
                $("#mensaje10").fadeIn();
                
             }else{
                $("#mensaje10").fadeOut();
             }
 
           } else{

     var ActualizarUser ="txteditarNombreUsuario="+$("#txteditarNombreUsuario").val()+
                         "&txteditarCorreo="+$("#txteditarCorreo").val()+
                         "&txteditarNumeroEmpleado="+$("#txteditarNumeroEmpleado").val()+
                         "&txteditarNombrePersonal="+$("#txteditarNombrePersonal").val()+
                         "&txteditarApellidosPersonal="+$("#txteditarApellidosPersonal").val()+
                         "&CodigoUsuarioActualizar="+CodigoUsuarioActualizar+
                         "&txteditarSexo="+$("#txteditarSexo").val()+
                         "&dte-editarfecha-nacimiento="+$("#dte-editarfecha-nacimiento").val()+
                         "&dte-editarfecha-act="+$("#dte-editarfecha-act").val()+
                         "&tipo-usuarioEditar="+$("#tipo-usuarioEditar").val();

     $.ajax({
       data:ActualizarUser,
       url: "ajax/acciones.php?accion=11",
       method: "POST",
       success:function(Usuario){
              alert("Usuario Actualizado con exito");
              window.location.reload();
            
       },

       error:function(){
          alert("No se Actualizo el Usuario");
       }
     }) 
   }
});

$("#btn-revisionUsuario").click(
  function(){

     var nombreUsuario = $("#txtUserH").val();
 
     var RevisionUser ="txtUserH="+$("#txtUserH").val();

     $.ajax({
       data:RevisionUser,
       url: "ajax/json.php?accion=5",
       method: "POST",
       dataType: 'json',
       success:function(resultado){
              //alert("Usuario Actualizado con exito");
              if(resultado.username == nombreUsuario){
              $("#mensaje1").fadeOut();
              location.href ="pregunta_clave_supervisor.php?UserH="+$("#txtUserH").val();;
              }else{
              $("#mensaje1").fadeIn();}
            
       },

       error:function(){
          alert("No se encontro el usuario");
          $("#mensaje1").fadeIn();
       }
     }) 
});




