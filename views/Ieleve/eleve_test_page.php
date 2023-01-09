<?php 
require "../../phpFiles/Eleve/eleTestPage.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/39383a79c4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/eleve_test_page.css">
    
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans&family=Raleway:wght@500&family=Roboto+Slab:wght@500&family=Rubik&family=Ubuntu:ital@0;1&display=swap');
    </style>
    <title>eEducation</title>
</head>

<body>
    <div id="king">
        
        <div class="prince1">
            <div class="userDiv">
                <ul>
                    <li><i class="fa-regular fa-circle-user userIcon"></i> <span><?php echo $_SESSION['fn']; ?></span></li>
                </ul>
            </div>
        </div>
        <div class="prince2">
            <div class="infoTest">
                <div class="infoSup">
                <table class="bb">
                    <tr>
                        <td><label for="">Nombre des questions : </label></td><td><?php echo $questions; ?></td>
                    </tr>
                    <tr>
                        <td><label for="">Classe :</label></td><td><?php echo $classe; ?></td>
                    </tr>
                    <tr>
                        <td><label for="">CNE Eleve :</label></td><td><?php echo $cne; ?></td>
                    </tr>
                </table>
                    <!-- <p>Annee Scolaire : 2022/2023</p>
                    <p>Classe : DUT INFO</p>
                    <p>CNE Eleve : AL06102001</p> -->

                </div>
                <div class="infoTest1">
                    <h2><?php echo $matiere; ?> - <?php echo $titre; ?></h2>
                    <h3>Prof <?php echo $ens; ?></h3>
                    <h3>Duree : <span id="timer"></span> </h3>
                    <input id="idTst" type="hidden" value="<?php echo $id_test;?>">
                </div>
            </div>
            <form action="../../phpFiles/Eleve/eleTestPage.php<?php echo "?".$id_test; ?>" method="post">
            <div class="testBoth">

                <?php
                    $size = count($qsts);
                    for ($i = 0; $i < count($qsts); $i += 2) {
                        echo "<div class='testBoth1'>
                            <div class='qst'>
                                <h3>Question : ".($i + 1)."</h3>
                                <p>".$qsts[$i]['question']."</p>
                                
                                <!-- <input type='text' placeholder='Votre reponse' name='response'> -->
                                <textarea id='res$i' name='reponse[]' id=' cols='60' rows=2' placeholder='Votre reponse'></textarea>
                            </div>";
                            if (($i + 1) < count($qsts)) {
                                $t = $i + 1;
                                echo "<div class='qst'>
                                    <h3>Question : ".($i+2)."</h3>
                                        <p>".$qsts[$i + 1]['question']."</p>
                                        
                                        <!-- <input type='text' placeholder='Votre reponse' name='response'> -->
                                        <textarea id='res$t' name='reponse[]' id=' cols='60' rows=2' placeholder='Votre reponse'></textarea>
                                    </div>
                                </div>";
                            }
                    }
                ?>
            </div>

            <div class="valide">
                <div class="verifie">
                    <input id="check" type="checkbox" name="verifie" >
                    <p>j'ai verifier tous les champs, et je valide mon Test.</p>
                </div>

                <input id="val" type="submit" name="sub" value="Valider" class="validerbtn">
            </div>
            </form>
            <!-- <div class="contentDiv">
                <div class="timer">
                    
                </div>
                <form action="" method="POST" class="annonceDiv">
                    <div class="questionDiv">
                        <div class="questionAnnDiv">
                            <div class="questionAnn" onmousedown="return false;" onselect="return false">
                                <span class="num">1</span>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, nemo? Eligendi veritatis, repellendus aut nostrum eaque 
                                autem a modi quia? Cupiditate, sint. Facere perferendis inventore culpa nihil suscipit quas aperiam. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quas mollitia, corporis reiciendis, quidem deserunt consequatur dolorum explicabo quam qui vero obcaecati, 
                                ab placeat repellendus! Debitis voluptatem ad asperiores reiciendis enim. Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque blanditiis, alias culpa aut aperiam perspiciatis iure ad 
                                sit ex repellat dignissimos eum. Repellat dolorem ullam voluptates totam cum? Iste, laudantium!
                            </div>
                            <div class="ansDiv">
                                <input class="inp" type="text" name="" id="" placeholder="Votre reponse ...">
                            </div>
                        </div>
                    </div>

                    <div class="questionDiv">
                        <div class="questionAnnDiv">
                            <div class="questionAnn" onmousedown="return false;" onselect="return false">
                                <span class="num">1</span>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, nemo? Eligendi veritatis, repellendus aut nostrum eaque 
                                autem a modi quia? Cupiditate, sint. Facere perferendis inventore culpa nihil suscipit quas aperiam. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quas mollitia, corporis reiciendis, quidem deserunt consequatur dolorum explicabo quam qui vero obcaecati, 
                                ab placeat repellendus! Debitis voluptatem ad asperiores reiciendis enim. Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque blanditiis, alias culpa aut aperiam perspiciatis iure ad 
                                sit ex repellat dignissimos eum. Repellat dolorem ullam voluptates totam cum? Iste, laudantium!
                            </div>
                            <div class="ansDiv">
                                <input class="inp" type="text" name="" id="" placeholder="Votre reponse ...">
                            </div>
                        </div>
                    </div>

                    <div class="questionDiv">
                        <div class="questionAnnDiv">
                            <div class="questionAnn" onmousedown="return false;" onselect="return false">
                                <span class="num">1</span>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, nemo? Eligendi veritatis, repellendus aut nostrum eaque 
                                autem a modi quia? Cupiditate, sint. Facere perferendis inventore culpa nihil suscipit quas aperiam. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quas mollitia, corporis reiciendis, quidem deserunt consequatur dolorum explicabo quam qui vero obcaecati, 
                                ab placeat repellendus! Debitis voluptatem ad asperiores reiciendis enim. Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque blanditiis, alias culpa aut aperiam perspiciatis iure ad 
                                sit ex repellat dignissimos eum. Repellat dolorem ullam voluptates totam cum? Iste, laudantium!
                            </div>
                            <div class="ansDiv">
                                <input class="inp" type="text" name="" id="" placeholder="Votre reponse ...">
                            </div>
                        </div>
                    </div>

                    <div class="questionDiv">
                        <div class="questionAnnDiv">
                            <div class="questionAnn" onmousedown="return false;" onselect="return false">
                                <span class="num">1</span>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, nemo? Eligendi veritatis, repellendus aut nostrum eaque 
                                autem a modi quia? Cupiditate, sint. Facere perferendis inventore culpa nihil suscipit quas aperiam. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quas mollitia, corporis reiciendis, quidem deserunt consequatur dolorum explicabo quam qui vero obcaecati, 
                                ab placeat repellendus! Debitis voluptatem ad asperiores reiciendis enim. Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque blanditiis, alias culpa aut aperiam perspiciatis iure ad 
                                sit ex repellat dignissimos eum. Repellat dolorem ullam voluptates totam cum? Iste, laudantium!
                            </div>
                            <div class="ansDiv">
                                <input class="inp" type="text" name="" id="" placeholder="Votre reponse ...">
                            </div>
                        </div>
                    </div>

                    <div class="finishDiv">
                        <input class="btn1" type="submit" value="Terminer !">
                    </div>
                </form>
            </div> -->
        </div>
    </div>

    <script>
        let duree = '<?php echo $duree;?>';
        const timer = document.getElementById('timer')
        if (duree = '1 heure') {
            const starting = 60;
            let time = starting * 60;

            setInterval(updateCounter, 1000)
            
            function updateCounter() {
                const minutes = Math.floor(time / 60);
                let seconds = time % 60;

                seconds = seconds < 10 ? '0' + seconds : seconds

                timer.innerHTML = `${minutes} : ${seconds}`
                time--;
                if (minutes <= 10) {
                    timer.style.color = 'red'
                }

                if (minutes == 0 && seconds == 0) {
                    
                }
            }
        } else {
            const starting = 30;
            let time = starting * 60;

            setInterval(updateCounter, 1000)
            
            function updateCounter() {
                const minutes = Math.floor(time / 60);
                let seconds = time % 60;

                seconds = seconds < 10 ? '0' + seconds : seconds

                timer.innerHTML = `${minutes} : ${seconds}`
                time--;
                if (minutes <= 10) {
                    timer.style.color = 'red'
                }
            }
        }
    </script>
</body>
</html>