<?php require "../../phpFiles/Eleve/eleCours.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://kit.fontawesome.com/39383a79c4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/eleve_cours.css">
    
    <title>eEducation</title>
</head>
<body>
    <div id="king">
        <div class="prince1">
            <div class="userDiv">
                <ul>
                <li style="float:left; margin-top: 5px; margin-left: 40px;"><span style="font-weight:lighter; font-family: cursive;">Vous etes connecte en tant que <?php echo $_SESSION['role'];?></span></li>
                    <li><i class="fa-regular fa-circle-user userIcon"></i> <span style="font-weight:lighter; font-family: cursive;"><?php echo $_SESSION['fn']; ?></span></li>
                </ul>
            </div>
        </div>
        <div class="prince2">
            <div class="sidebarDiv">
                <div class="sidebar">
                    <div class="logo">
                        <img src="../../resources/logooo.png" alt="">
                    </div>
                    <nav>
                        <div class="navList"><span><i class="fa-solid fa-house-user navIcon"></i><a href="../../PFE/views/Ieleve/eleve_index1.php">Acceuil</a></span></div>
                        <div class="navList active"><span><i class="fa-solid fa-square-plus navIcon"></i><a href="./eleve_cours.php">Cours</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-share-from-square navIcon"></i><a href="../../PFE/views/Ieleve/eleve_notes.php">Notes</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-file navIcon"></i><a href="./eleve_demandes.php">Rendez-vous</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-calendar-days navIcon"></i><a href="./eleve_tests.php">Tests</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-gear navIcon"></i><a href="./eleve_parametres.php">Parametres</a></span></div>
                        <br><br><br><br><br><br><br><br>
                        <div class="navList"><span><i class="fa-solid fa-right-from-bracket navIcon"></i><a href="../../phpFiles/logout.php">Deconnexion</a></span></div>
                    </nav>
                </div>
            </div>
            <!-- <div class="head">
                        <div class="headContent">
                            <i class="fa-solid fa-list-ul"></i> Liste des annonces
                        </div>
                    </div> -->
            <div class="contentDiv">
                <div class="annonceDiv">
                    <div class="navMatieres">
                        <?php echo $nav; ?>
                    </div>
                    <div class="coursDiv">
                        <div class="head">
                            <div class="headContent">
                                <i class="fa-solid fa-chalkboard-user"></i>  <?php if (isset($t)) echo $t." :";?>
                            </div>
                        </div>
                        
                        <?php echo $cours;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/responsable_index.js"></script>
</body>
</html>