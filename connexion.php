<?php
require_once 'configbdd.php';
ini_set('error_reporting', E_ALL);

session_start();
//var_dump($_SESSION);

if(isset($_REQUEST['login_btn'])){

        if (isset($_POST['logout'])){
        session_destroy();
        header('location:index.php');
        }

        
    $_login = filter_var($_REQUEST['login'],FILTER_SANITIZE_STRING);
    $_password = strip_tags($_REQUEST['password']);
    

    if(empty($_login)){
        $errorMsg[] = 'Veuillez entrer votre login';
    }
    if(empty($_password)){
        $errorMsg[] = 'Veuillez entrer votre password';
    }

    else{
        
        $select_stmt = $db->prepare("SELECT * FROM utilisateurs WHERE login = :login LIMIT 1");
        $select_stmt->execute([':login' => $_login]);
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        if($select_stmt->rowCount() == true){
        if(password_verify($_password,$row['password'])){
            $_SESSION['user'] = $row;
            header('location:index.php');
        
        }
        else{
        
        $errorMsg[] = 'Login ou password incorrect(s)';
        }
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
        body{ 
            font-size: 14px;
            font-family: monospace;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            background-image:url(les_images/Australie.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            opacity:0,8;
            height:97vh; 
}

        .logo{
            float: left;
            color: black;
            text-decoration: none;
            font-size: 14px;
            line-height: 22px;
            font-family: monospace;
            cursor: pointer;
}
        .logo:hover{
            color:red;
        }
        .header-right{
                    font-size: 14px;
                    line-height: 20px;
                    text-align: right;
                    text-decoration:none;
        }
        .box {
            padding: 30px 25px 10px 25px;
            margin: 30px auto;
            width: 400px;
            margin-top:140px;
            }
        #btn1{
            border-radius: 5px;
            background:rgb(60, 60, 185) ;
            text-align: center;
            cursor: pointer;
            font-size: 19px;
            width: 100%;
            height: 35px;
            padding: 0;
            color: #fff;
            border: 0;
            outline:0;
    }
    #btn1:hover{
        color:red;
    }
    #btn2{
        border-radius: 5px;
        background:red ;
        text-align: center;
        cursor: pointer;
        font-size: 19px;
        width: 100%;
        height: 35px;
        padding: 0;
        color: #fff;
        border: 0;
        outline:0;
    }
    #btn2:hover{
        color:blue;
    }
    .form-control{
            text-align:center;
        }
        .box-button:hover{
            color:rgb(211, 30, 39);
            box-shadow:none; 
        }
        p{
            font-size:13px;
            color:white;
            text-align:center;
        }
        .active{
            text-decoration:none;
            color:black;
        }
        .active:hover{
            color:red;
        }
        .inscription{
            text-decoration:none;
            font-size:13px;
            color:red;
        }
        .inscription:hover{
            color:white;
        }
        button{
            margin-bottom:20px;
            align-items:center;
        }
        input{
            color:black;
        }
        .header {
            background: linear-gradient(180deg, rgb(0, 247, 255), rgb(10, 10, 116));
            padding: 1%;
            text-align: center;
            font-size: 25px;
            color: white;
            opacity: 0.8;
            }
    </style>
    <title>Login</title>
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
		
    <?php
    
    if(isset($_REQUEST['msg'])){
        echo "<p class='alert alert-danger'>".$_REQUEST['msg']."</p>";
    }
    if(isset($errorMsg)){
        foreach($errorMsg as $loginError ){
        echo "<p class='alert alert-danger'>".$loginError."</p>";
    }

    }
    ?>
    
    <form action="connexion.php" class="box" method="post">
        <div class="mb-3">
            <input type="text" name="login" class="form-control" placeholder="Login">
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
			<button type="submit" name="login_btn" id="btn1" class="btn btn-primary">Connexion</button>
			<button type="submit" name="logout" id="btn2" class="btn btn-danger">Déconnexion</button>
		
    <p>Vous ne possédez pas de compte ? <a class="inscription" href="inscription.php">Enregistrez-vous ici !</a></p>
	</form>
</div>
</body>
</html>