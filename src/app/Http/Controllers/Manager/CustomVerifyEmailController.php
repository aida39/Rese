<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manager;
use Illuminate\Auth\Events\Verified;

class CustomVerifyEmailController extends Controller
{
    public function emailVerification()
    {
        return view('manager/verify-email');
    }

    public function verifyEmail(Request $request, $id)
    {
        $manager = Manager::find($id);
        if (!$manager) {
            abort(404);
        }

        $hash = $request->route('hash');

        if ($manager->getKey() == $id && sha1($manager->getEmailForVerification()) == $hash) {
            $manager->forceFill([
                'email_verified_at' => $manager->freshTimestamp(),
            ])->save();

            event(new Verified($manager));

            return redirect('/manager/thanks');
        } else {
            abort(403, 'Invalid verification link');
        }
    }

    public function thanks()
    {
        return view('manager/thanks');
    }
}
