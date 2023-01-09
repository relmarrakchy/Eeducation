<?php 
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $reqNav = "SELECT * from matiere INNER JOIN enseignant on matiere.id_matiere = enseignant.id_matiere
    INNER JOIN classe_enseignant on classe_enseignant.id_enseignant = enseignant.id_enseignant 
    WHERE classe_enseignant.id_classe = (SELECT id_classe FROM eleve WHERE cne = '".$_SESSION['cne']."');";
    $resNav = mysqli_query($con, $reqNav);
    $nav = "";
    while ($row = mysqli_fetch_assoc($resNav)) {
        if ($row['discipline'] == "Science de la vie et de la terre") $row['discipline'] = "SVT";
        $nav .= "<div class='navList'><span><i class='fa-solid fa-chalkboard navIcon'></i>
        <a href='http://localhost/PFE/views/Ieleve/eleve_cours.php?".$row['id_matiere']."'>".$row['discipline']."</a></span></div>";
    }

    $id = explode('?', $_SERVER['REQUEST_URI']);
    $id_matiere = end($id);

    $reqT = "SELECT * from matiere INNER JOIN enseignant on matiere.id_matiere = enseignant.id_matiere
    INNER JOIN classe_enseignant on classe_enseignant.id_enseignant = enseignant.id_enseignant 
    WHERE matiere.id_matiere = '$id_matiere' AND classe_enseignant.id_classe = (SELECT id_classe FROM eleve WHERE cne = '".$_SESSION['cne']."');";
    $resT = mysqli_query($con, $reqT);
    while ($row = mysqli_fetch_assoc($resT)) {
        $t = $row['discipline'];
    }

    if(!empty($_GET['file']))
    {
        $filename = basename($_GET['file']);
        $filepath = $_GET['file'];
        echo "<script>alert('$filepath')</script>";

        if(!empty($filename) && file_exists($filepath)){

    //Define Headers
            header("Cache-Control: public");
            header("Content-Description: FIle Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/zip");
            header("Content-Transfer-Emcoding: binary");

            readfile($filepath);
            exit;
        } else {
            echo "<script>alert('Pas encore ...')</script>";
        }
    }

    $reqCours = "SELECT cours.* from cours INNER JOIN enseignant ON enseignant.id_enseignant = cours.id_enseignant
    INNER JOIN classe_cours on cours.id_cours = classe_cours.id_cours
    WHERE enseignant.id_matiere = '$id_matiere' AND classe_cours.id_classe = (SELECT id_classe FROM eleve
    WHERE cne = '".$_SESSION['cne']."');";
    $resCours = mysqli_query($con, $reqCours);
    $cours = "";
    while ($row = mysqli_fetch_assoc($resCours)) {
        $cours .= "<div class='cours'>
                <div class='heart'>
                    <div class='coursTitre'>
                        <div>".$row['titre']."</div>
                    </div>
                    <div class='coursLink'>
                        <div>
                            <i class='fa-solid fa-file navIcon'></i>
                            <a href='http://localhost/PFE/views/Ieleve/eleve_cours.php?file=".$row['url']."'>".$row['titre'].".pdf</a>
                        </div>
                    </div>
                </div>
                <div class='timeDiv'>
                    <div class='time'>".$row['date_creation']."</div>
                </div>
        </div>";
    }
    
?>