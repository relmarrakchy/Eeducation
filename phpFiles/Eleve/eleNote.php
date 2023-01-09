<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $reqSm = "Select * from semestre";
    $resSm = mysqli_query($con, $reqSm);
    $data = "";
    while ($row = mysqli_fetch_assoc($resSm)) {
        $data .= "<option value=".$row['id_semestre'].">".$row['num_semestre']."</option>";
    }

    $reqtest = "SELECT test.titre, matiere.discipline, eleve_test.note, test.date_creation, SUM(questionnaire.bareme) as total FROM test
    INNER JOIN eleve_test ON eleve_test.id_test = test.id_test
    INNER JOIN test_questionnaire ON test.id_test = test_questionnaire.id_test
    INNER JOIN questionnaire ON test_questionnaire.id_question = questionnaire.id_question
    INNER JOIN matiere ON matiere.id_matiere = test.id_matiere
    WHERE eleve_test.cne_eleve = '".$_SESSION['cne']."' AND eleve_test.etat <> 'Non consulte'
    GROUP BY test.id_test;";
    $restest = mysqli_query($con, $reqtest);
    $tests = "";;
    while ($row = mysqli_fetch_assoc($restest)) {
        $tests .= "<tr>
            <td>".$row['discipline']."</td>
            <td>".$row['titre']."</td>
            <td>".$row['note']."/".$row['total']."</td>
            <td>".$row['date_creation']."</td>
        </tr>";
    }

    $noteFinal = [];


    $reqMatiere = "SELECT matiere.id_matiere, filiere_matiere.coefficient FROM matiere
    INNER JOIN filiere_matiere ON filiere_matiere.id_matiere = matiere.id_matiere
    INNER JOIN classe ON classe.id_filiere = filiere_matiere.id_filiere
    INNER JOIN eleve ON eleve.id_classe = classe.id_classe
    WHERE eleve.cne = '".$_SESSION['cne']."';";
    $resMatiere = mysqli_query($con, $reqMatiere);
    $matieres = [];
    $i = 0;
    while ($row = mysqli_fetch_assoc($resMatiere)) {
        $matieres[$i] = [
            "id_matiere" => $row['id_matiere'],
            'coef' => $row['coefficient']
        ];
        $i++;
    }

    $reqAllSub = "SELECT COUNT(filiere_matiere.id_matiere) as total FROM filiere_matiere
    INNER JOIN classe ON filiere_matiere.id_filiere = classe.id_filiere
    INNER JOIN eleve ON classe.id_classe = eleve.id_classe
    WHERE eleve.cne = '".$_SESSION['cne']."';";
    $resAllSub = mysqli_query($con, $reqAllSub);
    while ($row = mysqli_fetch_assoc($resAllSub)) {
        $all = $row['total'];
    }

    $size = 0;
    $notesF = [];

    if (!empty($_POST['val'])) {
        $sm = $_POST['sm'];
        $_SESSION['notesCC'] = "";
        $_SESSION['dateSemestre'] = "";
        $j = 0;
        
        foreach ($matieres as $matiere) {
            $reqNotes = "SELECT note.note FROM note
            INNER JOIN matiere ON note.id_matiere = matiere.id_matiere
            INNER JOIN semestre ON note.id_semestre = semestre.id_semestre
            WHERE note.cne_eleve = '".$_SESSION['cne']."' 
            AND note.id_semestre = $sm
            AND matiere.id_matiere = '".$matiere['id_matiere']."'";
            $resNotes = mysqli_query($con, $reqNotes);
            $notes  = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($resNotes)) {
                if ($row['note'] < 0) goto end;  
                $notes[$i] = $row['note'];
                $i++;
            }
            $reqDataNotes = "SELECT note.*, matiere.discipline FROM note
            INNER JOIN matiere ON note.id_matiere = matiere.id_matiere
            INNER JOIN semestre ON note.id_semestre = semestre.id_semestre
            WHERE note.cne_eleve = '".$_SESSION['cne']."' 
            AND note.id_semestre = $sm
            AND matiere.id_matiere = '".$matiere['id_matiere']."' LIMIT 1;";
            $resDataNotes = mysqli_query($con, $reqDataNotes);
            // var_dump($resDataNotes);
            $dataSemestre = "";
            $dataNotes  = "";
            if (mysqli_num_rows($resDataNotes) > 0) {
                while ($row = mysqli_fetch_assoc($resDataNotes)) {
                    $dataNotes = "<tr>
                        <td>".$row['discipline']."</td>
                        <td>".$notes[0]."</td>
                        <td>".$notes[1]."</td>
                        <td>".$notes[2]."</td>
                    </tr>";

                    $dataSemestre = "<tr>
                        <td>".$row['discipline']."</td>
                        <td>".(number_format((float)(($notes[0] + $notes[1] + $notes[2]) / 3), 2, '.', ''))."</td>
                    </tr>
                    <input name='note$j' type='hidden' value='".(($notes[0] + $notes[1] + $notes[2]) / 3)."'>";
                    $notesF[$j] = number_format((float)(($notes[0] + $notes[1] + $notes[2]) / 3), 2, '.', '');
                }

                $_SESSION['notesCC'] .= $dataNotes;
                if ($notes[0] !== null && $notes[1] !== null && $notes[2] !== null) {
                    $j++;
                    $size++;
                    $_SESSION['dataSemestre'] .= $dataSemestre;
                }
            }        
        }
        $_SESSION['dataSemestre'] .= "<input name='size' type='hidden' value='$j'>";
        if ($size == $all) {
            $reqV = "select note_semestre from semestre_eleve where cne_eleve = '".$_SESSION['cne']."' and id_semestre = $sm";
            $resV = mysqli_query($con, $reqV);
            while ($row = mysqli_fetch_assoc($resV)) {
                $note = $row['note_semestre'];
            }
            $sumCoeff = 0;
            $sumNotesCoeff = 0;
            for ($i=0; $i < $all; $i++) { 
                $sumCoeff += $matieres[$i]['coef'];
                $sumNotesCoeff += ($notesF[$i] * $matieres[$i]['coef']);
            }
            $_SESSION['moy'] = number_format((float)($sumNotesCoeff / $sumCoeff), 2, '.', '');
            if ($note == null) {
                $reqUp = "update semestre_eleve set note_semestre = ".$_SESSION['moy']." where cne_eleve = '".$_SESSION['cne']."'";
                mysqli_query($con, $reqUp);
            }
        }
        end : header('location:../../PFE/views/Ieleve/eleve_notes.php');
    }

        
?>