<?php require "../../phpFiles/Enseignant/ensPara.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://kit.fontawesome.com/39383a79c4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/enseignant_parametre.css">
    
    <title>eEducation</title>
</head>
<body>
    <div id="king">
        <div class="prince1">
            <div class="userDiv">
                <ul>
                <li style="float:left; margin-top: 5px; margin-left: 40px;"><span style="font-weight:lighter; font-family: cursive;">Vous etes connecte en tant que <?php echo $_SESSION['role'];?></span></li>
                    <li><i class="fa-regular fa-circle-user userIcon"></i> <span style="font-weight:lighter; font-family: cursive;"><?php echo $fn; ?></span></li>
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
                    <div class="navList"><span><i class="fa-solid fa-house-user navIcon"></i><a href="./enseignant_index.php">Acceuil</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-square-plus navIcon"></i><a href="../../PFE/views/Ienseignant/enseignant_cours.php">Cours</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-share-from-square navIcon"></i><a href="./enseignant_test.php">Tests</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-file navIcon"></i><a href="../../PFE/views/Ienseignant/Ienseignant_notes.php">Notes</a></span></div>
                        <div class="navList active"><span><i class="fa-solid fa-gear navIcon"></i><a href="./enseignant_parametre.php">Parametres</a></span></div>
                        <br><br><br><br><br><br><br><br><br><br>    
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
                                        <table style="width: 60%;">
                                            <tr>
                                                <td><span class="label">ID :</span></td>
                                                <td><span class="data"><?php echo $_SESSION['id_enseignant']; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <table style="width: 60%;">
                                            <tr>
                                                <td><span class="label">CIN :</span></td>
                                                <td><span class="data"><?php echo $cin; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <table style="width: 60%;">
                                            <tr>
                                                <td><span class="label">Nom :</span></td>
                                                <td><span class="data"><?php echo $n; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <table style="width: 60%;">
                                            <tr>
                                                <td><span class="label">Prenom :</span></td>
                                                <td><span class="data"><?php echo $l; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="field">
                                    <div>
                                        <table style="width: 80%;">
                                            <tr>
                                                <td><span class="label">Adresse :</span></td>
                                                <td><span class="data"><?php echo $add; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <table style="width: 80%;">
                                            <tr>
                                                <td><span class="label">Email :</span></td>
                                                <td><span class="data"><?php echo $email; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <table style="width: 80%;">
                                            <tr>
                                                <td><span class="label">Telephone :</span></td>
                                                <td><span class="data"><?php echo $tel; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <table style="width: 80%;">
                                            <tr>
                                                <td><span class="label">Mot de passe :</span></td>
                                                <td><span class="data"><?php echo $pass; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="columns">
                                <div class="field">
                                    <div>
                                        <span class="label">Nom :</span>
                                        <span class="data">XXXX</span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <span class="label">Nom :</span>
                                        <span class="data">XXXX</span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <span class="label">Nom :</span>
                                        <span class="data">XXXX</span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div>
                                        <span class="label">Nom :</span>
                                        <span class="data">XXXXXXXXXXXXX</span>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="modPara">
                    <div class="myForm">
                       <div class="form">
                           <form class="f1" action="" method="post">
                                <div class="head">
                                    <div class="headContent">
                                        <i class="fa-solid fa-gear"></i> Changer votre email :
                                    </div>
                                </div>
                                <div class="passForm">
                                    <div>
                                        <label for="">L'email actual : </label>
                                        <input class="inp" type="email" name="actE" id="" value="<?php echo $email; ?>" placeholder="">
                                    </div>
                                    <div>
                                        <label for="">Le nouveau email : </label>
                                        <input class="inp" type="email" name="nE" id="" placeholder="">
                                    </div>
                                    <input class="btn1" name="chE" type="submit" value="Changer votre email">
                                </div>
                       </div>
                       <div class="form">
                           <div class="f2">
                                <div class="head">
                                    <div class="headContent">
                                        <i class="fa-solid fa-gear"></i> Changer votre mot de passe : 
                                    </div>
                                </div>
                                <div class="passForm">
                                    <div>
                                        <label for="">Le mot de passe actual : </label>
                                        <input class="inp" name="actPass" type="password" value="<?php echo $pass; ?>" name="" id="" placeholder="">
                                    </div>
                                    <div>
                                        <label for="">Le nouveau mot de passe : </label>
                                        <input class="inp" type="password" name="nPass" id="" placeholder="">
                                    </div>
                                    <div>
                                        <label for="">Confirmer le nouveau mot de passe : </label>
                                        <input class="inp" type="password" name="ncPass" id="" placeholder="">
                                    </div>
                                    <input class="btn1" name="chP" type="submit" value="Changer votre mot de passe">
                                </div>
                           </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/responsable_index.js"></script>
    <?php if(isset($_SESSION['err_para'])) echo $_SESSION['err_para'];?>
</body>
</html>