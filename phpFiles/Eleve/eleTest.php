<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $reqTest = "SELECT test.*, COUNT(questionnaire.id_question) as questions, enseignant.*, matiere.* FROM test
    INNER JOIN test_questionnaire ON test.id_test = test_questionnaire.id_test
    INNER JOIN questionnaire ON test_questionnaire.id_question = questionnaire.id_question
    INNER JOIN enseignant ON questionnaire.id_enseignant = enseignant.id_enseignant
    INNER JOIN matiere ON test.id_matiere = matiere.id_matiere
    INNER JOIN classe ON test.id_classe = classe.id_classe
    INNER JOIN eleve_test ON eleve_test.id_test = test.id_test
    WHERE eleve_test.cne_eleve = '".$_SESSION['cne']."' and eleve_test.etat = 'Non consulte'
    GROUP BY test.id_test";
    $resTest = mysqli_query($con, $reqTest);
    $Test = "";
    while ($row = mysqli_fetch_assoc($resTest)) {
        if ($row['questions'] == 0) {
            break;
        } else {
            $Test .= "<div class='test'>
                <div class='testName'>
                    <span class='name'>".$row['discipline']." - Prof. ".$row['nom']."</span>
                    <span class='sub'> ".$row['titre']." </span>
                </div>
                <div class='testInfo'>
                    <span>Duree : ".$row['duree']."</span>
                    <span>".$row['questions']." Questions</span>
                </div>
                <div class='start'>
                    <a href='../../views/Ieleve/eleve_test_page.php?".$row['id_test']."'>Commencer le test</a>
                </div>
            </div>";
        }
    }
?>