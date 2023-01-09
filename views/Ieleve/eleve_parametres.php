<?php require "../../phpFiles/Eleve/eleParametres.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://kit.fontawesome.com/39383a79c4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/eleve_parametres.css">
    
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
                        <div class="navList"><span><i class="fa-solid fa-square-plus navIcon"></i><a href="./eleve_cours.php">Cours</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-share-from-square navIcon"></i><a href="../../PFE/views/Ieleve/eleve_notes.php">Notes</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-file navIcon"></i><a href="./eleve_demandes.php">Rendez-vous</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-calendar-days navIcon"></i><a href="./eleve_tests.php">Tests</a></span></div>
                        <div class="navList active"><span><i class="fa-solid fa-gear navIcon"></i><a href="./eleve_parametres.php">Parametres</a></span></div>
                        <br><br><br><br><br><br><br><br>  
                        <div class="navList"><span><i class="fa-solid fa-right-from-bracket navIcon"></i><a href="../../phpFiles/logout.php">Deconnexion</a></span></div>
                    </nav>
                </div>
            </div>
            
            <div class="contentDiv">
                <div class="annonceDiv">
                    <div class="head">
                        <div class="headContent">
                            <i class="fa-solid fa-graduation-cap"></i> Informations personnelles 
                        </div>
                    </div>
                    <div class="eleInfo">
                        <div class="elePic">
                            <div class="pic">
                                <img src="../../resources/eleve.png" alt="">
                            </div>
                        </div>
                        <div class="eleData">
                            <div class="columns">
                                <div class="field">
                                    <div>
                                        <span class="label">Nom :</span>
                                        <span style="margin-left: -30px" class="data"><?php echo $nom; ?></span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <span class="label">Prenom :</span>
                                        <span style="margin-left: -30px" class="data"><?php echo $prenom; ?></span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <span class="label">Classe :</span>
                                        <span style="margin-left: -30px" class="data"><?php echo $classe; ?></span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <span class="label">Sexe :</span>
                                        <span style="margin-left: -30px" class="data"><?php echo $sexe; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="field">
                                    <div>
                                        <span class="label">Adresse :</span>
                                        <span style="font-size: 12px; margin-left: -35px" class="data"><?php echo $adresse; ?></span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <span class="label">Date de naissance :</span>
                                        <span style="margin-left: -30px" class="data"><?php echo $date_naissance; ?></span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <span class="label">Lieu de naissance :</span>
                                        <span style="margin-left: -30px" class="data"><?php echo $lieu_naissance; ?></span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <span class="label">Telephone :</span>
                                        <span style="margin-left: -30px" class="data"><?php echo $telephone; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="field">
                                    <div>
                                        <span class="label">CNE :</span>
                                        <span style="margin-left: -30px" class="data"><?php echo $cne; ?></span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <span class="label">Email :</span>
                                        <span style="margin-left: -30px" class="data"><?php echo $email; ?></span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <span class="label">Mot de passe :</span>
                                        <span style="margin-left: -30px" class="data"><?php echo $pass; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modPara">
                    <div class="myForm">
                       <div class="form">
                           <form class="f1" action="../../phpFiles/Eleve/eleParametres.php" method="post">
                                <div class="head">
                                    <div class="headContent">
                                        <i class="fa-solid fa-solid fa-gear"></i> Changer votre email : 
                                    </div>
                                </div>
                                <div class="passForm">
                                    <div>
                                        <label for="">L'email actual : </label>
                                        <input class="inp" name="actE" type="email" name="" id="" value="<?php echo $email; ?>" placeholder="">
                                    </div>
                                    <div>
                                        <label for="">Le nouveau email : </label>
                                        <input class="inp" name="nE" type="email" name="" id="" placeholder="">
                                    </div>
                                    <input class="btn1" name="subE" type="submit" value="Changer votre email">
                                </div>
                           </form>
                       </div>
                       <div class="form">
                           <form class="f2" action="../../phpFiles/Eleve/eleParametres.php" method="post">
                                <div class="head">
                                    <div class="headContent">
                                        <i class="fa-solid fa-solid fa-gear"></i> Changer votre mot de passe : 
                                    </div>
                                </div>
                                <div class="passForm">
                                    <div>
                                        <label for="">Le mot de passe actual : </label>
                                        <input class="inp" name="actP" type="password" name="" id="" value="<?php echo $pass; ?>" placeholder="">
                                    </div>
                                    <div>
                                        <label for="">Le nouveau mot de passe : </label>
                                        <input class="inp" name="nP" type="password" name="" id="" placeholder="">
                                    </div>
                                    <div>
                                        <label for="">Confirmer le nouveau mot de passe : </label>
                                        <input class="inp" name="vP" type="password" name="" id="" placeholder="">
                                    </div>
                                    <input class="btn1" name="subP" type="submit" value="Changer votre mot de passe">
                                </div>
                           </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/responsable_index.js"></script>
</body>
</html>