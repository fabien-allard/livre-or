<?php
require_once "configbdd.php";
ini_set('error_reporting', E_ALL);

session_start();

/*if(isset($_SESSION['user'])){
    header("location: index.php");
}*/

if(isset($_REQUEST['inscription_btn'])){
    
    /*echo "<pre>";
        print_r($_REQUEST);
    echo "</pre>";*/
    
    $_login = filter_var($_REQUEST['login'],FILTER_SANITIZE_STRING);
    $_password = strip_tags($_REQUEST['password']);
    $_confirm_password = strip_tags($_REQUEST['confirm_password']);

    if(empty($_login)){
        $errorMsg[0][] = 'Login requis';
    }

    if(empty($_password)){
        $errorMsg[3][] = 'Password requis';
    }

    if(empty($_confirm_password)){
        $errorMsg[4][] = 'Confirmation password requis';
    }

    if ($_REQUEST['password'] === $_REQUEST['confirm_password']) {
        (empty($errorMsg));
    }

    if(empty($errorMsg)){
        
        $select_stmt = $db->prepare("SELECT login FROM utilisateurs WHERE login = :login" );
        //var_dump($_login);
        $select_stmt->bindValue(':login',$_login);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        
        if(isset($row['login']) && $row['login'] == $_login){
            $errorMsg[0][] = "Ce nom d'utilisateur existe déjà, veuillez en choisir un autre";
        }
        else{
            $hashed_password = password_hash($_password, PASSWORD_DEFAULT);
            $insert_stmt = $db->prepare("INSERT INTO utilisateurs (login,password) VALUES (:login,:password)");
            $insert_stmt->bindValue(':login', $_login);
            $insert_stmt->bindValue('password',$hashed_password);
        
            $insert_stmt->execute();
                header("location: connexion.php");   
        }
        }
    }
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<style>

        /* Style général */
* {
    font-family: 'Scada', sans-serif;
    max-width: 1700;
    }
        body{ 
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font: 14px sans-serif;
            font-family: monospace;
            background-image:url(les_images/Thaïlande.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            opacity:0,8;
            height:97vh;
}
        
        .logo{
            float: left;
            color: white;
            text-decoration: none;
            font-size: 14px;
            line-height: 22px;
            font-family: monospace;
            cursor: pointer;
}
        .box {
        padding: 30px 25px 10px 25px;
        margin: 30px auto;
        width: 400px;
        margin-top:250px;
    }
        .box-button {
        border-radius: 5px;
        background:orange ;
        text-align: center;
        cursor: pointer;
        font-size: 19px;
        width: 100%;
        height: 51px;
        padding: 0;
        color: #fff;
        border: 0;
        outline:0;
    }
        .box-button:hover{
            color:rgb(211, 30, 39);
            box-shadow:none; 
        }
        .connexion{
            text-decoration:none;
            font-size:13px;
            color:blue;
        }
        .header {
                background: linear-gradient(180deg, rgb(11, 117, 117), rgb(10, 10, 116));
                padding: 1%;
                text-align: center;
                font-size: 25px;
                color: white;
                opacity: 0.8;
            }
        .header-right{
            font-size: 14px;
            line-height: 20px;
            text-align: right;
            text-decoration:none;
}
        p{
            font-size:13px;
            color:red;
            margin:15px;
        }
        .active{
            text-decoration:none;
            color:black;
        }
        .active:hover{
            color:red;
        }
        input{
            color:black;
        }
        
        .form-control{
            text-align:center;
        }
        h1.box-title {
            color: black;
            font-weight: 300;
            padding: 15px 25px;
            line-height: 15px;
            font-size: 28px;
            text-align:center;
            margin: -76px -26px 26px;
        }
        section h1{
            text-align:center;
            font-size:25px;
            margin:25px;
            color:orange;
        }
    </style>
    <title>Inscription</title>
</head>
    <body>
    <header>
    <div class="header">
    <a href="index.php" class ="logo">FabTravel</a>
    <div class="header-right">
        <a class="active" href="livre-or.php">Livre d'or</a> 
    </div>
</div>
</header>
<section>
    </section>
		<form action="inscription.php" method="post" class="box">
        <h1 class="box-title">Veuillez vous Inscrire Ici</h1>
        <div class="mb-3">
                
        <?php
        if(isset($errorMsg[0])){
            foreach($errorMsg[0] as $loginErrors){
                echo "<p class='small text-danger'>".$loginErrors."</p>";
            }
        }
        ?>
        
				<input type="text" name="login" class="form-control" placeholder="Login">
			</div>
        
        <div class="mb-3">
				
        <?php
        if(isset($errorMsg[3])){
            foreach($errorMsg[3] as $passwordErrors){
                echo "<p class='small text-danger'>".$passwordErrors."</p>";
            }
        }
        ?>       

				<input type="password" name="password" class="form-control" placeholder="Password">
				</div>

        <div class="mb-3">
                
        <?php
        if(isset($errorMsg[4])){
            foreach($errorMsg[4] as $confirmpasswordErrors){
                echo "<p class='small text-danger'>".$confirmpasswordErrors."</p>";
                    
            }
        }
        ?>
                
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password">
                </div>
			
                <button type="submit" name="inscription_btn" class="box-button">Enregistrer</button>
		<P>Vous possédez déjà un compte ? <a class="connexion" href="connexion.php">Connectez-vous !</a></p>
	</form>
    </div>
    </body>
</html>