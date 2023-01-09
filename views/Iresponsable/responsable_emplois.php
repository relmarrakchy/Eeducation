<?php 
    require "../../phpFiles/Responsable/responsableEmploi.php";
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
    <link rel="stylesheet" href="./css/responsable_emplois.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <title>eEducation</title>
    
</head>
<body>
    <div id="king">
        <div class="prince1">
            <div class="userDiv">
                <ul>
                <li style="float:left; margin-top:5px; margin-left: 40px;"><span style="font-weight:lighter; font-family: cursive;">Vous etes connecte en tant que <?php echo $_SESSION['role'];?></span></li>
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
                        <div class="navList"><span><i class="fa-solid fa-share-from-square navIcon"></i><a href="./responsable_annonces.php">Annonces</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-file navIcon"></i><a href="./responsable_demandes.php">Demandes</a></span></div>
                        <div class="navList activee"><span><i class="fa-solid fa-calendar-days navIcon"></i><a href="./responsable_emplois.php">Emplois</a></span></div>
                        <br><br><br><br><br><br><br><br><br><br>   
                        <div class="navList"><span><i class="fa-solid fa-right-from-bracket navIcon"></i><a href="../../phpFiles/logout.php">Deconnexion</a></span></div>
                    </nav>
                </div>
            </div>
            <div class="contentDiv">
                <div class="demDiv1">
                    <div class="head">
                        <div class="headContent">
                        <i class="fa-solid fa-share-nodes"></i> Diffuser un emploi
                        </div>
                    </div>
                    <form class="formEmp" action="../../phpFiles/Responsable/responsableEmploi.php" method="post" enctype="multipart/form-data">
                        <div class="formEmp2">
                            <div class="field">
                                <label for="">Type :</label>
                                <select class="inp" name="type" id="">
                                    <option value="" selected>...</option>
                                    <option value="Scolaire">Scolaire</option>
                                    <option value="Travail">Travail</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="">De :</label>
                                <select class="inp" name="de" id="">
                                    <option value="" selected>...</option>
                                    <optgroup label="Enseignants">
                                        <?php
                                            echo $ens;
                                        ?>
                                    </optgroup>
                                    <optgroup label="Classes">
                                        <?php
                                            echo $classes;
                                        ?>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="file-upload">
                                <div class="file-select">
                                    <div class="file-select-button" id="fileName">Choose File</div>
                                    <div class="file-select-name" id="noFile">No file chosen...</div> 
                                    <input type="file" name="file" id="chooseFile">
                                </div>
                            </div>
                        </div>
                            
                            <div class="formEmp3">
                                <input class="btn1" name="sub" type="submit" value="Diffuser">
                                <input class="btn1" type="submit" value="Modifier">
                            </div>
                    </form>
                </div>

                <div class="demDiv2">
                    <div class="head2">
                        <div class="headContent">
                        <i class="fa-solid fa-share-nodes"></i> Liste d'etat
                        </div>
                    </div>
                    <div class="tableDiv">
                        
                        <div class="table">
                            <div class="table1">
                                <table>
                                    <tr>
                                        <th>Classes</th>
                                        <th style="text-align: center;">Emploi</th>
                                    </tr>
                                    <?php
                                        echo $tableClasse;
                                    ?>
                                </table>
                            </div>
                            <div class="table2">
                                <table>
                                    <tr>
                                        <th>Enseignants</th>
                                        <th style="text-align: center;">Emploi</th>
                                    </tr>
                                    <?php
                                        echo $tableEns; 
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/responsable_emplois.js"></script>

    <?php
        if (isset($_SESSION['err_emploi'])) {
            echo $_SESSION['err_emploi'];
        } 
    ?>
</body>
</html>