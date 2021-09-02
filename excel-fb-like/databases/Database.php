<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/**
 * Contain all the configs, table, columns name and method getConnection()
 */
class Database {
    protected $HOST;
    protected $USERNAME;
    protected $PASSWORD;
    protected $DATABASENAME;
    
    private function setMode() {
        switch (ENV) {
            case 'development':
                $this->HOST = "localhost";
                $this->USERNAME = "root";
                $this->PASSWORD = "";
                $this->DATABASENAME = "adminm_fbreiplex";
                break;
            case 'production':
                $this->HOST = "localhost";
                $this->USERNAME = "adminm_fbreiplex";
                $this->PASSWORD = "2peM2U9lqT";
                $this->DATABASENAME = "adminm_fbreiplex";
                break;
            default:
                break;
        }
    }

    protected function getConnection(){
        $this->setMode();
        return new mysqli($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DATABASENAME);
    }
}