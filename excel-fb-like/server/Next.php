<?php

Class Next {
    private $chains;

    public function __construct(Request $req, Response $res, $chains = array()) {
        $this->chains = $chains;
        $this->execute($req, $res);
    }

    public function execute(Request $req, Response $res) {
        if (count($this->chains) != 0) {
            $currentChain = $this->chains[0];
            if (function_exists($currentChain)) {
                $this->chains = array_slice($this->chains, 1);
                $currentChain($req, $res, $this);
            } else {
                throw new Exception("Middleware function not found", 500);
            }
        }
    }

    public function break(string $message) {
        
    }

    public function done() {
        return count($this->chains) == 0;
    }
}