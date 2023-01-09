<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $idP = explode('?', $_SERVER['REQUEST_URI']);
    $id_test = end($idP);

    // if ($id_test == $_SERVER['REQUEST_URI']) $id_test = 0;

    $reqQs = "SELECT test.*, questionnaire.* FROM test
    INNER JOIN test_questionnaire ON test.id_test = test_questionnaire.id_test
    INNER JOIN questionnaire ON test_questionnaire.id_question = questionnaire.id_question
    INNER JOIN classe ON test.id_classe = classe.id_classe
    INNER JOIN eleve ON classe.id_classe = eleve.id_classe
    WHERE eleve.cne = '".$_SESSION['cne']."' AND test.id_test = $id_test";
    $resQs = mysqli_query($con, $reqQs);
    $qsts = [];
    $i = 0;
    while ($row = mysqli_fetch_assoc($resQs)) {
        $qsts[$i] = [
            'id' => $row['id_question'],
            'question' => $row['question'],
            'reponse' => $row['correct_rep'],
            'bareme' => $row['bareme']
        ];
        $i++;
    }

    $req = "
    SELECT eleve_test.*, test.*,  classe.titre as classe, COUNT(questionnaire.id_question) as questions, enseignant.*, matiere.* FROM test
    INNER JOIN test_questionnaire ON test.id_test = test_questionnaire.id_test
    INNER JOIN questionnaire ON test_questionnaire.id_question = questionnaire.id_question
    INNER JOIN enseignant ON questionnaire.id_enseignant = enseignant.id_enseignant
    INNER JOIN matiere ON test.id_matiere = matiere.id_matiere
    INNER JOIN classe ON test.id_classe = classe.id_classe
    INNER JOIN eleve_test ON eleve_test.id_test = test.id_test
    WHERE eleve_test.cne_eleve = '".$_SESSION['cne']."' and test.id_test = $id_test";
    $res = mysqli_query($con, $req);
    while ($row = mysqli_fetch_assoc($res)) {
        $classe = $row['classe'];
        $cne = $row['cne_eleve'];
        $titre = $row['titre'];
        $matiere = $row['discipline'];
        $ens = $row['nom']." ".$row['prenom'];
        $questions = $row['questions'];
        $duree = $row['duree'];
    }

    if (isset($_POST['sub'])) {
        if (isset($_POST['verifie'])) {
            $reps = $_POST['reponse'];
            $noteFinal = 0;
            for ($i=0; $i < count($reps); $i++) { 
                if ($reps[$i] == $qsts[$i]['reponse']) {
                    $noteFinal += $qsts[$i]['bareme'];
                }
            }

            $reqEtat = "update eleve_test set note = $noteFinal, etat = 'Fait' 
            where id_test = $id_test and cne_eleve = '".$_SESSION['cne']."'";
            mysqli_query($con, $reqEtat);
            header('location:../../views/Ieleve/eleve_tests.php');
        }
    }
?>