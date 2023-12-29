<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            if ($user->email_verified_at === null) {
                $user->sendEmailVerificationNotification();

                // $verificationLink = $this->generateVerificationLink($user);
                // Mail::to($user->email)->send(new VerificationEmail($verificationLink));

                return response()->json(['message' => 'Email verifikasi telah dikirim. Silakan cek email Anda.'], 200);
            } else {
                return response()->json(['message' => 'Email Anda sudah terverifikasi.'], 400);
            }
        } else {
            return response()->json(['message' => 'User dengan email tersebut tidak ditemukan.'], 404);
        }
    }

    private function generateVerificationLink($user)
    {
        $expires = now()->addMinutes(config('auth.verification.expire', 60));
        $hash = sha1($user->getEmailForVerification());

        return URL::temporarySignedRoute(
            'verification.verify',
            $expires,
            ['id' => $user->id, 'hash' => $hash]
        );
    }

    public function verifyEmail(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404, 'User not found.');
        }
        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link.');
        }
        if ($user->hasVerifiedEmail()) {
            return redirect('/login')->with('status', 'Email ini sudah diverifikasi');
        }
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        return redirect('/login')->with('success', 'Email berhasil diverifikasi');
    }
}
