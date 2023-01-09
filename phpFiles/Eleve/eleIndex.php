<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $req = "select eleve.*, classe.titre from eleve
    inner join classe on eleve.id_classe = classe.id_classe
    where cne = '".$_SESSION['cne']."';";
    $res = mysqli_query($con, $req);
    while ($row = mysqli_fetch_assoc($res)) {
        $_SESSION['fn'] = $row['nom']." ".$row['prenom'];
        $classe = $row['titre'];
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

    $reqAnn = "SELECT * FROM annonce WHERE destination = 'Eleves'";
    $resAnn = mysqli_query($con, $reqAnn);
    $annonce = "";
    while ($row = mysqli_fetch_assoc($resAnn)) {
        $annonce .= "<div class='annDiv'>
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

    $date = date('Y-m-d');

    $reqNote = "select count(*) as total from note 
    where cne_eleve = '".$_SESSION['cne']."' and date_note = '$date';";
    $resNote = mysqli_query($con, $reqNote);
    while ($row = mysqli_fetch_assoc($resNote)) {
        $notes = $row['total'];
    }

    $reqTest = "SELECT COUNT(*) as total from test 
    INNER JOIN eleve_test ON eleve_test.id_test = test.id_test
    WHERE eleve_test.cne_eleve = '".$_SESSION['cne']."' AND eleve_test.etat = 'Non consulte';";
    $resTest = mysqli_query($con, $reqTest);
    while ($row = mysqli_fetch_assoc($resTest)) {
        $tests = $row['total'];
    }

    $reqRD = "select count(*) as total from rendez_vous where cne_eleve = '".$_SESSION['cne']."' and etat = 'En attente' ;";
    $resRD = mysqli_query($con, $reqRD);
    while ($row = mysqli_fetch_assoc($resRD)) {
        $RDs = $row['total'];
    }

    $reqAnnC = "SELECT count(*) as total FROM annonce WHERE destination = 'Eleves'";
    $resAnnC = mysqli_query($con, $reqAnnC);
    while ($row = mysqli_fetch_assoc($resAnnC)) {
        $annonceC = $row['total'];
    }

    $reqCours = "SELECT cours.*, enseignant.*, matiere.* from cours 
    INNER JOIN classe_cours on cours.id_cours = classe_cours.id_cours
    INNER JOIN enseignant on cours.id_enseignant = enseignant.id_enseignant
    INNER JOIN matiere ON enseignant.id_matiere = matiere.id_matiere
    WHERE cours.date_creation = '$date' AND classe_cours.id_classe = (SELECT id_classe from eleve where cne = '".$_SESSION['cne']."');";
    $resCours = mysqli_query($con, $reqCours);
    $cours = "";
    while ($row = mysqli_fetch_assoc($resCours)) {
        $cours .= " <tr>
            <td>".$row['id_cours']."</td>
            <td>".$row['discipline']."</td>
            <td>".$row['nom']." ".$row['prenom']."</td>
            <td>".$row['titre']."</td>
            <td>".$row['date_creation']."</td>
        </tr>";
    }
?>