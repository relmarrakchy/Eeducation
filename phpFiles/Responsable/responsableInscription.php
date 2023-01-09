
<?php
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $_SESSION['err_annonce'] = $_SESSION['err_emploi'] = "";


    $reqDataClasse = "Select id_classe ,titre from classe";
    $resDataClasse = mysqli_query($con, $reqDataClasse);
    $_SESSION['classData'] = "";
    while ($row = mysqli_fetch_assoc($resDataClasse)) {
        $data = $row['titre'];
        $datai = $row['id_classe'];
        $_SESSION['classData'] .="<option value='$datai'>$data</option>";
    }

    $reqDataEleve = "select cne, nom, prenom, titre from eleve inner join classe on eleve.id_classe = classe.id_classe";
    $resDataEleve = mysqli_query($con, $reqDataEleve);
    $_SESSION['eleveData'] = "";
    while ($row = mysqli_fetch_assoc($resDataEleve)) {
        $_SESSION['eleveData'] .="<tr>
            <td>".$row['cne']."</td>
            <td>".$row['nom']."</td>
            <td>".$row['prenom']."</td>
            <td>".$row['titre']."</td>
        </tr>";
    }
 
    if (isset($_POST['valider'])) {
        $cne = $_POST['cne'];
        $nomE = $_POST['nomE'];
        $prenomE = $_POST['prenomE'];
        $emailE = $_POST['emailE'];
        $adresseE = $_POST['adresseE'];
        $telephoneE = $_POST['telephoneE'];
        $date_de_naissanceE = $_POST['date_de_naissance'];
        $lieu_de_naissanceE = $_POST['lieu_de_naissance'];
        $sexe = $_POST['sexe'];
        $nationnalite = $_POST['nationnalite'];
        $classe = $_POST['classe'];
        $mdp = $_POST['mdp'];
        $cinT = $_POST['cinT'];
        $nomT = $_POST['nomT'];
        $prenomT = $_POST['prenomT'];
        $titre = $_POST['titre'];
        $telephoneT = $_POST['telephoneT'];
        $adresseT = $_POST['adresseT'];

        $err = "";
        if (!empty($cne) && !empty($nomE) && !empty($prenomE) && !empty($emailE) && !empty($adresseE)
        && !empty($telephoneE) && !empty($date_de_naissanceE) && !empty($lieu_de_naissanceE)
        && !empty($sexe) && !empty($nationnalite) && !empty($classe) && !empty($mdp) && !empty($cinT)
        && !empty($nomT) && !empty($prenomT) && !empty($titre) && !empty($telephoneT) && !empty($adresseT)) {
            if (strlen($cne) ==  10 && strlen($cinT) == 8) {
                if (strlen($mdp) >= 8) {
                    $reqT = "insert into tuteur values('$cinT', '$prenomT', '$nomT', '$titre',
                    '$adresseT', $telephoneT);";

                    $reqE = "insert into eleve values('$cne', '$cinT', $classe, '$prenomE', '$nomE',
                    '$emailE', '$mdp', '$sexe', '$date_de_naissanceE', '$lieu_de_naissanceE',
                    '$adresseE', $telephoneE, '$nationnalite');";

                    $curr = date('y');

                    $reqSP = "insert into semestre_eleve values (50, '$cne', null, '20$curr-20".($curr + 1)."');";


                    if(mysqli_query($con, $reqT) && mysqli_query($con, $reqE) && mysqli_query($con, $reqSP)) {
                        $mailto = $emailE;
                        $subject = "Mot de passe de votre compte";
                        $headers = "From: ".$_SESSION['resEmail'];
                        $txt = "Mr. $prenomE, votre mot de passe est '$mdp'";
                        mail($mailto, $subject, $txt, $headers);
                        if (isset($_SESSION['err'])) $_SESSION['err'] = "";
                        header('location:../../PFE/views/Iresponsable/responsable_inscription.php');
                    } else {
                        $_SESSION['err_ins'] = "<script>
                        alert('Error 500 !')
                    </script>";
                        header('location:../../PFE/views/Iresponsable/responsable_inscription.php');
                    }
                } else {
                    $_SESSION['err_ins'] = "<script>
                        alert('Le mot de passe doit etre 8 caracteres en minimal !')
                    </script>";
                    header('location:../../PFE/views/Iresponsable/responsable_inscription.php');
                }
            } else {
                $_SESSION['err_ins'] = "<script>
                        alert('Le CIN ou CNE est invalide!')
                    </script>";
                header('location:../../PFE/views/Iresponsable/responsable_inscription.php');
            }
        } else {
            $_SESSION['err_ins'] = "<script>
                alert('Tous les champs doivent etre remplis !')
            </script>";
            header('location:../../PFE/views/Iresponsable/responsable_inscription.php');
        }
    }

    if (isset($_POST['annuler'])) {
        header('location:../../PFE/views/Iresponsable/responsable_inscription.php');
    }

    //partie annonce
?>