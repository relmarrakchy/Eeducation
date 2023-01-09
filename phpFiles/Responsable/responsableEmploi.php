<?php
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'eeducation');
    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $_SESSION['err_ins'] = $_SESSION['err_annonce'] = "";

    $reqDataClasse = "select id_classe, titre from classe";
    $resDataClasse = mysqli_query($con, $reqDataClasse);
    $classes = "";
    while ($row = mysqli_fetch_assoc($resDataClasse)) {
        $classes .= "<option value='".$row['id_classe']."'>".$row['titre']."</option>";
    }

    $reqDataEns = "select id_enseignant, nom, prenom from enseignant";
    $resDataEns = mysqli_query($con, $reqDataEns);
    $ens = "";
    while ($row = mysqli_fetch_assoc($resDataEns)) {
        $ens .= "<option value='".$row['id_enseignant']."'>".$row['nom']." ".$row['prenom']."</option>";
    }

    $reqCount = "select max(id_emploi) as total from emploi";
    $resCount = mysqli_query($con, $reqCount);
    while ($row = mysqli_fetch_assoc($resCount)) {
        $c = $row['total'] + 1;
    }

    if(isset($_POST['sub'])) {
        $type = $_POST['type'];
        $de = $_POST['de'];
        $file = $_FILES['file'];

        if (!empty($type) && !empty($de) && !empty($file)) {
            $reqClasse = "select titre from classe where id_classe = $de";
            $reqEns = "select cin from enseignant where id_enseignant = $de";
            $resClasse = mysqli_query($con, $reqClasse);
            $resEns = mysqli_query($con, $reqEns);
            if (mysqli_num_rows($resClasse) == 1) {
                while ($row = mysqli_fetch_assoc($resClasse)) {
                    $cl = $row['titre'];
                }
            } else {
                while ($row = mysqli_fetch_assoc($resEns)) {
                    $ens = $row['cin'];
                }
            }

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
                    if ($fileSize < 2000000) {
                        $fileNameNew = (isset($cl) ? $cl : $ens).".".$fileActualExt;
                        $fileDestination = "C:/xampp/htdocs/PFE/data/emplois/".$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

                        if(isset($_SESSION['err_emploi'])) $_SESSION['err_emploi'] = "";
                        $requp = "insert into emploi values ($c, ".$_SESSION['id_responsable'].", '$type', '$de', '$fileDestination')";
                        if(mysqli_query($con, $requp)) {
                            if ($type == "Scolaire") {
                                $reqUpdateCls = "update classe set id_emploi = $c where id_classe = $de";
                                if(mysqli_query($con, $reqUpdateCls)) {
                                    header('location:../../views/Iresponsable/responsable_emplois.php');
                                } else {
                                    $_SESSION['err_emploi'] = "<script>
                                        alert('Error 500 !')
                                    </script>";
                                    header('location:../../views/Iresponsable/responsable_emplois.php');
                                }
                            } else {
                                $reqUpdateEns = "update enseignant set id_emploi = $c where id_enseignant = $de";
                                if(mysqli_query($con, $reqUpdateEns)) {
                                    header('location:../../views/Iresponsable/responsable_emplois.php');
                                } else {
                                    $_SESSION['err_emploi'] = "<script>
                                        alert('Error 500 !')
                                    </script>";
                                    header('location:../../views/Iresponsable/responsable_emplois.php');
                                }
                            }
                        } else {
                            $_SESSION['err_emploi'] = "<script>
                                alert('Error 500 !')
                            </script>";
                            header('location:../../views/Iresponsable/responsable_emplois.php');
                        }
                    } else {
                        $_SESSION['err_emploi'] = "<script>
                            alert('La taille de fichier doit etre 2MB en maximum !')
                        </script>";
                        header('location:../../views/Iresponsable/responsable_emplois.php');
                    }
                } else {
                    $_SESSION['err_emploi'] = "<script>
                        alert('Erreur de telechargement !')
                    </script>";
                    header('location:../../views/Iresponsable/responsable_emplois.php');
                }
            } else {
                $_SESSION['err_emploi'] = "<script>
                    alert('Vous devez inserer le fichier avec extention .jpeg/.jpg/.png/.pdf !')
                </script>";
                header('location:../../views/Iresponsable/responsable_emplois.php');
            }
        } else {
            $_SESSION['err_emploi'] = "<script>
                alert('Tous les champs doivent etre remplis !')
            </script>";
            header('location:../../views/Iresponsable/responsable_emplois.php');
        }
    }

    $reqTableClasse = "select * from classe";
    $resTableClasse = mysqli_query($con, $reqTableClasse);
    $tableClasse = "";
    while ($row = mysqli_fetch_assoc($resTableClasse)) {
        $tableClasse .= "<tr>
            <td>".$row['titre']."</td>".(($row['id_emploi'] != null) ? "
            <td style='text-align: center;color:green;font-weight: 500;'>OUI</td>
        </tr>" : "
        <td style='text-align: center;color:red;font-weight: 500; '>NON</td>
        </tr>");
    }

    $reqTableEns = "select * from enseignant";
    $resTableEns = mysqli_query($con, $reqTableEns);
    $tableEns = "";
    while ($row = mysqli_fetch_assoc($resTableEns)) {
        $tableEns .= "<tr>
            <td>".$row['nom']." ".$row['prenom']."</td>".(($row['id_emploi'] != null) ? "
            <td style='text-align: center;color:green;font-weight: 500;'>OUI</td>
        </tr>" : "
        <td style='text-align: center;color:red;font-weight: 500; '>NON</td>
        </tr>");
    }
?>