<?php
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $_SESSION['err_note'] = "";

    $req = "select * from enseignant where id_enseignant = ".$_SESSION['id_enseignant'].";";
    $res = mysqli_query($con, $req);
    while ($row = mysqli_fetch_assoc($res)) {
        $fn = $row['nom']." ".$row['prenom'];
    }

    $req = "SELECT id_matiere from enseignant WHERE id_enseignant = ".$_SESSION['id_enseignant'].";";
    $res = mysqli_query($con, $req);
    while ($row = mysqli_fetch_assoc($res)) {
        $idm = $row['id_matiere'];
    }

    $reqClasse = "select classe.id_classe ,titre from classe 
    inner join classe_enseignant on classe.id_classe = classe_enseignant.id_classe
    where classe_enseignant.id_enseignant = ".$_SESSION['id_enseignant'].";";
    $resClasse = mysqli_query($con, $reqClasse);
    $classes = "";
    while ($row = mysqli_fetch_assoc($resClasse)) {
        $classes .= "<div class='navList activee'><span><i class='fa-solid fa-chalkboard navIcon'></i>
        <a href='http://localhost/PFE/PFE/views/Ienseignant/Ienseignant_notes.php?".$row['id_classe']."'>".$row['titre']."</a></span></div>";
    }

    $idP = explode('?', $_SERVER['REQUEST_URI']);
    $id_classe = end($idP);
    setcookie('idclasse', $id_classe, time() + (86400 * 30), "/");
    if ($id_classe === $_SERVER['REQUEST_URI']) $id_classe = 0;

    $reqT = "SELECT * from classe WHERE id_classe = $id_classe";
    $resT = mysqli_query($con, $reqT);
    while ($row = mysqli_fetch_assoc($resT)) {
        $t = $row['titre'];
        $id = $id_classe;
    }

    $reqEleve = "select * from eleve where id_classe = $id_classe";
    $resEleve = mysqli_query($con, $reqEleve);
    $eleves = "";
    while ($row = mysqli_fetch_assoc($resEleve)) {
        $eleves .= "<option value='".$row['cne']."'>".$row['cne']."</option>";
    }

    $reqDataSemestre0 = "select * from semestre";
    $resDataSemestre0 = mysqli_query($con, $reqDataSemestre0);
    $semI = "";
    while ($row = mysqli_fetch_assoc($resDataSemestre0)) {
        $semI .= "<option value='".$row['id_semestre']."'>".$row['num_semestre']."</option>";
    }

    $reqDataSemestre = "select * from semestre";
    $resDataSemestre = mysqli_query($con, $reqDataSemestre);
    $sem = "";
    while ($row = mysqli_fetch_assoc($resDataSemestre)) {
        $sem .= "<option value='".$row['num_semestre']."'>".$row['num_semestre']."</option>";
    }

    $reqData = "SELECT note.note, note.date_note, note.num_cc, eleve.cne, eleve.nom, eleve.prenom, semestre.num_semestre 
    FROM note
    INNER JOIN eleve ON note.cne_eleve = eleve.cne
    INNER JOIN enseignant ON note.id_matiere = enseignant.id_matiere
    INNER JOIN classe_enseignant ON enseignant.id_enseignant = classe_enseignant.id_enseignant
    INNER JOIN semestre ON note.id_semestre = semestre.id_semestre
    WHERE enseignant.id_enseignant = ".$_SESSION['id_enseignant']." 
    AND classe_enseignant.id_classe = $id_classe
    AND eleve.id_classe = $id_classe";
    $resData = mysqli_query($con, $reqData);
    $data = "";
    while ($row = mysqli_fetch_assoc($resData)) {
        $data .= "<tr>
            <td>".$row['cne']."</td>
            <td>".$row['nom']."</td>
            <td>".$row['prenom']."</td>
            <td>".$row['num_semestre']."</td>
            <td>".$row['num_cc']."</td>
            <td>".$row['note']."</td>
            <td>".$row['date_note']."</td>
        </tr>";
    }

    if(isset($_POST['sub'])) {
        $sem = $_POST['sem'];
        $cc = $_POST['cc'];
        $cne = $_POST['cne'];
        $note = $_POST['note'];
        $date = date('Y-m-d');

        $idP = explode('?', $_SERVER['REQUEST_URI']);
        $id_classe = end($idP);

        if(!empty($sem) && !empty($cc) && !empty($cne) && !empty($note)) {
            $reqV = "select * from note where cne_eleve = '$cne' and id_matiere = '$idm' and num_cc = $cc";
            $resV = mysqli_query($con, $reqV);
            if (mysqli_num_rows($resV) == 0) {
                $reqI = "insert into note values (null, '$cne', '$idm', $sem, $cc, $note, '$date')";
                mysqli_query($con, $reqI);
                header('location:../../PFE/views/Ienseignant/Ienseignant_notes.php?'.$id_classe);
            } else {
                $_SESSION['err_note'] = "Already set !";
                header('location:../../PFE/views/Ienseignant/Ienseignant_notes.php?'.$id_classe);
            }
        }
    }

    if (isset($_POST['search'])) {
        $sem = $_POST['semS'];
        $cc = $_POST['ccS'];

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
        // var_dump($resDataN);
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
        $_SESSION['new_Data'] = $dataN;
        header('location:../../PFE/views/Ienseignant/Ienseignant_notes.php?'.$_COOKIE['idclasse']);
    }
?>