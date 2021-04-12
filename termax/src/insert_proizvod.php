<?php

$conn = mysqli_connect('localhost', 'termax', 'termax', 'termax');

if (!$conn) {
    echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
} else {
    $nesto=$_POST['data'];

   // $naziv=$_POST['naziv_karakteristike'];
   // $kategorija=$_POST['kategorija_id'];
    $nazivProizvoda=$_POST['nazivProizvoda'];
    $nazivProizvodjaca=$_POST['nazivProizvodjaca'];
    $poljeOpis=$_POST['poljeOpis'];
  //  $kategorija=$_POST['kategorija'];
    $podKategorija=$_POST['podKategorija'];
    //$formData=$_POST['formData'];
   // $listaKarakteristika=$_POST['listaKarakteristika'];
   $cena=$_POST['cena'];

    $data = json_decode(stripslashes($_POST['listaKarakteristika']),true);
   
    //$data1 = json_decode(stripslashes($_POST['listaKategorijaBezID'])); 
   //$someJSON ='[{"id":"1","vrednost":"male"},{"id":"1","vrednost":"male"}]';
   // $someJSON1=json_decode($someJSON,true);
    // print_r($someJSON1); 
     //echo $someJSON1[0]["id"];

    /*$result = mysqli_query($conn,"SELECT `id` FROM `karakteristike` WHERE `naziv_karakteristike` = 'tata'") ;
    $row = mysqli_fetch_assoc($result);
    $id1 = $row['id'];
    echo $id1;*/

    $sql = 'INSERT INTO proizvodi(naziv,proizvodjac,opis,kategorija,cena) VALUES ("'.$nazivProizvoda.'","'.$nazivProizvodjaca.'","'.$poljeOpis.'","'.$podKategorija.'",'.$cena.')';
    //echo "$sql";
    $last_id;
    /* $sql5='INSERT INTO karakteristike_za_proiz(proizvod_id,karakteristika_id,vrednost) VALUE(5,1,56)';

       if ($conn->query($sql5) === TRUE) {
              echo "IDEMOOOOOOOOOOOOOOOO";
            } else {
            echo "Error: NE IDEMOOOOOOOOOOOO" . $sql5 . "<br>" . $conn->error;
            }
*/

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;

        foreach ($data as $key => $d) {
         // print_r($d);
           // echo $value["name"] . ", " . $value["gender"] . "<br>";

            if(is_numeric($d['id'])){
                $sql1='INSERT INTO karakteristike_za_proiz(proizvod_id,karakteristika_id,vrednost) VALUE("'.$last_id.'","'.$d['id'].'","'.$d['vrednost'].'")';
            }
            else{

                $result = mysqli_query($conn,"SELECT `id` FROM `karakteristike` WHERE `naziv_karakteristike` = '".$d['id']."' AND kategorija_id='".$podKategorija."'");
                $row = mysqli_fetch_assoc($result);
                $id1 = $row['id'];

                $sql1='INSERT INTO karakteristike_za_proiz(proizvod_id,karakteristika_id,vrednost) VALUE("'.$last_id.'","'.$id1.'","'.$d['vrednost'].'")';

            }
  

            if ($conn->query($sql1) === TRUE) {
              echo "New record created successfullyAAAAAAAAAAAAAAAAAA";
            } else {
            echo "Error:AAAAAAAAAAAAAAAAAA " . $sql1 . "<br>" . $conn->error;
            }


        }


       /* foreach($data1 as $d1){

            $result = mysql_query("SELECT `id` FROM `karakteristike` WHERE `naziv_karakteristike` = '".$d1."'") or die (mysql_error());
            $row = mysql_fetch_assoc($result);
            $id1 = $row['id'];

             $sql1='INSERT INTO karakteristike_za_proiz(proizvod_id,karakteristika_id,vrednost) VALUE("'.$last_id.'","'.$id1.'","'.$d1.'")';

            if ($conn->query($sql1) === TRUE) {
              echo "New record created successfullyAAAAAAAAAAAAAAAAAA";
            } else {
            echo "Error:AAAAAAAAAAAAAAAAAA " . $sql1 . "<br>" . $conn->error;
            }
        }*/
      

      echo "New record created successfully";
    } 
    else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
   
 

   


    if (move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.'/img/'. $_FILES["image"]['name'])) {
        echo "Uploaded";
    } else {
       echo "File was not uploaded";
    }



    
  
}
mysqli_close($conn);
