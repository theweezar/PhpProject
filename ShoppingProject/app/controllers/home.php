<?php

class Home extends Controller{
    public function default($name=''){ // dòng này là method. $name là params | test localhost/home/duc -> echo Hello duc
        $this->view('home/homepage',['name'=>$name,'fuck'=>'hell']);  
    }

    public function test($name=''){ // gõ localhost/home/test để thử nghiệm
        echo "this is a test ".$name." ";
    }
    
}