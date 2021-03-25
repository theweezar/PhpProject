<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    
    /**
     * Cách dùng api database của php
     * Client::create([
            'firstName' => "Duc",
            'lastName' => "Minh",
            'email' => "hpmduc1999@gmail.com",
            'password' => "admin",
            'phoneNumber' => "0935723714",
            'avatar' => null
            *'updated_at', 'created_at' là 2 column mà php laravel bắt buộc database phải có nhưng sẽ tự gen
            *nên khi tạo table phải thêm 2 cột này dạng datetime để php gen, ko thì sẽ lỗi
            *]);
     */

    public function register(Request $request){
        
        return 'register here';
    }
}
