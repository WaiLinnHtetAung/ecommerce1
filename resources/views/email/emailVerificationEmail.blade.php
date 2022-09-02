<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div style="display: flex;justify-content:center;align-item:center;">
        <div style="padding:50px;border:1px solid #bbb;border-radius:12px">
            <h1>Email Verification Mail</h1>
            Please verify your email with bellow link:
            <a
                href="{{ route('email.verify', ['id' => $user->id, 'email_verification_code' => $user->email_verification_code]) }}">Verify
                Email</a>
        </div>

    </div>
</body>

</html>
