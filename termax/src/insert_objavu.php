<?php

$conn = mysqli_connect('localhost', 'termax', 'termax', 'termax');

if (!$conn) {

    echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
} else {


    $tipObjave = $_POST["tipObjave"];

    $data1 = array();
    if (!isset($tipObjave)) {
        return;
    }
    $naslov = $_POST["naslov"];
    $podnaslov = $_POST["podnaslov"];

    if ($tipObjave == "Slika") {
        if (move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/img/' . $_FILES["image"]['name'])) {
            // echo "Uploaded";


        } else {
            $data1["Error"] = "File was not uploaded";
            die(json_encode($data1));
            mysqli_close($conn);
            return;
            //  echo "File was not uploaded";
        }
        //$slikaObjave = $_POST["slika"];
        $tekst1 = $_POST["tekst1"];
        $tekst2 = $_POST["tekst2"];

        $sql = 'INSERT INTO objave(naslov,podnaslov,tekst,tekst2,link,tip) VALUES ("' . $naslov . '","' . $podnaslov . '","' . $tekst1 . '","' . $tekst2 . '","tretnilinkSlike","' . $tipObjave . '")';
    } else if ($tipObjave == "Video") {
        //$snimakObjave = $_POST["video"]; treba nesto slicno ko gore za img
        $tekst = $_POST["tekst"];
        $sql = 'INSERT INTO objave(naslov,podnaslov,tekst,link,tip) VALUES ("' . $naslov . '","' . $podnaslov . '","' . $tekst . '","tretnilinkVidea","' . $tipObjave . '")';
    }

    //echo "$sql";
    $save_status = false;
    if ($conn->query($sql) === TRUE) {
        $save_status = true;
        //  echo "New record created successfully";
    } else {
        $data1["Error"] = "Error: " . $sql . "<br>" . $conn->error;
        die(json_encode($data1));
        mysqli_close($conn);
        return;
        //  echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $data1['save_status'] = $save_status;
    die(json_encode($data1));
    mysqli_close($conn);
}
