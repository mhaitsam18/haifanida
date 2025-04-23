{{-- resources/views/emails/forgot-password.blade.php --}}

@component('mail::message')
    # Reset Kata Sandi

    Anda menerima email ini karena kami menerima permintaan untuk mereset kata sandi akun Anda.

    @component('mail::button', ['url' => $resetLink])
        Reset Kata Sandi
    @endcomponent

    Jika Anda tidak merasa melakukan permintaan ini, Anda bisa mengabaikan email ini.

    Terima kasih,<br>
    {{ config('app.name') }}
@endcomponent
