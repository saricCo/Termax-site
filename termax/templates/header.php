<?php
include "pages/functions.php";
$kateg = array_unique(array_column(vratiKategorije(), 'naziv'));

?>


<?php
$adminLogovan = false;
if (isset($_SESSION['user'])) {
    $adminLogovan = true;
} ?>





<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>AWESOME-GAME ///</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css?<?php echo time(); ?>">

</head>
<script src="./js/jquery.min.js"></script>
<script src="./js/popper.min.js"></script>
<script src="./js/bootstrap.min.js"></script>

<body>

    <?php if ($adminLogovan) {
    ?>
        <div id="adminPanel" style="position:fixed; left:0; top:20%;">
            <!--    <ul id="admin-menu" style="overflow: hidden;">
                <li>-Admin panel</li>
                <li>-Dodaj proizvode</li>
                <li>-Dodaj objave</li>
                <li>-Logout</li>
            </ul>-->
            <div id="admin-menu" style="float:left; overflow: hidden;">
                <div>
                    <a href="admin_panel.php">-Admin panel</a>


                </div>
                <div>

                    <a href="admin.php">-Dodaj proizvode </a>

                </div>
                <div>

                    <a href="posts.php">-Dodaj objave </a>

                </div>
                <div>


                    <a href="admin.php?logout='1'" style="color: red;">-Logout</a>


                </div>
            </div>

            <div id="adminBar" class="my-auto" style="float:right;">
                <img class="flip" src="assets/strelicaNaDesno.png">
            </div>

        </div>
    <?php
    } ?>

    <div id="nav-top">
        <img class=" offset-md-1" id="logo" src="assets/logo.png">

        <address class="remove-on-mobile ml-auto my-auto" style="margin-right: 2rem; font-size: 18px !important;">
            <a href="tel:+35970017343" class="ops04" style="text-decoration: none; color:black">
                <i class="fa fa-phone"></i>
                <strong id="et-info-phone">064-152500</strong>
            </a>
            <br>
            <a href="mailto:sales@burnit.bg" class="ops04" style="text-decoration: none; color:black">
                <i class="fa fa-envelope"></i>
                <strong id="et-info-email" style="font-weight: 400;">termax_plus@org.rs</strong>
            </a>
        </address>

    </div>
    <nav class="navbar navbar-expand-lg sticky-top navbar-light shadow-sm" style="scroll-behavior:unset;">

        <img id="logo-name" class="offset-md-1" style="width: 200px;">
        <!-- <a class="navbar-brand" href="#">Navbar</a>-->
        <button  class="navbar-toggler1" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class=" navbar-collapse offset-md-1 prikaziZaTelefone" id="navbarForToggle" style="display:none;" >
            <ul class="navbar-nav ">
                <li class="nav-item ">
                    <?php
                    if ($_SERVER['PHP_SELF'] ==  '/termax/src/index.php') {

                    ?>
                        <a class="nav-link" href="#">Početna <span class="sr-only">(current)</span></a>
                    <?php
                    } else {

                    ?>
                        <a class="nav-link" href="http://localhost/termax/src/index.php">Početna <span class="sr-only">(current)</span></a>
                    <?php
                    }


                    ?>
                </li>

                <li id="drodown-togler" class="nav-item dropdown">
                    <a class="nav-link dropdownProizvodi align-middle" href="proizvodi.php" role="button">
                        Proizvodi
                    </a>

                    <form id="form_proizvod" action="proizvodi.php" method="get">
                        <input type="hidden" id="proizvod_id" name="kat-proizvoda" value="">
                    </form>


                    <div style="position: absolute;">
                        <ul id="proizvodi-meni" class="dropdown-menu" style="position: relative;">
                            <?php
                            foreach ($kateg as $kategorija) {
                            ?>
                                <li class="dropdown-submenu">
                                    <a class="kategorije-linkovi dropdown-item" href="#" style=" text-decoration: none;" role="button"> <?php echo ucfirst($kategorija)  ?></a>
                                    <ul class="dropdown-menu submenu " style=" top:-1px; left:100%; ">
                                        <?php
                                        $arrayOfKateg = array();
                                        foreach (vratiKategorije() as $ktlg) {
                                            if ($ktlg['naziv'] == $kategorija) {
                                                if (!in_array($ktlg['podkategorije'], $arrayOfKateg)) {
                                                    $arrayOfKateg[] = $ktlg['podkategorije'];

                                        ?>
                                                    <li><a class="kategorije-linkovi submenu2 dropdown-item" href="#"><?php echo ucfirst($ktlg['podkategorije'])  ?></a></li>
                                        <?php
                                                }
                                            }
                                        }

                                        ?>
                                    </ul>
                                </li>

                            <?php

                            }
                            ?>

                            <li class="dropdown-submenu">
                                <a class="dropdown-item" href="#">CSS</a>
                                <ul class="dropdown-menu submenu " style="top:-1px; left:100%; ">
                                    <li><a class="dropdown-item" href="#">2nd level dropdown</a></li>
                                    <li><a class="dropdown-item" href="#">2nd level dropdown</a></li>

                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" href="#">New dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu submenu" style="top:-1px; left:100%; ">
                                    <li><a class="dropdown-item" href="#">2nd level dropdown</a></li>
                                    <li><a class="dropdown-item" href="#">2nd level dropdown</a></li>

                                </ul>
                            </li>
                        </ul>



                    </div>


                </li>
                <li class="nav-item">
                    <a class="nav-link" href="o_nama.php">O nama</a>
                </li>
                <li class="nav-item">
                    <?php
                    if ($_SERVER['PHP_SELF'] ==  '/termax/src/index.php') {

                    ?>
                        <a class="nav-link" href="/termax/src/index.php#kontakt">Kontakt</a>
                    <?php
                    } else {

                    ?>
                        <a class="nav-link" href="/termax/src/index.php#kontakt">Kontakt</a>

                    <?php
                    }


                    ?>


                </li>

            </ul>
            <form class="remove-on-mobile form-inline my-2 my-lg-0 offset-md-2">
                <input class="form-control1 mr-sm-2" type="search" placeholder="" aria-label="Search">
                <button class="btn btnSearch my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

    </nav>
    <?php
    if ($adminLogovan) {
    ?>
        <script type="text/javascript">
            var prikazanAdminBar = true;
            var duzina = $("#admin-menu").outerWidth();
            $("#adminBar").click(function(e) {
                $("#adminBar img").toggleClass('flip');
                //alert(duzina);
                if (prikazanAdminBar) {
                    prikazanAdminBar = false;
                    $('#admin-menu').animate({
                        'marginLeft': "-=" + duzina + "px"
                    }, 500, function() {
                        $("#admin-menu").slideUp();
                    });

                    //$("#admin-menu").toggle("slide", { direction: "left" }, 1000);
                    // $('#admin-menu').animate({width:'hide'},1000);
                } else {
                    $("#admin-menu").slideDown();
                    $('#admin-menu').animate({
                        'marginLeft': "+=" + duzina + "px"
                    });
                    prikazanAdminBar = true;
                    //$('#admin-menu').animate({ width: 'show' }, 1000);
                }
            });
        </script>
    <?php
    }
    ?>



    <!--<div style="padding-top:40px;">
            <img class="img-fluid" src="assets/slika1.jpg">
        </div>-->