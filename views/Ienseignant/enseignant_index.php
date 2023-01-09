<?php
    require "../../phpFiles/Enseignant/ensIndex.php";
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
    <link rel="stylesheet" href="./css/enseignant_index.css">
    
    <title>eEducation</title>
</head>
<body>
    <div id="king">
        <div class="prince1">
            <div class="userDiv">
                <ul>
                <li style="float:left; margin-top: 5px; margin-left: 40px;"><span style="font-weight:lighter; font-family: cursive;">Vous etes connecte en tant que <?php echo $_SESSION['role'];?></span></li>
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
                        <div class="navList active"><span><i class="fa-solid fa-house-user navIcon"></i><a href="./enseignant_index.php">Acceuil</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-square-plus navIcon"></i><a href="../../PFE/views/Ienseignant/enseignant_cours.php">Cours</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-share-from-square navIcon"></i><a href="./enseignant_test.php">Tests</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-file navIcon"></i><a href="../../PFE/views/Ienseignant/Ienseignant_notes.php">Notes</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-gear navIcon"></i><a href="./enseignant_parametre.php">Parametres</a></span></div>
                        <br><br><br><br><br><br><br><br><br><br>
                        <div class="navList"><span><i class="fa-solid fa-right-from-bracket navIcon"></i><a href="../../phpFiles/logout.php">Deconnexion</a></span></div>
                    </nav>
                </div>
            </div>
            <div class="contentDiv">
                <div class="content">
                    <div class="blocksDiv">
                        <div class="blocks">
                            <div class="iconDiv"><i class="fa-solid fa-graduation-cap block-icon re"></i></div>
                            <div class="infoDiv">
                                <div class="info">
                                    <p class="num"><?php echo $eleves;?></p>
                                    <span class="title">Eleves</span>
                                </div>
                            </div>
                        </div>
                        <div class="blocks">
                            <div class="iconDiv"><i class="fa-solid fa-person-chalkboard block-icon re"></i></div>
                            <div class="infoDiv">
                                <div class="info">
                                    <p class="num"><?php echo $classes;?></p>
                                    <span class="title">Classes</span>
                                </div>
                            </div>
                        </div>
                        <div class="blocks">
                            <div class="iconDiv"><i class="fa-solid fa-chalkboard-user block-icon re"></i></i></div>
                            <div class="infoDiv">
                                <div class="info">
                                    <p class="num"><?php echo $cours;?></p>
                                    <span class="title">Cours</span>
                                </div>
                            </div>
                        </div>
                        <div class="blocks">
                            <div class="iconDiv"><i class="fa-solid fa-calendar-days block-icon "></i></div>
                            <div class="infoDiv">
                                <div class="info">
                                    <p class="num">Emploi</p>
                                    <span class="title"><a href='http://localhost/PFE/views/Ienseignant/enseignant_index.php?file=<?php echo $cin.".pdf"?>'>voir</a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="graphsDiv">
                        <div class="graph1Div">
                            <div class="graph1">
                                <div class="head">
                                    <div class="headContent">
                                        <i class="fa-solid fa-list"></i> Liste des annonces
                                    </div>
                                </div>

                                <?php
                                    echo $annonce;
                                ?>
                            </div>
                        </div>

                        <div class="graph2Div">
                            <div class="graph2">
                                <canvas id="myChart" style=" width:95%; height: 95%;"></canvas>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var xValues = <?php echo json_encode($classesStats) ?>;
        var yValues = <?php echo json_encode($elevesStats) ?>;
        var barColors = ["red", "green","blue","orange","brown"];

        new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            text: "Statistiques des classes par eleves"
            }
        }
        });
    </script>
</body>
</html>