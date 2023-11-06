<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\I18n\Time;

use function auth;
use function hash_equals;
use function hash_hmac;
use function sha1;

class VerifyEmailController extends BaseController
{
    /**
     * Mark the authenticated users email addres as verified.
     *
     * @return RedirectResponse
     */
    public function index(string $hash)
    {
        // Check first if user email already verified
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->to(session('intended') ?? config('Auth')->home);
        }

        // Check if hash equal with current user email.
        if (!hash_equals($hash, sha1(auth()->user()->email))) {
            return redirect()->route('verification.notice')->with('error', lang('Passwords.token'));
        }

        $signature = hash_hmac('sha256', auth()->user()->email, config('Encryption')->key);

        // Check signature key
        if (!hash_equals($signature, $this->request->getVar('signature'))) {
            return redirect()->route('verification.notice')->with('error', lang('Passwords.token'));
        }

        // Check for token if expired
        if ($this->request->getVar('expires') < Time::now()->getTimestamp()) {
            return redirect()->route('verification.notice')->with('error', lang('Passwords.expired'));
        }

        auth()->user()->markEmailAsVerified();

        Events::trigger('fireVerifiedUser', auth()->user());

        // O usuário estava tentando comprar um plano?
        if (session()->has('choice')) {
            // Sim... então redirecionamos ele para a mesma rota de compra
            return redirect()->to(session('choice'));
        }

        return redirect()->to(session('intended') ?? config('Auth')->home);
    }
}
