<?php

class CM_Media {
    /**
     * Get the media directory base path
     */
    public static function get_media_base_dir_path() {
        return self::make_path('cm_root_upload');
    }

    /**
     * Strip the back dot and the previous element in the path
     * 
     * @param string $path The path
     * @return string The stripped path
     */
    public static function stip_back_dot($path = '') {
        return preg_replace('/\/((\w+[-_\s])+\w+|\w+)\/(\.\.)/', '', $path);
    }

    /**
     * Add trailing slashes to path
     * 
     * @param string $path The path to parse
     * @return string The path with trailing slashes.
     */
    public static function make_path($path) {
        $clone_path = trim($path);

        if (strcmp($clone_path, '') === 0) return '';

        $clone_path = rtrim($clone_path, '/') . '/';
        $clone_path = '/' . ltrim($clone_path, '/');
        $clone_path = str_replace('\\', '/', $clone_path);
        $clone_path = preg_replace('/(\/){2,}/', '/', $clone_path);

        return $clone_path;
    }

    /**
     * Get all files and folders in directory
     * @param string $dir the directory path
     * @return array The file list
     */
    public static function get_files_list_in_dir($dir_path = '') {
        $current_dir = self::get_media_dir_path($dir_path);
        $file_list = array();

        if ($handle = opendir($current_dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != ".") {
                    $file_path = self::get($dir_path.$file);
                    $file_path_in_dir = $current_dir.$file;
                    $is_dir = is_dir($file_path_in_dir);
                    $file_size = floor((filesize($file_path_in_dir) / 1024) * 100) / 100 . ' KB';

                    array_push($file_list, array(
                        'file_name' => $file,
                        'file_path' => $file_path,
                        'file_size' => !$is_dir ? $file_size : '',
                        'is_dir' => $is_dir
                    ));
                }
            }
        
            closedir($handle);
        }

        // Sort the files based on the is_dir variable
        $is_dir_sort = array_column($file_list, 'is_dir');
        array_multisort($is_dir_sort, SORT_DESC, $file_list);

        return $file_list;
    }

    /**
     * Get the media directory path
     * 
     * @param string $dir_path The add in directory path
     * @return string The media path: /wp-content/uploads/cm_root_upload/ + $dir_path
     */
    public static function get_media_dir_path($dir_path = '') {
        // Get the upload root folder
        $wp_upload_dir = wp_upload_dir();
        $wp_upload_path = $wp_upload_dir['basedir'];
        return (strcmp(WP_APP_MODE, 'production') === 0 ? '/' : '') .
        ltrim(self::make_path($wp_upload_path . self::get_media_base_dir_path() . $dir_path), '/');
    }

    /**
     * Get the media url instead of path. So the browser can make a request to it.
     * Example: <?php echo CM_Media::get('blog/20220924-tester-la-gi.jpg'); ?>
     * 
     * @param string $media_path the media path
     * @return string The media url
     */
    public static function get($media_path) {
        if (!isset($media_path)) return '';
        return rtrim(self::make_path('/wp-content/uploads/' . self::get_media_base_dir_path() . $media_path), '/');
    }

    /**
     * Handle upload file by using the Wordpress method.
     * The image will be saved in folder uploads
     * 
     * @return array { success => true/false, status, attachment_id if upload successfully }
     */
    public static function wp_upload_file($file) {
        $ret = array(
            'success' => false
        );

        if (!isset($_FILES[$file])) {
            $ret['status'] = CM_Error_Status::$status_file_upload_not_exist;
            return $ret;
        }

        $attachment_id = media_handle_upload($file, 0);

        if (is_wp_error($attachment_id)) {
            $ret['status'] = CM_Error_Status::$status_upload_file_failed;
            return $ret;
        }

        $ret = array(
            'success' => false,
            'status' => CM_Status::$status_upload_file_successfully,
            'attachment_id' => $attachment_id
        );

        return $ret;
    }

    /**
     * Handle upload file by using pure PHP code solution
     * 
     * @param string $file_field The field name to get the file from $__FILES
     * @param string $dir_path the directory path that file will be upload to
     * 
     * @return array Return the array that content the status and uploaded file path
     */
    public static function upload_file($file_field, $dir_path = '') {
        $ret = array(
            'success' => false
        );

        if (!is_uploaded_file($_FILES[$file_field]['tmp_name'])) {
            $ret['status'] = CM_Error_Status::$status_file_upload_not_exist;
            return $ret;
        }

        $wp_upload_dir = wp_upload_dir();
        // Get the upload root folder
        $wp_upload_path = $wp_upload_dir['basedir'];
        $target_dir = $wp_upload_path . $dir_path;

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $req_file = $_FILES[$file_field];
        $file_path = $target_dir . '/' . basename($req_file['name']);

        if (move_uploaded_file($req_file['tmp_name'], $file_path)) {
            $ret['success'] = true;
            $ret['status'] = CM_Status::$status_upload_file_successfully;
            $ret['uploaded_file_path'] = '/wp-content' . explode('wp-content', $file_path)[1];
        } else {
            $ret['status'] = CM_Error_Status::$status_upload_file_failed;
        }

        return $ret;
    }

    /**
     * Upload multiple files
     * 
     * @param string $file_field The field name to get the file from $__FILES
     * @param string $dir_path the directory path that file will be upload to
     */
    public static function upload_multiple_files($file_field, $dir_path = '') {
        $ret = array(
            'success' => false
        );

        $file_object = $_FILES[$file_field];
        $file_error_list = $file_object['error'];
        $file_name_list = $file_object['name'];
        $file_tmp_list = $file_object['tmp_name'];

        for ($idx = 0; $idx < count($file_error_list); $idx++) { 
            if ($file_error_list[$idx] !== 0) {
                $ret['status'] = CM_Error_Status::$status_upload_file_error;
                return $ret;
            }
        }

        $wp_upload_dir = wp_upload_dir();
        $wp_upload_path = $wp_upload_dir['basedir'];
        $target_dir = $wp_upload_path . $dir_path;
        
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        for ($idx = 0; $idx < count($file_name_list); $idx++) { 
            $file_name = $file_name_list[$idx];
            $tmp_name = $file_tmp_list[$idx];
            $file_path = $target_dir . '/' . basename($file_name);

            if (move_uploaded_file($tmp_name, $file_path)) {
                $ret['success'] = true;
                $ret['status'] = CM_Status::$status_upload_file_successfully;
            } else {
                $ret['success'] = false;
                $ret['file_name_not_upload'] = $file_name;
                $ret['status'] = CM_Error_Status::$status_upload_file_failed;
                break;
            }
        }

        return $ret;
    }
}