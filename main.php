<?php
// Para ver si la sesión se ha iniciado.
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}


?>


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

    <?php

    include 'queries.php';

    $q = new Query();
    $ID = $q->checkId($_SESSION['user']);
    
    foreach($ID as $val){
        $id = $val['id'];
    }

    
    $Users = $q->checkUser();
    $em = "";
    $su = "";

    
   

        
    foreach($Users as $value){
        if($value['Username']==$_SESSION['user']){
            $em = $value['Email'];
            $su = $value['Surname'];
        } 
    }

    echo '<h2>Bienvenido ' . $_SESSION['user'] . '</h2>';

    echo '<label for="email">Correo electrónico</label> ';
    echo '<input type="email" name="email" required value="'. $em .'"> ';

    echo '<label for="username">Nombre (Usuario)</label> ';
    echo '<input type="text" name="username" required value="'. $_SESSION['user'] .'"> ';

    echo '<label for="surname">Appellidos</label> ';
    echo '<input type="text" name="surname" required value="'. $su .'"> ';

    echo '<label for="rol">Rol</label> ';
    echo '<select name="rol" id="rol" required>';
    echo    '<option value="" selected disabled>Elige una opción</option>';
    echo     '<option value="alumno">Alumno</option>';
    echo    '<option value="profesor">Profesor</option>';
    echo    '<option value="administrativo">Administrativo</option>';
    echo   '<option value="administrador">Administrador</option>';
    echo '</select>';

    
    ?>
    <br>
    <br>
        <input class="submit-btn" type="submit" value="Actualizar usuario">
        </form>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method='POST'>
                <input type="text" name='close' value="close" style='display:none'>
                <input type="submit" value="Cerrar sesión">
            </form>
        </div>
    </div>


    <div class="footer-wrapper"> 
        <h4>Desarrollo Web en Entorno Servidor</h4>
    </div>

    <?php

    if(isset($_POST['email'])
        &&isset($_POST['username'])
        &&isset($_POST['surname'])
        &&isset($_POST['rol'])) {

            $userUpdate = $q->update($id, $_POST['username'], $_POST['surname'], $_POST['email'], $_POST['rol']);
            $_SESSION['user'] = $_POST['username'];
            header("Location: main.php");
            exit();
            

        }


    if(isset($_POST['close'])){

        unset($_SESSION['user']);
        unset($_SESSION['pass']);
        session_destroy();
        header("Location: index.php");
        exit();
    }

    ?>

</body>
</html>