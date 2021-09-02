<?php 

class Response {
    public function render(string $view, $viewData = array()){
        require(ROOT.'/views/'.$view);
    }

    public function json(array $json, int $response_code = 200){
        header('Content-Type: application/json');
        http_response_code($response_code);
        echo json_encode($json);
    }
}