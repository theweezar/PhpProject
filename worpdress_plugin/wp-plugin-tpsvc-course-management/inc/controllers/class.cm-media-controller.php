<?php



class CM_Media_Controller {
    /**
     * Route render the image container
     */
    public function route_render_media_container() {
        $dir = CM_Request::get_param('dir');
        $dir = CM_Media::stip_back_dot($dir);
        $file_list = CM_Media::get_files_list_in_dir($dir);

        CM_Template::render('media/view.media-container.php', array(
            'upload_media_ajax_action' => 'submit_upload_custom_media',
            'upload_media_nonce' => 'upload_media_nonce',
            'current_dir' => $dir,
            'file_list' => $file_list
        ));
    }

    /**
     * Route get the media tree by Ajax
     */
    public function route_get_media_tree_data() {
        $dir = CM_Request::get_param('dir');
        $file_list = CM_Media::get_files_list_in_dir($dir);

        wp_send_json(array(
            'success' => true,
            'file_list' => $file_list,
            'current_dir' => CM_Media::get_media_dir_path($dir)
        ));
    }

    /**
     * Route submit to upload media files
     */
    public function route_submit_upload_custom_media() {
        $current_dir = '/cm_root_upload' . CM_Media::make_path(CM_Request::get_param('current_dir'));
        $response = CM_Media::upload_multiple_files('media_files', $current_dir);

        wp_send_json(array(
            'result' => $_FILES['media_files'],
            'response' => $response
        ));
    }
}