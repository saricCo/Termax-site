<?php

$conn = mysqli_connect('localhost', 'termax', 'termax', 'termax');

if (!$conn) {
    echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
} else {
  
    $id_objave=$_POST['id_objave'];
   
    $sql = 'DELETE FROM objave WHERE id='.$id_objave.'';
    $result = array();
    $delete_result=false;
    if ($conn->query($sql) === TRUE) {
        $delete_result=true;
        $result["delete_status"]=$delete_result;
     // echo "New record created successfully";
    } else {
        $result["Error"]="Error: " . $sql . "<br>" . $conn->error;
   
    }
    die(json_encode($result));
    mysqli_close($conn);
  
}



?>