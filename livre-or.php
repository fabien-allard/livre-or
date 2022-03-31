<?php
require_once "configbdd.php";
ini_set('error_reporting', E_ALL);
session_start();


$select_stmt = $db->prepare("SELECT login, commentaire, date FROM utilisateurs INNER JOIN commentaires WHERE utilisateurs.id = commentaires.id_utilisateur");
$select_stmt-> execute();
$row = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($row);

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
        .navbar {
            background: linear-gradient(180deg, rgb(0, 247, 255), rgb(10, 10, 116));
            padding: 1%;
            text-align: center;
            font-size: 25px;
            color: white;
            opacity: 0.8;
            margin-bottom:250px;
            }
        .wrapper{ 
            width: 360px; padding: 20px; 
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
        .active{
            text-decoration:none;
            color:black;
        }
        .active:hover{
            color:red;
        }
        .commentaire{
            text-align:center;
            margin-top:250px;
}

        .header-right{
            font-size: 14px;
            line-height: 20px;
            text-align: right;
            text-decoration:none;
}
#teste a{
    text-align:center;
}
        
    </style>
    <title>Livre d'or</title>
</head>
    <body>
    <header>
    <div class="navbar">
    <a href="index.php" class ="logo">FabTravel</a>
    <div class="header-right">
        <a class="active" href="commentaire.php">Espace Commentaire</a> 
    </div>
</div>
</header>
            <form action="livre-or.php" method="post">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Date de publication</th>
                    </tr>
                </thead>
    <?php
        foreach ($row as $key => $values){
            echo "<tr>";
            foreach ($values as $key => $value){
            echo "<td>" . $value . "</td>";
    }
            echo "</tr>";
    }
    ?>
                    
                
		</form>
	</div>
    </body>
</html>