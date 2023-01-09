<?php 
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'eeducation');
    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $_SESSION['err_test'] = "";

    $req = "select * from enseignant where id_enseignant = ".$_SESSION['id_enseignant'].";";
    $res = mysqli_query($con, $req);
    while ($row = mysqli_fetch_assoc($res)) {
        $n = $row['nom']; $l = $row['prenom'];
        $fn = $row['nom']." ".$row['prenom'];
        $cin = $row['cin'];
        $add = $row['adresse'];
        $email = $row['email'];
        $pass = $row['pass'];
        $tel = $row['telephone'];
    }

    if (isset($_POST['chE'])) {
        $act = $_POST['actE'];
        $new = $_POST['nE'];

        if (!empty($act) && !empty($new)) {
            if (filter_var($new, FILTER_VALIDATE_EMAIL)) {
                $up = "update enseignant set email = '$new' where id_enseignant = ".$_SESSION['id_enseignant'].";";
                if (mysqli_query($con, $up)) {
                    if (isset($_SESSION['err_para'])) $_SESSION['err_para'] = "";
                    header('location:../../views/Ienseignant/enseignant_parametre.php');
                } else {
                    $_SESSION['err_para'] = "<script>
                        alert('Error 500')
                    </script>";
                    header('location:../../views/Ienseignant/enseignant_parametre.php');
                }
            } else {
                $_SESSION['err_para'] = "<script>
                    alert('Invalid email')
                </script>";
                header('location:../../views/Ienseignant/enseignant_parametre.php');
            }
        } else {
            $_SESSION['err_para'] = "<script>
                alert('Tous ...')
            </script>";
            header('location:../../views/Ienseignant/enseignant_parametre.php');
        }
    }

    if (isset($_POST['chP'])) {
        $act = $_POST['actPass']; $new = $_POST['nPass']; $conf = $_POST['ncPass'];

        if (!empty($act) && !empty($new) && !empty($conf)) {
            if ($new == $conf) {
                $upP = "update enseignant set pass = '$new' where id_enseignant = ".$_SESSION['id_enseignant'].";";
                if (mysqli_query($con, $upP)) {
                    if (isset($_SESSION['err_para'])) $_SESSION['err_para'] = "";
                    header('location:../../views/Ienseignant/enseignant_parametre.php');
                } else {
                    $_SESSION['err_para'] = "<script>
                        alert('Error 500')
                    </script>";
                    header('location:../../views/Ienseignant/enseignant_parametre.php');
                }
            } else {
                $_SESSION['err_para'] = "<script>
                    alert('Not match')
                </script>";
                header('location:../../views/Ienseignant/enseignant_parametre.php');
            }
        } else {
            $_SESSION['err_para'] = "<script>
                alert('Tous ...')
            </script>";
            header('location:../../views/Ienseignant/enseignant_parametre.php');
        }
    }
?>