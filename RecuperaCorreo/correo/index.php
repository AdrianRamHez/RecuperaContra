<?php

$errores = '';
$enviado = '';

if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $email = $_POST['correo'];
    
    if(!empty($nombre)){
        $nombre = trim($nombre);
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    }else {
        $errores .= 'Por favor ingrese un nombre <br>';
    }
 
    if(!empty($email)){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errores .= 'Por favor ingrese un correo valido <br>';
        }
    }else{
        $errores .= 'Por favor ingrese un correo <br>';
    }

        if(!$errores){
            try{
                if(isset($_POST['correo']) && !empty($_POST['correo'])){
                    $pass = substr( md5(microtime()), 1, 10);
                    $passwor = md5($pass);
                    $mail = $_POST['correo'];
                    
                    //Conexion con la base
                    $conn = new mysqli("localhost", "id14306552_root", "A*1uno2dos3tres", "id14306552_bdalumno");
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 
                    //cunsulta a ejecutar
                    $sql = "Update tbl_user Set password='$passwor' Where correo='$mail'";
        
                    if ($conn->query($sql) === TRUE) {
                        $enviado = true;
                        //echo "usuario modificado correctamente ";
                    } else {
                        echo "Error modificando: " . $conn->error;
                    }
                    
                    $to = $_POST['correo'];//"destinatario@email.com";
                    $from = "From: " . "Farel";
                    $subject = "Recuperar contraseña";
                    $message = "El sistema le asigno su nueva contraseña: " . $pass;
        
                    mail($to, $subject, $message, $from);
                    echo 'Correo enviado satisfactoriamente a ' . $_POST['correo'];
                }
            }
            catch (Exception $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            }
    }
}

require 'view/viecorreo.php';
?>