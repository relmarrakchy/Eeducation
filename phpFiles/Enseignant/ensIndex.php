<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $reqEmploi = "SELECT url FROM emploi
    INNER JOIN enseignant ON emploi.id_emploi = enseignant.id_emploi
    WHERE enseignant.id_enseignant = ".$_SESSION['id_enseignant'].";";
    $resEmploi = mysqli_query($con, $reqEmploi);
    while ($row = mysqli_fetch_assoc($resEmploi)) {
        $url = $row['url'];
    }

    if(!empty($_GET['file']))
    {
        $filename = basename($_GET['file']);
        $filepath = 'C:/xampp/htdocs/PFE/data/emplois/' . $filename;
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

    $req = "select * from enseignant where id_enseignant = ".$_SESSION['id_enseignant'].";";
    $res = mysqli_query($con, $req);
    while ($row = mysqli_fetch_assoc($res)) {
        $fn = $row['nom']." ".$row['prenom'];
        $cin = $row['cin'];
    }

    $reqStats = "SELECT titre, COUNT(eleve.cne) as eleves FROM eleve
    INNER JOIN classe ON eleve.id_classe = classe.id_classe
    GROUP BY eleve.id_classe;";
    $resStats = mysqli_query($con, $reqStats);
    $i = 0;
    while ($row = mysqli_fetch_assoc($resStats)) {
        $classesStats[$i] = $row['titre'];
        $elevesStats[$i] = $row['eleves'];
        $i++;
    }

    $reqEle = "SELECT count(*) as total FROM eleve WHERE id_classe in (SELECT id_classe FROM classe_enseignant WHERE id_enseignant = ".$_SESSION['id_enseignant'].");";
    $resEle = mysqli_query($con, $reqEle);
    while ($row = mysqli_fetch_assoc($resEle)) {
        $eleves = $row['total'];
    }

    $reqCla = "SELECT COUNT(*) as total FROM classe_enseignant WHERE id_enseignant = ".$_SESSION['id_enseignant'].";";
    $resCla = mysqli_query($con, $reqCla);
    while ($row = mysqli_fetch_assoc($resCla)) {
        $classes = $row['total'];
    }

    $reqCours = "SELECT COUNT(*) as total FROM cours WHERE id_enseignant = ".$_SESSION['id_enseignant'].";";
    $resCours = mysqli_query($con, $reqCours);
    while ($row = mysqli_fetch_assoc($resCours)) {
        $cours = $row['total'];
    }

    $reqAnn = "SELECT * FROM annonce WHERE destination = 'enseignants'";
    $resAnn = mysqli_query($con, $reqAnn);
    $annonce = "";
    while ($row = mysqli_fetch_assoc($resAnn)) {
        $annonce .= "<div class='annonce'>
            <div class='textDiv'>
                <div class='text'>
                    ".$row['annonce']."
                </div>
            </div>
            <div class='dateDiv'>
                <div class='date'>
                ".$row['date_diffusion']."
                </div>
            </div>
        </div>";
    }

?>