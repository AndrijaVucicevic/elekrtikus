<link rel="stylesheet" href="{{asset('css/form_new.css')}}" />
<ul class="clip_list nav nav-pills">
    <li class="active"><a href="#section_firstStep" data-toggle="pill">Kategorija</a></li>
    <li class="wrap"><a href="#section_secondStep" data-toggle="pill">Oglas</a></li>
    <li><a href="#section_thirdStep" data-toggle="pill">Promo</a></li>
    <li><a href="#section_fourthStep" data-toggle="pill">Korisnik</a></li>


</ul>

<form accept-charset="UTF-8" id="formInsert_update" name="formInsert_update"  role="form" action="" method="" enctype="multipart/form-data">
@csrf
    <div class="tab-content">
<div id="section_firstStep" class="active section_new tab-pane">

    <span style="margin-bottom: 20px;">
   <b>Izaberite stanje Vašeg proizvoda:</b>
 </span>
    <br>
    <select id="conditionStatus">
        <option value="1">Novo</option>
        <option value="2">Kao novo</option>
        <option value="3">Polovno</option>
    </select>
<br>
<br>

    <span style="margin-bottom: 20px;">
     Nakon odabira kategorije, ispod odaberite potkategoriju, a nakon toga tacnu kategoriju Vašeg oglasa.
    <br> Na primer: <b>Telefon</b><i class='fas fa-arrow-circle-right'></i> <b>Iphone</b> <i class='fas fa-arrow-circle-right'></i> <b>Iphone X</b>
 </span>
<br>

<select id="category_ddl" name="category_ddl">

@if(isset($category))
<option value="0">Kategorija:</option>
    @foreach($category as $cat)

        <option value="c_{{$cat->name_category}}_{{$cat->id_category}}">{{$cat->name_category}} </option>

        @endforeach
    @endif
</select>


    <select id="subcategory_ddl" name="subcategory_ddl">

<option value="0">Izaberite kategoriju levo...
</option>



    </select>


    <select id="ppk_ddl" name="ppk_ddl">

        <option value="0">Izaberite kategoriju levo...
        </option>



    </select>

    <div id="displayBlockError" class="error">
        <ul id="displayErrors">

        </ul>
    </div>






</div>
    <div id="section_secondStep" class="fade section_new tab-pane">


        <label for="text_name">Naziv:</label>
<input required type="text" id="text_name" style=" width:65%;"/>

        <br> <label for="price_new">Cena:</label>&nbsp&nbsp<input required type="text" id="price_new" name="price_new"/>
        <input type="radio" name="ch_currency" class="chCurrency" value="1" id="chCurrency1" /> <label for="chCurrency1"> RSD</label>
             <input type="radio" name="ch_currency" class="chCurrency" value="2" id="chCurrency2" /> <label for="chCurrency2"  style="border-right: 1px solid;">&euro; &nbsp;</label>

       <input type="radio" id="ch_Fixed1" name="ch_Fixed1" class="chFixed" value="1"/><label for="ch_Fixed1">Fiksno</label>
        <input type="checkbox" name="ch_Fixed" class="chFixed ch_Fixed" value="2" id="ch_Fixed2"/> <label for="ch_Fixed2">Dogovor</label>
       <input type="checkbox" name="ch_Fixed" class="chFixed ch_Fixed" value="3" id="ch_Fixed3"/> <label for="ch_Fixed3">Zamena</label>

        <br><textarea id="description_new" name="description_new" placeholder="Unesite opis" cols="24" rows="5"></textarea>

        <div id="picture_insert_block" class="picture">
            <p style="font-weight: bold">Mozete maksimalno uneti 10 slika, ili minimalno samo jednu, podrzavani formati su jpg/jpeg/png</p>
            <ul id="listPicture" class="listPicture">


                <script>
                    var a='';
                    for(var i=0; i<10;i++){
                        a+='<li><label class="pictureLabel">Unesi sliku<input type="file" id="file'+i+'" class="slikaBlock" name="file'+i+'"/></label>' +

                            '<img src="#" id="imgshow'+i+'" class="imgShowModal" align="left" style="width:140px!important; height:130px!important;" alt="" title=""/></li>';

                    }
                    $("#listPicture").html(a);
                </script>


            </ul></div>

</div>
    <div id="section_thirdStep" class="fade section_new tab-pane">
        <ul id="modalPromocija">
            <li id="podrazumevano">
                <input type="radio" name="chPromocija" value="0" id="chStandard" checked/>
                <h3>Standardna vidljivost</h3>
                <p>Smanjuje broj poseta, Vas oglas ce biti prikazivan prilikom vrsenja pretraga medju svim ostalim oglasima.<h4 class="cenaPromocija" style="float: right;">00,00 RSD</h4></p>
            </li>
            <li id="click_sponsored">
                <input type="radio" name="chPromocija" value="0" id="chSponsored" />
                <h3>Sponzorisanost</h3>
                <p>Povećava broj poseta, lakši put do korisnika. Odabirom ove opcije možete da izaberete sponzorisanost Vašeg oglasa koja Vam najviše odgovara.</p>
            </li>
            <li class="promotion_new promotion_none" id="">
                <input type="checkbox" name="chPromocija1" class="chPromCh" value="1" id="chProm1" />
                <h3>Vidljivost jedan</h3>
                <p>Povecava broj poseta, Vas oglas ce biti prikazivan medju preporucenim oglasima za kategoriju kojoj pripada Vas oglas <h4 class="cenaPromocija" style="float: right;">1450,00 RSD</h4></p>
            </li>
            <li class="promotion_new promotion_none" id="">
                <input type="checkbox" name="chProm2" class="chPromCh" value="2" id="chProm2" />
                <h3>Vidljivost dva</h3>
                <p>Mogucnost da se Vas oglas nadje na pocetnoj strani, sigurna vidljivost, povecava broj poseta, broj mesta 9. Promocija se placa na nedeljnom nivou.<h4 class="cenaPromocija" style="float: right;">4450,00 RSD</h4></p>
            </li>
            <li id="user_shop" class="promotion_new promotion_none">

                <h3>Vidljivost tri</h3>
                <p>Za vecu vidljivost, mozete napraviti svoj izlog. Tu ce se prikazivati svi Vasi oglasi uz razne druge mogucnosti sortiranje i pretrage..Izlog mozete napraviti putem svog korisnickog profila.Cena je na mesecnom nivou<h4 class="cenaPromocija" style="float: right;">3450,00 RSD</h4></p>


            </li>
        </ul>





    </div>
    <div id="section_fourthStep" class="fade section_new tab-pane">



          <div class="cheat">
              Svi podaci su zasticeni
              </div>

          <div>
              <input required type="text" name="user_name" id="user_name"/>
              <label for="user_name">Ime:</label>
          </div>

       <div>
           <input required type="text" name="user_lastName" id="user_lastName"/>
           <label for="user_lastName">Prezime:</label>
       </div>

        <div>
            <input required type="text" name="user_phone" id="user_phone"/>
            <label for="user_phone">Telefon:</label>
        </div>
         <div>
             <input required type="text" name="user_place" id="user_place"/>
             <label for="user_place">Mesto:</label>
         </div>
        <div>
            <input required type="text" name="user_street" id="user_street"/>
            <label for="user_street">Ulica, broj:</label>
        </div>
        <div>
            <input required type="text" name="user_jmbg" id="user_jmbg"/>
            <label for="user_jmbg">JMBG:</label>
        </div>
        <div>
            <input required type="text" name="user_IDcard" id="user_IDcard"/>
            <label for="user_IDcard">Broj licne karte:</label>
        </div>

              <div class="cheat">PREVARA AAAAAAAA ZABRANJENO ITDD</div>

<div>
    <input type="checkbox" name="ch_terms" class="ch_accept" value="1" id="ch_terms" />
    <label for="chUslovi">Slazem se sa <a href="#">uslovima</a> korišćenja sajta!</label>
</div>
<div>
    <input type="checkbox" name="ch_accuracy" class="ch_accept" value="1" id="ch_accuracy"/>
    <label for="chTacnost">Garantujem tacnost unetih podataka</label>




</div>







                  <div id="update_insert">
                      <button type="button" name="form_insert" class="btn btn-primary btnUpdateInsert" id="form_insert">Unesi</button>
                  </div>




    </div>
    </div>

</form>

