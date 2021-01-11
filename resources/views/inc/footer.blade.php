<footer class="footer">
    <!-- Footer Top -->
    <div class="footer-top section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer about">
                        <div class="logo">
                            <a href="index.html"><img src="images/logo2.png" alt="#"></a>
                        </div>
                        <p class="text">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue,  magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
                        <p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">+0123 456 789</a></span></p>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>Information</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Faq</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Help</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>Customer Service</h4>
                        <ul>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Money-back</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        <h4>Get In Tuch</h4>
                        <!-- Single Widget -->
                        <div class="contact">
                            <ul>
                                <li>NO. 342 - London Oxford Street.</li>
                                <li>012 United Kingdom.</li>
                                <li>info@eshop.com</li>
                                <li>+032 3456 7890</li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                        <ul>
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                            <li><a href="#"><i class="ti-twitter"></i></a></li>
                            <li><a href="#"><i class="ti-flickr"></i></a></li>
                            <li><a href="#"><i class="ti-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->
    <div class="copyright">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="left">
                            <p>Copyright © 2020 <a href="http://www.wpthemesgrid.com" target="_blank">Wpthemesgrid</a>  -  All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="right">
                            <img src="images/payments.png" alt="#">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade alert" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 300px!important; height: 400px!important;">
        <div class="modal-content">
            <div class="modal-header" style="width: 260px!important; border-bottom: 1px solid black;">
                <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody-alert" style="height:150px!important; width: 270px; padding-top: 70px; padding-left: 20px;">

            </div>
            <div class="modal-footer" style="width: 300px!important;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

<!--Modal 2 -->
@if(!\Illuminate\Support\Facades\Auth::check())
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
    <div class="modal-dialog1 modal-login1" role="document">
        <div class="modal-content1">
            <div class="modal-header1">
                <div class="avatar">
                    <img src="/examples/images/avatar.png" alt="Avatar">
                </div>
                <h4 class="modal-title1">Member Login</h4>
                <button type="button" class="myClose close" data-dismiss="modal" id="closeLogin"  aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body1">

                <div class="alert alert-danger print-error-msg" id="loginErrors" style="display:none">
                    <ul></ul>


                </div>
                <form  id="login_form">
                    @csrf
                    <div class="form-group1">
                        <input type="text" id="login_username" class="form-control1" name="login_username" placeholder="Username" required="required">
                    </div>
                    <div class="form-group1">
                        <input type="password" id="login_password" class="form-control1" name="login_password" placeholder="Password" required="required">
                    </div>
                    <div class="form-group1">
                        <button type="button" class="btn btn-primary btn-lg btn-block login-btn" id="btnLogin">Login</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer1">
                <a href="#">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>

    @endif