@foreach($userLi as $li)
    @if($li->messages!=null)
    <li>
        <a href="#" class="remove" title="Oznaci procitano"><i class="fa fa-remove"></i></a>
        <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
        <h4><a href="#">Ime prezime</a></h4>
        <p class="quantity">vreme <span class="amount">tekst poruke</span></p>
    </li>
@endif
    @if($li->messages==null)
        <li>
            <a href="#" class="remove" title="Oznaci procitano"><i class="fa fa-remove"></i></a>
            <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
            <h4><a href="#">Ime prezime</a></h4>
            <p class="quantity">vreme <span class="amount">tekst poruke</span></p>
        </li>
    @endif


    @endforeach