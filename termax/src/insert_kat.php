<?php

$conn = mysqli_connect('localhost', 'termax', 'termax', 'termax');

if (!$conn) {
    echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
} else {
    $nesto=$_POST['data'];

    $naziv=$_POST['naziv_karakteristike'];
    $kategorija=$_POST['kategorija_id'];
    $filter=$_POST["zaFilter"];
 

    $sql = 'INSERT INTO karakteristike(naziv_karakteristike,kategorija_id,za_filter) VALUES ("'.$naziv.'","'.$kategorija.'",'.$filter.')';
    echo "$sql";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    mysqli_close($conn);
  
}



?>
