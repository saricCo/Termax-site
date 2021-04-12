$('.carousel').carousel({
  interval: 1000 * 6

});



var cw = $('#map-container-google-1').width();
$('#map-container-google-1').css({ 'height': cw * 0.8 + 'px' });


$('.kontakt_klik1').click(function (e) {
  e.preventDefault();
  $('body, html').animate({ scrollTop: $("#kontakt").offset().top }, 700);
});

$(".dropdown-submenu").hover(function () {
  // $( this ).fadeOut( 100 );



  var heig = document.getElementById('proizvodi-meni').offsetHeight;
  $(this).find("ul").css("height", heig + "px");


  $(this).find('ul').css("display", "block");
}, function () {
  $(this).find('ul').css("display", "none");

});

$("#drodown-togler").hover(function () {
  $("#proizvodi-meni").stop().slideDown();
  // $("#proizvodi-meni").removeClass("d-none");
}, function () {
  // $("#proizvodi-meni").addClass("d-none");
  $("#proizvodi-meni").stop().slideUp();
});




$(".carousel").on('slide.bs.carousel', function (evt) {
  setTimeout(
    function () {

      var slideFrom = $(this).find('.active').index();
      var slideTo = $(evt.relatedTarget).index();

      $("#pic-info div h4").fadeOut("slow", function () {
        if (slideTo == 0)
          $(this).text("MARELI KOTLOVI VRHUNSKOG KVALITETA").fadeIn("slow");
        else if (slideTo == 1)
          $(this).text("KOTLOVI NA PELENT I DRVA").fadeIn("slow");
        else if (slideTo == 2)
          $(this).text("TERMAX PLUS SAMO ZA VAS").fadeIn("slow");


      });
      $("#pic-info div h6").fadeOut("slow", function () {
        if (slideTo == 0)
          $(this).text("Ovi kotlovi predstavljuju pruzaju odlicne usluge grejanje po pristupacnim cenama, pogledajte marili kotlove u nasem katalogu!").fadeIn("slow");
        else if (slideTo == 1)
          $(this).text("Sve veći broj naših kupaca se odlučuje baš za kotlove na pelet. Osim uštede na ovaj način grejanja im je omogućeno i da lakse i čistije obezbede grejanje svoje kuće").fadeIn("slow");
        else if (slideTo == 2)
          $(this).text("Možete nas naći na adresi Magistralni put 955, Kraljevo. Vršimo dostavu poručene robe u najkraćem vremenskom roku! Posetite nas i zagrejte vaš dom.").fadeIn("slow");
      });
      if (slideTo == 2) {
        $("#pic-info div div a").html("Kontakt");
        $("#pic-info div div a").attr("href", " #kontakt");

      }
      else {
        $("#pic-info div div a").html("Prikazi proizvod");
        $("#pic-info div div a").attr("href", "/");
      }


    }, 1700);

});

function isMobile() {
  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    // true for mobile device
    return true;
  } else {
    // false for not mobile device
    return false;
  }

}
function skrolajNavBar() {

}

$(".footerIcon").hover(function () {
  $(this).find("i").css("color", "#781b24");

  $(this).find(".fa").css("transform","scale(1.4)")
  $(this).find("#linija").css("display", "block");
  $(this).find("#linija").stop().animate({
    width: "85%",
  }, 1200);
}
  , function () {

    $(this).find(".fa").css("transform","scale(1)")
    $(this).find("#linija").stop().animate({
      width: "0",
    }, 300);
    $(this).find("i").css("color", "#b51d2f");

  }
);

var element_position = $('.navbar').offset().top;
var postavio = false;
$(window).on('scroll', function () {
  var y_scroll_pos = window.pageYOffset;
  var scroll_pos_test = element_position;
  //alert($(".navbar").offset().top);


  if (!postavio && y_scroll_pos > scroll_pos_test) {
    postavio = true;
    if (isMobile()) {

      $("#navbarForToggle").slideUp();
    }
    $("#logo-name").attr("src", "assets/naziv-logo1.png");

  }

  if (postavio && y_scroll_pos < scroll_pos_test) {

    postavio = false;
    $("#logo-name").attr("src", " ");
  }

});


var form = document.getElementById("form_proizvod");

$('.kategorije-linkovi').click(function (e) {
  e.preventDefault();
  // alert(1);
  if ($(this).is("a")) {
    $("#proizvod_id").val($(this).text());
    if ($(this).hasClass("submenu2")) {
      $('#form_proizvod').attr('action', 'katalog.php');
    }
    form.submit();
  }
  else {

    $("#proizvod_id").val($(this).attr('name'));
    form.submit();
  }
  // alert($(this).text());
});

var form1 = document.getElementById("katalog_forma");
$('.sub-kat').click(function (e) {
  e.preventDefault();

  $("#kat-proizvoda").val($(this).attr('name'));
  form1.submit();
});




var form2 = document.getElementById("proizvod-form");

$('.to-generic').click(function (e) {
  e.preventDefault();
  $("#proizvod").val($(this).attr('name'));
  form2.submit();

  // alert($(this).text());
});


//var sidebar=false;
$('.facet').click(function (e) {
  var otvoren = $(this).attr("name");
  if (otvoren == "true") {
    $(this).toggleClass('open');
    $(this).parent().parent().find(".list-group:first").stop().slideUp();
    $(this).attr("name", "false");
  }
  else {

    $(this).toggleClass('open');
    //alert($(this).parent().parent().find(".list-group:first").prop('nodeName'));
    $(this).parent().parent().find(".list-group:first").stop().slideDown();
    $(this).attr("name", "true");

  }
  /*
  if(!sidebar){
    $(this).next().stop().slideDown();
    sidebar=true;
    var otvoren=$(this).attr("name");
  }
  else{
    $(this).next().stop().slideUp();
    sidebar=false;
  }
 
 
*/

});

$("#dodajKat").click(function (e) {
  e.preventDefault();

  $("#dodajKategorijuDiv").css("display", "block");
  $("#dodajKatDiv").css("display", "none");
  $("#dodajKatVrednost").val("");
  $("#dodajKatNaziv").val("");
});

/*
$(".uslov-za-filter").click(function(e){
 // alert($(this).attr("name"));
  alert( proizvodi[0]);
 
});
*/


/*$("#formaKategorije").submit(function(e){
    
  e.preventDefault();
  $.post(
    'insert_kat.php',
    {
      naziv_karakteristike : $("#dodajKatNaziv").val(),
      kategorija_id: 2
    });
 
 
     $.ajax({
        url: 'insert_kat.php',
        type: 'POST',
        data: {
            naziv_karakteristike : $("#dodajKatNaziv").val(),
            kategorija_id: 2
        },
        success: function(msg) {
          
        }  
      });
         
 
});*/
var broj2 = 0;
var broj = 1;

function napuniListu() {

  $("#broj" + broj).empty();
  $("#broj" + broj).append('<option value="" selected disabled hidden>Izaberite ovde</option>');
  var i;


  for (var key in listaMogucihKategorija) {
    //console.log("key " + key + " has value " + myArray[key]);

    $("#broj" + broj).append('<option name=' + key + '>' + listaMogucihKategorija[key] + '</option>');


  }






  /*for(i=0;i<listaMogucihKategorija.length;i++){
 
     
      $("#broj"+broj).append('<option>'+listaMogucihKategorija[i]+'</option>');
  }*/

}
var listaKategorijaBezID = [];
function napuniListu1() {

  $("#broj" + broj2).empty();
  $("#broj" + broj2).append('<option value="" selected disabled hidden>Izaberite ovde</option>');
  var i;
  var naziv = $("#dodajKatNaziv").val();
  var vrednost = $("#dodajKatVrednost").val();






  /*for (var key in listaMogucihKategorija) {
  //console.log("key " + key + " has value " + myArray[key]);
  
  
     if(naziv==listaMogucihKategorija[key]){
            $("#broj"+broj2).append('<option selected>'+listaMogucihKategorija[key]+'</option>');
         }
         else{
            $("#broj"+broj2).append('<option>'+listaMogucihKategorija[key]+'</option>');
         }
      }*/


  for (i = 0; i < listaKategorijaBezID.length; i++) {

    if (naziv == listaKategorijaBezID[i]) {
      $("#broj" + broj2).append('<option selected>' + listaKategorijaBezID[i] + '</option>');
    }
    else {
      $("#broj" + broj2).append('<option>' + listaKategorijaBezID[i] + '</option>');
    }

  }
  for (var key in listaMogucihKategorija) {
    //console.log("key " + key + " has value " + myArray[key]);

    $("#broj" + broj2).append('<option>' + listaMogucihKategorija[key] + '</option>');


  }

  $("#broj" + broj2).parent().parent().children().eq(1).find("input").val(vrednost);

}



$("#dodajKategoriju").click(function (e) {
  e.preventDefault();/*
    var submitInput = $("<input type='submit' />");
    $("#formaKategorije").append(submitInput);
    submitInput.trigger("click");*/
  //document.getElementById("formaKategorije").submit();

  // $("#").submit();
  //alert($("#dodajKatNaziv").val());

  /*$.post(
    'insert_kat.php',
    {
 
 
    }
 
 
 
    );
 
 
              
  });*/

  if ($("#dodajKatNaziv").val() != "" && $("#dodajKatVrednost").val() != "") {
    var vredZaFilter = 0;
    if ($("#dodajKatCheckBox").is(":checked")) {
      vredZaFilter = 1;
    }
    //alert(vredZaFilter);

    $.ajax({
      url: 'insert_kat.php',
      type: 'POST',
      data: {
        'naziv_karakteristike': $("#dodajKatNaziv").val(),
        'kategorija_id': selectedVrsta2,
        'zaFilter': vredZaFilter
      },
      success: function (msg) {
        broj2 = broj2 - 1;
        $("#meniKarakteristika").prepend(' <div class="form-group">   <div class="col-md-6 col-sm-6"><select id="broj' + broj2 + '" class="kateg form-control"> <option value="" selected disabled hidden>Izaberite ovde</option> </select></div><div class="col-md-6 col-sm-6"><input type="text" class="form-control" id="exampleInputLastName2" placeholder="Eg.Thomas"></div></div>');
        listaKategorijaBezID.push($("#dodajKatNaziv").val());
        napuniListu1();
      }
    });



    $("#dodajKatDiv").css("display", "flex");
    $("#dodajKategorijuDiv").css("display", "none");



  }
  else {
    alert("Greska, polja za unos moraju biti popunjena");
  }
});


$(document).on('change', "select.kateg", function () {
  var vred = $(this).attr("id");
  var vred2 = "broj" + broj;
  //$(this).parent().prepend('<input style="position:absolute; left:0;" type="checkbox" id="filter_' + vred2 + '" name="vehicle3" value="Boat">');
  if (vred == vred2) {
    broj = broj + 1;
    $(this).parent().parent().after(' <div class="form-group"> <div class="col-md-6 col-sm-6"><select id="broj' + broj + '" class="kateg form-control"> <option value="" selected disabled hidden>Izaberite ovde</option> <option>Velicina</option> <option>English(Uk)</option></select></div><div class="col-md-6 col-sm-6"><input type="text" class="form-control" id="exampleInputLastName2" placeholder="Npr . 50W"></div></div>');
    napuniListu();

  }
});

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

$(document).on('change', "#vrsta1", function () {
  $("#meniKarakteristika").slideUp("slow");
  $('#vrsta2').children(".dodati").remove();
  $('#vrsta2').append('<option value="" selected disabled hidden>Izaberite ovde</option>');

  var i;
  var naziv = $(this).children("option:selected").val();

  for (i = 0; i < kategorije.length; i++) {
    if (naziv.toLowerCase() == kategorije[i]["naziv"]) {
      $("#vrsta2").append('<option class="dodati">' + capitalizeFirstLetter(kategorije[i]["podkategorije"]) + '</option>');
    }

    // alert(kategorije[i]["pod-kategorije"]);
    // $( this ).append('');
  }



});
var listaMogucihKategorija = {};
var selectedVrsta2 = 0;
$(document).on('change', "#vrsta2", function () {

  var prvi = true;
  for (i = broj; i >= broj2; i--) {
    if (prvi) {
      $("#broj" + i).attr("id", "broj1");
      prvi = false;
    }
    else
      $("#broj" + i).parent().parent().remove();

  }
  broj = 1;
  broj2 = 0;
  listaKategorijaBezID = [];
  listaMogucihKategorija = [];
  //$('#meniKarakteristika').find('.form-group:not(:last)').remove();
  var naziv = $(this).children("option:selected").val();
  var i;
  for (i = 0; i < kategorije.length; i++) {
    if (naziv.toLowerCase() == kategorije[i]["podkategorije"]) {
      selectedVrsta2 = kategorije[i]['id'];
      break;
    }



  }

  for (i = 0; i < karakteristike.length; i++) {

    if (selectedVrsta2 == karakteristike[i]["kategorija_id"]) {

      listaMogucihKategorija[karakteristike[i]["id"]] = karakteristike[i]["naziv_karakteristike"];
    }

  }



  $("#meniKarakteristika").slideDown("slow");

  $("#deoKarakteristike").css("pointer-events", "auto");
  napuniListu();
});



/*
$(".kateg111").change(function(){
 
  var vred = $(this).attr("id");
  var vred2="broj"+broj;
   alert( vred +" "+ vred2);
  if(vred==vred2)
  {
     broj=broj+1;
    $( this ).parent().parent().after( ' <div class="form-group"> <div class="col-md-6 col-sm-6"><select id="broj'+broj+'" class="kateg form-control"> <option>Velicina</option> <option>English(Uk)</option></select></div><div class="col-md-6 col-sm-6"><input type="text" class="form-control" id="exampleInputLastName2" placeholder="Eg.Thomas"></div></div>' );
   
 
 
  }
//alert(broj);
  
 
 
});*/

function uploadFile() {
  var input = document.getElementById("file");
  file = input.files[0];
  if (file != undefined) {
    formData = new FormData();
    if (!!file.type.match(/image.*/)) {
      formData.append("image", file);
      $.ajax({
        url: "upload.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
          alert('success');
        }
      });
    } else {
      alert('Not a valid image!');
    }
  } else {
    alert('Input something!');
  }
}
//listaKategorijaBezID

$("#dodajProizvod").click(function (e) {
  e.preventDefault();
  var nazivProizvoda = $("#nazivProizvoda").val();
  var nazivProizvodjaca = $("#nazivProizvodjaca").val();
  var poljeOpis = $("#poljeOpis").val();
  var kategorija = $("#vrsta1").children("option:selected").val();
  var podKategorija = $("#vrsta2").children("option:selected").val();
  var cena = $("#cenaProizvoda").val();

  if (cena === "" || nazivProizvoda === "" || nazivProizvodjaca === "" || poljeOpis === "" || kategorija === "" || podKategorija === "") {
    alert("Sva polja iznas dela za karakteristike moraju biti uneta!");
    return;
  }



  var listaKategorija = [];
  for (i = broj - 1; i >= broj2; i--) {
    if (i == 0)
      continue;
    var neki = $("#broj" + i).children("option:selected").attr("name");
    if (!neki) {
      neki = $("#broj" + i).children("option:selected").val();


    }

    var vred = $("#broj" + i).parent().parent().children().eq(1).find("input").val();
    /*if(vred.includes("/")){
      var nesto=vred.split("/");
      //alert(nesto[0]);
      for(j=0;j<nesto.length;j++){
        listaKategorija.push({
          'id': neki,
          'vrednost': nesto[j]
        });
      }
      continue;
    }*/


    if ($("#filter_broj" + i).is(":checked")) {
      var vredZaFilter = 1;
    }
    else {
      var vredZaFilter = 0;
    }
    listaKategorija.push({
      'id': neki,
      'vrednost': vred,
      'zaFilter': vredZaFilter
    });
  }

  var input = document.getElementById("slikaProizvodaID");
  file = input.files[0];
  formData = new FormData();
  if (file != undefined) {
    if (!!file.type.match(/image.*/)) {
      formData.append("image", file);
    }
  }

  else {
    alert("GRESKA");
    return;
  }
  //alert(JSON.stringify(listaKategorija));
  formData.append('nazivProizvoda', nazivProizvoda);
  formData.append('nazivProizvodjaca', nazivProizvodjaca);
  formData.append('poljeOpis', poljeOpis);
  formData.append('cena', cena);
  formData.append('podKategorija', selectedVrsta2);
  formData.append('listaKarakteristika', JSON.stringify(listaKategorija));

  $.ajax({
    url: "insert_proizvod.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (msg) {
      alert(123);
    }



  });




});


var form3 = document.getElementById("proizvod-form");

$('.linkoviZaDruge').click(function (e) {
  e.preventDefault();
  var id_proizvoda = $(this).attr("name");
  $("#proizvod").val(id_proizvoda);
  form3.submit();

  // alert($(this).text());
});









function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#slikaProizvodaID").change(function () {
  var filename = $("#slikaProizvodaID").val();
  if (/^\s*$/.test(filename)) {
    $(".file-upload").removeClass('active');
    $("#noFile").text("No file chosen...");
  }
  else {
    $(".file-upload").addClass('active');
    $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
  }

  readURL(this);
});


var tac = false;
$("#dodajNovuKategoriju").click(function () {

  if (!tac) {
    $("#dodajKategMeni").hide();
    $("#poljeNovaKateg").show();
    tac = true;
  }
  else {

    $("#poljeNovaKateg").hide();
    $("#dodajKategMeni").show();
    tac = false;
  }







});









$("#ctl00_ctl01_358_btn_send").click(function (e) {
  e.preventDefault();
  var form2 = document.getElementById("proizvod-form");
  $("#proizvod").val($(this).attr('name'));
  form2.submit();
});


$(".preporuceniProizvod").click(function (e) {
  e.preventDefault();
  var form2 = document.getElementById("proizvod-form");
  $("#proizvod").val($(this).attr('name'));
  form2.submit();
});

$("#dodajKat1").click(function (e) {
  e.preventDefault();

  var kategorija;
  if (!tac) {
    kategorija = $("#dodajKategSelect").children("option:selected").val();

  }
  else {
    kategorija = $("#poljeNovaKateg input").val();
  }
  var vrednost = $("#nazivPodKategorije").val();



  $.ajax({
    url: "insert_vrsta.php",
    type: "POST",
    data: {
      'kategorija': kategorija.toLowerCase(),
      'vrednost': vrednost
    },
    success: function (msg) {
      alert("Uspesan unos proizvoda!");
    }



  });



});

$(".navbar-toggler1").click(function (e) {
  e.preventDefault();
  $("#navbarForToggle").slideToggle();


});


document.addEventListener('scroll', function (e) {
  // $("#navbarForToggle").attr("")
  if ($('#navbarForToggle').is(':visible')) {
    // $("#navbarForToggle").slideUp();
  }
});

/*document.getElementsByClassName("kategorije-linkovi").addEventListener("click", function () {
  alert(2);
 var vrednost= $(this ).text();
 alert(vrednost);
  $("#proizvod_id").val(vrednost);
  form.submit();
});*/