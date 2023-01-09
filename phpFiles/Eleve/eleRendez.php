<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    if (isset($_POST['sub'])) {
        $type = $_POST['type'];
        $dateC = $_POST['date'];
        $etat = "En attente";
        $date = date("d-m-Y");

        if (!empty($type) && !empty($dateC)) {
            $reqAdd = "insert into rendez_vous values(null, '".$_SESSION['cne']."', '$type', '$etat', '$date', '$dateC');";
            if(mysqli_query($con, $reqAdd)) {
                if (isset($_SESSION['err_rd'])) $_SESSION['err_rd'] = "";
                header('location:../../views/Ieleve/eleve_demandes.php');
            }
        }
    }

    $reqData = "select * from rendez_vous where cne_eleve = '".$_SESSION['cne']."';";
    $resData = mysqli_query($con, $reqData);
    $data = "";
    while ($row = mysqli_fetch_assoc($resData)) {
        $data .= "<tr>
            <td>".$row['id_rendezVous']."</td>
            <td>".$row['type']."</td>
            <td>".$row['date_demande']."</td>";

        if ($row['etat'] == "En attente") {
            $data .= "<td style='text-align: center; color: orange'; font-weight: 800;>".$row['etat']."</td>
            </tr>";
        } else if ($row['etat'] == "Refuse") {
            $data .= "<td style='text-align: center; color: red'; font-weight: 800;>".$row['etat']."</td>
            </tr>";
        } else {
            $data .= "<td style='text-align: center; color: green'; font-weight: 800;>".$row['etat']."</td>
            </tr>";
        }
    }
?>