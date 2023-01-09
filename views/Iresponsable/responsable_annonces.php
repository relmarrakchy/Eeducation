<?php
    require "../../phpFiles/Responsable/responsableAnnonce.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://kit.fontawesome.com/39383a79c4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/responsable_annonces.css">
    
    <title>eEducation</title>
</head>
<body>
    <div id="king">
        <div class="prince1">
            <div class="userDiv">
                <ul>
                <li style="float:left;margin-top:5px; margin-left: 40px;"><span style="font-weight:lighter; font-family: cursive;">Vous etes connecte en tant que <?php echo $_SESSION['role'];?></span></li>
                    <li><i class="fa-regular fa-circle-user userIcon"></i> <span style="font-weight:lighter; font-family: cursive;"><?php echo $_SESSION['resName'];?></span></li>
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
                        <div class="navList"><span><i class="fa-solid fa-house-user navIcon"></i><a href="./responsable_index.php">Acceuil</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-square-plus navIcon"></i><a href="../../PFE/views/Iresponsable/responsable_inscription.php">Inscriptions</a></span></div>
                        <div class="navList active"><span><i class="fa-solid fa-share-from-square navIcon"></i><a href="./responsable_annonces.php">Annonces</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-file navIcon"></i><a href="./responsable_demandes.php">Demandes</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-calendar-days navIcon"></i><a href="./responsable_emplois.php">Emplois</a></span></div>
                        <br><br><br><br><br><br><br><br><br><br>    
                        <div class="navList"><span><i class="fa-solid fa-right-from-bracket navIcon"></i><a href="../../phpFiles/logout.php">Deconnexion</a></span></div>
                    </nav>
                </div>
            </div>
            <div class="contentDiv">
                <div class="annonceDiv">
                    <div class="head">
                        <div class="headContent">
                            <i class="fa-solid fa-list-ul"></i> Liste des annonces
                        </div>
                    </div>
                    <div class="annonceFormDiv">
                           <form action="../../phpFiles/Responsable/responsableAnnonce.php" method="post">
                               <div class="annonceForm">
                                   <div class="formPart1">
                                       <div>
                                            <label for="">Destination : </label>
                                            <select name="destination" id="" class="inp">
                                                <option value="Eleves">Eleves</option>
                                                <option value="Enseignants">Enseignants</option>
                                            </select>
                                       </div>
                                   </div>
                                   <div class="formPart2">
                                       <textarea placeholder="Ecrire une annonce ..." name="annonce" id="" cols="30" rows="10"></textarea>
                                   </div>
                               </div>

                               <div class="searchForm">
                                   <div style="position:relative; left: 75%;" class="buttonsDiv">
                                       <div class="buttons">
                                           <input type="submit" name="ajout" class="btn1" value="Ajout">
                                           <input type="submit" name="supp" class="btn1" value="Supprimer">
                                           <!-- <input type="submit" name="" class="btn1" value="Suprrimer"> -->
                                       </div>
                                   </div>
                               </div>
                    </div>
                    <div class="annonceTableDiv">
                        <div class="annonceTable">
                            <table>
                                    <tr>
                                        <th># ID</th>
                                        <th>Description</th>
                                        <th>Destination</th>
                                        <th>Date diffusion</th>
                                        <th style="text-align: center;">Suppression</th>
                                    </tr>
                                    <?php
                                        if(isset($dataSearch)) {
                                            echo $dataSearch;
                                        } else {
                                            echo $_SESSION['annData'];
                                        }
                                    ?>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script src="./js/responsable_index.js"></script>
    <?php if(isset($_SESSION['err_annonce'])) echo $_SESSION['err_annonce']; ?>
</body>
</html>