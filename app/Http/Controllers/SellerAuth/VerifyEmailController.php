<?php

namespace App\Http\Controllers\SellerAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerEmailVerificationRequest as RequestsSellerEmailVerificationRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(RequestsSellerEmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('seller')->hasVerifiedEmail()) {
            return redirect()->intended(route('seller.index').'?verified=1');
        }

        if ($request->user('seller')->markEmailAsVerified()) {
            event(new Verified($request->user('seller')));
        }

        return redirect()->intended(route('seller.index').'?verified=1');
    }
}
