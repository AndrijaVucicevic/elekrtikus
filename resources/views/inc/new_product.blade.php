<link rel="stylesheet" href="{{asset('css/form_new.css')}}" />
<ul class="clip_list nav nav-pills">
    <li class="active"><a href="#section_firstStep" data-toggle="pill">Kategorija</a></li>
    <li><a  href="#section_secondStep" data-toggle="pill">Podaci o oglasu</a></li>
    <li><a href="#section_thirdStep" data-toggle="pill">Promocije</a></li>
    <li><a href="#section_fourthStep" data-toggle="pill">Lični podaci</a></li>


</ul>

<form accept-charset="UTF-8" id="formInsert_update" name="formInsert_update"  role="form" action="" method=""  enctype="multipart/form-data">
@csrf
    <div class="tab-content">
<div id="section_firstStep" class="active section_new tab-pane">

    <span style="margin-bottom: 20px;">
     Nakon odabira kategorije, ispod odaberite potkategoriju, a nakon toga tacnu kategoriju Vašeg oglasa.
    <br> Na primer: <b>Telefon</b><i class='fas fa-arrow-circle-right'></i> <b>Iphone</b> <i class='fas fa-arrow-circle-right'></i> <b>Iphone X</b>
 </span>
<br>

<select id="category_ddl" name="category_ddl">

@if(isset($category))
<option value="0">Kategorija:</option>
    @foreach($category as $cat)

        <option value="{{$cat->id_category}}">{{$cat->name_category}} </option>

        @endforeach
    @endif
</select>


    <select id="subcategory_ddl" name="subcategory_ddl">

<option value="0">
    Izaberite kategoriju levo...
</option>



    </select>


    <select id="ppk_ddl" name="ppk_ddl">

        <option value="0">
            Izaberite kategoriju levo...
        </option>



    </select>
</div>
    <div id="section_secondStep" class="fade section_new tab-pane">

 <label>Naziv</label>
<input type="text" id="text_name"/>

        <label>Cena:</label>&nbsp&nbsp<input type="number" id="price_new" name="price_new"/>
         RSD<input type="radio" name="ch_valuta" class="chValuta" value="1" id="chValuta1" />
            &euro; <input type="radio" name="ch_valuta" class="chValuta" value="2" id="chValuta2" />

        <br><div id="fixedPrice">Fiksno<input type="radio" name="ch_Fixed" class="ch_Fixed" value="1" id="ch_Fixed1" />
            Zamena<input type="checkbox" name="ch_Fixed" class="chFixed" value="2" id="ch_Fixed2" />
            Dogovor<input type="checkbox" name="ch_Fixed" class="chFixed" value="3" id="ch_Fixed3" />
        </div>
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
                <input type="checkbox" name="chPromocija" value="0" id="chPromocija" />
                <h3>Standardna vidljivost</h3>
                <p>Smanjuje broj poseta, Vas oglas ce biti prikazivan prilikom vrsenja pretraga medju svim ostalim oglasima.<h4 class="cenaPromocija" style="float: right;">00,00 RSD</h4></p>
            </li>
            <li class="promotion_new" id="">
                <input type="checkbox" name="chPromocija1" value="1" id="chPromocija1" />
                <h3>Vidljivost jedan</h3>
                <p>Povecava broj poseta, Vas oglas ce biti prikazivan medju preporucenim oglasima za kategoriju kojoj pripada Vas oglas <h4 class="cenaPromocija" style="float: right;">1450,00 RSD</h4></p>
            </li>
            <li class="promotion_new" id="">
                <input type="checkbox" name="chProm2" value="2" id="chProm2" />
                <h3>Vidljivost dva</h3>
                <p>Mogucnost da se Vas oglas nadje na pocetnoj strani, sigurna vidljivost, povecava broj poseta, broj mesta 9. Promocija se placa na nedeljnom nivou.<h4 class="cenaPromocija" style="float: right;">4450,00 RSD</h4></p>
            </li>
            <li id="user_shop">

                <h3>Vidljivost tri</h3>
                <p>Za vecu vidljivost, mozete napraviti svoj izlog. Tu ce se prikazivati svi Vasi oglasi uz razne druge mogucnosti sortiranje i pretrage..Izlog mozete napraviti putem svog korisnickog profila.Cena je na mesecnom nivou<h4 class="cenaPromocija" style="float: right;">3450,00 RSD</h4></p>


            </li>
        </ul>





    </div>
    <div id="section_fourthStep" class="fade section_new tab-pane">


      <table>
          <tr> <td colspan="2" class="cheat">
              Svi podaci su zasticeni
              </td>
          </tr>


       <tr>
           <td><label for="user_name">Ime:</label><input type="text" name="user_name" id="user_name"/></td>
           <td><label for="user_lastName">Prezime:</label><input type="text" name="user_lastName" id="user_lastName"/>

           </td></tr>
        <tr>
          <td><label for="user_phone">Telefon:</label>
          <input type="text" name="user_phone" id="user_phone"/>
          </td>
            <td></td>
        </tr>



          <tr>
              <td> <label for="user_place">Mesto:</label>
              <input type="text" name="user_place" id="user_place"/></td>
              <td> <label for="user_street">Ulica, broj:</label>
              <input type="text" name="user_street" id="user_street"/></td>

          </tr>

          <tr>

              <td>  <label for="user_jmbg">JMBG:</label> <input type="text" name="user_jmbg" id="user_jmbg"/></td>
              <td> <label for="user_IDcard">Broj licne karte:</label>
                  <input type="text" name="user_IDcard" id="user_IDcard"/>
              </td>


          </tr>

          <tr>
              <td colspan="2" class="cheat">PREVARA AAAAAAAA ZABRANJENO ITDD</td>

          </tr>
          <tr>
              <td>
                  <label for="chUslovi">Slazem se sa <a href="#">uslovima</a> korišćenja sajta!</label>   <input type="checkbox" name="ch_condition" value="1" id="chUslovi" />
              </td>
              <td>
                  <label for="chTacnost">Garantujem tacnost unetih podataka</label>  <input type="checkbox" name="ch_accuracy" value="1" id="chTacnost" />
              </td>


              <tr>

              <td colspan="2">
                  <div id="update_insert">
                      <button type="button" name="form_insert" class="btn btn-primary" id="form_insert">Unesi</button>
                  </div>
              </td>

          </tr>

      </table>



    </div>
    </div>

</form>

