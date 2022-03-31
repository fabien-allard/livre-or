<?php
require_once "configbdd.php";
ini_set('error_reporting', E_ALL);
session_start();
/*echo '<pre>';
var_dump($_SESSION['user']['login']);
echo '</pre>';*/
if(empty($_SESSION['user']['login'])){
    header('location: connexion.php');
}

if(isset($_SESSION['user']['login'])){
    $_login=$_SESSION['user']['login'];
    $select_stmt=$db->prepare("SELECT * FROM `utilisateurs` WHERE `login`= :login");
    $select_stmt->bindValue(':login',$_login);
    $select_stmt->execute();
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
}
if(isset($_POST['submit_btn'])){
$_commentaire = $_POST['commentaire'];
    if(!empty($_commentaire)){
        $_utilisateur=$row['id'];
        $select_stmt = $db->prepare("INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES(:commentaire, :id, NOW())");
        $select_stmt->bindValue(':commentaire', $_commentaire, PDO::PARAM_STR);
        $select_stmt->bindValue(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
        $select_stmt->execute();
        header("location: livre-or.php");
        exit;
}
else{$errorMsg[0][] = 'Veuillez entrer votre commentaire';}}

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <style>
        body{ 
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font: 14px sans-serif;
            font-family: monospace;
            background-image:url(les_images/Machu-Picchu.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            opacity:0,8;
            height:97vh;
}
        
        .logo{
            color: white;
            padding: 6px;
            text-decoration: none;
            font-size: 14px;
            line-height: 22px;
            font-family: monospace;
            cursor: pointer;
}
        .header{
        }
        .navbar {
            background: linear-gradient(180deg, rgb(0, 247, 255), rgb(10, 10, 116));
            padding: 1%;
            text-align: center;
            font-size: 25px;
            color: white;
            opacity: 0.8;
            margin-bottom:250px;
            }
        .box {
            padding: 30px 25px 10px 25px;
            margin: 30px auto;
            width: 1400px;
            margin-top:140px;
            }
#commentaire{
    width:100%;
}
label{
    text-align:center;
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
    </style>
    <title>Commentaire</title>
</head>
<body>
<header>
    <div class="navbar">
    <a href="index.php" class ="logo">FabTravel</a>
    </div>
</header>
		<form action="commentaire.php" class="box" method="post">
<div class="mb-3">
                
        <?php
        if(isset($errorMsg[0])){
            foreach($errorMsg[0] as $loginErrors){
                echo "<p class='small text-danger'>".$loginErrors."</p>";
            }
        }
        ?>
<label for="commentaire">Ecrit ton Commentaire ici !</label>
<br/>
<textarea name="commentaire" id="commentaire"></textarea>
<br/>
<button type="submit" id="btn1" name="submit_btn" class="btn btn-primary">Valider</button>
        </form>
    </body>
</html>