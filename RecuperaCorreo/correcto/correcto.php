<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recupera de contraseña</title>
    </head>
    <body>
        
        <form action="index.php" method="POST">
            <input type="text" name="email" value="" placeholder="email" /> <br/>
            <input type="submit" value="Recordar contraseña" />
        </form>
        
        <?php
        
		try{
			if(isset($_POST['email']) && !empty($_POST['email'])){
                $pass = substr( md5(microtime()), 1, 10);
                $mail = $_POST['email'];
                
                //Conexion con la base
                $conn = new mysqli("localhost", "root", "123456", "bdclases");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
                //cunsulta a ejecutar
                $sql = "Update mh_tbl_user Set password='$pass' Where correo='$mail'";

                if ($conn->query($sql) === TRUE) {
                    echo "usuario modificado correctamente ";
                } else {
                    echo "Error modificando: " . $conn->error;
                }
                
               /* $to = $_POST['email'];//"destinatario@email.com";
                $from = "From: " . "Farel";
                $subject = "Recuperar contraseña";
                $message = "El sistema le asigno la siguiente clave " . $pass;

                mail($to, $subject, $message, $from);
                echo 'Correo enviado satisfactoriamente a ' . $_POST['email'];*/
            }
            else 
                echo 'Informacion incompleta';
		}
		catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
            
        ?>
    </body>
</html>