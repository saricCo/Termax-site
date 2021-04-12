<?php
include "../templates/header.php";
?>


<div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleSlidesOnly" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleSlidesOnly" data-slide-to="1"></li>
        <li data-target="#carouselExampleSlidesOnly" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" style=" width:100%; min-height: 500px ;">
        <div class="carousel-item active">
            <img class="d-block w-100" src="assets/image-slider-01.jpg" alt="First slide">

        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/teaser_03b.jpg" alt="Second slide">

        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/teaser_01b.jpg" alt="Third slide">
        </div>


    </div>
    <div id="pic-info">
        <div class="p-3" style="height: 100%;">

            <h4 class="pb-3" style="height: 25%;">MARELI KOTLOVI VRHUNSKOG KVALITETA</h4>
            <h6 class="pb-3" style="height: 50%; border-bottom: 1px solid white;">Ovi kotlovi predstavljuju pruzaju
                odlicne
                usluge grejanje po pristupacnim cenama, pogledajte marili kotlove u nasem katalogu!</h6>
            <div class="text-center pt-3">
                <a class="btn btn-outline-blue my-2 my-sm-0" style="width: 60%;" href="/">Prikazi proizvod</a>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <div class="panel-body">

        <div id="objaveIndex">
            <?php

            foreach (vratiObjaveZaPocetnu() as $objava) {
                if ($objava["tip"] == "Slika") {
            ?>
                    <div class=" my-4 py-4" style="position:relative;">
                        <?php
                        if ($adminLogovan) {
                        ?>
                            <div name="<?php echo $objava["id"] ?>" class="izbrisiObjavu" style="cursor:pointer; position:absolute; right:0;">
                                <img id="proba525" style="width:32px; margin-left:5px;" src="assets/deleteIcon.png">
                            </div>
                        <?php
                        } ?>

                        <div id="prikazBord" class="py-4 my-4 " style="border-bottom:1px solid red; display:inline-block;">


                            <h1 id="naslovPrikaz" class="pb-1" style="text-align:center;"><?php echo $objava["naslov"] ?></h1>
                            <h3 id="podnaslovPrikaz" class="pb-1" style="text-align:center;"><?php echo $objava["podnaslov"] ?></h3>
                            <p id="tekst1Prikaz"><?php echo $objava["tekst"] ?></p>
                            <div class="col-md-4 float-md-left pr-4" style="padding-left: 0px; ">
                                <img id="slikaObjave" src="assets/kamini_front2.png" class="img-fluid float-left">
                            </div>
                            <br>
                            <p id="tekst2Prikaz"><?php echo $objava["tekst2"] ?></p>

                            <br>

                        </div>
                    </div>
                <?php
                } else  if ($objava["tip"] == "Video") {
                ?>
                    <div class=" my-4 py-4" style="position:relative;">
                        <?php
                        if ($adminLogovan) {
                        ?>
                            <div name="<?php echo $objava["id"] ?>" class="izbrisiObjavu" style="cursor:pointer; position:absolute; right:0;">
                                <img id="proba525" style="width:32px; margin-left:5px;" src="assets/deleteIcon.png">
                            </div>
                        <?php
                        } ?>
                        <div id="prikazBord" class="py-4 my-4 " style="border-bottom:1px solid red; display:block;">
                            <div class="py-3 mx-5">
                                <video width="100%" controls>
                                    <source src="" id="video_here">
                                    Your browser does not support HTML5 video.
                                </video>
                            </div>

                            <h1 id="naslovPrikaz" class="pb-1" style="text-align:center;"><?php echo $objava["naslov"] ?></h1>
                            <h3 id="podnaslovPrikaz" class="pb-1" style="text-align:center;"><?php echo $objava["podnaslov"] ?></h3>

                            <p id="tekstPrikaz"><?php echo $objava["tekst"] ?></p>

                            <br>

                        </div>
                    </div>
            <?php
                }
            }

            ?>
        </div>
        <div class="col-md-4 mx-auto" stlye="text-align:center;">
            <div class="pages mx-auto" style="display:table;">
                <ol id="stranice" class="mx-auto p-0" style="display: table-cell;">
                    <?php

                    $prvi = true;
                    for ($x = 1; $x <= ceil(vratiVelicnu() / 3); $x++) {

                        if ($prvi) {
                            $prvi = false;
                    ?>
                            <li class="current"><a href=""><?php echo $x ?></a></li>
                        <?php
                        } else {
                        ?>
                            <li><a href=""><?php echo $x ?></a></li>
                    <?php
                        }
                    }

                    ?>

                    <!-- <li class="current"><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href="">5</a></li>
                    <li class="next-page">
                        <a class="next i-next" href="https://www.winwin.rs/tv-audio-video/tv/televizori.html?p=2" title="Sledeće">
                            <img class="my-auto w-100" src="assets/iconRight.png">
                        </a>
                    </li>
-->
                </ol>
            </div>
        </div>

        <div id="kontakt" class="pb-5" style="border-bottom: 1px solid red; clear:both; ">
            <br>
            <br>
            <br>
            <div>
                <h2 class="offset-md-3  col-md-6" style="text-align:center; padding-bottom:2rem; border-bottom: 1px solid #e70103; "> Kontakt</h2>

                <br>
                <br>
                <div style="float:left;">
                    <p>
                        <h3>Termax Plus d.o.o.</h3>
                        <br>
                        <div style="float:left; padding-bottom:1rem;">
                            <h4 style="float:left">
                                <span class="fa-stack fa-1x">
                                    <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                    <i class="fa fa-map-marker fa-stack-1x icon-color"></i>
                                </span>
                            </h4>

                            <div style="padding-left:1rem; float:left;">
                                <h4> ADRESA</h4>
                                356 Magistralni put
                                <br>
                                36000 Kraljevo, Srbija

                            </div>

                        </div>
                        <div style="clear:both; float:left; padding-bottom:1rem;">
                            <h4 style="float:left">
                                <span class="fa-stack fa-1x">
                                    <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                    <i class="fa fa-phone fa-stack-1x icon-color"></i>
                                </span>
                            </h4>

                            <div style="padding-bottom:1rem; padding-left:1rem; float:left;">
                                <h4>TELEFON</h4>
                                064-252526

                            </div>

                        </div>
                        <div style="clear:both; float:left; padding-bottom:1rem;">
                            <h4 style="float:left">
                                <span class="fa-stack fa-1x">
                                    <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                    <i class="fa fa-envelope fa-stack-1x icon-color"></i>
                                </span>
                            </h4>

                            <div style="padding-bottom:1rem; padding-left:1rem; float:left;">
                                <h4> E-MAIL
                                </h4>
                                termax_plus@doo.rs

                            </div>

                        </div>
                        <div style="clear:both; float:left; padding-bottom:1rem;">
                            <h4 style="float:left">
                                <span class="fa-stack fa-1x">
                                    <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                    <i class="fa fa-calendar fa-stack-1x icon-color"></i>
                                </span>
                            </h4>

                            <div style="padding-bottom:1rem; padding-left:1rem; float:left;">
                                <h4>RADNO VREME</h4>

                                Ponedeljak-Petak 8h-16h

                            </div>

                        </div>


                    </p>
                </div>
                <div id="map-container-google-1" class="z-depth-1-half map-container" style="padding-left: 15%; float: left; width: 70%;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.100731973499!2d20.614703541959134!3d43.70513681348427!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4757a9e29d572ce1%3A0x51eb0320725aafbc!2sTermax%20Plus%20d.o.o.!5e0!3m2!1sen!2srs!4v1577219999611!5m2!1sen!2sr" frameborder="0" style="border:0; width:100%; height:100%;" allowfullscreen></iframe>
                </div>

                <div style="clear:both;"></div>



            </div>



        </div>



    </div>



</div>
<div class="contactwrap2 mb-5 pt-1">
    <div class="container contact mb-5  upit">
        <div class="row">
            <div class="col-xl-6 col-lg-5 col-md-5 info remove-on-mobile">
                <h3 style="margin-top:20%;">Pošaljite nam upit: </h3>



            </div>
            <div class="col-xl-5 col-lg-5 col-md-5  form-wrap">







                <div class="form">
                    <h3 st>Kontaktirajte nas</h3>
                    <div class="inner">
                        <input name="ctl00$ctl01$358$tb_name" type="text" id="ctl00_ctl01_358_tb_name" placeholder="Ime">


                        <input name="ctl00$ctl01$358$tb_mail" type="text" id="ctl00_ctl01_358_tb_mail" placeholder="Email">

                        <input name="ctl00$ctl01$358$tb_phone" type="text" id="ctl00_ctl01_358_tb_phone" placeholder="Telefon">

                        <input name="ctl00$ctl01$358$tb_subject" type="text" id="ctl00_ctl01_358_tb_subject" placeholder="Tema">

                        <textarea name="ctl00$ctl01$358$tb_message" rows="4" cols="20" id="ctl00_ctl01_358_tb_message" placeholder="Poruka"></textarea>


                    </div>


                    <a id="ctl00_ctl01_358_btn_send" class="btn btn-white">Pošalji</a>






                </div>

            </div>
            <div class="col-xl-1 col-lg-2 col-md-2 social remove-on-mobile">
                <a class="soc-icon" href="">
                    <img src=""></a>

            </div>
        </div>
    </div>
</div>
<br>
<div class="clearfix"></div>

<script type="text/javascript">
    $("#navbarForToggle").show();


    $("#stranice li a").click(function(e) {
        e.preventDefault();
        var stranica = $(this).text();
        if ($(this).parent().hasClass("current")) {
            return;
        }
        // alert( $(this).parent().parent().find('.current').attr("class"));
        $(this).parent().parent().find('.current').removeClass('current');
        $(this).parent().addClass("current");

        $.ajax({
            url: "ucitaj_objave.php",
            type: "GET",
            data: {
                'stranica': stranica,
            },
            success: function(msg) {
                data = JSON.parse(msg);
                console.log(data);
                const myNode = document.getElementById("objaveIndex");
                myNode.innerHTML = '';

                ucitajObjave(data["objave"]);
                $('html, body').animate({
                    scrollTop: $("#objaveIndex").offset().top - 70
                }, 0);


            }



        });

    });



    function ucitajObjave(data) {
        data.forEach(element => {
            //  alert(element["tip"]);
            if (element["tip"] == "Slika") {
                var tekst = '<div class=" my-4 py-4" style="position:relative;">';
                <?php
                if ($adminLogovan) {
                ?>
                    tekst += '<div name="' + element["id"] + '" class="izbrisiObjavu" style="cursor:pointer; position:absolute; right:0;">' +
                        ' <img id="proba525" style="width:32px; margin-left:5px;" src="assets/deleteIcon.png"></div>';
                <?php
                } ?>
                tekst += ' <div id="prikazBord" class="py-4 my-4 " style="border-bottom:1px solid red; display:inline-block;">' +
                    '<h1 id="naslovPrikaz" class="pb-1" style="text-align:center;">' + element["naslov"] + '</h1>' +
                    '<h3 id="podnaslovPrikaz" class="pb-1" style="text-align:center;">' + element["podnaslov"] + '</h3>' +
                    '<p id="tekst1Prikaz">' + element["tekst"] + '</p>' +
                    ' <div class="col-md-4 float-md-left pr-4" style="padding-left: 0px; ">' +
                    '<img id="slikaObjave" src="assets/kamini_front2.png" class="img-fluid float-left"> </div> <br>' +
                    '<p id="tekst2Prikaz">' + element["tekst2"] + '</p><br></div></div>';

                $("#objaveIndex").append(tekst);




            } else if (element["tip"] == "Video") {
                var tekst = '<div class=" my-4 py-4" style="position:relative;">';

                <?php
                if ($adminLogovan) {
                ?>
                    tekst += '<div name="' + element["id"] + '" class="izbrisiObjavu" style="cursor:pointer; position:absolute; right:0;">' +
                        ' <img id="proba525" style="width:32px; margin-left:5px;" src="assets/deleteIcon.png"></div>';
                <?php
                } ?>
                tekst += '<div id="prikazBord" class="py-4 my-4 " style="border-bottom:1px solid red; display:block;"> <div class="py-3 mx-5">' +
                    '<video width="100%" controls>  <source src="" id="video_here"> Your browser does not support HTML5 video.' +
                    '  </video> </div>' +
                    '<h1 id="naslovPrikaz" class="pb-1" style="text-align:center;">' + element["naslov"] + '</h1>' +
                    '<h3 id="podnaslovPrikaz" class="pb-1" style="text-align:center;">' + element["podnaslov"] + '</h3>' +
                    '<p id="tekstPrikaz">' + element["tekst"] + '</p><br> </div> </div>';
                $("#objaveIndex").append(tekst);

            }
            $(".izbrisiObjavu").click(function(e) {
                // e.preventDefault();
                var idObjave = $(this).attr("name");
                // formData = new FormData();

                //alert(JSON.stringify(listaKategorija));
                //formData.append('id', idObjave);
                $.ajax({
                    url: "pages/obrisi_objavu.php",
                    type: "POST",
                    data: {
                        id_objave: idObjave

                    },
                    success: function(msg) {
                        data = JSON.parse(msg);
                        console.log(data);
                        if (data["delete_status"]) {
                            window.location.replace("http://localhost/termax/src/index.php");
                        } else {
                            alert(data["Error"]);
                        }
                    }



                });


            });

        });


    }


    <?php
    if ($adminLogovan) {
    ?>



        $(".izbrisiObjavu").click(function(e) {
            // e.preventDefault();
            var idObjave = $(this).attr("name");
            // formData = new FormData();

            //alert(JSON.stringify(listaKategorija));
            //formData.append('id', idObjave);
            $.ajax({
                url: "pages/obrisi_objavu.php",
                type: "POST",
                data: {
                    id_objave: idObjave

                },
                success: function(msg) {
                    data = JSON.parse(msg);
                    console.log(data);
                    if (data["delete_status"]) {
                        window.location.replace("http://localhost/termax/src/index.php");
                    } else {
                        alert(data["Error"]);
                    }
                }



            });


        });
    <?php } ?>
</script>


<?php
include "../templates/footer.php"
?>