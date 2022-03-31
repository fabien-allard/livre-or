<?php
require_once "configbdd.php";
ini_set('error_reporting', E_ALL);

session_start();
//var_dump($_SESSION);
if (isset($_POST['logout']))
    {
        session_destroy();
        header('location:index.php');
    }

?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<style>
        body{ 
            font: 14px sans-serif;
            font-family: monospace; 
            background-image:url(les_images/voyage.jpg);
            background-repeat: no-repeat;
            background-size: cover;
}

        .main{
            display:flex;
            text-decoration:none;
        }

        .logo{
            float: left;
            width:75px;
            height:75px;
            text-decoration:none;
            color:black;
}
        .logo:hover{
            color:red;
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
}

        .image{
            display:flex;
            justify-content:center;
            border-radius: 4px;
            opacity: 1;
            width:1200px;

}
        .welcome{
            width:100%;
            flex-wrap:wrap;
}
        .co{
            display:flex;
            justify-content:center;
            width:100%;
}
        form{
            margin-left:2%;
}
        main{
            margin-top:70px;
}       
        footer{
            padding:1%;
            margin-top:480px;
        }
        footer a{
            text-decoration:none;
            font-size:16px;
            color:black;
        }
        footer a:hover{
            color:red;
        }
        .active{
            text-decoration:none;
            color:black;
        }
        .active:hover{
            color:red;
        }
        .texte{
            font-size:18px;
            color: red;
            text-align:center;
        }
        .welcome{
            color:red;
        }
        .btn{
            margin-top:50px;
        }
        p{
            margin-top:125px;
        }
    </style>
    <title>Accueil</title>
</head>
<body>
    <header>
    <div class="header">
    <a href="#" class ="logo">FabTravel</a>
    <div class="header-right">
    <?php
    if(!isset($_SESSION['user'])){
            echo "<a class='active' href='inscription.php'> S'inscrire</a>";
        }else{
            echo "";
        }
    if(!isset($_SESSION['user'])){
            echo "<a class='active' href='connexion.php'> Se connecter</a>";
        }else{
            echo "";
        }
        if(isset($_SESSION['user'])){
            echo "<a class='active' href='profil.php'> Profil</a>";
        }else{
            echo "";
        }
        ?>
        <a class="active" href="livre-or.php">Livre d'or</a> 
    </div>
</div>
    </header>  
        
            <main>

<div class="welcome">
    <div class="co">
    <h1><?php if(isset($_SESSION['user']) && $_SESSION['user'] != ''){
    echo "Bienvenue ","</br>" . $_SESSION['user']['login'];} ?></h1>        
<?php if(isset($_SESSION['user'])){
    echo "<form method='post'>
    <button type='submit' name='logout' class='btn btn-danger align-center'>Logout</button>  
        </form>";
    }
?>
    </div>
    </div>
    <section class="texte">
        <p> Les voyages incontournables à faire au moins une fois dans sa vie</p>
</section>
<footer>
    <a href="https://github.com/fabien-allard/livre-or.git">Mon Repo Github</a>
</footer>                    
            </main>
            <!--Import jQuery before materialize.js-->
<!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
        </body>
</html>