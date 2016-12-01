<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>

    <table>
        <tbody>
            <tr>
                <td style="padding:0;font-family:'Segoe UI Light','Segoe UI','Helvetica Neue Medium',Arial,sans-serif;font-size:41px;color:#2672ec">驗證您的電子信箱地址</td>
            </tr>
            <tr></tr>
            <tr>
                <td style="padding:0;padding-top:25px;font-family:'Segoe UI',Tahoma,Verdana,Arial,sans-serif;font-size:14px;color:#2a2a2a">若要完成 APAR 網站使用者的註冊，我們必須確定此電子信箱地址是您的。</td>
            </tr>
            <tr></tr>
            <tr>
                <td bgcolor="#2672ec" style="background-color:#2672ec;padding-top:5px;padding-right:20px;padding-bottom:5px;padding-left:20px;min-width:50px">
                    <a style="font-family:'Segoe UI Semibold','Segoe UI Bold','Segoe UI','Helvetica Neue Medium',Arial,sans-serif;font-size:14px;text-align:center;text-decoration:none;font-weight:600;letter-spacing:0.02em;color:#fff" href="{{ url("register/verify/{$confirmation_code}") }}" target="_blank">
                        驗證 <span dir="ltr">{{ $email }}</span>
                    </a>
                </td>
            </tr>
            <tr>
                <td style="padding:0;padding-top:25px;font-family:'Segoe UI',Tahoma,Verdana,Arial,sans-serif;font-size:14px;color:#2a2a2a">謝謝您！</td>
            </tr>
            <tr>
                <td style="padding:0;font-family:'Segoe UI',Tahoma,Verdana,Arial,sans-serif;font-size:14px;color:#2a2a2a">APAR 研究團隊</td>
            </tr>
        </tbody>
    </table>

</div>

</body>
</html>