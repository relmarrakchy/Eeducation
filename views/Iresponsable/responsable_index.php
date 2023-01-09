<?php
    require "../../phpFiles/Responsable/responsableIndex.php";
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
    <link rel="stylesheet" href="./css/responsable_index.css">
    
    <title>eEducation</title>
</head>
<body>
    <div id="king">
        <div class="prince1">
            <div class="userDiv">
                <ul>
                <li style="float:left; margin-top:5px; margin-left: 40px; "><span style="font-weight:lighter; font-family: cursive;">Vous etes connecte en tant que <?php echo $_SESSION['role'];?></span></li>
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
                        <div class="navList active"><span><i class="fa-solid fa-house-user navIcon"></i><a href="./responsable_index.php">Acceuil</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-square-plus navIcon"></i><a href="../../PFE/views/Iresponsable/responsable_inscription.php">Inscriptions</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-share-from-square navIcon"></i><a href="./responsable_annonces.php">Annonces</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-file navIcon"></i><a href="./responsable_demandes.php">Demandes</a></span></div>
                        <div class="navList"><span><i class="fa-solid fa-calendar-days navIcon"></i><a href="./responsable_emplois.php">Emplois</a></span></div>
                        <br><br><br><br><br><br><br><br><br><br>    
                        <div class="navList"><span><i class="fa-solid fa-right-from-bracket navIcon"></i><a href="../../phpFiles/logout.php">Deconnexion</a></span></div>
                    </nav>
                </div>
            </div>
            <div class="contentDiv">
                <div class="content">
                    <div class="blocksDiv">
                        <div class="blocks">
                            <div class="iconDiv"><i class="fa-solid fa-graduation-cap block-icon"></i></div>
                            <div class="infoDiv">
                                <div class="info">
                                    <p class="num"><?php echo $_SESSION['numEleve'];?></p>
                                    <span class="title">Eleves</span>
                                </div>
                            </div>
                        </div>
                        <div class="blocks">
                            <div class="iconDiv"><i class="fa-solid fa-person-chalkboard block-icon"></i></div>
                            <div class="infoDiv">
                                <div class="info">
                                    <p class="num"><?php echo $_SESSION['numEns'];?></p>
                                    <span class="title">Enseignants</span>
                                </div>
                            </div>
                        </div>
                        <div class="blocks">
                            <div class="iconDiv"><i class="fa-solid fa-chalkboard-user block-icon"></i></i></div>
                            <div class="infoDiv">
                                <div class="info">
                                    <p class="num"><?php echo $_SESSION['numCl'];?></p>
                                    <span class="title">Classes</span>
                                </div>
                            </div>
                        </div>
                        <div class="blocks">
                            <div class="iconDiv"><i class="fa-solid fa-people-group block-icon"></i></div>
                            <div class="infoDiv">
                                <div class="info">
                                    <p class="num"><?php echo $_SESSION['numTuteur'];?></p>
                                    <span class="title">Tuteurs</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="graphsDiv">
                        <div class="graph1Div">
                            <div class="graph1">
                                <canvas style="width: 90%; height: 90%;" id="myChart" style="width:100%;max-width:600px"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="blocksDiv">
                        <div class="blocks">
                            <div class="iconDiv"><i class="fa-solid fa-calendar-day block-icon"></i></div>
                            <div class="infoDiv">
                                <div class="info">
                                    <p class="num">2021 - 2022</p>
                                    <span class="title">Annee scolaire</span>
                                </div>
                            </div>
                        </div>
                        <div class="blocks">
                            <div class="iconDiv"><i class="fa-solid fa-calendar-check block-icon"></i></div>
                            <div class="infoDiv">
                                <div class="info">
                                    <p class="num"><?php echo $_SESSION['numRD'];?></p>
                                    <span class="title">Rendez-vous</span>
                                </div>
                            </div>
                        </div>
                        <div class="blocks">
                            <div class="iconDiv"><i class="fa-solid fa-newspaper block-icon"></i></div>
                            <div class="infoDiv">
                                <div class="info">
                                    <p class="num"><?php echo $_SESSION['numAnn'];?></p>
                                    <span class="title">Annonces</span>
                                </div>
                            </div>
                        </div>
                        <div class="blocks">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var xValues = <?php echo json_encode($classes) ?>;

        var yValues = <?php echo json_encode($eleves) ?>;
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
            text: "Statistiques des classes"
            }
        }
        });
    </script>
</body>
</html>