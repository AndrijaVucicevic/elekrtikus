

    <section class="signup" id="signup-form-section">
        <!-- <img src="images/signup-bg.jpg" alt=""> -->
        <div class="container">
            <div class="signup-content">


                <div id="signup-form" class="signup-form">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">Ime</label>
                            <input type="text" class="form-input" name="first_name" id="first_name" />

                        </div>
                        <div class="form-group">
                            <label for="last_name">Prezime</label>
                            <input type="text" class="form-input" name="last_name" id="last_name" />

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group form-email">
                            <label for="birth_date">Korisničko ime</label>
                            <input type="text" class="form-input" name="username" id="username"/>

                        </div>

                    </div>
                    <div class="form-row">
                    <div class="form-group form-email">
                        <label for="phone_number">Email</label>
                        <input type="email" class="form-input" name="email" id="email" />

                    </div>
                    </div>

                    <div class="form-row borderPassword">
                        @if(Route::current()->getName() != 'register')

                            <style>
                                .borderPassword{
                                    border:1px solid;
                                    border-left:none;
                                    border-right:none;
                                }

                            </style>

                            <h3>Izmena šifre</h3>

                            <div class="form-group form-email">
                                <label for="old_password">Stara šifra</label>
                                <input type="password" class="form-input pass" name="old_password" id="old_password"/>
                                <i class="far fa-eye" id="toggle_old_password"></i>

                            </div>


                        @endif
                        <div class="form-group ">
                            <label for="password">Šifra</label>
                            <input type="password" class="form-input pass" name="password" id="password"/>
                            <i class="far fa-eye" id="toggle_password"></i>

                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Ponovite šifru</label>
                            <input type="password" class="form-input" name="password_confirmation" id="password_confirmation"/>
                            <i class="far fa-eye" id="toggleRePassword"></i>

                        </div>
                    </div>
                    @if(Route::current()->getName() == 'register')
<div class="form-row">
                    <div class="form-group form-email">
                        <input type="button" name="submit" id="submitForm" class="form-submit" value="Submit"/>
                    </div>
</div>
                        @else
<div class="form-row form-confirm">
                        <div class="form-group form-email">
                            <label for="password_change">Potvrdite izmene</label>
                            <input type="password" class="form-input pass" name="password_change" id="password_change"/>
                            <i class="far fa-eye" id="toggle_password_change"></i>

                        </div>
</div>
                        @endif
                </div>
            </div>
        </div>
    </section>

