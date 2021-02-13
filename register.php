<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

    <div class="form-wrapper">
        <h1>Examen 2o Cuatrimestre DWES - 2o DAW</h1>
        <div class="form-box">
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method='POST'>
            <!-- -->
                <label for="email">Correo electrónico</label> 
                <input type="email" name="email" required> 
                <!-- -->
                <label for="password">Contraseña</label> 
                <input type="password" name="password" minlength="8" maxlength='20' required> 
                <!-- -->
                <label for="c-password">Repetir Contraseña</label> 
                <input type="password" name="c-password" minlength="8" maxlength='20' required> 
                <!-- -->
                <label for="username">Nombre (Usuario)</label> 
                <input type="text" name="username" required> 
                <!-- -->
                <label for="surname">Appellidos</label> 
                <input type="text" name="surname" required> 
                <!-- -->
                <label for="rol">Rol</label> 
                <select name="rol" id="rol" required>
                    <option value="" selected disabled>Elige una opción</option>
                    <option value="alumno">Alumno</option>
                    <option value="profesor">Profesor</option>
                    <option value="administrativo">Administrativo</option>
                    <option value="administrador">Administrador</option>
                </select>
                <!-- -->
                <br>
                <br>
                <input class="submit-btn" type="submit" value="Registrar usuario">
            </form>
            <a href="index.php">Volver a inicio de sesión</a>
        </div>
    </div>


    <div class="footer-wrapper"> 
        <h4>Desarrollo Web en Entorno Servidor</h4>
    </div>


    <?php 
    include 'queries.php';
    
    if(isset($_POST['email'])
        &&isset($_POST['password'])
        &&isset($_POST['c-password'])
        &&isset($_POST['username'])
        &&isset($_POST['surname'])
        &&isset($_POST['rol'])){

        
        if($_POST['password']!=$_POST['c-password']){
            echo "<h2>Las contraseñas no coinciden</h2>";
        } else {
            
            $q = new Query();

            $Users = $q->checkUser();
            $UserList = array();

        
            foreach($Users as $value){
                if(!in_array($value["Username"], $UserList)){
                    array_push($UserList, $value["Username"]);
                } 
            }

            if(!in_array($_POST['username'], $UserList)){
                $newUser = $q->register($_POST['username'], $_POST['surname'], $_POST['email'], $_POST['rol'], md5($_POST['password']));
                echo "<h2 style='color: green' >Usuario registrado</h2>";
            } else {
                echo "<h2>Ya existe un usuario con ese nombre</h2>";
            }

            
            


        }

    }

    ?>
</body>
</html>