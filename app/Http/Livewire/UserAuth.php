<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserAuth extends Component
{
    public $view = 'login';
    public $name='';
    public $phone;
    public $email='';
    public $password;
    public $password_confirmation;
    public $login_email;
    public $login_password;


    public function switchView($view)
    {
        $this->view = $view;
    }

    public function login()
    {
        $this->validate([
            'login_email' => 'required|email',
            'login_password' => 'required'
        ]);
        if (auth()->attempt(['email' => $this->login_email, 'password' => $this->login_password])) {
            return redirect()->to('/');
        } else {
            session()->flash('error', 'Invalid email or password');
        }
    }

    public function register(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'min:6',
             'phone' => 'required|numeric' ,
        ]);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'phone' => $this->phone,

        ]);
        auth()->login($user);
        session()->flash('success', 'Registration successful.');
        //redirect after 2 seconds
        return redirect()->to('/');
    }


    public function render()
    {
        return view('livewire.user-auth');
    }
}
