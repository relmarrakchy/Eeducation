<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $req = "select eleve.*, classe.titre from eleve 
    inner join classe on eleve.id_classe = classe.id_classe
    where cne = '".$_SESSION['cne']."'";
    $res = mysqli_query($con, $req);
    while ($row = mysqli_fetch_assoc($res)) {
        $cne = $_SESSION['cne'];
        $nationalite = $row['nationalite'];
        $prenom = $row['prenom'];
        $nom = $row['nom'];
        $classe = $row['titre'];
        $sexe = $row['sexe'];
        $date_naissance = $row['date_naissance'];
        $lieu_naissance = $row['lieu_naissance'];
        $adresse = $row['adresse'];
        $telephone = $row['telephone'];
        $email = $row['email'];
        $pass = $row['pass'];
    }

    if (isset($_POST['subE'])) {
        if (!empty($_POST['actE']) && !empty($_POST['nE'])) {
            $req = "update eleve set email = '".$_POST['nE']."' where cne = '".$_SESSION['cne']."';";
            mysqli_query($con, $req);
            header('location:../../views/Ieleve/eleve_parametres.php');
        }
    }

    if (isset($_POST['subP'])) {
        if (!empty($_POST['actP']) && !empty($_POST['nP'] && !empty($_POST['vP']))) {
            if ($_POST['nP'] == $_POST['vP']) {
                $req = "update eleve set pass = '".$_POST['nP']."' where cne = '".$_SESSION['cne']."';";
                mysqli_query($con, $req);
                header('location:../../views/Ieleve/eleve_parametres.php');
            }
        }
    }
?>