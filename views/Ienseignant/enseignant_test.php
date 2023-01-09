<?php
    require "../../phpFiles/Enseignant/ensTest.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://kit.fontawesome.com/39383a79c4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/enseignant_test.css">
    <title>eEducation</title>
</head>
<body>
    <div id="king">
        <div class="prince1">
            <div class="userDiv">
                <ul>
                    <li style="float:left; margin-top:5px; margin-left: 40px;"><span style="font-weight:lighter; font-family: cursive;">Vous etes connecte en tant que <?php echo $_SESSION['role'];?></span></li>
                    <li><i class="fa-regular fa-circle-user userIcon"></i> <span style="font-weight:lighter; font-family: cursive;"><?php echo $fn;?></span></li>
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
                        <div class="navList active"><span><i class="fa-solid fa-share-from-square navIcon"></i><a href="./enseignant_test.php">Tests</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-file navIcon"></i><a href="../../PFE/views/Ienseignant/Ienseignant_notes.php">Notes</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-gear navIcon"></i><a href="./enseignant_parametre.php">Parametres</a></span></div>
                        <br><br><br><br><br><br><br><br><br><br>    
                        <div class="navList"><span><i class="fa-solid fa-right-from-bracket navIcon"></i><a href="../../phpFiles/logout.php">Deconnexion</a></span></div>
                    </nav>
                </div>
            </div>
            
            <div class="contentDiv">
                <div class="annonceDiv">
                    <div class="checkForm">
                        <div class="head">
                            <div class="headContent">
                                <i class="fa-solid fa-list-check"></i> Creer un test
                            </div>
                        </div>

                        <form action="../../phpFiles/Enseignant/ensTest.php" method="post" class="testForm">
                            <div class="part1">
                                <div class="info">
                                    <label for="">Classe : </label>
                                    <select class="inp" name="classe" id="">
                                        <option selected>...</option>
                                        <?php
                                            echo $dataClasse;
                                        ?>
                                    </select>
                                </div>
                                <div class="info">
                                <label for="">Duree : </label>
                                    <select class="inp" name="dur" id="">
                                        <option selected>...</option>
                                        <option value="30 minutes">30 minutes</option>
                                        <option value="1 heure">1 heure</option>
                                    </select>
                                </div>
                            </div>

                            <div class="info">
                                <label for="">Titre : </label>
                                <input id="id" class="inp" type="text" name="titre" id="">
                            </div>

                            <div class="part2">
                                <div class="tableDiv">
                                    <table>
                                        <tr>
                                            <th>Question</th>
                                            <th>Reponse</th>
                                            <th style='text-align: center;'>Bareme</th>
                                            <th style="text-align: center;">Choix</th>
                                            <th style="text-align: center;">Suppression</th>
                                        </tr>
                                            <?php
                                                echo $dataQst;
                                            ?>
                                    </table>
                                </div>
                                <div class="validate">
                                    <input class="btn1" name="subT" type="submit" value="Creer">
                                    <input class="btn1" name="subS" type="submit" value="Supp">
                                </div>
                            </div>
                    </div>
                    <div class="addForm">
                        <div class="head">
                            <div class="headContent">
                                <i class="fa-solid fa-circle-plus"></i> Ajouter un question
                            </div>
                        </div>

                        <div class="part3">
                                <div class="info">
                                    <label for="">Question : </label>
                                    <textarea id="tt" class="inp" name="qst" id="" cols="30" rows="10"></textarea>
                                </div>
                                <div class="info">
                                    <label for="">Reponse : </label>
                                    <input id="yy" class="inp" type="text" name="rep" id="">
                                </div>
                                <div class="info">
                                    <label for="">Bareme : </label>
                                    <input id="yy" class="inp" type="number" name="bar" id="" max="3" min="1">
                                </div>
                                <div class="validate">
                                    <input id="zz" class="btn1" name="subQst" type="submit" value="Ajouter">
                                </div>
                            </div>
                        </form>

                        <div class="head">
                            <div class="headContent">
                                <i class="fa-solid fa-list-ol"></i> Vos tests
                            </div>
                        </div>

                        <div class="part4">
                                <div class="tableDiv">
                                    <!-- <table id="testData">
                                        <tr>
                                            <th># ID</th>
                                            <th style="text-align: center;">Titre</th>
                                        </tr>
                                            <?php
                                                // echo $dataTest;
                                            ?>
                                    </table> -->

                                    <?php
                                        if(isset($notesTest)) {
                                            echo $notesTest;
                                        } else {
                                            echo $dataTest;
                                        }
                                    ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script src="./js/ensTest.js"></script>
    <?php
        if(isset($_SESSION['err_test'])) {
            echo $_SESSION['err_test'];
        }
    ?>
</body>
</html>