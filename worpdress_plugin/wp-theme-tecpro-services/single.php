<!-- single.php will be used to render signle post -->
<?php
// Check if the plugin wp-plugin-tpsvc-course-management exists
if (!class_exists('CM_Initialization')) {
    return;
}
get_header();
?>

<main>
    <?php

    global $post;

    echo '<!-- Post ID: ' . get_the_title($post) . ' -->';

    $post_content = $post->post_content;

    //! TODO: Update the logic to execute PHP script. HIGH PRIORITY
    ob_start();

    eval('?>' . $post_content);

    $ob_post_content = ob_get_clean();

    echo $ob_post_content;

    ?>
</main>

<?php
get_footer();
?>