

            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="https://via.placeholder.com/370x300" alt="#">
                    <div class="content">
                        <p class="date"> {{date("d F, Y. l",$blog->datetime)}}</p>
                        <a href="#" class="title">{{$blog->name}}</a>
                        <a href="{{ route("blog", ["blog_name" => $blog->name.'_el_'.$blog->id_blog])}}" class="more-btn">Continue Reading</a>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>

