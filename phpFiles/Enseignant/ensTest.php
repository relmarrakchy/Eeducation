<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $_SESSION['err_para'] = "";

    $idP = explode('?', $_SERVER['REQUEST_URI']);
    $id_test = end($idP);
    if ($id_test == $_SERVER['REQUEST_URI']) $id_test = 0;

    if ($id_test != 0) {
        $reqTest = "SELECT DISTINCT eleve.prenom, eleve.nom, eleve_test.note, SUM(questionnaire.bareme) as total FROM eleve
        INNER JOIN eleve_test ON eleve.cne = eleve_test.cne_eleve
        INNER JOIN test_questionnaire ON eleve_test.id_test = test_questionnaire.id_test
        INNER JOIN questionnaire ON test_questionnaire.id_question = questionnaire.id_question
        WHERE eleve_test.id_test = $id_test
        GROUP BY eleve_test.cne_eleve";
        $resTest = mysqli_query($con, $reqTest);
        $notesTest = "<table id='testData'>
            <tr>
                <th style='text-align: center;'>Eleve</th>
                <th style='text-align: center;'>Note</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($resTest)) {
            $notesTest .= "<tr>
                <td style='text-align: center;'>".$row['nom']." ".$row['prenom']."</td>
                <td style='text-align: center;'>".$row['note']."/".$row['total']."</td>
            </tr>";
        }
        $notesTest .= "</table>";
    }


    $req = "select * from enseignant where id_enseignant = ".$_SESSION['id_enseignant'].";";
    $res = mysqli_query($con, $req);
    while ($row = mysqli_fetch_assoc($res)) {
        $fn = $row['nom']." ".$row['prenom'];
        $idM = $row['id_matiere'];
    }

    $reqDataQst = "select * from questionnaire where id_enseignant = ".$_SESSION['id_enseignant'].";";
    $resDataQst = mysqli_query($con, $reqDataQst);
    $dataQst = "";
    while ($row = mysqli_fetch_assoc($resDataQst)) {
        $dataQst .= "<tr>
            <td>".$row['question']."</td>
            <td>".$row['correct_rep']."</td>
            <td style='text-align: center;'>".$row['bareme']."</td>
            <td style='text-align: center;'><input type='checkbox' name='i[]' value='".$row['id_question']."' id=''></td>
            <td style='text-align: center;'><input type='checkbox' name='d[]' value='".$row['id_question']."'></td>
        </tr>";
    }

    $reqDataClasse = "SELECT id_classe, titre FROM classe WHERE id_classe in (SELECT id_classe FROM classe_enseignant WHERE id_enseignant = ".$_SESSION['id_enseignant'].");";
    $resDataClasse = mysqli_query($con, $reqDataClasse);
    $dataClasse = "";
    while ($row = mysqli_fetch_assoc($resDataClasse)) {
        $dataClasse .= "<option value='".$row['id_classe']."'>".$row['titre']."</option>";
    }

    $reqCount = "select count(*) as total from questionnaire";
    $resCount = mysqli_query($con, $reqCount);
    while ($row = mysqli_fetch_assoc($resCount)) {
        $c = $row['total'] + 1;
    }

    $reqDataT = "select test.*, classe.titre as classe from test
    inner join classe on test.id_classe = classe.id_classe
    where id_enseignant = ".$_SESSION['id_enseignant'].";";
    $resDataT = mysqli_query($con, $reqDataT);
    $dataTest = "<table id='testData'>
        <tr>
            <th># ID</th>
            <th style='text-align: center;'>Titre</th>
            <th style='text-align: center;'>Classe</th>
    </tr>";
    while ($row = mysqli_fetch_assoc($resDataT)) {
        $dataTest .= "<tr>
            <td style='text-align: center;'><a href='http://localhost/PFE/views/Ienseignant/enseignant_test.php?".$row['id_test']."'><button value= '".$row['id_test']."' id='l' style='background-color: transparent; border:none;'>".$row['id_test']."</button></a></td>
            <td style='text-align: center;'>".$row['titre']."</td>
            <td style='text-align: center;'>".$row['classe']."</td>
        </tr>";
    }
    $dataTest .= "</table>";

    if (isset($_POST['subQst'])) {
        if(!empty($_POST['qst']) && !empty($_POST['rep']) && !empty($_POST['bar'])) {
            $qst = $_POST['qst'];
            $rep = $_POST['rep'];
            $bar = $_POST['bar'];

            $sql = "insert into questionnaire values (null, ".$_SESSION['id_enseignant'].", '$qst', '$rep', '$bar')";
            if (mysqli_query($con, $sql)) {
                if (isset($_SESSION['err_test'])) $_SESSION['err_test'] = "";
                header('location:../../views/Ienseignant/enseignant_test.php');
            }
        } else {
            $_SESSION['err_test'] = "<script>
                alert('Tous les champs doivent etre remplis !')
            </script>";
            header('location:../../views/Ienseignant/enseignant_test.php');
        }
    }

    if (isset($_POST['subT'])) {      
        if(!empty($_POST['classe']) && !empty($_POST['dur']) && $_POST['titre'] != null) {
            $classe = $_POST['classe'];
            $dur = $_POST['dur'];
            $titre = $_POST['titre'];
            $date = date("d-m-Y");

            $sql0 = "insert into test values (null, $classe, '$idM', ".$_SESSION['id_enseignant'].", '$titre', '$dur', '$date')";
            if (mysqli_query($con, $sql0)) {
                if (isset($_POST['i'])) {
                    $reqCountT = "select max(id_test) as total from test";
                    $resCountT = mysqli_query($con, $reqCountT);
                    while ($row = mysqli_fetch_assoc($resCountT)) {
                        $ct = $row['total'];
                    }

                    $eleves = [];
                    $i = 0;
                    $reqEleve = "select cne from eleve where id_classe = $classe;";
                    $resEleve = mysqli_query($con, $reqEleve);
                    while ($row = mysqli_fetch_assoc($resEleve)) {
                        $eleves[$i] = $row['cne'];
                        $i++;
                    }

                    for ($i=0; $i < count($eleves); $i++) { 
                        $s = "insert into eleve_test values ('$eleves[$i]', $ct, null, 'Non consulte')";
                        mysqli_query($con, $s);
                    }

                    foreach ($_POST['i'] as $value) {
                        $sql1 = "insert into test_questionnaire values ($ct, $value)";
                        mysqli_query($con, $sql1);
                    }
                    if (isset($_SESSION['err_test'])) $_SESSION['err_test'] = "";
                    header('location:../../views/Ienseignant/enseignant_test.php');
                } else {
                    $reqRe = "delete from test where id_test = $ct";
                    mysqli_query($con, $reqRe);
                    $_SESSION['err_test'] = "<script>
                        alert('Vous devez choisir en moins 1 question !')
                    </script>";
                    header('location:../../views/Ienseignant/enseignant_test.php');
                }
            }
        } else {
            $_SESSION['err_test'] = "<script>
                alert('Tous les champs doivent etre remplis !')
            </script>";
            header('location:../../views/Ienseignant/enseignant_test.php');
        }
    }

    $reqArrayTests = "select id_test from test where id_enseignant = ".$_SESSION['id_enseignant']." ;";
    $resArrayTests = mysqli_query($con, $reqArrayTests);
    $arrayTests = array();
    if (mysqli_num_rows($resArrayTests) >= 1)  {
        while ($row = mysqli_fetch_assoc($resArrayTests)) {
            array_push($arrayTests, $row['id_test']);
        }
    }

    if (isset($_POST['subS'])) {
        if (isset($_POST['d'])) {
            foreach ($_POST['d'] as $value) {
                $reqDelete = "delete from questionnaire where id_question = $value";
                $reqDeletePivot = "delete from test_questionnaire where id_question = $value";
                mysqli_query($con, $reqDeletePivot);
                mysqli_query($con, $reqDelete);
                

                for ($i=0; $i < count($arrayTests); $i++) { 
                    $reqChecking = "select * from test_questionnaire where id_test = $arrayTests[$i];";
                    $resChecking = mysqli_query($con, $reqChecking);
                    if (mysqli_num_rows($resChecking) < 1)  {
                        $reqRemovePivot = "delete from eleve_test where id_test = $arrayTests[$i]";
                        mysqli_query($con, $reqRemovePivot);
                        $reqRemoveTest = "delete from test where id_test = $arrayTests[$i]";
                        mysqli_query($con, $reqRemoveTest);
                    }
                }
            }
            header('location:../../views/Ienseignant/enseignant_test.php');
        }
        header('location:../../views/Ienseignant/enseignant_test.php');
    }
?>