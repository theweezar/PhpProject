<div class="container-fluid bg-dark">
    <div class="row">
        <div class="col-12">
            <div class="screen-size d-flex justify-content-center align-items-center">
                <div class="login-register-box login-register-background">
                    <div class="row h-100">
                        <div class="col-12">
                            <a type="button" href="<?php echo Fn_Utils::parse_page_url('student-login'); ?>" class="btn btn-redirect">Login</a>

                            <form class="login-register-form register" name="register-form" 
                            action="<?php echo esc_url(get_rest_url(null, CM_Rest_API::$endpoint_student_register)); ?>"
                            method="POST">

                                <?php wp_nonce_field('wp_rest'); ?>

                                <h2 class="login-register-heading">REGISTER ACCOUNT</h2>

                                <div class="form-group">
                                    <label class="label label-input" for="firstName">First Name</label>
                                    <input type="text" class="input first-name-input form-control" name="first_name" placeholder="First Name" required>
                                    <div class="error-message">First Name is required</div>
                                </div>

                                <div class="form-group">
                                    <label class="label label-input" for="lastName">Last Name</label>
                                    <input type="text" class="input last-name-input form-control" name="last_name" placeholder="Last Name" required>
                                    <div class="error-message">Last Name is required</div>
                                </div>

                                <div class="form-group active">
                                    <label class="label label-input" for="email">Email</label>
                                    <input type="email" class="input email-input form-control" name="email" placeholder="Please fill in your email" required>
                                    <div class="error-message"></div>
                                </div>

                                <div class="form-group invalid">
                                    <label class="label label-input" for="password">Password</label>
                                    <input type="password" class="input password-input form-control" name="student_password" placeholder="*******" required>
                                    <div class="error-message">Password is required</div>
                                </div>

                                <div class="form-group">
                                    <label class="label label-input" for="passwordConfirm">Password (confirm)</label>
                                    <input type="password" class="input password-confirm-input form-control" name="student_confirm_password" placeholder="*******" required>
                                    <div class="error-message">Password is required</div>
                                </div>

                                <div class="form-group active">
                                    <label class="label label-select" for="gender">Gender</label>
                                    <select class="select gender-select form-control" name="gender" required>
                                        <option value="" checked>Choose your gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                    <div class="error-message">Gender is required</div>
                                </div>

                                <!-- <div class="form-group invalid">
                                    <label class="label label-select" for="district">District</label>
                                    <select class="select district-select form-control" required>
                                        <option value="" checked>Choose your living district</option>
                                        <option value="binhthanh">Binh Thanh</option>
                                        <option value="tanbinh">Tan Binh</option>
                                    </select>
                                    <div class="error-message">District is required</div>
                                </div> -->

                                <div class="form-group">
                                    <label class="label label-input" for="phone">Mobile Number</label>
                                    <input type="phone" class="input password-input form-control" name="phone_number" placeholder="" required>
                                    <div class="error-message">Mobile Number is required</div>
                                </div>

                                <div class="form-group">
                                    <label class="label label-input" for="phone">Citizen Identification</label>
                                    <input type="text" class="input password-input form-control" name="citizen_identification" placeholder="" required>
                                    <div class="error-message">Mobile Number is required</div>
                                </div>

                                <!-- Replace by js-date-picker in the future -->
                                <!-- <div class="form-group dob-group">
                                    <label class="label label-select" for="dob">Date of birth</label>
                                    <div class="d-flex">
                                        <div class="date-item day">
                                            <select class="select custom-select day-select form-control" required>
                                                <option value="" checked>Day</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </div>
                                        <div class="date-item month">
                                            <select class="select custom-select month-select form-control" required>
                                                <option value="" checked>Month</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </div>
                                        <div class="date-item year">
                                            <select class="select custom-select year-select form-control" required>
                                                <option value="" checked>Year</option>
                                                <option value="1999">1999</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="dob" class="date-of-birth-input">
                                    <div class="error-message">Date of birth is required</div>
                                </div>
                                <div class="form-group grecaptcha-box"></div>
                                <div class="form-group flex-group sub-group">
                                    <div class="w-100">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">
                                                Please update latest news to my mail box.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">
                                                I agree to
                                                <a href="#">TECPRO Services Exclusives Club Terms & Conditions</a>,
                                                <a href="#">Privacy Policy</a>,
                                                <a href="#">Terms & Conditions</a>,
                                                and <a href="#">Personal Information Collection Statement</a>.
                                            </label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <div class="w-100">
                                        <button type="submit" class="btn btn-fill-up register-btn w-100">Register</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="forgot-password">
                                        <a href="#">Forget your password</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>