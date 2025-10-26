<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Websitemail;
use App\Models\Admin;

class AdminController extends Controller
{
    public function AdminLogin(){
        return view('admin.login');
    }

    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminLoginSubmit(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $check = $request->all();
        $data = [
            'email'=>$check['email'],
            'password'=>$check['password'],
        ];
         if (Auth::guard('admin')->attempt($data)){
            return redirect()->route('admin.dashboard')->with('success','Admin Login Successfully');
        }else{
            return redirect()->route('admin.login')->with('error','Admin Login Invalid');
        }
    }

    public function AdminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success','Admin Logout Successfully');
    }

    public function AdminForgetPassword(){
        return view('admin.forget_password');
    }

    public function AdminPasswordSubmit(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);

        $admin_data = Admin::where('email', $request->email)->first();
        if (!$admin_data){
            return redirect()->back()->with('error','Email Not Found');
        }
        $token = hash('sha256', time());
        $admin_data->token = $token;
        $admin_data->update();

        $reset_link = url('admin/reset-password/'.$token.'/'.$request->email);
        $subject = "Reset Password";
        $massage = "Click on the link to reset your password<br>";
        $massage .= "<a href='".$reset_link."'>Click Here</a>";

        Mail::to($request->email)->send(new Websitemail($subject, $massage));
        return redirect()->back()->with('success','We have e-mailed your password reset link!');
    }

    public function AdminResetPassword($token, $email){
        $admin_data = Admin::where('email', $email)->where('token', $token)->first();

        if (!$admin_data){
            return redirect()->route('admin.login')->with('error','Invalid Token or Email');
        }
        return view('admin.reset_password', compact('token', 'email'));
    }

    public function AdminResetPasswordSubmit(Request $request){
        $request->validate([
            'password'=>'required|confirmed',
            'password_confirmation'=>'required|same:password',
        ]);
        $admin_data = Admin::where('email', $request->email)->where('token', $request->token)->first();
        $admin_data->password = Hash::make($request->password);
        $admin_data->token = "";
        $admin_data->update();

        return redirect()->route('admin.login')->with('success','Password Reset Successfully');
    }
}
