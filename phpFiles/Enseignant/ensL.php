<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'eeducation');

    if (!$con) {
        die ("Connection Failed ".mysqli_connect_error());
    }

    if(isset($_POST['name'])) {
        $classe = $_POST['classe'];

        $rq = "select * from eleve where id_classe = $classe";
        $query = mysqli_query($con, $rq);
        
        while($row = mysqli_fetch_assoc($query))
        {
            echo "<option>".$row['cne']."</option>";
        }
    }
    
?>