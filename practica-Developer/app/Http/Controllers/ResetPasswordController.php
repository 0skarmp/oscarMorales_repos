<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Illuminate\Http\RedirectResponse; // Agrega esta línea

class ResetPasswordController extends Controller
{
    // Método para mostrar el formulario de solicitud de restablecimiento de contraseña
    public function showResetFormwithEmail()
    {
        return view('auth.passwords.email');
    }

    // Método para enviar el correo electrónico con el enlace de restablecimiento de contraseña
    public function sendResetLinkEmail(Request $request): RedirectResponse|array // Añade RedirectResponse|array como tipo de retorno
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'), function ($message) {
            $message->sender('your_email@example.com');
        });

        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }

    // Método para mostrar el formulario de restablecimiento de contraseña
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    // Método para restablecer la contraseña
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }  
}
