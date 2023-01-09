<?php
    // echo "<script>alert('".$_COOKIE['idens']."')</script>";
    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    if (isset($_POST['search'])) {
        $sem = $_POST['semS'];
        $cc = $_POST['ccS'];
        echo "<script>alert('".$_POST['ccS']."')</script>";

        $reqDataN = "SELECT note.note, note.date_note, note.num_cc, eleve.cne, eleve.nom, eleve.prenom, semestre.num_semestre 
        FROM note
        INNER JOIN eleve ON note.cne_eleve = eleve.cne
        INNER JOIN enseignant ON note.id_matiere = enseignant.id_matiere
        INNER JOIN classe_enseignant ON enseignant.id_enseignant = classe_enseignant.id_enseignant
        INNER JOIN semestre ON note.id_semestre = semestre.id_semestre
        WHERE enseignant.id_enseignant = ".$_COOKIE['idens']." AND classe_enseignant.id_classe = ".$_COOKIE['idclasse']." AND eleve.id_classe = ".$_COOKIE['idclasse']."
        AND semestre.num_semestre = $sem
        AND note.num_cc = $cc";
        $resDataN = mysqli_query($con, $reqDataN);
        var_dump($reqDataN);
        $dataN = "";
        while ($row = mysqli_fetch_assoc($resDataN)) {
            $dataN .= "<tr>
                <td>".$row['cne']."</td>
                <td>".$row['nom']."</td>
                <td>".$row['prenom']."</td>
                <td>".$row['num_semestre']."</td>
                <td>".$row['num_cc']."</td>
                <td>".$row['note']."</td>
                <td>".$row['date_note']."</td>
            </tr>";
        }
        header('location:../../PFE/views/Ienseignant/Ienseignant_notes.php?'.$id_classe);
    }
?>