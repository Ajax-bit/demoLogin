<?php
session_start();
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
                <label for="username">Usuario</label> 
                <input type="text" name="username" required > 
                <label for="password">Contraseña</label> 
                <input type="password" name="password" required> 
                <input class="submit-btn" type="submit" value="Acceder">
            </form>
            <a href="register.php">Registro de usuario</a> <br> <br>
            <?php

            if(isset($_SESSION['user'])){
                echo '<a href="main.php" > Volver a sesión de '. $_SESSION['user'] . '</a>';
            }


            ?>
        </div>
    </div>


    <div class="footer-wrapper"> 
        <h4>Desarrollo Web en Entorno Servidor</h4>
    </div>


    <?php

    include 'queries.php';

    // Recieves data from form
    if(isset($_POST['username'])&&isset($_POST['password'])){
        $u = $_POST['username'];
        $p = md5($_POST['password']);


        $q = new Query();

        $Users = $q->checkUser();
        $UserList = array();

        
        foreach($Users as $value){
            if(!in_array($value["Username"], $UserList)){
                array_push($UserList, $value["Username"]);
            } 
        }


        $check = $q->validate($u, $p);

        
        if(in_array($u, $UserList)){
            foreach ($check as $value){
            
                if($value["Password"]==$p){

                    $_SESSION['user'] = $u;
                    $_SESSION['pass'] = $p;


                    header("Location: main.php");
                    exit();
                } else {
                    echo '<h2>Usuario o contraseña errónea.</h2>';
                }
            }
        } else {
            echo '<h2>Usuario o contraseña errónea.</h2>';
        }
       
    };

    ?>
</body>
</html>