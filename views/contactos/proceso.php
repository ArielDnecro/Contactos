<?php 


$email = isset($_POST['correo']) ? $_POST['correo'] : null;

$errores = array();


//Pregunta si está llegando una petición por POST, lo que significa que el usuario envió el formulario.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

/////////////////////////////////////////////////////////////////////////////////////////////

   //Valida que el campo email no esté vacío.
if (!validaRequerido($email)) { $errores[] = 'El campo email esta vacio.'; }
////////////////////////////////////////////////////////////////////////////////////////////////////
   //Valida que el campo email sea correcto.
if (!validaEmail($email)) {$errores[] = 'El campo email es incorrecto.'; }

////////////////////////////////////////////////////////////////////////////////////////////////////

//Verifica si ha encontrado errores y de no haber redirige a la página con el mensaje de que pasó la validación.
   if(!$errores){ header('Location: validado.php'); exit; }else{
                foreach ($errores as $error){
                     echo $error."<br>" ;
                 } 
   }
}

 function validaRequerido($valor){
    if(trim($valor) == ''){
       return false;
    }else{
       return true;
    }
 }
 
 function validaEmail($valor){
    if(filter_var($valor, FILTER_VALIDATE_EMAIL) === FALSE){
       return false;
    }else{
       return true;
    }
 }
 
?>