




<?php


session_start();

if (isset($_SESSION['user'])) {
      
    }
else{
    $_SESSION['msg'] = "You must log in first";
    header('location: pages/login.php');
}


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: pages/login.php");
}

include "../templates/header.php";


/*
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}*/


?>








<div style="padding-top:50px;">
    <div class="form-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <h2 style="text-align: center; padding-bottom: 20px;">Dodaj proizvod:</h2>

                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 col-sm-2 control-label" for="nazivProizvoda">Naziv proizvoda</label>
                            <div class="col-md-9 col-sm-10">
                                <input type="text" class="form-control" id="nazivProizvoda" placeholder="Npr.Mareli 156G">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-2 control-label" for="nazivProizvodjaca">Naziv proizvođača</label>
                            <div class="col-md-9 col-sm-10">
                                <input type="text" class="form-control" id="nazivProizvodjaca" placeholder="Npr.Mareli">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-2 control-label" for="cenaProizvoda">Cena</label>
                            <div class="col-md-9 col-sm-10">
                                <input type="text" class="form-control" id="cenaProizvoda" placeholder="Npr.10000">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-2 control-label" for="poljeOpis">Opis</label>
                            <div class="col-md-9 col-sm-10">
                                <textarea type="text" rows="4" cols="20" style="height:unset; line-height:1.5;" class="form-control" id="poljeOpis" placeholder="Opis proizvoda"></textarea>
                            </div>
                        </div>
                        <div class="clearfix"></div>
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
                        <div id="deoKarakteristike" style="pointer-events: none; border-bottom: 1px solid black; "> 
                            <h3 style="padding-top:5px; border-top:1px solid black; text-align: center;">Karakteristike</h3> <br>
                            <div id="meniKarakteristika" style="display:none;">
                                 <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <select id="broj1" class="kateg form-control">
                                            <option value="" selected disabled hidden>Izaberi</option>
                                            <option >Velicina</option>
                                            <option>English(Uk)</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" class="form-control" id="exampleInputLastName2" placeholder="Npr. 200kg">
                                    </div>
                                </div>



                                <div id="dodajKatDiv" class="form-group" style="border-bottom:1px solid black; padding-bottom: 15px;">
                                    <div class="col-md-offset-5 col-sm-offset-2 col-sm-7">
                                        <button type="submit" id="dodajKat" class="btn btn-default">Dodaj novu kategoriju</button>

                                    </div>
                                    <br>


                                </div>
                                <div id="dodajKategorijuDiv" style="display:none;">

                                    <div class="form-group" style="clear:both;">
                                        <input style="position:absolute; left:0;" type="checkbox" id="dodajKatCheckBox" >
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="dodajKatNaziv" class="form-control " stlye="float:left;"  placeholder="Naziv Karakteristike">
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="dodajKatVrednost" class="form-control"  placeholder="Vrednost">
                                        </div>
                                        <br>

                                    </div>

                                    <div class="form-group " style="border-bottom:1px solid black; padding-bottom: 15px; clear:both;">
                                        <div class="col-md-offset-5 col-sm-offset-2 col-sm-7">
                                            <button type="submit" form="formaKategorije" id="dodajKategoriju" class="btn btn-default">Dodaj kategoriju</button>

                                        </div>

                                    </div>
                                </div>
                    <!-- <div class="form-group">
                        <div class="col-md-10 col-sm-10">
                            <input type="text" class="form-control" id="exampleInputLastName2" placeholder="Eg.Thomas">
                        </div>
                    </div> -->
                    <div class="clearfix"></div>



                    <!--
                    <div class="form-group">
                        <label class="col-md-3 col-sm-2 control-label">Gender</label>
                        <div class="col-md-9 col-sm-10">
                            <input class="check" type="radio" id="check1" name="radio">
                            <label for="check1">Male</label>
                            <input class="check" type="radio" id="check2" name="radio">
                            <label for="check2">Female</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-2 control-label" for="exampleInputName2">Date of Birth</label>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="DD">
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="MM">
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="YYYY">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-2 control-label">Languages</label>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-control">
                                <option>English(US)</option>
                                <option>English(Uk)</option>
                            </select>
                        </div>
                    </div>
                --> </div>
                </div>
                 <div class="file-upload" style="float:left; margin-bottom:50px;">
                        <div class="file-select">
                            <div class="file-select-button" id="fileName">Izaberi sliku</div>
                              <div class="file-select-name" id="noFile">Unesi sliku...</div> 
                            <input  type="file"  name="photo" id="slikaProizvodaID"  /> 

                        </div>
                </div>

               <!--  <div class="form-group">
                    <label class="col-md-3 col-sm-2 control-label" for="slikaProizvodaID">Slika</label>
                    <div class="col-md-9 col-sm-10">
                        <input type="file" class="form-control" id="slikaProizvodaID" placeholder="Eg.Thomas">
                    </div>
                </div>
-->

                <div class="form-group" style="clear:both; ">
                    <div class="col-md-offset-3 col-sm-offset-2 col-sm-3">
                        <button type="submit" id="dodajProizvod" class="btn btn-default">Dodaj proizvod</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-offset-3 col-md-6" style="border-left:1px solid black;">
            <h2 style="text-align: center; padding-bottom: 20px;">Dodaj kategoriju:</h2>

                    <form class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3 col-sm-2 control-label">Kategorija</label>
                <div id="dodajKategMeni" class="col-md-9 col-sm-10">
                   
                    <select id="dodajKategSelect" class="form-control ">
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
              
                <div id="poljeNovaKateg" style="display:none;" class="col-md-9 col-sm-10">
                    <input type="text" class="form-control"  placeholder="Npr. 200kg">
                </div>

               
                <h5 id="dodajNovuKategoriju">
                    <span class="fa-stack fa-1x">
                         <i class="fa fa-circle fa-stack-2x " style="color:#545b62;"></i>
                         <i class="fa fa-plus fa-stack-1x icon-color"></i>
                    </span>
                </h5>
               
               
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-2 control-label" for="nazivPodKategorije">Sub kategorija</label>
                <div class="col-md-9 col-sm-10">
                    <input type="text" class="form-control" id="nazivPodKategorije" placeholder="Npr. Kotao na gas">
                </div>
            </div>
            <div class="form-group" style="clear:both; justify-content: center;">
                <div class="col-md-offset-3 col-sm-offset-2 col-sm-3">
                    <button type="submit" id="dodajKat1" class="btn btn-default">Dodaj kategoriju</button>
                </div>
            </div>

                </form>
        </div>


    </div>
</div>
</div>

</div>

<script type="text/javascript">
     var kategorije = <?php echo json_encode(vratiKategorije(), JSON_PRETTY_PRINT) ?>; 
     var karakteristike= <?php echo json_encode(vratiKrakteristike(), JSON_PRETTY_PRINT) ?>;   
    // alert(kategorije[4]['id']);

</script>



<?php
include "../templates/footer.php"
?>