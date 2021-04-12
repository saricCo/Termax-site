<?php
include "../templates/header.php";
?>

<?php
$izabrana_kategorija = $_GET['kat-proizvoda'];
//print_r($izabrana_kategorija);
$conn = mysqli_connect('localhost', 'termax', 'termax', 'termax');
if (!$conn) {
    echo "Postoji greska u konekciji sa bazom : " . mysqli_connect_error();
} else {

    $sql = "SELECT p.id,p.naziv,p.proizvodjac,p.opis,p.cena,p.kategorija FROM proizvodi as p INNER JOIN kategorije as k ON p.kategorija=k.id WHERE k.podkategorije='" . $izabrana_kategorija . "'";
    //print_r($sql);
    $result = mysqli_query($conn, $sql);


    $proizvodi = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    //print_r($proizvodi);

    // $proizvodiUnique=array_unique(array_column($proizvodi, 'naziv'));
    //print_r($proizvodiUnique);
    $proizvodiUnique = array_count_values(array_column($proizvodi, 'naziv'));
    // print_r($proizvodiUnique);


    //print_r($proizvodi);
    //print_r($kategorije[1]);


    $sql = "SELECT * FROM karakteristike_za_proiz as k LEFT JOIN karakteristike as ka ON k.karakteristika_id=ka.id LEFT JOIN kategorije as kat ON kat.id=ka.kategorija_id WHERE kat.podkategorije='" . $izabrana_kategorija . "'";
    //print_r($sql);
    $result1 = mysqli_query($conn, $sql);
    $karakteristike = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    mysqli_free_result($result1);



    if (!isset($karakteristike[0]["naziv"])) {

        foreach (vratiKategorije() as $kategori) {
            if ($kategori["podkategorije"] == $izabrana_kategorija) {
                $kategorijaBezPluseva = $kategori["naziv"];
                $katego = str_replace(' ', '+', $kategorijaBezPluseva);
                break;
            }
        }
    } else {
        $katego = str_replace(' ', '+', $karakteristike[0]["naziv"]);
    }



    mysqli_close($conn);
    //print_r($karakteristike);

    //print_r($karakteristike[0]);
    $karakteristike_za_filtere = array();
    //print_r($karakteristike);
    $karakteristike_za_filtere["Cena"] = array();
    $karakteristike_za_filtere["Proizvodjac"] = array();

    $Cene = array_column($proizvodi, "cena");
    if (!empty($Cene)) {

        $min = min($Cene);
        $max = max($Cene);
    } else {
        $min = 0;
        $max = 1;
    }
    foreach ($proizvodi as $proizvod) {


        array_push($karakteristike_za_filtere["Cena"], $proizvod["cena"]);
        array_push($karakteristike_za_filtere["Proizvodjac"], $proizvod["proizvodjac"]);
    }
    foreach ($karakteristike as $karakteristika) {
        // print_r($karakteristika["naziv_karakteristike"]);
        //$karakteristike_za_filtere[$karakteristika["naziv_karakteristike"]]=$karakteristika["vrednost"];
        if ($karakteristika["za_filter"] == 1) {


            if (isset($karakteristike_za_filtere[$karakteristika["naziv_karakteristike"]])) {
                array_push($karakteristike_za_filtere[$karakteristika["naziv_karakteristike"]], $karakteristika["vrednost"]);
            } else {
                $karakteristike_za_filtere[$karakteristika["naziv_karakteristike"]] = array();
                array_push($karakteristike_za_filtere[$karakteristika["naziv_karakteristike"]], $karakteristika["vrednost"]);
            }
        }
    }

    $podkatego = str_replace(' ', '+', $izabrana_kategorija);
    //print_r($karakteristike_za_filtere[0]);
}

?>



<div class="container">
    <?php

    ?>
    <div class="topbread">
        <ol class="breadcrumb">
            <li><a href="/"><span style="width:20px;" class="glyphicon glyphicon-home"></span></a></li>
            <li><a href="/termax/src/proizvodi.php">Proizvodi</a></li>
            <?php
            if (!isset($karakteristike[0]["naziv"])) {

            ?>
                <li><a href="/termax/src/proizvodi.php?kat-proizvoda=<?php echo  $katego ?>"><?php echo  ucfirst($kategorijaBezPluseva) ?></a></li>

            <?php } else { ?>
                <li><a href="/termax/src/proizvodi.php?kat-proizvoda=<?php echo  $katego ?>"><?php echo  ucfirst($karakteristike[0]["naziv"]) ?></a></li>
            <?php } ?>
            <li class="active"><?php echo ucfirst($izabrana_kategorija) ?></li>
        </ol>
    </div>



    <form id="proizvod-form" action="generic.php" method="get">
        <input type="hidden" id="proizvod" name="proizvod" value="">
    </form>
    <div class="row pt-5 mb-5">



        <div class='col-md-3' id="filteri">
            <h2 class="p-2" style="border-bottom:2px solid black;">Filteri</h2>
            <?php
            $x = 0;
            $ubacenaCena = false;

            foreach ($karakteristike_za_filtere as $karakteristika7) {
                // print_r(array_keys($karakteristike_za_filtere)[$x]);
                if ($ubacenaCena && array_keys($karakteristike_za_filtere)[$x] == "Cena") {
                    // 
                    continue;
                }
                // print_r(array_count_values($karakteristika7));
                //print_r(array_keys($karakteristike_za_filtere)[1]);
                // print_r($karakteristika7);
                //print_r(array_keys($karakteristike_za_filtere)[$x]);
            ?>
                <div>
                    <div class="nekiFilter">


                        <?php
                        if (array_keys($karakteristike_za_filtere)[$x] == "Cena") {
                        ?>
                            <h3 class="facet open" name="true" name2=""><?php echo array_keys($karakteristike_za_filtere)[$x] ?></h3>
                        <?php
                        } else {


                        ?>
                            <h3 class="facet" name2=""><?php echo array_keys($karakteristike_za_filtere)[$x] ?></h3>
                        <?php  } ?>
                    </div>
                    <?php
                    if (array_keys($karakteristike_za_filtere)[$x] == "Cena") {
                    ?>
                        <ul class="list-group" style="display:block;">
                        <?php
                    } else {


                        ?>
                            <ul class="list-group">
                            <?php  } ?>
                            <?php
                            //   print_r(key($karakteristike_za_filtere));
                            // $cetiriGrupe=[];
                            $cetiriGrupe = array_fill(0, 4, 0);
                            if (key($karakteristike_za_filtere) == "Cena" && !$ubacenaCena) {
                                $ubacenaCena = true;
                                $cetvrtina = ($max - $min) / 4;
                                foreach ($karakteristika7 as $jednaKarakteristika) {
                                    //  $min
                                    // $max

                                    //  print_r($min);
                                    if ($jednaKarakteristika <= $cetvrtina + $min) {
                                        $cetiriGrupe[0] = $cetiriGrupe[0] + 1;
                                    } else if ($jednaKarakteristika <= $cetvrtina * 2 + $min) {
                                        $cetiriGrupe[1] = $cetiriGrupe[1] + 1;
                                    } else if ($jednaKarakteristika <= $cetvrtina * 3 + $min) {
                                        $cetiriGrupe[2] = $cetiriGrupe[2] + 1;
                                    } else if ($jednaKarakteristika <= $cetvrtina * 4 + $min) {
                                        $cetiriGrupe[3] = $cetiriGrupe[3] + 1;
                                    }
                                }
                                $broj = 1;
                                foreach ($cetiriGrupe as $grupa) {
                                    if ($broj == 1) {
                            ?>

                                        <li class="list-group-item d-flex justify-content-between align-items-center uslov-za-filter" name="<?php echo ($cetvrtina * ($broj - 1) + $min) . '-' . $cetvrtina * $broj ?>">
                                            Od <?php echo ($cetvrtina * ($broj - 1) + $min) ?> do <?php echo  $cetvrtina * $broj   ?> din.
                                            <span class="badge badge-primary badge-pill"><?php echo $grupa ?></span>
                                        </li>

                                    <?php
                                    } else {
                                    ?>

                                        <li class="list-group-item d-flex justify-content-between align-items-center uslov-za-filter" name="<?php echo ($cetvrtina * ($broj - 1) + $min + 1) . '-' . $cetvrtina * $broj ?>">
                                            Od <?php echo ($cetvrtina * ($broj - 1) + $min + 1) ?> do <?php echo  $cetvrtina * $broj   ?> din.
                                            <span class="badge badge-primary badge-pill"><?php echo $grupa ?></span>
                                        </li>

                                <?php
                                    }
                                    $broj++;
                                }
                                ?>
                </div>
                <?php $x++;
                                continue;
                            }
                            //print_r($cetiriGrupe);


                            $y = 0;
                            // print_r(array_keys($karakteristike_za_filtere)[$x]);
                            if (array_keys($karakteristike_za_filtere)[$x] != "Cena") {
                                // print_r(array_count_values($karakteristika7));


                                foreach (array_count_values($karakteristika7) as $vrednostKarakteristike) {
                                    // print_r(array_count_values($vrednostKarakteristike));
                ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center uslov-za-filter" name="<?php echo array_keys(array_count_values($karakteristika7))[$y]    ?>">
                        <?php echo array_keys(array_count_values($karakteristika7))[$y]    ?>
                        <span class="badge badge-primary badge-pill"><?php echo $vrednostKarakteristike ?></span>
                    </li>

            <?php
                                    $y++;
                                }
                            }
            ?>

            </ul>
        </div>

    <?php
                $x++;
            }
    ?>



    </div>




    <div class="col-md-9 ml-md-5" style="background:white;">
        <h2 class="mb-5 mt-2 border-bottom"><?php echo strtoupper($izabrana_kategorija) ?></h2>

        <div id="prizvodiPrikaz">
            <?php
            $brojPrikazanihProizvoda = 1;
            $poceoRow = false;
            foreach ($proizvodi as $proizvod) {



                if ($brojPrikazanihProizvoda >= 10) {
            ?>
                    <div id="prikaziJos" class="col-md-3 mx-auto my-4 " style="  text-align: center; cursor:pointer;">
                        <img class="w-100 p-2" src="assets/krug.png">
                        <h4 style="color:#545b62; position:absolute; top:50%; left:50%;  transform: translate(-50%, -50%);">PRIKAŽI JOŠ PROIZVODA</h4>
                    </div>
                <?php
                    break;
                }
                if (!$poceoRow) {
                    $poceoRow = true;
                ?>
                    <div class="row">
                    <?php
                }
                    ?>

                    <div class="col-md-4 mb-4">
                        <div class="to-generic" name="<?php echo $proizvod['id'] ?>">
                            <div>
                                <img class="p-4 w-100" src='img/kamini_front2.png' onerror="this.src='img/kamini_front2.png'">
                            </div>
                            <div>
                                <h4><?php echo $proizvod["naziv"] ?></h4>
                                <h5><?php echo $proizvod["cena"] ?> din.</h5>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($brojPrikazanihProizvoda % 3 == 0) {
                        $poceoRow = false;
                    ?>
                    </div>
                <?php
                    }
                    $brojPrikazanihProizvoda++;
                }
                if ($poceoRow) {
                ?>
        </div>

    <?php
                }



    ?>
    </div>
</div>

</div>







</div>






<script type="text/javascript">
    var proizvodi = <?php echo json_encode($proizvodi, JSON_PRETTY_PRINT) ?>;
    var karakteristike = <?php echo json_encode($karakteristike, JSON_PRETTY_PRINT) ?>;
    var proizvodiID = <?php echo json_encode(array_column($proizvodi, 'id'), JSON_PRETTY_PRINT) ?>;
    //alert(proizvodi[0]);
    // alert(kategorije[4]['id']);
    //var proizvodiKojiIspunjavajuUslove=proizvodi;
    //var trenutnaLista=proizvodi;
    //var proizvodiIDkojiOdgovaraju=[];
    var proizvodiIDkojiOdgovaraju = proizvodiID;
    // alert(proizvodiID[0]);
    var uslovi = [];
    var mnozac = 0;
    $("#prikaziJos").click(function(e) {
        mnozac++;
        ucitajProizvode();


    });

    $(".uslov-za-filter").click(function(e) {
        //  $(this).addClass()
        mnozac = 0;
        if ($(this).hasClass("activeFilter")) {
            $(this).removeClass('activeFilter');
        } else {


            $(this).addClass('activeFilter').siblings().removeClass('activeFilter');
        }

        var uslov = $(this).parent().siblings(".nekiFilter").children(".facet").text();
        var vrednostUslova = $(this).attr("name");




        for (var i = 0; i < uslovi.length; i++)
            if (uslovi[i].uslov === uslov) {
                var vrednost = uslovi[i].vrednostUslova;
                uslovi.splice(i, 1);

                if (vrednost === vrednostUslova) {
                    ucitajProizvode();
                    return;
                }
                break;
            }

        let obj = {};
        obj.uslov = uslov;
        obj.vrednostUslova = vrednostUslova;
        uslovi.push(obj);


        ucitajProizvode();

    });

    function ucitajProizvode() {


        if (uslovi.length == 0) {
            var i = 0;
            const item = document.querySelector('#prizvodiPrikaz');
            item.innerHTML = '';
            var brojPrikazanihProizvoda = 1;
            var sviPrikazani = false;



            for (i = 0; i < proizvodi.length; i++) {

                if (brojPrikazanihProizvoda >= 10 + (10 * mnozac)) {
                    sviPrikazani = true;
                    $("#prizvodiPrikaz").append('<div id="prikaziJos" class="col-md-3 mx-auto my-4 " style="  text-align: center; cursor:pointer;">' +
                        '<img class="w-100" src="assets/krug.png">' +
                        ' <h4 style="color:#545b62; position:absolute; top:50%; left:50%;  transform: translate(-50%, -50%);">PRIKAŽI JOŠ PROIZVODA</h4>' +
                        ' </div>');




                    $("#prikaziJos").click(function(e) {
                        mnozac++;
                        ucitajProizvode();


                    });
                    break;
                }
                if (brojPrikazanihProizvoda % 3 == 1) {
                    $('#dodajOvom').removeAttr('id');

                    $("#prizvodiPrikaz").append(' <div id="dodajOvom" class="row"></div>');

                }

                $("#dodajOvom").append('<div class="col-md-4 mb-4">' +
                    ' <div class="to-generic" name="' + proizvodi[i]["id"] + '">' +
                    ' <div>' +
                    '<img class="p-4 w-100" src="img/kamini_front2.png" onerror="this.src=\'img/kamini_front2.png\'"  >' +
                    ' </div>' +
                    '<div>' +
                    '<h4>' + proizvodi[i]["naziv"] + '</h4>' +
                    '<h5>' + proizvodi[i]["cena"] + ' din.</h5>' +
                    '  </div>' +
                    ' </div>' +
                    '  </div>');



                brojPrikazanihProizvoda++;
            }
            if (proizvodi.length == brojPrikazanihProizvoda) {
                $("#prikaziJos").remove();
            }

            $('#dodajOvom').removeAttr('id');



            $('.to-generic').click(function(e) {
                e.preventDefault();
                $("#proizvod").val($(this).attr('name'));
                form2.submit();

                // alert($(this).text());
            });
            return;
        }
        //  alert(karakteristika);
        var y;
        //alert(uslov);
        //alert(karakteristike["naziv_karakteristike"]);
        var novaLista = [];
        //alert(uslovi[0].uslov);
        for (y = 0; y < uslovi.length; y++) {
            var i = 0;
            var dobar = false;
            if (uslovi[y].uslov == "Cena") {
                for (z = 0; z < proizvodi.length; z++) {
                    var nesto = uslovi[y].vrednostUslova.split("-");
                    var min = nesto[0];
                    var max = nesto[1];
                    // alert(min);
                    if (min <= proizvodi[z]["cena"] && max >= proizvodi[z]["cena"]) {
                        novaLista.push(proizvodi[z]["id"]);
                    }
                }

            }
            if (uslovi[y].uslov == "Proizvodjac") {
                for (z = 0; z < proizvodi.length; z++) {
                    if (uslovi[y].vrednostUslova == proizvodi[z]["proizvodjac"]) {
                        novaLista.push(proizvodi[z]["id"]);
                    }
                }

            }

            for (i = 0; i < karakteristike.length; i++) {




                if (karakteristike[i]["naziv_karakteristike"] == uslovi[y].uslov && karakteristike[i]["vrednost"] == uslovi[y].vrednostUslova) {

                    var id = karakteristike[i]["proizvod_id"];
                    /*if(proizvodiIDkojiOdgovaraju.includes(id)){
                        novaLista.push(id);
                    }*/
                    novaLista.push(id);


                }

            }
            // if(trenutnaLista[i][])



            //  alert(trenutnaLista[i][""]);  


        }


        //const arr = ["hi", "hello", "hi"];
        //console.log(JSON.stringify(novaLista));
        //var lista=[];
        var brojUslova = uslovi.length;
        // alert(brojUslova);
        const countUnique = novaLista => {
            const counts = {};
            for (var i = 0; i < novaLista.length; i++) {
                counts[novaLista[i]] = 1 + (counts[novaLista[i]] || 0);
            };
            // alert(  counts[novaLista[i]] );
            /*if(brojUslova==counts[novaLista[i]]){
                lista.push(novaLista[i]);
            }*/
            return counts;
        };
        var lista = countUnique(novaLista);
        proizvodiIDkojiOdgovaraju = [];
        $.each(lista, function(key, value) {
            if (value >= brojUslova) {
                proizvodiIDkojiOdgovaraju.push(key);
            }
            // alert( key + ": " + value );
        });

        console.log(lista);

        /* for(var i=0;i<lista.length;i++){
             Console.Log(lista[novaLista[i]]);

         }*/

        // proizvodiIDkojiOdgovaraju=lista;
        ucitajGrafickiProizvode();
        // alert(proizvodiIDkojiOdgovaraju[2]);
    }

    function ucitajGrafickiProizvode() {
        //alert(uslovi.toString());
        console.log(JSON.stringify(uslovi));
        const item = document.querySelector('#prizvodiPrikaz');
        item.innerHTML = '';
        var brojPrikazanihProizvoda = 1;
        var i;
        console.log(proizvodi);
        var sviPrikazani = true;
        for (i = 0; i < proizvodi.length; i++) {
            if (proizvodiIDkojiOdgovaraju.includes(proizvodi[i]["id"])) {





                if (brojPrikazanihProizvoda >= 10 + (10 * mnozac)) {
                    sviPrikazani = false;
                    $("#prizvodiPrikaz").append('<div id="prikaziJos" class="col-md-3 mx-auto my-4 " style="  text-align: center; cursor:pointer;">' +
                        '<img class="w-100" src="assets/krug.png">' +
                        ' <h4 style="color:#545b62; position:absolute; top:50%; left:50%;  transform: translate(-50%, -50%);">PRIKAŽI JOŠ PROIZVODA</h4>' +
                        ' </div>');

                    $("#prikaziJos").click(function(e) {
                        mnozac++;
                        ucitajProizvode();
                    });
                    break;
                }
                if (brojPrikazanihProizvoda % 3 == 1) {
                    $('#dodajOvom').removeAttr('id');

                    $("#prizvodiPrikaz").append(' <div id="dodajOvom" class="row"></div>');

                }

                $("#dodajOvom").append('<div class="col-md-4 mb-4">' +
                    ' <div class="to-generic" name="' + proizvodi[i]["id"] + '">' +
                    ' <div>' +
                    '<img class="p-4 w-100" src="img/kamini_front2.png" onerror="this.src=\'img/kamini_front2.png\'"  >' +
                    ' </div>' +
                    '<div>' +
                    '<h4>' + proizvodi[i]["naziv"] + '</h4>' +
                    '<h5>' + proizvodi[i]["cena"] + ' din.</h5>' +
                    '  </div>' +
                    ' </div>' +
                    '  </div>');



                brojPrikazanihProizvoda++;






            }
        }
        if (sviPrikazani) {
            $("#prikaziJos").remove();
        }

        $('#dodajOvom').removeAttr('id');

        $('.to-generic').click(function(e) {
            e.preventDefault();
            $("#proizvod").val($(this).attr('name'));
            form2.submit();

            // alert($(this).text());
        });

    }
</script>


<?php
include "../templates/footer.php"
?>