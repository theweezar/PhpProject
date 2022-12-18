
    <footer id="site-footer" class="footer-group">

        <!-- Footer widget -->
        <div class="footer-widget-wrapper container">
            <div class="row widget-row">
                <!-- This HTML will be moved to Page section in the future -->
                <div class="col-12 col-lg-4 order-1 order-lg-2 email-subscription-wrapper">
                    <h4><?php echo Resource::text('footer.email.subscription.label', 'homepage'); ?></h4>
                    <p><?php echo Resource::text('footer.email.subscription.introduce', 'homepage'); ?></p>
                    <form action="" method="post" class="email-subscription-form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email-subscription">
                            <span><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                        </div>
                    </form>
                </div>

                <div class="col-12 col-lg-8 order-2 order-lg-1">
                <?php
                    // Display the registered sidebar mobile-footer-widget
                    dynamic_sidebar("mobile-footer-widget");
                ?>
                </div>
            </div>
        </div>

        <div class="footer-copyright-wrapper">
            <div class="footer-copyright">
                <span>
                    <?php echo Resource::text('footer.copyright', 'homepage'); ?>
                </span>
            </div>
        </div>

    </footer>

    <?php
    wp_footer();
    ?>

</body>

</html>