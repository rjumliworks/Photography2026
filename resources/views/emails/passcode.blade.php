<p>Good day {{ $user->username }},</p>

<p>Your account has been created and requires activation.</p>

<p>Please use the temporary password below to access your account:</p>

<p><strong>Temporary Password:</strong></p>

<h2 style="letter-spacing:3px;">{{ $code }}</h2>

<p>This temporary password will expire in 10 minutes and must be changed after logging in.</p>

<p>Regards,<br>{{ config('app.name') }}</p>
