<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$conn = mysqli_connect('localhost', 'termax', 'termax', 'termax');






function login()
{

    $name = $_POST['name'];
    $pass = $_POST['pass'];
    global $conn;


    if (!$conn) {
        echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
    } else {

        $sql = 'SELECT * FROM admin';
        $result = mysqli_query($conn, $sql);
        $admini = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);


        foreach ($admini as $admin) {

            if ($admin['name'] == $name) {
                if ($admin['password'] == $pass) {
                    // $logovan = true;
                    $_SESSION['user'] = $name;
                    break;
                }
            }
        }

        $sql = 'SELECT * FROM karakteristike';
        $result = mysqli_query($conn, $sql);

        $karakteristike = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        //mysqli_close($conn);

        header('location: ../admin.php');
    }
}

function vratiKrakteristike()
{
    global $conn;


    if (!$conn) {
        echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
    } else {
        $sql = 'SELECT * FROM karakteristike';
        $result = mysqli_query($conn, $sql);

        $karakteristike = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
    }
    return $karakteristike;
}

function vratiKategorije()
{
    global $conn;


    if (!$conn) {
        echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
    } else {
        $sql = 'SELECT * FROM kategorije';

        $result = mysqli_query($conn, $sql);


        $kategorije = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);

        // print_r($kategorije);

    }
    return $kategorije;
}
//vratiProizvode();

function vratiProizvode()
{
    global $conn;


    if (!$conn) {
        echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
    } else {
        $sql = "SELECT p.id, p.naziv,p.opis, p.proizvodjac,k.naziv AS kategorija,k.podkategorije FROM proizvodi as p INNER JOIN kategorije k ON p.kategorija=k.id ORDER BY p.id DESC";

        $result = mysqli_query($conn, $sql);


        $proizvodi = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);



        $sql1 = "SELECT k.id,k.proizvod_id,ka.naziv_karakteristike,k.vrednost FROM karakteristike_za_proiz k JOIN karakteristike ka ON k.karakteristika_id=ka.id";

        $result1 = mysqli_query($conn, $sql1);
        $karakteristike = mysqli_fetch_all($result1, MYSQLI_ASSOC);

        mysqli_free_result($result1);
        //    print_r($proizvodi);
        //echo  $proizvodi[29];
        $lista = array();
        foreach ($proizvodi as $proizvod) {
            $lista[$proizvod['id']][] = $proizvod;
        }

        foreach ($karakteristike as $karakteristika) {
            $id = $karakteristika["proizvod_id"];
            if (!isset($lista[$id]["karakteristike"])) {

                $lista[$karakteristika["proizvod_id"]]["karakteristike"] = array();
            }
            unset($karakteristika["proizvod_id"]);
            array_push($lista[$id]["karakteristike"], $karakteristika);
        }
        // print_r($lista);
        /*  foreach ($karakteristike as $karakteristika) {
          
            for ($x = 0; $x <= count($proizvodi); $x++) {
                if(!isset($proizvodi[$x]["karakteristike"])){
              
                     $proizvodi[$x]["karakteristike"]=array();
                }
                if(isset($proizvodi[$x]["id"])) {
                    if($proizvodi[$x]["id"]==$karakteristika["proizvod_id"]){
                    array_push($proizvodi[$x]["karakteristike"], $karakteristika);
                    }
                }
                
            }
           
        }
        print_r($proizvodi);*/


        // print_r($kategorije);
        // echo implode(" ",implode(" ",$proizvodi));


    }
    return $lista;
}
function vratiObjave()
{
    global $conn;


    if (!$conn) {
        echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
    } else {
        $sql = 'SELECT * FROM objave';

        $result = mysqli_query($conn, $sql);


        $objave = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);

        // print_r($kategorije);

    }
    return $objave;
}
function vratiObjaveZaPocetnu(){
    global $conn;


    if (!$conn) {
        echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
    } else {
        $sql = 'SELECT * FROM objave  order by id desc limit 3;';

        $result = mysqli_query($conn, $sql);


        $objave = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);

        // print_r($kategorije);

    }
    return $objave;
}
function vratiVelicnu(){
    global $conn;


    if (!$conn) {
        echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
    } else {
        $sql = 'SELECT * FROM objave';

        $result = mysqli_query($conn, $sql);


        $objave = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);

        // print_r($kategorije);

    }
    return count($objave);
}



function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}
