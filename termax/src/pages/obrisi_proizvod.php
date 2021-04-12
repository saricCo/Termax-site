<?php

$conn = mysqli_connect('localhost', 'termax', 'termax', 'termax');

if (!$conn) {
    echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
} else {
    $nesto=$_POST['data'];

    $id_proizvoda=$_POST['id_proizvoda'];
   
    $sql = 'DELETE FROM proizvodi WHERE id='.$id_proizvoda.'';
    echo "$sql";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    mysqli_close($conn);
  
}



?>