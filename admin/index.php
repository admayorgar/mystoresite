<?php
session_start();
if($_POST){
    //Hay un envio? Aca valido
    if(($_POST['usuario']=="admin")&&($_POST['contrasenia']=="admin2022")){

        $_SESSION['usuario']="Administrador";
        $_SESSION['nombreUsuario']="Administrador";

        header('Location:inicio.php');
    }else{
        $noValidado="Error: el usuario o contraseña son incorrectos";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>MY STORE SITE MANAGER</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
                <div class="col-md-4">
                <br><br><br>
                    <div class="card">
                        <div class="card-header">
                            INICIO DE SESIÓN
                        </div>
                        <div class="card-body">
                            <?php if(isset($noValidado)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $noValidado?>
                            </div>
                            <?php } ?>
                            <form method="POST">
                                <div class = "form-group">
                                    <label for="adminUsuario">Usuario: </label>
                                    <input type="text" class="form-control" name="usuario" id="adminUsuario" aria-describedby="emailHelp" placeholder="Escribe tu usuario">
                                </div>
                                <div class="form-group">
                                    <label for="adminPass">Contraseña: </label>
                                    <input type="password" class="form-control" name="contrasenia" id="adminPass" placeholder="Escribe tu contraseña">
                                </div>
                                <button type="submit" class="btn btn-dark">Ingresar</button>
                                <a class="btn btn-dark" href="../index.php">Volver</a>
                            </form>
                            
                            
                        </div>
                        
                    </div>
            </div>
            
        </div>
    </div>

</body>
</html>