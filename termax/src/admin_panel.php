<?php


session_start();

if (isset($_SESSION['user'])) {
} else {
    $_SESSION['msg'] = "You must log in first";
    header('location: pages/login.php');
}


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: pages/login.php");
}

include "../templates/header.php";



?>



<div id="izmeniProizvodProzor" style="z-index: 1000;display:none; position: absolute; background: white; width: 50%; left:25%;">
    <div style="text-align: center; margin:25px 0;">
        <h3>Izmeni proizvod</h3>
    </div>
    <form class="form-horizontal">
        <div style="width: 50%; margin:20px 40px;">
            <div class="form-group">
                <label class="col-md-3 col-sm-2 control-label" for="nazivProizvoda">Naziv proizvoda</label>
                <div class="col-md-9 col-sm-10">
                    <input type="text" class="form-control" id="nazivProizvoda" placeholder="Eg.Steve">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-2 control-label" for="nazivProizvodjaca">Naziv proizvođača</label>
                <div class="col-md-9 col-sm-10">
                    <input type="text" class="form-control" id="nazivProizvodjaca" placeholder="Eg.Thomas">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-2 control-label" for="poljeOpis">Opis</label>
                <div class="col-md-9 col-sm-10">
                    <input type="text" class="form-control" id="poljeOpis" placeholder="Eg.Thomas">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-2 control-label">Vrsta</label>
                <div class="col-md-9 col-sm-10">

                    <select id="vrsta1" class="form-control ">
                        <option value="" selected disabled hidden>Izaberi</option>
                        <?php
                        foreach ($kateg as $kategorija) {

                        ?>
                            <option><?php echo ucfirst($kategorija)  ?></option>
                        <?php

                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-2 control-label">Pod vrsta</label>
                <div class="col-md-9 col-sm-10">
                    <select id="vrsta2" class="form-control">
                        <option value="" selected disabled hidden>Izaberi</option>
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div style="width: 50%; text-align: center; margin:20px 40px;">
            <h4> Kategorije</h4>
            <table id="detaljiProizvoda" class="tabele">
                <tbody>
                    <tr id="tableHeader">
                        <th>Naziv</th>
                        <th>Vrednost</th>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="clearfix"></div>
        <div id="meniKarakteristika" style="display:none; 	width: 70%; text-align: center; margin:20px 40px;">
            <h4>Dodaj kategoriju</h4>
            <div class="form-group">
                <label class="col-md-3 col-sm-2 control-label">Karakteristika</label>
                <div id="dodajKategMeni" class="col-md-9 col-sm-10">

                    <select id="broj1" class=" form-control">
                        <option value="" selected disabled hidden>Izaberi</option>
                        <option>Velicina</option>
                        <option>English(Uk)</option>
                    </select>
                </div>

                <div id="poljeNovaKateg" style="display:none;" class="col-md-9 col-sm-10">
                    <input type="text" class="form-control" placeholder="Eg.Thomas">
                </div>


                <h5 id="dodajNovuKategoriju">
                    <span class="fa-stack fa-1x">
                        <i class="fa fa-circle fa-stack-2x " style="color:#545b62;"></i>
                        <i class="fa fa-plus fa-stack-1x icon-color"></i>
                    </span>
                </h5>


            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-2 control-label" for="nazivPodKategorije">Vrednost</label>
                <div class="col-md-9 col-sm-10">
                    <input type="text" class="form-control" id="nazivPodKategorije" placeholder="Eg.Steve">
                </div>
            </div>
            <div class="form-group" style="clear:both; justify-content: center; border-bottom: 1px solid black; padding:10px 0 40px 0;">
                <div class="col-md-offset-3 col-sm-offset-2 col-sm-3">
                    <button type="submit" id="dodajKarakteristikuIzmeniOpcija" class="btn btn-default" style="border:1px solid black;">Dodaj karakteristiku</button>
                </div>
            </div>

        </div>


        <div style="margin:50px 0;">
            <button style="border:1px solid black;    margin:0 50px; float:right;  display: flex; " class="btn btn-default">Izmeni proizvod</button>
            <button id="izadjiBtn" style="border:1px solid black;   float:right; " class="btn btn-default">Izadji</button>
            <div class="clearfix"></div>
        </div>


    </form>
</div>

<div style="padding-top:50px;">
    <div class="form-bg">
        <div class="container">
            <div class="row">

                <div>
                    <h2 style="border-bottom:2px solid black;">KATEGORIJE</h2>
                    <table class="tabele" id="detaljiRacun2">
                        <tbody id="tbodiKategorije">
                            <tr id="tableHeaderKategorije">
                                <th>Kategorija</th>
                                <th>Pod kategorija</th>
                            </tr>
                        </tbody>


                    </table>
                </div>

                <div>
                    <h2 style="border-bottom:2px solid black;">PROIZVODI</h2>
                    <div class="row">
                        <div class="form-group col-md-6 mt-5">
                            <label class="col-md-3 col-sm-2 control-label" for="nazivProizvoda">Naziv proizvoda</label>
                            <div class="col-md-9 col-sm-10">
                                <input type="text" class="form-control" id="nazivProizvoda" placeholder="Eg.Mareli">
                            </div>
                            <button id="filtrirajProizvode" class="btn btn-white" style="margin:0;">Pretrazi</button>
                        </div>
                    </div>



                    <table class="tabele" id="detaljiRacun1">
                        <tbody id="tbodiProizvoda">
                            <tr id="tableHeader">
                                <th>ID</th>
                                <th>Naziv</th>
                                <th>Proizvodjac</th>
                                <th>Kategorija</th>
                            </tr>
                        </tbody>


                    </table>
                </div>

            </div>
        </div>
    </div>
</div>




<?php
include "../templates/footer.php"
?>
<script type="text/javascript">
    var karakteristike = <?php echo json_encode(vratiKrakteristike(), JSON_PRETTY_PRINT) ?>;


    var kategorije = <?php echo json_encode(vratiKategorije(), JSON_PRETTY_PRINT) ?>;
    dodajKategorije();

    var proizvodi = <?php echo json_encode(vratiProizvode(), JSON_PRETTY_PRINT) ?>;

    dodajProizvode();


    $("#filtrirajProizvode").click(function() {
        var noviProizvodi = [];
        var uslov = $(this).parent().find("#nazivProizvoda").val();

        for (const i in proizvodi) {
            // console.log(proizvodi[index][0]["id"]);
            //$("#detaljiRacun1").append('<tr class="racun" name=' + proizvodi[i][0]["id"] + ' ><td>' + (y++) + '</td> <td>' + capitalizeFirstLetter(proizvodi[i][0]["naziv"]) + '</td><td>' + capitalizeFirstLetter(proizvodi[i][0]["proizvodjac"]) + '</td><td>' + capitalizeFirstLetter((proizvodi[i][0]["podkategorije"])) + '</td> </tr>');
            if (proizvodi[i][0]["naziv"].toLowerCase().includes(uslov.toLowerCase())) {


                noviProizvodi.push(proizvodi[i][0]["id"]);
            }

        }
        console.log(noviProizvodi);
        const myNode = document.getElementById("tbodiProizvoda");
        myNode.innerHTML = '';

        $("#tbodiProizvoda").append('<tr id="tableHeader">  <th>ID</th><th>Naziv</th><th>Proizvodjac</th><th>Kategorija</th></tr>');
        //alert(noviProizvodi[5][0]["id"]);

        ucitajProizvodeSaFilterom(noviProizvodi);
    });

    function dodajKategorije() {



        for (i = 0; i < kategorije.length; i++) {

            $("#detaljiRacun2").append('<tr name=' + kategorije[i]["id"] + ' class="racun" ><td>' + capitalizeFirstLetter(kategorije[i]["naziv"]) + '</td> <td>' + capitalizeFirstLetter(kategorije[i]["podkategorije"]) + '</td> </tr>');
            // alert(kategorije[i]["pod-kategorije"]);
            // $( this ).append('');
        }



    }

    function ucitajProizvodeSaFilterom(noviProizvodi) {
        var y = 1;
        console.log(proizvodi);
        // alert(proizvodi[noviProizvodi[0]][0]["id"] );
        for (i = 0; i < noviProizvodi.length; i++) {

            $("#detaljiRacun1").append('<tr class="racun" name=' + proizvodi[noviProizvodi[i]][0]["id"] + ' ><td>' + (y++) + '</td> <td>' + capitalizeFirstLetter(proizvodi[noviProizvodi[i]][0]["naziv"]) + '</td><td>' + capitalizeFirstLetter(proizvodi[noviProizvodi[i]][0]["proizvodjac"]) + '</td><td>' + capitalizeFirstLetter((proizvodi[noviProizvodi[i]][0]["podkategorije"])) + '</td> </tr>');

        }

    }

    function dodajProizvode() {


        //console.log(proizvodi);
        //alert(proizvodi[5][0]["id"]);
        //alert(typeof(proizvodi));
        var y = 1;
        for (const i in proizvodi) {
            // console.log(proizvodi[index][0]["id"]);


            $("#detaljiRacun1").append('<tr class="racun" name=' + proizvodi[i][0]["id"] + ' ><td>' + (y++) + '</td> <td>' + capitalizeFirstLetter(proizvodi[i][0]["naziv"]) + '</td><td>' + capitalizeFirstLetter(proizvodi[i][0]["proizvodjac"]) + '</td><td>' + capitalizeFirstLetter((proizvodi[i][0]["podkategorije"])) + '</td> </tr>');


        }
        /*for(i=0;i<proizvodi.length && i<50;i++){

  		if (typeof proizvodi[i] !== 'undefined') {
  			alert(proizvodi[i][0]);
   			 $("#detaljiRacun1").append('<tr class="racun" name='+proizvodi[i][0]["id"] +' ><td>' +(i+1)+ '</td> <td>' + capitalizeFirstLetter(proizvodi[i][0]["naziv"]) + '</td><td>' + capitalizeFirstLetter(proizvodi[i][0]["proizvodjac"]) + '</td><td>' + capitalizeFirstLetter((proizvodi[i][0]["podkategorije"])) + '</td> </tr>');
		}
             
   // alert(kategorije[i]["pod-kategorije"]);
  // $( this ).append('');
  }*/
    }


    function nadjiKategoriju(nesto) {
        for (i = 0; i < kategorije.length; i++) {

            if (kategorije[i]["id"] === nesto)
                return kategorije[i]["podkategorije"];
        }


    }


    function ucitajRB() {
        var i = 1;
        $('#tbodiProizvoda tr td:first-child').each(function() {
            $(this).html(i);
            i++;
            //console.log($(this).text());
        });
    }

    $(document).on({
        mouseenter: function() {


            if ((this).id != "tableHeader") {
                //<img id='izmeniIkona'  style='width:30px; margin-left:5px;' src='assets/izmeniIcon.png'>
                $(this).append("<td id='dodatak'><img id='deleteIkona' style='width:32px; margin-left:5px;' src='assets/deleteIcon.png'></td>");
                $(this).find(">:first-child").prepend("<img id='strelica' style='margin-right:10px;' src='assets/strelicaNaDesno.png'>");
                $(this).find(">:first-child").css("padding", "10px 50px 10px 20px");
            }

            $("#izmeniIkona").click(function() {
                $("#izmeniProizvodProzor").css("display", "block");
                //alert(proizvodi[5]["karakteristike"]);
                var id = $(this).parent().parent().attr("name");

                $("#nazivProizvoda").val(proizvodi[id][0]["naziv"]);
                $("#nazivProizvodjaca").val(proizvodi[id][0]["proizvodjac"]);
                $("#poljeOpis").val(proizvodi[id][0]["opis"]);
                //console.log(proizvodi);
                //alert(capitalizeFirstLetter(proizvodi[id][0]["kategorija"]));
                //$('#vrsta1 option[value='+capitalizeFirstLetter(proizvodi[id][0]["kategorija"])+']').attr('selected','selected');
                $("#vrsta1").val(capitalizeFirstLetter(proizvodi[id][0]["kategorija"])).change();
                $("#vrsta2").val(capitalizeFirstLetter(proizvodi[id][0]["podkategorije"])).change();

                var lista = proizvodi[id]["karakteristike"];

                if (typeof lista !== 'undefined') {
                    for (i = 0; i < lista.length; i++) {
                        $("#detaljiProizvoda").append('<tr id="' + lista[i]['id'] + '" ><td>' + capitalizeFirstLetter(lista[i]["naziv_karakteristike"]) + '</td> <td>' + capitalizeFirstLetter(lista[i]["vrednost"]) + '</td> </tr>');
                    }
                }
                /*
                    $("#bgIzmeni").css("display", "block");
                    $("#izmeniRacun").fadeIn("fast");
                    var id = $(this).parent().parent().attr("name");
                    idRacunaZaIzmenu = id;
                    for (var i = 0; i < listaRacun.length; i++) {
                        if (id == listaRacun[i].id) {
                            $("#tabelaStavkaRacuna tr[name=filler]").remove();
                            var datum = listaRacun[i].vreme.split("-");
                            var datum1 = datum[2] + '-' + datum[1] + "-" + datum[0];
                            $("#kupacIme").val(listaRacun[i].kupac);
                            $("#datumRacun").val(datum1);
                            $("#popustIzmena").val(listaRacun[i].popust);
                            $("#iznosIzmena").val(listaRacun[i].iznos);
                            var stavke = listaRacun[i].stavke.split("/");
                            $(".stavkeRacuna").remove();
                            popustStari = listaRacun[i].popust;
                            for (var y = 0; y < stavke.length - 1; y++) {
                                var m = stavke[y].split("-");
                                $("#tabelaStavkaRacuna").append('<tr class="stavkeRacuna" name=' + m[0] + '><td>' + (y + 1) + '</td> <td>' + m[1] + '</td><td>' + m[2] + '</td> </tr>');
                            }
                            var brojStavki = stavke.length - 1;
                            if (brojStavki > 5) {
                                $("#tabelaStavkaRacuna").css("overflow-y", "scroll");
                            }

                            while (brojStavki < 5) {
                                $("#tabelaStavkaRacuna").append('<tr name="filler"><td> </td> <td> </td><td> </td> </tr>');
                                brojStavki++;
                            }

                            break;
                        }
                    }*/



            });
            $("#deleteIkona").click(function() {
                /*$("#racunZaBrisanje").val($(this).parent().parent().attr("name"));
                $("#formaRacunZaBrisanje").submit();*/
                //alert($(this).parent().parent().attr("name"));
                var brojUListi = $(this).parent().siblings(":first").text() - 1;

                proizvodi.splice(brojUListi, 1);

                var id = $(this).parent().parent().attr("name");
                $.ajax({
                    url: 'pages/obrisi_proizvod.php',
                    type: 'POST',
                    data: {
                        id_proizvoda: id

                    },
                    success: function(msg) {
                        alert("Izbrisan je proizvod sa id: " + id);

                    }
                });
                $(this).parent().parent().remove();
                ucitajRB();

            });
        },
        mouseleave: function() {

            $('#dodatak').remove();
            $(this).find(">:first-child").css("padding", "10px 50px 10px 50px");
            $('#strelica').remove();
        }
    }, "#detaljiRacun1 tr");


    $(document).on({
        mouseenter: function() {


            if ((this).id != "tableHeaderKategorije") {
                $(this).append("<td id='dodatak'><img id='deleteIkona' style='width:32px; margin-left:5px;' src='assets/deleteIcon.png'></td>");
                $(this).find(">:first-child").prepend("<img id='strelica' style='margin-right:10px;' src='assets/strelicaNaDesno.png'>");
                $(this).find(">:first-child").css("padding", "10px 50px 10px 20px");
            }


            $("#deleteIkona").click(function() {
                var idZaBrisanje = $(this).parent().parent().attr("name");
                alert(idZaBrisanje);
                $.ajax({
                    url: 'pages/obrisi_kategoriju.php',
                    type: 'POST',
                    data: {
                        id_kategorije: idZaBrisanje

                    },
                    success: function(msg) {
                        data = JSON.parse(msg);
                        if (data[delete_status]) {
                            alert("Izbrisana je kategorija sa id: " + idZaBrisanje);

                        }
                        else{
                            alert("GRESKA");
                        }
                    }
                });
                $(this).parent().parent().remove();
                //ucitajRB();

            });
            /*var brojUListi = $(this).parent().siblings(":first").text() - 1;

                proizvodi.splice(brojUListi, 1);

                var id = $(this).parent().parent().attr("name");
                $.ajax({
                    url: 'pages/obrisi_proizvod.php',
                    type: 'POST',
                    data: {
                        id_proizvoda: id

                    },
                    success: function(msg) {
                        alert("Izbrisan je proizvod sa id: " + id);

                    }
                });
                $(this).parent().parent().remove();
                ucitajRB();

            });*/
        },
        mouseleave: function() {

            $('#dodatak').remove();
            $(this).find(">:first-child").css("padding", "10px 50px 10px 50px");
            $('#strelica').remove();
        }
    }, "#detaljiRacun2 tr");




    $("#izadjiBtn").click(function(e) {
        e.preventDefault();
        $("#detaljiProizvoda tr").remove();
        $("#meniKarakteristika").css("display", "none");
        $("#izmeniProizvodProzor").css("display", "none");

    });
</script>