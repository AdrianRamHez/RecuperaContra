<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="UTF-8">
	<title>Recuperar contraseña</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="estilos/escorreo.css">
</head>
<body>
    <div class="wrap">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

        <div align="center">
        <img src="logo.jpg" width="200" height="200">
        </div>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php if(!$enviado && isset($nombre)) echo $nombre?>">

        <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo" value="<?php if(!$enviado && isset($email)) echo $email?>">
 
        <?php if(!empty($errores)):?>
            <div class="alert error">
                <?php echo $errores;?>
            </div>
        <?php elseif($enviado):?>
            <div class="alert success">
                <p>Enviado Correctamente</p>
            </div>
        <?php endif ?>

        <input type="submit" name="submit" class="btn btn-primary" value="Enviar Correo">
        </form>
    </div>
</body>
</html>
