<?php

$proizvod_id = $_GET['proizvod'];

$conn = mysqli_connect('localhost', 'termax', 'termax', 'termax');
if (!$conn) {
    echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
} else {

    $sql = 'SELECT * FROM proizvodi WHERE id=' . $proizvod_id;

    $result = mysqli_query($conn, $sql);


    $proizvod = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // print_r($proizvod_id);
    mysqli_free_result($result);
    //print_r($proizvod);
    //print_r($proizvod);
    $sql = 'SELECT * FROM proizvodi WHERE naziv="' . $proizvod[0]["naziv"] . '"';

    $result = mysqli_query($conn, $sql);


    $proizvodi = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // print_r($proizvod_id);
    mysqli_free_result($result);

    if (count($proizvodi) > 1) {


        $sql = 'SELECT ka.naziv_karakteristike,k.vrednost,k.proizvod_id FROM karakteristike_za_proiz as k LEFT JOIN karakteristike as ka ON k.karakteristika_id=ka.id WHERE ';
        $prvi = true;
        foreach ($proizvodi as $pro) {
            if ($pro["id"] != $proizvod[0]['id']) {
                if ($prvi) {
                    $prvi = false;
                    $sql .= ' k.proizvod_id=' . $pro["id"];
                } else {
                    $sql .= ' OR k.proizvod_id=' . $pro["id"];
                }
            }
        }

        //print_r($sql);
        //print_r($sql);
        $result = mysqli_query($conn, $sql);
        $karakteristikeZaProizvode = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //print_r($karakteristikeZaProizvod );
        mysqli_free_result($result);
    }
    $sql = 'SELECT ka.naziv_karakteristike,k.vrednost FROM karakteristike_za_proiz as k LEFT JOIN karakteristike as ka ON k.karakteristika_id=ka.id WHERE k.proizvod_id=' . $proizvod_id . ' ORDER BY+
    k.vrednost';
    //print_r($sql);
    $result = mysqli_query($conn, $sql);
    $karakteristikeZaProizvod = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //print_r($karakteristikeZaProizvod );
    mysqli_free_result($result);


    $sql = "SELECT * FROM proizvodi WHERE kategorija=" . $proizvod[0]['kategorija'] . " ORDER BY RAND() LIMIT 8";
    $result = mysqli_query($conn, $sql);
    $preporuceniProizvodi = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //print_r($preporuceniProizvodi );
    mysqli_free_result($result);

    if (count($preporuceniProizvodi) < 8) {
        $broj = 8 - count($preporuceniProizvodi);
        $sql = "SELECT * FROM proizvodi  ORDER BY RAND() LIMIT " . $broj;
        $result = mysqli_query($conn, $sql);
        $preporuceniProizvodi1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (is_object($preporuceniProizvodi)) {
        }
        //array_push($preporuceniProizvodi, $preporuceniProizvodi1);
        $preporuceniProizvodi = array_merge($preporuceniProizvodi, $preporuceniProizvodi1);
        mysqli_free_result($result);
        print_r($preporuceniProizvodi1);
    }


    $sql = "SELECT * FROM kategorije WHERE id=" . $proizvod[0]["kategorija"];
    $result = mysqli_query($conn, $sql);
    $kategorija2 = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);
    //print_r($proizvodi);
    //print_r($kategorije[1]);

}

?>
<?php
include "../templates/header.php";
?>






<div class="container">
    <form id="proizvod-form" action="generic.php" method="get">
        <input type="hidden" id="proizvod" name="proizvod" value="">
    </form>
    <?php
    // echo $kategorija2[0]["naziv"];
    // echo $kategorija2[0]["podkategorije"];
    $katego = str_replace(' ', '+', $kategorija2[0]["naziv"]);
    $podkatego = str_replace(' ', '+', $kategorija2[0]["podkategorije"]);
    ?>
    <div class="topbread">
        <ol class="breadcrumb">
            <li><a href="/"><span style="width:20px;" class="glyphicon glyphicon-home"></span></a></li>
            <li><a href="/termax/src/proizvodi.php">Proizvodi</a></li>
            <li><a href="/termax/src/proizvodi.php?kat-proizvoda=<?php echo  $katego ?>"><?php echo   ucfirst($kategorija2[0]["naziv"]) ?></a></li>
            <li><a href="/termax/src/katalog.php?kat-proizvoda=<?php echo $podkatego ?>"><?php echo  ucfirst($kategorija2[0]["podkategorije"]) ?></a></li>
            <li class="active"><?php echo ucfirst($proizvod[0]["naziv"]) ?></li>
        </ol>
    </div>


    <div class="border mt-5" style="background:white;">
        <div class="col-md-12 py-4">
            <h2 class="col-md-10  mx-auto my-4 border-bottom border-black py-3" style="text-align:center;"><?php echo $proizvod[0]["naziv"] ?></h2>
        </div>
        <div>
            <div class="row">
                <div class="col-md-6  clearfix">
                    <img class="ml-md-2 w-100" src="img/kamini_front2.png" onerror="this.src=img/kamini_front2.png">
                </div>
                <div id="karakteristikeZaProizvod" class="border col-md-5  m-5 p-5 form-wrap">
                    <div class="m-4">
                        <h2 class="mb-4 border-bottom pb-3" style="text-align:center;">Karakteristike </h2>
                        <?php
                        //  print_r($karakteristikeZaProizvode);
                        foreach ($karakteristikeZaProizvod as $karakteristika) {

                        ?>
                            <div>
                                <h4 class="float-left" style="font-weight:400;" ><?php echo $karakteristika["naziv_karakteristike"] ?></h4>


                                <?php
                                $nesto2 = false;
                                if (count($proizvodi) > 1) {
                                    //print_r("LAA");


                                    $listaBrojeva = array();
                                    $prvi = true;
                                ?>
                                    <div id="grupaKarakteristika">
                                        <?php
                                        $broj = 0;
                                        foreach ($karakteristikeZaProizvode as $karakteristikaDrugih) {


                                            //$listabrojeva[0]=0;
                                            if ($karakteristika["naziv_karakteristike"] == $karakteristikaDrugih["naziv_karakteristike"]) {
                                                array_push($listaBrojeva, $karakteristikaDrugih["vrednost"]);

                                                if ($karakteristikaDrugih["vrednost"] < $karakteristika["vrednost"]) {

                                                    if ($prvi) {
                                                        $prvi = false;
                                        ?>
                                                        <h5 class="linkoviZaDruge" name="<?php echo $karakteristikaDrugih["proizvod_id"] ?>"><?php echo $karakteristikaDrugih["vrednost"] ?></h5>

                                                    <?php
                                                    } else {


                                                    ?>
                                                        <h4>/</h4>
                                                        <h5 class="linkoviZaDruge" name="<?php echo $karakteristikaDrugih["proizvod_id"] ?>"><?php echo $karakteristikaDrugih["vrednost"] ?></h5>

                                                        <?php }
                                                } else {
                                                    if (!$nesto2) {
                                                        if ($prvi) {
                                                            $prvi = false;
                                                            $nesto2 = true;
                                                        ?>
                                                            <h4 class="" style="color:#ff5b5b;"><?php echo $karakteristika["vrednost"] ?></h4>
                                                            <h4>/</h4>
                                                            <h5 class=" linkoviZaDruge" name="<?php echo $karakteristikaDrugih["proizvod_id"] ?>"><?php echo $karakteristikaDrugih["vrednost"] ?></h5>
                                                        <?php
                                                        } else {
                                                            $nesto2 = true;

                                                        ?>
                                                            <h4>/</h4>
                                                            <h4 class="" style="color:#ff5b5b;"><?php echo $karakteristika["vrednost"] ?></h4>
                                                            <h4>/</h4>
                                                            <h5 class=" linkoviZaDruge" name="<?php echo $karakteristikaDrugih["proizvod_id"] ?>"><?php echo $karakteristikaDrugih["vrednost"] ?></h5>
                                                        <?php }
                                                    } else {
                                                        ?>
                                                        <h4>/</h4>
                                                        <h5 class=" linkoviZaDruge" name="<?php echo $karakteristikaDrugih["proizvod_id"] ?>"><?php echo $karakteristikaDrugih["vrednost"] ?></h5>
                                            <?php
                                                    }
                                                }

                                                // array.push($nesto,);
                                                /*   //   $str= preg_replace('/[^0-9]/', '', $string);
                                            print_r(preg_replace('/[^0-9]/', '', $karakteristikaDrugih["vrednost"]));
                                            if ($nesto2 || preg_replace('/[^0-9]/', '', $karakteristika["vrednost"]) > preg_replace('/[^0-9]/', '', $karakteristikaDrugih["vrednost"])) {


                                ?>

                                                <h4 class="float-md-right linkoviZaDruge" name="<?php echo $karakteristikaDrugih["proizvod_id"] ?>">/<?php echo $karakteristikaDrugih["vrednost"] ?></h4>
                                            <?php
                                            } else if(!$nesto2){
                                                $nesto2=true;
                                            ?>
                                                <h4 class="float-md-right" style="color:#ff5b5b;"><?php echo $karakteristika["vrednost"] ?></h4>
                                <?php

                                            }*/
                                            }
                                        }

                                        if (!$nesto2) {
                                            $nesto2 = true;
                                            ?>
                                            <h4>/</h4>
                                            <h4 class="" style="color:#ff5b5b;"><?php echo $karakteristika["vrednost"] ?></h4>
                                        <?php

                                        }
                                        // array_push($listaBrojeva, $karakteristika["vrednost"]);
                                        // $lista = sort(array_values(($listaBrojeva)));
                                        //print_r($listaBrojeva);
                                        ?>
                                    </div>
                                <?php
                                }

                                if (!$nesto2) {


                                ?>
                                    <h4 class="float-md-right" style="color:#ff5b5b;"><?php echo $karakteristika["vrednost"] ?></h4>
                                <?php } ?>
                                <div style="display: block; clear: both;"></div>
                            </div>

                        <?php
                        }
                        ?>
                        <div class="mt-5 pt-3 border-top" style="display: flow-root;">
                            <div style="float:right;">
                                <h2 class="mr-5 " style="display: inline;" >CENA</h2>
                                <h2 class="float-right"><?php echo $proizvod[0]["cena"] ?> dinara</h2>

                                <div style="display: block; clear: both; "></div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="border clearfix p-4 m-3" style="clear:both; background: #e9ecef;">
            <h3>OPIS PROIZVODA</h3>
            
            <p><?php echo nl2br($proizvod[0]["opis"]) ?> </p>
        </div>

    </div>






</div>
<div class="container-fluid abs mb-5">
    <form id="proizvod-form" action="generic.php" method="get">
        <input type="hidden" id="proizvod" name="proizvod" value="">
    </form>
    <div class="border p-5 my-4" id="slicniProizvodi" style=" background: white;">
        <h2 class="mb-4" style="border-bottom:1px solid black;">SLIČNI PROIZVODI</h2>
        <div class="row border-bottom border-top py-4 border-white" style="background:#f1f1f1;">
            <?php
            for ($x = 0; $x < count($preporuceniProizvodi); $x++) {

            ?>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-5 border mx-auto  preporuceniProizvod " style="cursor:pointer" name="<?php echo $preporuceniProizvodi[$x]["id"] ?>">
                            <img class="w-100" src="img/kamini_front2.png">
                            <h6><?php echo $preporuceniProizvodi[$x++]["naziv"] ?></h6>
                        </div>
                        <?php
                        if ($x < count($preporuceniProizvodi)) {
                        ?>
                            <div class="col-md-5 border preporuceniProizvod mx-auto" style="cursor:pointer" name="<?php echo $preporuceniProizvodi[$x]["id"] ?>">
                                <img class="w-100" src="img/kamini_front2.png">
                                <h6><?php echo $preporuceniProizvodi[$x]["naziv"] ?></h6>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>












<?php
include "../templates/footer.php"
?>