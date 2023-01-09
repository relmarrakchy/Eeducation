
<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    if(isset($_POST['sub'])) {
        if (!empty($_POST['id']) && !empty($_POST['pass'])) {
            $id = $_POST['id']; $pass = $_POST['pass'];
            $pattern = "/[A-Z]/i";

            if (preg_match($pattern, $id)) {
                $req0 = "Select * from eleve where cne = '$id' and pass = '$pass';";
                $res0 = mysqli_query($con, $req0);
                if (mysqli_num_rows($res0) == 1) {
                    $_SESSION['cne'] = $id;
                    $_SESSION['role'] = 'ELEVE';
                    if (isset($_SESSION['msg'])) $_SESSION['msg'] = "";
                    header("location:../PFE/views/Ieleve/eleve_index1.php");
                } else {
                    $_SESSION['msg'] = "<p style='color: red; font-weight: 500;'>Le id ou le mot de passe est incorrect</p>";
                    header('location:../login/login.php');
                }
            } else {
                $req1 = "Select * from enseignant where id_enseignant = $id and pass = '$pass';";
                $res1 = mysqli_query($con, $req1);

                $req2 = "Select * from responsable where id_responsable = $id and pass = '$pass';";
                $res2 = mysqli_query($con, $req2);

                if (mysqli_num_rows($res1) == 1) {
                    $_SESSION['id_enseignant'] = $id;
                    $_SESSION['role'] = 'ENSEIGNANT';
                    setcookie('idens', $id, time() + (86400 * 30), "/");
                    if (isset($_SESSION['msg'])) $_SESSION['msg'] = "";
                    header("location:../views/Ienseignant/enseignant_index.php");
                } else if (mysqli_num_rows($res2) == 1) {
                    $_SESSION['id_responsable'] = $id;
                    $_SESSION['role'] = 'RESPONSABLE';
                    if (isset($_SESSION['msg'])) $_SESSION['msg'] = "";
                    header("location:../views/Iresponsable/responsable_index.php");
                } else {
                    $_SESSION['msg'] = "<p style='color: red; font-weight: 500;'>Le id ou le mot de passe est incorrect</p>";
                    header('location:../login/login.php');
                }
            }
        }
    }
?> 