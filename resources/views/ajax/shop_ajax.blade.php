<!-- single product -->
@foreach($products as $product)
<div class="col-lg-4 col-md-6 col-12">
    <div class="single-product">
        <div class="product-img">
            <a href="{{ route("product", ["product_id" => $product->name.'_el_'.$product->id_oglas])}}">
                @if($product->src=='images/.png')
                    <img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
                    <img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
                @elseif($product->src!=null)
                    <img class="default-img" src="{{asset($product->src)}}" alt="{{$product->alt}}">
                    <img class="hover-img" src="{{asset($product->src)}}" alt="{{$product->alt}}">

                @endif
                <span class="new">New</span>
            </a>
            <div class="button-head">
                <div class="product-action">

                    @if(Route::current()->getName() == 'user' || Route::current()->getName() == 'more_user' || Route::current()->getName() == 'category_user')

                        @if(isset($product->user_follow))
                            <a title="Brisanje" href="#"><i class="fa fa-trash-o" id="user_delete_{{$product->name}}_{{$product->id_oglas}}"></i><span>Brisanje</span></a>

                            <a title="Izmeni" href="#"> <i class="fa fa-edit" id="user_edit_{{$product->name}}_{{$product->id_oglas}}"></i><span>Izmeni</span></a>

                        @else

                            <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Otprati</span></a>
                        @endif
                    @endif

                    @if(Route::current()->getName() != 'user' && Route::current()->getName() != 'more_user' && Route::current()->getName() != 'category_user')


                        <a data-toggle="modal" data-target="#exampleModal" title="Brz pregled" href="#"><i class=" ti-eye"></i><span>Brz pregled</span></a>
                        <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Prati</span></a>
                        <!-- kad se uradi login da se stavi da se provera user i da li prati oglase-->
                        <!--<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>-->
                @endif

                    <!--<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>-->
                </div>
                <div class="product-action-2">
                    <a title="Add to cart" href="#">Add to cart</a>
                    <!-- posalji poruku korisniku -->
                </div>
            </div>
        </div>
        <div class="product-content">

            <h3><a href="{{ route("product", ["product_id" => $product->name.'_el_'.$product->id_oglas])}}">{{$product->name}}</a></h3>
            <div class="product-price">
                <!--  <span class="old">$60.00</span>-->
                <span>{{$product->price}}
                    {{$product->currency_text}}
                </span>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach
<!--end single product -->