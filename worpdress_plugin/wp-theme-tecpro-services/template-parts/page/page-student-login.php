<div class="container-fluid bg-dark">
    <div class="row">
        <div class="col-12">
            <div class="screen-size d-flex justify-content-center align-items-center">
                <div class="login-register-box login-register-background">
                    <div class="row h-100">
                        <div class="col-12">
                            <form class="login-register-form login" method="POST" name="login-form"
                            action="<?php echo esc_url(get_rest_url(null, CM_Rest_API::$endpoint_student_login)); ?>">
                                
                                <?php wp_nonce_field('wp_rest'); ?>

                                <h2 class="login-register-heading">ACCOUNT SIGN IN</h2>
                                <div class="form-group active">
                                    <label class="label label-input" for="email">Email</label>
                                    <input type="email" class="input email-input form-control" name="email"
                                    placeholder="Please fill in your email" required>
                                    <div class="error-message"></div>
                                </div>
                                <div class="form-group invalid">
                                    <label class="label label-input" for="password">Password</label>
                                    <input type="password" class="input password-input form-control" name="student_password"
                                    placeholder="*******" required>
                                    <div class="error-message">Password is required</div>
                                </div>
                                <!-- <div class="form-group flex-group sub-group">
                                    <div class="remember-me w-50 font-small">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">
                                                Default checkbox
                                            </label>
                                        </div>
                                    </div>
                                    <div class="forgot-password w-50">
                                        <a href="#">Forget your password</a>
                                    </div>
                                </div> -->
                                <div class="form-group flex-btn-group action-btn-group">
                                    <div class="btn-box btn-100-lg-50 sign-in-btn-box">
                                        <button type="submit" class="btn btn-fill-up sign-in-btn left">Sign in</button>
                                    </div>
                                    <div class="btn-box btn-100-lg-50 register-btn-box ">
                                        <a type="button" href="register.html" class="btn btn-border register-btn right">Register</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p class="important-noting">
                                        By signing in, you agree to 
                                        <a href="#">TECPRO Services Exclusives Club Terms & Conditions</a>, 
                                        <a href="#">Privacy Policy</a>, 
                                        <a href="#">Terms & Conditions, and Personal Information Collection Statement</a>.
                                    </p>
                                </div>
                            </form>
                        </div>                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>