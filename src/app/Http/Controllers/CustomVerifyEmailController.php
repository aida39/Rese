<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class CustomVerifyEmailController extends Controller
{
    public function VerifyEmail(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }

        $hash = $request->route('hash');

        if ($user->getKey() == $id && sha1($user->getEmailForVerification()) == $hash) {
            $user->forceFill([
                'email_verified_at' => $user->freshTimestamp(),
            ])->save();

            event(new Verified($user));

            return redirect('/thanks');
        } else {
            abort(403, 'Invalid verification link');
        }
    }
}