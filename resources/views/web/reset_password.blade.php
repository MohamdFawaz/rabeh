<html>
<link href="{{asset('assets/css/reset-password.css')}}" rel="stylesheet">
<div class="login">
    <div class="login-triangle"></div>

    <h2 class="login-header">Reset Password</h2>

    <form class="login-container" method="post" onsubmit="onFormSubmit()">
        {{ csrf_field() }}
        {{ method_field('post') }}
        <input type="hidden" name="email" value="{{$password_reset->email}}">
        <p><input type="password" id="password" name="password" placeholder="New Password"></p>
        <p><input type="password" onkeyup="checkIsNotValid()" id="confirm_password" placeholder="Confirm Password"></p>
        <p><span id="message"></span></p>
        <p><input type="submit" value="Reset Password"></p>
    </form>
</div>
<script>
    var checkIsNotValid = function() {
        if (document.getElementById('password').value !==
            document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Password Not Matching';
            return true;
        }else{
            document.getElementById('message').innerHTML = '';
            return false;
        }
    }

    var onFormSubmit = function (){
        if (checkIsNotValid()){
            event.preventDefault();
        }
    }
</script>
</html>
