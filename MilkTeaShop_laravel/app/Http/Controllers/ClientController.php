<?php

namespace App\Http\Controllers;

use Input;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Client;

class ClientController extends Controller
{

    public function validate_remember_token($token){
        $client = Client::where('remember_token','=',$token)->first();
        if ($client) return true;
        else return false;
    }

    public function render_login_form(Request $request){
        $token = csrf_token();
        return [
            "_token" => $token
        ];
        // return view('login');
    }

    public function render_register_form(Request $request){
        return view('register');
    }

    public function register(Request $request){
        // xác thực các input có đúng hay ko
        $request->validate(array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:client',
            'password' => 'required|alphaNum|min:5|max:32',
            're_password' => 'required|alphaNum|min:5|max:32',
            'phone_number' => 'required|numeric|min:10|unique:client'
        ));
        // return $request;
        if ($request->input('password') != $request->input('re_password')){
            return back()->with('re_password_failed','Wrong Re-password');
        }
        else{
            // xác thực password và re_password hoàn thành thì hash password và lưu vào database
            // remember_token sẽ là dùng string random có length = 32 + microtime hiện tại và băm nó ra
            $hashed_password = Hash::make($request->input('password'));
            $new_client = Client::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => $hashed_password,
                'remember_token' => sha1(Hash::make(Str::random(32).microtime())),
                'phone_number' => $request->input('phone_number'),
            ]);
            
            return $new_client;
        }    
    }

    public function login(Request $request){
        // Xác thực 2 input
        $request->validate(array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:5|max:32'
        ));

        // Xác thực hoàn thành thì truy xuât theo email trước
        $client = Client::where('email','=',$request->input('email'))->first();

        // Nếu có client thì kiểm tra tiếp hash password, nếu sai thì quay lại
        if (!$client){
            return back()->with('status','Wrong password or email');
        }
        else{
            if (Hash::check($request->input('password'), $client['password'])) {
                // Tạo session và lưu remember_token của client vào
                $request->session()->put('client_validation', [
                    'client_id' => $client->client_id,
                    'logged' => true,
                    'remember_token' => $client->remember_token
                ]);
                // gửi remember_token tới client để lưu cookies
                return response($client->remember_token, 200);
            }
            else{
                return response(null, 200);
            }
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return response(null, 200);
    }

    public function profile(Request $request){
        // Đầu tiên, phải kiểm tra token của client để tránh bị lỗi csrf
        // $remember_token 
        if ($request->input('remember_token') != null){
            
        }
    }

    public function add_address(Request $request){
        if ($request->input('remember_token') != null){
            $this->validate_remember_token($request->input('remember_token'));
        }
    }

}
