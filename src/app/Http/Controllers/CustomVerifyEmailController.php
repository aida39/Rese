<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Routing\Controller;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\VerifyEmailResponse;
use Laravel\Fortify\Http\Requests\VerifyEmailRequest;
use Laravel\Fortify\Http\Controllers\VerifyEmailController as FortifyVerifyEmailController;

class CustomVerifyEmailController extends FortifyVerifyEmailController
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Laravel\Fortify\Http\Requests\VerifyEmailRequest  $request
     * @return \Laravel\Fortify\Contracts\VerifyEmailResponse
     */
    public function verifyEmail(VerifyEmailRequest $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        // メールアドレスが既に確認されているかどうかをチェック
        if (!is_null($user->email_verified_at)) {
            return app(VerifyEmailResponse::class);
        }

        // メールアドレスを確認済みにマーク
        $user->forceFill([
            'email_verified_at' => $user->freshTimestamp(),
        ])->save();

        // Verifiedイベントをトリガー
        event(new Verified($user));

        return app(VerifyEmailResponse::class);
    }
}
