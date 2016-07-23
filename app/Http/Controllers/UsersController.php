<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function registration() {

        return view('registration');
    }


    public function login() {

        $rules = array(
            'username' => 'required',
            'password' => 'required|min:6',
            'password2' => 'required|same:password'
        );

        $messages = array(
            'same'  => 'The Passwords does not match!'
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {

            return Redirect::to('registration')
                ->withErrors($validator)
                ->withInput(Input::except('password', 'password2'));
        }

        if (User::where('username', '=', Input::get('username'))->exists()) {

            $message = array(
                'exists'  => 'The Username already exists!'
            );

            return Redirect::to('registration')
                ->withErrors($message)
                ->withInput(Input::except('password', 'password2'));

        } else {

            $user = new User();

            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('password'));

            $user->save();

            echo '<div id="message" class="alert alert-success">You have successfully registered !!!</div>';

            return view('login_page');

        }

    }


    public function welcome() {

        $username = Input::get('username');
        $password = Input::get('password');

        $rules = array(
            'username' => 'required',
            'password' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }

        if (Auth::attempt(array('username' => $username, 'password' => $password))) {

            return view('welcome');
        }
        elseif (User::where('username', '!=', Input::get('username'))->exists() && User::where('password', '=', Input::get('password'))->exists()) {

            $msgUser = array(
                'wrongUsr'  => 'Invalid Username!'
            );

            return Redirect::to('/')
                ->withErrors($msgUser)
                ->withInput(Input::except('password'));
        }
        else {

            $msgPass = array(
                'wrongPass'  => 'Wrong Password!!'
            );

            return Redirect::to('/')
                ->withErrors($msgPass)
                ->withInput(Input::except('password'));
        }
    }

}
