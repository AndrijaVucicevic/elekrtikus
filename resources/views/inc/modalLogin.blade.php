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