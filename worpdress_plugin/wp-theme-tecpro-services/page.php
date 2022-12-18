<!-- page.php will process all the page content in wordpress -->
<?php 
    get_header();
?>

<main>
<?php
    Fn_Utils::render_custom_page_by_url();
?>
</main>

<?php
    get_footer();
?>