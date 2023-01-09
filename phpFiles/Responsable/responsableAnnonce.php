<?php
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    $_SESSION['err_ins'] = $_SESSION['err_emploi'] = "";

    $reqAnnData = "select * from annonce where id_responsable = ".$_SESSION['id_responsable'].";";
    $resAnnData = mysqli_query($con, $reqAnnData);
    $_SESSION['annData'] = "";
    while ($row = mysqli_fetch_assoc($resAnnData)) {
        $_SESSION['annData'] .= "<tr>
            <td>".$row['id_annonce']."</td>
            <td>".$row['annonce']."</td>
            <td>".$row['destination']."</td>
            <td>".$row['date_diffusion']."</td>
            <td style='text-align: center;'><input type='checkbox' name='i[]' value='".$row['id_annonce']."'></td>
        </tr>";
    }

    if(isset($_POST['ajout'])) {
        $destination = $_POST['destination'];
        $annonce = $_POST['annonce'];
        $date = date("Y-m-d");

        if (!empty($destination) && !empty($annonce)) {
            $req = "Insert into annonce values(null ,'$annonce', ".$_SESSION['id_responsable'].", '$destination', '$date')";
            if (mysqli_query($con, $req)) {
                if(isset($_SESSION['err_annonce'])) $_SESSION['err_annonce'] = ""; 
                header('location:../../views/Iresponsable/responsable_annonces.php');
            } else {
                $_SESSION['err_annonce'] = "<script>
                    alert('Error 500 !')
                </script>";
            header('location:../../views/Iresponsable/responsable_annonces.php');
            }
        } else {
            $_SESSION['err_annonce'] = "<script>
                alert('Tous les champs doivent etre remplis !')
            </script>";
            header('location:../../views/Iresponsable/responsable_annonces.php');
        }
    }

    if (isset($_POST['supp'])) {
        if (isset($_POST['i'])) {
            foreach ($_POST['i'] as $value) {
                $reqDelete = "delete from annonce where id_annonce = '$value'";
                mysqli_query($con, $reqDelete);
            }
            header('location:../../views/Iresponsable/responsable_annonces.php');
        }
        header('location:../../views/Iresponsable/responsable_annonces.php');
    }

    if (isset($_POST['searchB'])) {
        $word = $_POST['word'];
        $reqS = "SELECT * FROM annonce where annonce LIKE '%$word%';";
        $dataSearch = "";
        while ($row = mysqli_fetch_assoc(mysqli_query($con, $reqS))) {
            $dataSearch .= "<tr>
                <td>".$row['id_annonce']."</td>
                <td>".$row['annonce']."</td>
                <td>".$row['destination']."</td>
                <td>".$row['date_diffusion']."</td>
                <td style='text-align: center;'><input type='submit' name='".$row['id_annonce']."' class='btn' value='Suprrimer'></td>
            </tr>";
        }
    }
?>