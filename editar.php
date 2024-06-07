<?php
    // Incluir conexion
    include 'conexion.php';

    // Obtener el id enviado desde index
    $idRegistro = $_GET['id'];

    // Seleccionar datos
    $query ="SELECT * from usuarios WHERE id='".$idRegistro."'";
    $usuario = mysqli_query($conn, $query) or die (mysqli_error());

    // Volcamos los datos de ese registro en un fila
    $fila = mysqli_fetch_assoc($usuario);


    if(isset($_POST['editarRegistro'])){
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
        $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        //Configurar zona horaria 
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $time = date('h:i:s a', time());

        // Validar si los campos no estan vacios
        if(!isset($nombre ) || $nombre == '' || !isset($apellidos ) || $apellidos == '' || !isset($telefono ) || $telefono == '' || !isset($email ) || $email == ''){

            $error = "Algunos campos estan vacios";
        }else{
            $query ="UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', telefono='$telefono', email='$email' WHERE id='$idRegistro'";

            if(!mysqli_query($conn, $query)){
                die('Error: '.mysqli_error($conn));
                $error = "Error, no se pudo editar el registro";
            }else{
                $mensaje = "Registro editado correctamente";
                header("Location: index.php?mensaje=".urlencode($mensaje));
                exit();
            }
        }
    }

?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="css/estilos.css" rel="stylesheet">

    <title>CRUD PHP Y MYSQL</title>
  </head>
  <body>
    <h1 class="text-center">CRUD PHP Y MYSQL</h1>
    <p class="text-center">Aprende a realizar las 4 operaciones básicas entre PHP y una base de datos, en este caso MYSQL: CRUD(Create, Read, Update, Delete)</p>

    <div class="container">

    <div class="row">
        <h4>Editar un Registro existente</h4>
    </div>   

        <div class="row caja">

            <?php if(isset($error)) : ?>
            
                <h4 class="bg-danger text-white"><?php echo $error; ?></h4>
            
            <?php endif; ?>

            <div class="col-sm-6 offset-3">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $fila['nombre']; ?>" placeholder="Ingresa el nombre" Required>                    
                </div>
                
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" value="<?php echo $fila['apellidos']; ?>" placeholder="Ingresa los apellidos" Required>                    
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono:</label>
                    <input type="number" class="form-control" name="telefono" value="<?php echo $fila['telefono']; ?>" placeholder="Ingresa el teléfono" Required>                    
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $fila['email']; ?>" placeholder="Ingresa el email" Required>                    
                </div>
              
                <button type="submit" class="btn btn-primary w-100" name="editarRegistro">Editar Registro</button>

                </form>
            </div>
        </div>
    </div>
  </body>
</html>