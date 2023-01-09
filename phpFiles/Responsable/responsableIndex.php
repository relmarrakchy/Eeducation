<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $req = "select * from responsable where id_responsable = ".$_SESSION['id_responsable'].";";
    $res = mysqli_query($con, $req);
    while ($row = mysqli_fetch_assoc($res)) {
        $_SESSION['resName'] = $row['nom'] ." ".$row['prenom'];
        $_SESSION['resEmail'] = $row['email'];
    }

    $reqStats = "SELECT titre, COUNT(eleve.cne) as eleves FROM eleve
    INNER JOIN classe ON eleve.id_classe = classe.id_classe
    GROUP BY eleve.id_classe;";
    $resStats = mysqli_query($con, $reqStats);
    $i = 0;
    while ($row = mysqli_fetch_assoc($resStats)) {
        $classes[$i] = $row['titre'];
        $eleves[$i] = $row['eleves'];
        $i++;
    }

    

    $reqnumEleve = "select count(cne) as total from eleve";
    $resnumEleve = mysqli_query($con, $reqnumEleve);
    while ($row = mysqli_fetch_assoc($resnumEleve)) {
        $_SESSION['numEleve'] = $row['total'];
    }

    $reqnumEns = "select count(cin) as total from enseignant";
    $resnumEns = mysqli_query($con, $reqnumEns);
    while ($row = mysqli_fetch_assoc($resnumEns)) {
        $_SESSION['numEns'] = $row['total'];
    }

    $reqnumCl = "select count(id_classe) as total from classe";
    $resnumCl = mysqli_query($con, $reqnumCl);
    while ($row = mysqli_fetch_assoc($resnumCl)) {
        $_SESSION['numCl'] = $row['total'];
    }

    $reqnumTuteur = "select count(cin_tuteur) as total from tuteur";
    $resnumTuteur = mysqli_query($con, $reqnumTuteur);
    while ($row = mysqli_fetch_assoc($resnumTuteur)) {
        $_SESSION['numTuteur'] = $row['total'];
    }

    $reqnumCl = "select count(id_classe) as total from classe";
    $resnumCl = mysqli_query($con, $reqnumCl);
    while ($row = mysqli_fetch_assoc($resnumCl)) {
        $_SESSION['numCl'] = $row['total'];
    }

    $reqnumRD = "select count(id_rendezVous) as total from rendez_vous";
    $resnumRD = mysqli_query($con, $reqnumRD);
    while ($row = mysqli_fetch_assoc($resnumRD)) {
        $_SESSION['numRD'] = $row['total'];
    }

    $reqnumAnn = "select count(id_annonce) as total from annonce";
    $resnumAnn = mysqli_query($con, $reqnumAnn);
    while ($row = mysqli_fetch_assoc($resnumAnn)) {
        $_SESSION['numAnn'] = $row['total'];
    }
?>