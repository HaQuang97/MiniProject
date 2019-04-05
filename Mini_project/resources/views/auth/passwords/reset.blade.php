<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Reset Password</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
        h1,h3{
            text-align: center;
        }
        .p1{
            display: block;
            float: left;
        }
        .in1{
            float: left;
            padding-left: 25px;
        }
        .confirm-password{
            clear:left;
            padding-left: 630px;
        }
        .p2{
            display: block;
            float: left;
        }
        .in2{
            float: left;
            padding-left: 5px;
        }
        .btnSubmit{
            clear: left;
        }
        .new-password{
            padding-left: 630px;
        }
    </style>
    <script language="JavaScript">
        function checkPw(form){
             pw1 = form.pw1.value;
             pw2 = form.pw2.value;
            if (pw1 != pw2) {
                alert ("\nYou did not enter the same new password twice. Please confirm password your password.")
                return false;
            }
            else return true;
        }
    </script>
</head>
<body>
    <div class="title">
        <h1>Reset Password</h1>
    </div>
    <form action="{!! route('confirm.password'); !!}" method="POST" onsubmit="return checkPw(this)">
        <div class="content">
            <h3>Please enter your new password in the form below</h3>
            <div class="new-password" align="center">
                <p class="p1">New Password :</p>
                <div class="in1">
                    <input name="pw1" type="password">
                </div>

            </div>
            <div class="confirm-password" align="center">
                <p class="p2">Confirm Password :</p>
                <div class="in2">
                    <input name="pw2" type="password">
                </div>

            </div>
            <div class="btnSubmit" align="center">
                <input type="submit" value="Submit" >
            </div>

        </div>
    </form>
</body>
</html>