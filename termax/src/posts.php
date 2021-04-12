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


/*
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}*/


?>









<div class="container">

    <div class="border my-4 py-4 unosObjave">
        <form class="form-horizontal">

            <h2 style="text-align:center;">DODAJ NOVU OBJAVU</h2>

            <div class="form-group" style="clear:both; ">
                <div class="col-md-4 col-sm-10">
                    <div class="dropdown tipObjave">
                        <button onclick="myFunction()" class="btn btn-default dropbtn">Tip objave</button>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="#">Slika</a>
                            <a href="#">Video</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4" >
                <h3>Tip objave:<strong id="tipOjaveStrong" class="mx-3">Video</strong> </h3>
                <h4></h4>
            </div>
            <div class="form-group" style="clear:both; ">
                <div class="col-md-4 col-sm-10">
                    <input class="form-control" id="naslovObjave" name="naslov" placeholder="Naslov">
                </div>
            </div>
            <div class="form-group" style="clear:both; ">
                <div class="col-md-4 col-sm-10">
                    <input class="form-control" id="podnaslovObjave" name="podnaslov" placeholder="Podnaslov">
                </div>
            </div>
            <div class="form-group" style="clear:both; ">
                <div class="col-md-4 col-sm-10">
                    <textarea class="form-control" id="tekstVideoZapisa" style="height:unset; line-height:1.5;" name="tekst" placeholder="Tekst"></textarea>
                </div>
            </div>
            <div class="form-group" style="clear:both; display: none;">
                <div class="col-md-4 col-sm-10">
                    <textarea class="form-control" id="tekstIznadSlikeObjave" style="height:unset; line-height:1.5;" name="tekst1" placeholder="Tekst iznad slike"></textarea>
                </div>
            </div>
            <div class="form-group" style="clear:both; display: none;">
                <div class="col-md-4 col-sm-10">
                    <textarea class="form-control" id="tekstPoredSlikeObjave" style="height:unset; line-height:1.5;" name="tekst2" placeholder="Tekst ispod slike"></textarea>
                </div>
            </div>

            <div class="form-group" style="clear:both; display: none; ">
                <div class="col-md-4 col-sm-10">

                    <div class="file-upload w-100" style=" margin-bottom:50px;">
                        <div class="file-select">
                            <div class="file-select-button" id="fileName">Izaberi sliku</div>
                            <div class="file-select-name" id="noFile">Unesi sliku...</div>
                            <input type="file" name="photo" id="ObjavaData" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group" style="clear:both; ">
                <div class="col-md-4 col-sm-10">

                    <div class="file-upload w-100" style=" margin-bottom:50px;">
                        <div class="file-select">
                            <div class="file-select-button" id="fileName1">Izaberi Video</div>
                            <div class="file-select-name" id="noFile1">Unesi video...</div>
                            <input type="file" name="photo" id="ObjavaDataVideo" accept="video/*" />
                        </div>
                    </div>
                </div>
            </div>



            <div class="form-group" style="clear:both; ">
                <div class="col-md-offset-3 col-sm-offset-2 col-sm-3">
                    <button type="submit" id="dodajObjavu" class="btn btn-default">Dodaj objavu</button>
                </div>
            </div>
        </form>
    </div>

    <div class=" my-4 py-4">
        <h1 class="mb-3 mx-3" style="text-align:center; border-bottom:3px solid #bd2130;">PRIKAZ OBJAVE</h1>
        <div id="prikazBord" class="py-4 my-4 " style="border-bottom:1px solid red; display:block;">
            <div class="py-3 mx-5">
                <video width="100%" controls>
                    <source src="" id="video_here">
                    Your browser does not support HTML5 video.
                </video>
            </div>

            <h1 id="naslovPrikaz" class="pb-1" style="text-align:center;">UNESITE POLJE NASLOV</h1>
            <h3 id="podnaslovPrikaz" class="pb-1" style="text-align:center;">UNESITE POLJE PODNASLOV</h3>
            <p id="tekst1Prikaz" style="display:none;">UNESITE POLJE TEKST IZNAD SLIKE</p>
            <div class="col-md-4 float-md-left pr-4" style="padding-left: 0px; display:none;">
                <img id="slikaObjave" src="assets/kamini_front2.png" class="img-fluid float-left">
            </div>
            <br>
            <p id="tekst2Prikaz" style="display:none;">UNESITE POLJE PORED SLIKE</p>

            <p id="tekstPrikaz">UNESITE POLJE TEKST </p>

            <br>

        </div>
    </div>


</div>

<script type="text/javascript">
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function readURL1(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {

                $('#slikaObjave').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

    $(".tipObjave").click(function(e) {
        e.preventDefault();


    });
    var tipObjave = "Video";
    $("#myDropdown a").click(function(e) {
        e.preventDefault();
        tipObjave = $(this).text();
        if (tipObjave == "Slika") {
            $("#tipOjaveStrong").text(tipObjave);
            $("#tekstVideoZapisa").parent().parent().css("display", "none");
            $("#ObjavaDataVideo").parent().parent().parent().parent().css("display", "none");
            $("#video_here").parent().parent().css("display", "none");
            $("#tekstPrikaz").css("display", "none");


            $("#tekstIznadSlikeObjave").parent().parent().css("display", "flex");
            $("#tekstPoredSlikeObjave").parent().parent().css("display", "flex");
            $("#ObjavaData").parent().parent().parent().parent().css("display", "flex");
            $("#tekst1Prikaz").css("display", "flex");
            $("#tekst2Prikaz").css("display", "flex");
            $("#prikazBord").css("display", "inline-block");

            $("#slikaObjave").parent().css("display", "flex");


        } else if (tipObjave == "Video") {
            $("#tipOjaveStrong").text(tipObjave);
            $("#tekstVideoZapisa").parent().parent().css("display", "flex");
            $("#ObjavaDataVideo").parent().parent().parent().parent().css("display", "flex");
            $("#video_here").parent().parent().css("display", "flex");
            $("#tekstPrikaz").css("display", "flex");

            $("#prikazBord").css("display", "block");


            $("#tekstIznadSlikeObjave").parent().parent().css("display", "none");
            $("#tekstPoredSlikeObjave").parent().parent().css("display", "none");
            $("#ObjavaData").parent().parent().parent().parent().css("display", "none");
            $("#tekst1Prikaz").css("display", "none");
            $("#tekst2Prikaz").css("display", "none");
            $("#slikaObjave").parent().css("display", "none");
        }

    });

    $(".unosObjave .form-group .form-control").change(function() {
        var polje = $(this).attr("name");
        var vrednost = $(this).val();
        if (polje == "naslov") {
            $("#naslovPrikaz").text(vrednost);
        } else if (polje == "podnaslov") {
            $("#podnaslovPrikaz").text(vrednost);
        } else if (polje == "tekst") {
            $("#tekstPrikaz").text(vrednost);
        } else if (polje == "tekst1") {
            $("#tekst1Prikaz").text(vrednost);
        } else if (polje == "tekst2") {
            $("#tekst2Prikaz").text(vrednost);
        }
    });


    $("#ObjavaData").change(function() {

        var filename = $("#ObjavaData").val();
        if (/^\s*$/.test(filename)) {
            $(".file-upload").removeClass('active');
            $("#noFile").text("No file chosen...");
        } else {
            $(".file-upload").addClass('active');
            $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
        }
        //  $('#slikaObjave').src = (window.URL ? URL : webkitURL).createObjectURL($(this).files[0]);
        readURL1(this);


    });
    $(document).on("change", "#ObjavaDataVideo", function(evt) {
        var filename = $("#ObjavaDataVideo").val();
        if (/^\s*$/.test(filename)) {
            $(".file-upload").removeClass('active');
            $("#noFile1").text("No file chosen...");
        } else {
            $(".file-upload").addClass('active');
            $("#noFile1").text(filename.replace("C:\\fakepath\\", ""));
        }
        var $source = $('#video_here');
        $source[0].src = URL.createObjectURL(this.files[0]);
        $source.parent()[0].load();
    });


    $("#dodajObjavu").click(function(e) {
        e.preventDefault();
        alert(tipObjave);
        formData = new FormData();
        if (tipObjave == "Slika") {
            var input = document.getElementById("ObjavaData");

            file = input.files[0];
            if (file != undefined) {
                if (!!file.type.match(/image.*/)) {
                    formData.append("image", file);
                }
            } else {
                alert("GRESKA PRILIKOM UPLOADA SLIKE");
                return;
            }



            formData.append('tekst1', $("#tekstIznadSlikeObjave").val());
            formData.append('tekst2', $("#tekstPoredSlikeObjave").val());
        } else {

            var input = document.getElementById("ObjavaDataVideo");

            file = input.files[0];
            if (file != undefined) {
                if (!!file.type.match(/video.*/)) {
                    formData.append("video", file);
                }
            } else {
                alert("GRESKA PRILIKOM UPLOADA VIDEO ZAPISA");
                return;
            }

            formData.append('tekst', $("#tekstVideoZapisa").val());
        }
        formData.append('tipObjave', tipObjave);
        formData.append('naslov',  $("#naslovObjave").val());
        formData.append('podnaslov',  $("#podnaslovObjave").val());
        $.ajax({
            url: "insert_objavu.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data1) {
                data2=JSON.parse(data1);
                //console.log(data2.save_status);
               // console.log(data2);
              
                if (data2['save_status']) {
                    window.location.replace("http://localhost/termax/src/index.php");
                   // window.location = 'http://localhost/termax/src/index.php';
                  //  location.replace("index.php")
                } else {
                    alert(data2["Error"]);
                }
            }



        });

    });
</script>


<?php
include "../templates/footer.php"
?>