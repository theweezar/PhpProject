<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/**
 * Nơi cấu hình để kết nối với Database
 */
class Database {
    protected $HOST;
    protected $USERNAME;
    protected $PASSWORD;
    protected $DATABASENAME;
    
    private function setMode(string $mode) {
        switch ($mode) {
            case 'development':
                $this->HOST = "localhost";
                $this->USERNAME = "root";
                $this->PASSWORD = "";
                $this->DATABASENAME = "adminm_fbreiplex";
                break;
            case 'production':
                $this->HOST = "fb.reiplex.com";
                $this->USERNAME = "adminm_fbreiplex";
                $this->PASSWORD = "fbreiplex";
                $this->DATABASENAME = "adminm_fbreiplex";
                break;
            default:
                break;
        }
    }

    protected function getConnection(){
        $this->setMode("development");
        return new mysqli($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DATABASENAME);
    }
}