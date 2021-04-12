<?php
$procena = false;
if (isset($_GET["kat-proizvoda"])) {
    $proizvod =  $_GET['kat-proizvoda'];
    $procena = true;
}


?>




<?php
include "../templates/header.php";
?>


<div class="container pt-5" style="min-height:1000px;">


    <div class="topbread">
        <ol class="breadcrumb">
            <li><a href="/"><span style="width:20px;" class="glyphicon glyphicon-home"></span></a></li>
            <?php if ($procena) {
            ?>
                <li><a href="/termax/src/proizvodi.php">Proizvodi</a></li>
                <li class="active"><?php echo ucfirst($proizvod) ?></li>

            <?php
            } else {
            ?>
                <li class="active">Proizvodi</li>

            <?php } ?>

        </ol>
    </div>
    <h2 class="mb-5" style=" width: 80%;text-align: center; border-bottom: 1px solid #b6b6b6;  margin-left: auto;  margin-right: auto;">KATALOG</h2>

    <div class="row" style="justify-content: center; ">



        <?php

        // print_r(array_keys($kategorije));

        $nesto = array_column(vratiKategorije(), 'podkategorije');

        // print_r($nesto);
        if ($procena) {


        ?>
            <form id="katalog_forma" action="katalog.php" method="get">
                <input type="hidden" id="kat-proizvoda" name="kat-proizvoda" value="">
            </form>



            <?php
            $prvi = false;
            foreach (vratiKategorije() as $neki) {
                if (trim(strtolower($neki['naziv'])) == trim(strtolower($proizvod))) {
                    if ($prvi) {
            ?>
                        <div name="<?php echo $neki["podkategorije"] ?>" class="sub-kat kat-proizvoda col-md-3 mr-5 mb-5 ">

                        <?php
                    } else {
                        $prvi = true;
                        ?>
                            <div name="<?php echo $neki["podkategorije"] ?>" class="sub-kat kat-proizvoda  col-md-3 mr-5 mb-5 ">
                            <?php } ?>
                            <div class=" mt-2 mr-2 " style="width: 30%; float:left;  ">


                                <img src="assets/radiator-img2.png" style="max-width:100%; border-right:1px solid black;">
                            </div>
                            <div style="display:grid;">
                                <h3 style="color: #dd3838;"> <?php echo ucfirst($neki['podkategorije'])  ?></h3>
                                <h6 style="color:gray;">Radiajtori na vodu, Radijatori na struju1111</h6>
                            </div>
                            </div>



                        <?php

                    }
                }
            } else {
                $prvi = false;
                foreach (array_unique(array_column(vratiKategorije(), 'naziv')) as $neki) {
                    if ($prvi) {
                        ?>
                            <div name="<?php echo $neki ?>" class="kategorije-linkovi kat-proizvoda col-md-3 mr-5 mb-5 ">

                            <?php
                        } else {
                            $prvi = true;
                            ?>
                                <div name="<?php echo $neki ?>" class="kategorije-linkovi kat-proizvoda  col-md-3 mr-5 mb-5 ">
                                <?php } ?>
                                <div class=" mt-2 mr-2 " style="width: 30%; float:left;  ">


                                    <img src="assets/radiator-img2.png" style="max-width:100%; border-right:1px solid black;">
                                </div>
                                <div style="display:grid;">
                                    <h3 style="color: #dd3838;"> <?php echo ucfirst($neki)  ?></h3>
                                    <h6 style="color:gray;">Radiajtori na vodu, Radijatori na struju</h6>
                                </div>
                                </div>

                        <?php
                    }
                }

                        ?>




                            </div>

                        </div>











                        <?php
                        include "../templates/footer.php"
                        ?>