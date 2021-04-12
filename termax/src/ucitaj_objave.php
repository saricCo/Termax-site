<?php

$conn = mysqli_connect('localhost', 'termax', 'termax', 'termax');

if (!$conn) {
    echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
} else {

    $stranica = $_GET['stranica'];




    $sql = 'SELECT * FROM objave  order by id desc ';

    $result = mysqli_query($conn, $sql);


    $objave = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $zaSlanje = array();
    $output = array_slice($objave, 3 * ($stranica - 1), 3);


    mysqli_free_result($result);
    $data = array();
    $data["objave"] = $output;

    die(json_encode($data));
    mysqli_close($conn);
}

?>