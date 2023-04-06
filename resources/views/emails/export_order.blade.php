<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <center>
        <div>
            <h1>تم استلام طلب تصدير جديد</h1>
            <p>تم استلام طلب جديد وحالته الان قيد التدقيق وسيتم التواصل معكم من قبل ادارة التطبيق لاحقا</p>
            <br />
            <br />
            <table border="1" width="100%;">
                <tr>
                    <td>الاسم</td>
                    <td>{{ $name }}</td>
                </tr>
                <tr>
                    <td>البريد الالكتروني</td>
                    <td>{{ $email }}</td>
                </tr>
                <tr>
                    <td>الرسالة </td>
                    <td>{{ $message }}</td>
                </tr>
                <tr>
                    <td>رقم التواصل </td>
                    <td>{{ $phonenumber }}</td>
                </tr>
            </table>
            <br />
        </div>
    </center>
</body>

</html>
