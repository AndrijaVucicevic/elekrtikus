<!-- single product -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a href="{{ route("product", ["product_id" => $product->name.'_el_'.$product->id_oglas])}}">
                                    <img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
                                    <img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
                                    <span class="new">New</span>
                                </a>
                                <div class="button-head">
                                    <div class="product-action">
                                        <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                        <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Prati</span></a>
                                        <!-- kad se uradi login da se stavi da se provera user i da li prati oglase-->
                                        <!--<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>-->
                                    </div>
                                    <div class="product-action-2">
                                        <a title="Add to cart" href="#">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">

                                    <h3><a href="{{ route("product", ["product_id" => $product->name.'_el_'.$product->id_oglas])}}">{{$product->name}}">{{$product->name}}</a></h3>
                                    <div class="product-price">
                                        <!--  <span class="old">$60.00</span>-->
                                        <span>{{$product->price}} {{$product->currency}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  <!--end single product -->