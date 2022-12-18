<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    wp_head();
    ?>

</head>

<body>

    <header id="site-header" class="header-group optimize-screen-size">

        <?php
        // Query the logo image src 
        $logo_src = get_template_directory_uri() . "assets/images/tecpro_services_icon.jpg";
        if (function_exists("the_custom_logo")) {
            $custom_logo_id = get_theme_mod("custom_logo");
            $logo_src = wp_get_attachment_image_src($custom_logo_id, "full");
        }

        // These two pages need to be created in WP admin Page
        $login_page_url = Fn_Utils::parse_page_url('student-login');
        $register_page_url = Fn_Utils::parse_page_url('student-register');
        $enable_header_search = get_theme_mod('enable_header_search', true);
        ?>

        <!-- Mobile menu -->
        <div class="mobile-menu-wrapper" id="right-sidebar">
            <div class="right-sidebar-wrapper">
                <div class="close-right-sidebar">
                    <button class="btn close-right-sidebar-btn">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="main-logo main-logo-mobile">
                    <img src="<?php echo $logo_src[0]; ?>" alt="tecpro_services_icon" srcset="">
                </div>

                <div class="divide-line"></div>

                <!-- Mobile Primary Menus -->
                <div class="header-navigation-wrapper header-navigation-mobile">
                    <?php
                    // Register the primary menu with configuration
                    wp_nav_menu(
                        array(
                            "menu" => "primary",
                            "container" => "",
                            "theme_location" => "primary",
                            "items_wrap" => '<ul class="nav flex-column align-items-center">%3$s</ul>'
                            // This class of <li></li> will be configured in the custom-classes field in WP
                        )
                    );
                    ?>
                </div>

                <div class="divide-line"></div>

                <!-- Login button -->
                <!-- <div class="action-btn login">
                    <a class="btn login-btn" href="<?php echo $login_page_url; ?>"><?php echo Resource::text('header.button.link.login', 'homepage'); ?></a>
                </div> -->

                <!-- Register button -->
                <!-- <div class="action-btn register">
                    <a class="btn register-btn" href="<?php echo $register_page_url; ?>"><?php echo Resource::text('header.button.link.register', 'homepage'); ?></a>
                </div> -->

                <!-- <div class="divide-line"></div> -->

                <div class="header-social-wrapper">
                    <p class="social-menu-label"><?php echo Resource::text('homepage.social.menu.greeting', 'homepage'); ?></p>
                    <?php
                    // Register the social menu with configuration
                    wp_nav_menu(
                        array(
                            "menu" => "secondary",
                            "container" => "",
                            "theme_location" => "social_menu",
                            "items_wrap" => '<ul class="nav social-sharing justify-content-center">%3$s</ul>'
                            // This class of <li></li> will be configured in the custom-classes field in WP
                        )
                    );
                    ?>
                </div>
            </div>
        </div>

        <!-- Logo, menu, search block -->
        <div class="container header-container">
            <div class="header-wrapper row align-items-center">
                <!-- Logo - Site identity -->
                <div class="main-logo">
                    <a href="<?php echo get_home_url(); ?>">
                        <img src="<?php echo $logo_src[0]; ?>" alt="tecpro_services_icon" srcset="">
                    </a>
                </div>

                <!-- Search box -->
                <div class="search-box-wrapper col-3 d-none d-lg-inline-block">
                    <?php
                    if ($enable_header_search === true) {
                        get_search_form();
                    }
                    ?>
                </div>

                <!-- Desktop Primary Menus -->
                <div class="header-navigation-wrapper d-none d-lg-inline-block col ml-auto">
                    <?php
                    // Register the primary menu with configuration
                    wp_nav_menu(
                        array(
                            "menu" => "primary",
                            "container" => "",
                            "theme_location" => "primary",
                            "items_wrap" => '<ul class="nav justify-content-end header-navigation">%3$s</ul>'
                            // This class of <li></li> will be configured in the custom-classes field in WP
                        )
                    );
                    ?>
                </div>

                <!-- Mobile search and hambuger action button -->
                <div class="header-searchbox-wrapper ml-auto d-flex d-lg-none col-4 col-lg-2 justify-content-end">
                    <button class="btn search-btn">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                    <button class="btn open-menu-btn">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>

                <!-- Desktop login, register action button -->
                <!-- <div class="action-btn login d-none d-lg-inline-block">
                    <a class="btn login-btn" href="<?php echo $login_page_url; ?>">
                        <?php echo Resource::text('header.button.link.login', 'homepage'); ?>
                    </a>
                </div> -->

                <!-- <div class="action-btn register d-none d-lg-inline-block">
                    <a class="btn register-btn" href="<?php echo $register_page_url; ?>">
                        <?php echo Resource::text('header.button.link.register', 'homepage'); ?>
                    </a>
                </div> -->

                <!-- The Desktop locale switcher -->
                <!-- <div class="locale-switcher d-none d-lg-inline-block">
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle text-uppercase" href="#" role="button" id="dropdownLocale" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo Custom_Locale::get_current_locale() ?>
                        </a>

                        <div class="dropdown-menu text-uppercase" aria-labelledby="dropdownLocale">
                            <?php
                            foreach (Custom_Locale::$locales as $key => $locale) {
                                ?>
                                <a class="dropdown-item" id="<?php echo $key ?>"
                                href="<?php echo add_query_arg(array('lang' => $key), $_SERVER['REQUEST_URI']); ?>">
                                    <?php echo $key ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>

        <!-- Callout message, social link block -->
        <!-- <div class="header-promo-wrapper">
            <div class="container header-promo-container">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="header-promo">
                        <div class="header-promo-callout">Discount 30% for early member registration</div>
                    </div>
                </div>
            </div>
        </div> -->

    </header>