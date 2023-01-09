<?php
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $reqRDData = "SELECT * FROM rendez_vous 
        INNER JOIN eleve ON rendez_vous.cne_eleve = eleve.cne
        INNER JOIN classe ON eleve.id_classe = classe.id_classe
        WHERE rendez_vous.etat = 'En attente'";
    $resRDData = mysqli_query($con, $reqRDData);
    $RDData = "";
    while ($row = mysqli_fetch_assoc($resRDData)) {
        $RDData .= "<tr>
            <td>".$row['id_rendezVous']."</td>
            <td>".$row['cne']."</td>
            <td>".$row['titre']."</td>
            <td>".$row['type']."</td>
            <td>".$row['date_demande']."</td>
            <td style='text-align: center;'><input name='acc[]' type='checkbox' value='".$row['id_rendezVous']."'></td>
            <td style='text-align: center'><input name='ref[]' type='checkbox' value='".$row['id_rendezVous']."'></td>
        </tr>";
    }

    if(isset($_POST['subAcc'])) {
        if(isset($_POST['acc'])) {
            foreach ($_POST['acc'] as $demande) {
                $reqAcc = "update rendez_vous set etat = 'Accepte' where id_rendezVous = $demande";
                mysqli_query($con, $reqAcc);
                header('location:../../views/Iresponsable/responsable_demandes.php');
            }
        }
    }

    if(isset($_POST['subRef'])) {
        if(isset($_POST['ref'])) {
            foreach ($_POST['ref'] as $demande) {
                $reqRef = "update rendez_vous set etat = 'Refuse' where id_rendezVous = $demande";
                mysqli_query($con, $reqRef);
                header('location:../../views/Iresponsable/responsable_demandes.php');
            }
        }
    }
?>