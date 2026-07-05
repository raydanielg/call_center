<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class PasswordResetController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'No account found with this email address.',
        ]);

        $email = $request->email;

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $token = Str::random(60);

        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'code' => $code,
            'created_at' => Carbon::now(),
        ]);

        $this->sendCodeEmail($email, $code);

        return redirect()->route('password.code', ['email' => base64_encode($email)])
            ->with('status', 'A 6-digit activation code has been sent to your email. The code expires in 15 minutes.');
    }

    public function showCodeForm(Request $request)
    {
        $emailEncoded = $request->query('email');
        $email = $emailEncoded ? base64_decode($emailEncoded) : null;

        if (!$email) {
            return redirect()->route('password.request')
                ->with('error', 'Invalid request. Please try again.');
        }

        return view('auth.passwords.code', ['email' => $email]);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|size:6',
        ]);

        $email = $request->email;
        $code = $request->code;

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('code', $code)
            ->first();

        if (!$record) {
            return back()->withErrors(['code' => 'Invalid activation code.'])->withInput();
        }

        $created = Carbon::parse($record->created_at);
        if ($created->addMinutes(15)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('password.request')
                ->with('error', 'The activation code has expired. Please request a new one.');
        }

        return redirect()->route('password.reset', [
            'token' => $record->token,
            'email' => $email,
        ]);
    }

    public function resendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->email;

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $token = Str::random(60);

        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'code' => $code,
            'created_at' => Carbon::now(),
        ]);

        $this->sendCodeEmail($email, $code);

        return back()->with('status', 'A new activation code has been sent to your email.');
    }

    public function showResetForm(Request $request, $token = null)
    {
        $email = $request->query('email') ?? old('email');

        if (!$email || !$token) {
            return redirect()->route('password.request')
                ->with('error', 'Invalid reset link. Please request a new one.');
        }

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$record) {
            return redirect()->route('password.request')
                ->with('error', 'Invalid or expired reset link. Please request a new one.');
        }

        $created = Carbon::parse($record->created_at);
        if ($created->addMinutes(15)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('password.request')
                ->with('error', 'The reset link has expired. Please request a new one.');
        }

        return view('auth.passwords.reset', ['token' => $token, 'email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $email = $request->email;
        $token = $request->token;

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$record) {
            return back()->withErrors(['email' => 'Invalid reset token.'])->withInput();
        }

        $created = Carbon::parse($record->created_at);
        if ($created->addMinutes(15)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('password.request')
                ->with('error', 'The reset link has expired. Please request a new one.');
        }

        $user = \App\Models\User::where('email', $email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('login')
            ->with('status', 'Your password has been reset successfully. Please sign in with your new password.');
    }

    private function sendCodeEmail(string $email, string $code): void
    {
        $appName = config('app.name', 'Laravel');

        $htmlBody = View::make('auth.emails.password-reset', ['code' => $code, 'email' => $email])->render();

        $textBody = "{$appName}\n\n"
            . "You requested a password reset.\n\n"
            . "Your activation code is: {$code}\n\n"
            . "This code expires in 15 minutes.\n\n"
            . "If you did not request this, please ignore this email.\n\n"
            . "© " . date('Y') . " {$appName}. All rights reserved.";

        $boundary = md5(time() . $email);

        $headers = [];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-Type: multipart/alternative; boundary="' . $boundary . '"';
        $headers[] = 'From: ' . $appName . ' <noreply@' . config('app.url', 'localhost') . '>';
        $headers[] = 'Reply-To: noreply@' . config('app.url', 'localhost');
        $headers[] = 'X-Mailer: PHP/' . phpversion();
        $headers[] = 'X-Priority: 1';

        $message = "--{$boundary}\n"
            . "Content-Type: text/plain; charset=UTF-8\n"
            . "Content-Transfer-Encoding: 7bit\n\n"
            . $textBody . "\n\n"
            . "--{$boundary}\n"
            . "Content-Type: text/html; charset=UTF-8\n"
            . "Content-Transfer-Encoding: 7bit\n\n"
            . $htmlBody . "\n\n"
            . "--{$boundary}--";

        @mail($email, 'Password Reset Activation Code - ' . $appName, $message, implode("\r\n", $headers));
    }
}
