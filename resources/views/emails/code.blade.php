<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verify Account</title>
</head>

<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#0d2c54;">
    <table align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin:auto;">
        <tr>
            <td align="center" style="padding: 15px; color:#ffffff; font-size:14px;">

            </td>
        </tr>
    </table>
    <!-- Container -->
    <table align="center" cellpadding="0" cellspacing="0" width="100%"
        style="max-width: 600px; margin: auto; margin-top: 30px; background-color: #ffffff; border-radius: 10px;">
        <tr>
            <td align="center" style="padding: 20px;">
                <div style="text-align: center; margin-top: 25px; margin-bottom: 20px;">
                    <img src="{{ asset('images/dost.png') }}" alt="tag"
                        style="width: 80px; height: 80px; margin-right: 20px;">
                    <img src="{{ asset('images/bagongpilipinas.png') }}" alt="tag" style="width: 80px; height: 80px;">
                </div>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding: 30px 20px 20px 20px;">
                <p style="margin:0; margin-bottom: 30px; font-size: 14px; color:#333;">
                    <b>We have generated an email code that you can use to login to your account.</b>
                </p>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding: 20px; margin-top: 0px;">
                <button type="button" style="background-color:#0056b3; color:#ffffff; text-decoration:none; padding:12px 24px; font-size:14px; font-weight:bold; border-radius:4px; display:inline-block;">
                    {{$code}}
                </button>
            </td>
        </tr>

        <tr>
            <td align="center"
                style="padding: 20px; color:#888; text-align: center; font-size: 11px; color: #777; border-top: 1px solid #eee; background: #fafafa; border-radius: 10px;">
                <p style="margin:0;">
                    TasweerHub will never ask for sensitive information such as One-Time PIN (OTP) or passwords via email
                    or SMS.
                    Please do not entertain calls or messages asking for such information.
                    This is a system-generated email. DO NOT reply to this message.
                </p>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <table align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin:auto;">
        <tr>
            <td align="center" style="padding: 15px; color:#ffffff; font-size:14px;">
                TasweerHub Dev
            </td>
        </tr>
    </table>

</body>

</html>
