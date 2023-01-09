<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $req = "select * from enseignant where id_enseignant = ".$_SESSION['id_enseignant'].";";
    $res = mysqli_query($con, $req);
    while ($row = mysqli_fetch_assoc($res)) {
        $fn = $row['nom']." ".$row['prenom'];
        $idM = $row['id_matiere'];
    }

    $reqDataClasse = "SELECT id_classe, titre FROM classe WHERE id_classe in (SELECT id_classe FROM classe_enseignant WHERE id_enseignant = ".$_SESSION['id_enseignant'].");";
    $resDataClasse = mysqli_query($con, $reqDataClasse);
    $dataClasse = "";
    while ($row = mysqli_fetch_assoc($resDataClasse)) {
        $dataClasse .= "<option value='".$row['id_classe']."'>".$row['titre']."</option>";
    }

    $reqCount = "select count(*) as total from cours";
    $resCount = mysqli_query($con, $reqCount);
    while ($row = mysqli_fetch_assoc($resCount)) {
        $c = $row['total'] + 1;
    }

    // $f = file_exists("D:/xampp/htdocs/PFE/data/cours");
    $id_ens = $_SESSION['id_enseignant'];

    $dataCours = "SELECT DISTINCT cours.*, classe.titre AS classe FROM cours
    INNER JOIN enseignant ON enseignant.id_enseignant = cours.id_enseignant
    INNER JOIN classe_enseignant ON classe_enseignant.id_enseignant = enseignant.id_enseignant
    INNER JOIN classe_cours ON cours.id_cours = classe_cours.id_cours
    INNER JOIN classe ON classe_cours.id_classe = classe.id_classe
    WHERE enseignant.id_enseignant = $id_ens";
    $resDataCours = mysqli_query($con, $dataCours);
    $cours = "";
    while ($row = mysqli_fetch_assoc($resDataCours)) {
        $cours .= "<tr>
            <td style='text-align: center;'>".$row['classe']."</td>
            <td style='text-align: center;'>".$row['titre']."</td>
            <td style='text-align: center;'>".$row['date_creation']."</td>
            <td style='text-align: center;'><input type='checkbox' name='del[]' value='".$row['id_cours']."'></td>
        </tr>";
    }



    // $_SESSION['err_cours'] = "<script>
    //             alert('$f')
    //         </script>";
            
    if (isset($_POST['sub'])) {
        $classe = $_POST['classe']; $titre = $_POST['titre']; $file = $_FILES['file'];
        $date = date("Y-m-d");

        if (!empty($classe) && !empty($titre) && !empty($file)) {
            $reqDataTitre = " select titre from cours
            inner join classe_cours where cours.id_enseignant = ".$_SESSION['id_enseignant']." and classe_cours.id_classe = $classe ;";
            $resDataTitre = mysqli_query($con, $reqDataTitre);
            $titres = array();
            while ($row = mysqli_fetch_assoc($resDataTitre)) {
                array_push($titres, $row['titre']);
            }
            if (!in_array($titre, $titres)) {
                $fileName = $_FILES['file']['name'];
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileSize = $_FILES['file']['size'];
                $fileError = $_FILES['file']['error'];
                $fileType = $_FILES['file']['type'];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array('jpeg', 'jpeg', 'png', 'pdf');
                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        if ($fileSize < 20000000) {
                            $reqCount = "select titre from classe where id_classe = $classe";
                            $resCount = mysqli_query($con, $reqCount);
                            while ($row = mysqli_fetch_assoc($resCount)) {
                                $classeTitre = $row['titre'];
                            }

                            $fileNameNew = $titre.".".$fileActualExt;
                            if (!file_exists("C:/xampp/htdocs/PFE/data/cours/$id_ens")) mkdir("C:/xampp/htdocs/PFE/data/cours/$id_ens");
                            if (!file_exists("C:/xampp/htdocs/PFE/data/cours/$id_ens/$classeTitre")) mkdir("C:/xampp/htdocs/PFE/data/cours/$id_ens/$classeTitre");
                            $fileDestination = "C:/xampp/htdocs/PFE/data/cours/$id_ens/$classeTitre/".$fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);

                            if(isset($_SESSION['err_cours'])) $_SESSION['err_cours'] = "";
                            $reqcours = "insert into cours values (null, ".$_SESSION['id_enseignant'].", '$titre', '$fileDestination', '$date')";
                            if(mysqli_query($con, $reqcours)) {
                                $reqCountT = "select max(id_cours) as total from cours";
                                $resCountT = mysqli_query($con, $reqCountT);
                                while ($row = mysqli_fetch_assoc($resCountT)) {
                                    $ct = $row['total'];
                                }
                                $reqCC = "insert into classe_cours values ($classe, $ct);";
                                if (mysqli_query($con, $reqCC)) {
                                    if (isset($_SESSION['err_cours'])) $_SESSION['err_cours'] = "";
                                    header('../../PFE/views/Ienseignant/enseignant_cours.php');
                                } else {
                                    $_SESSION['err_cours'] = "<script>
                                        alert('Error 500 !')
                                    </script>";
                                    header('../../PFE/views/Ienseignant/enseignant_cours.php');
                                }
                            } else {
                                $_SESSION['err_cours'] = "<script>
                                    alert('Error 500 !')
                                </script>";
                                header('../../PFE/views/Ienseignant/enseignant_cours.php');
                            }
                        } else {
                            $_SESSION['err_cours'] = "<script>
                                alert('La taille de fichier doit etre 20MB en maximum !')
                            </script>";
                            header('../../PFE/views/Ienseignant/enseignant_cours.php');
                        }
                    } else {
                        $_SESSION['err_cours'] = "<script>
                            alert('Erreur de telechargement !')
                        </script>";
                        header('../../PFE/views/Ienseignant/enseignant_cours.php');
                    }
                } else {
                    $_SESSION['err_cours'] = "<script>
                        alert('Vous devez inserer le fichier avec extention .pdf/.doc/.docx !')
                    </script>";
                    header('../../PFE/views/Ienseignant/enseignant_cours.php');
                }
            } else {
                $_SESSION['err_cours'] = "<script>
                    alert('Ce titre est deja existe !')
                </script>";
            }
        } else {
            $_SESSION['err_cours'] = "<script>
                alert('Tous les champs doivent etre remplis !')
            </script>";
        }
        header('location:../../PFE/views/Ienseignant/enseignant_cours.php');
    }

    if (isset($_POST['subDel'])) {
        if (isset($_POST['del'])) {
            foreach ($_POST['del'] as $cours) {
                $titre = "SELECT DISTINCT cours.*, classe.titre AS classe FROM cours
                INNER JOIN enseignant ON enseignant.id_enseignant = cours.id_enseignant
                INNER JOIN classe_enseignant ON classe_enseignant.id_enseignant = enseignant.id_enseignant
                INNER JOIN classe_cours ON cours.id_cours = classe_cours.id_cours
                INNER JOIN classe ON classe_cours.id_classe = classe.id_classe
                WHERE cours.id_cours = $cours";
                $resTitre = mysqli_query($con, $titre);
                while ($row = mysqli_fetch_assoc($resTitre)) {
                    $t = $row['titre'];
                    $c = $row['classe'];
                }
                if (unlink("C:/xampp/htdocs/PFE/data/cours/$id_ens/$c/$t.pdf")) {
                    $reqDelPivot = "delete from classe_cours where id_cours = $cours";
                    mysqli_query($con, $reqDelPivot);
                    $reqDel = "delete from cours where id_cours = $cours";
                    mysqli_query($con, $reqDel);
                    header('location:../../PFE/views/Ienseignant/enseignant_cours.php');
                }
            } 
        }
    }

    // unlink("D:/xampp/htdocs/PFE/data/cours/3000/TCS-1/Test 1.pdf");
?>