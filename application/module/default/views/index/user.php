<?php
    $linkLogin      = URL::createLink('default', 'index', 'login');
    $linkRegister   = URL::createLink('default', 'index', 'register');
    $linkReset      = URL::createLink('default', 'index' , 'renew', null, 'renew');
// MESSAGE
$message	= Session::get('message');
Session::delete('message');
$strMessage = Helper::cmsMessage($message);



$userInfo       = Session::get('user');

    ?>
<div id="fh5co-user">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                                    <div id="system-message-container"><?php echo $strMessage . $this->error . $this->errorActive;?></div>
                <div class="fh5co-tabs animate-box">
                    <div class="wrapper">
                        <div class="form-wrapper sign-up">
                            <form action="<?php echo $linkRegister?>" id="form-register" method="post">
                                <div class="input">
                                    <input type="text" required id="name" name="form[fullname]">
                                    <label for="">Fullname</label>
                                </div>
                                <div class="input">
                                    <input type="text" required id="email" name="form[email]">
                                    <label for="">Email</label>
                                </div>
                                <div class="input">
                                    <input type="text" required id="username-register" name="form[username]">
                                    <label for="">Username</label>
                                </div>
                                <input type="hidden" name="form[token]" value="<?php echo time()?>">
                                <div class="form-group">
                                    <input type="submit" name="form[submit]" value="Submit" class="btn-sign btn-primary">
                                </div>
                                <div class="sign-link">
                                    <p>Already have an account? <a class="signIn-link">Sign In</a></p>
                                </div>
                            </form>
                        </div>

                        <div class="form-wrapper sign-in">
                            <form action="<?php echo $linkLogin?>" method="post" id="form-login">
                                <div class="row form-group">
                                    <div class="input">
                                        <input type="text" required id="username" name="form[username]" class="form-control">
                                        <label for="">Username</label>
                                    </div>
                                    <div class="input">
                                        <input type="password" required id="password" name="form[password]" class="form-control">
                                        <label for="">Password</label>
                                    </div>
                                    <div class="forgot-pass">
                                        <a href="<?php echo $linkReset?>">Forgot Password?</a>
                                    </div>
                                    <input name="form[token]" type="hidden" value="<?php echo time(); ?>"/>
                                    <input type="submit" value="Login" class="btn-sign btn-primary">
                                    <div class="sign-link">
                                        <p>Don't have an account? <a class="signUp-link">Sign Up</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(-45deg   , gainsboro, #d1c286);
    }

    .wrapper {
        position: relative;
        width: 400px;
        height: 500px;
    }

    .form-wrapper {
        position: absolute;
        top: 10%;
        left: 75%;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);

    }

    .wrapper.animate-signUp .form-wrapper.sign-in {
        transform: rotate(7deg);
        animation: animateRotate .7s ease-in-out forwards;
        animation-delay: .3s;
    }

    .wrapper.animate-signIn .form-wrapper.sign-in {
        animation: animateSignIn 1.5s ease-in-out forwards;
    }

    @keyframes animateSignIn {
        0% {
            transform: translateX(0);
        }

        50% {
            transform: translateX(-500px);
        }

        100% {
            transform: translateX(0) rotate(7deg);
        }
    }

    .wrapper .form-wrapper.sign-up {
        transform: rotate(7deg);
    }

    .wrapper.animate-signIn .form-wrapper.sign-up {
        animation: animateRotate .7s ease-in-out forwards;
        animation-delay: .3s;
    }

    @keyframes animateRotate {
        0% {
            transform: rotate(7deg);
        }

        100% {
            transform: rotate(0);
            z-index: 1;
        }
    }

    .wrapper.animate-signUp .form-wrapper.sign-up {
        animation: animateSignUp 1.5s ease-in-out forwards;
    }

    @keyframes animateSignUp {
        0% {
            transform: translateX(0);
            z-index: 1;
        }

        50% {
            transform: translateX(500px);
        }

        100% {
            transform: translateX(0) rotate(7deg);
        }
    }

    h2 {
        font-size: 30px;
        color: #555;
        text-align: center;
    }

    .input {
        position: relative;
        width: 320px;
        margin: 30px 0;
    }

    .input label {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        font-size: 16px;
        color: #333;
        padding: 0 5px;
        pointer-events: none;
        transition: .5s;
    }

    .input input {
        width: 100%;
        height: 40px;
        font-size: 16px;
        color: #333;
        padding: 0 10px;
        background: transparent;
        border: 1px solid #333;
        outline: none;
        border-radius: 5px;
    }

    .input input:focus~label,
    .input input:valid~label {
        top: 0;
        font-size: 12px;
        background: #fff;
        z-index: 10;
    }

    .forgot-pass {
        margin: -15px 0 15px;
    }

    .btn-sign {
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        height: 40px;
        background: linear-gradient(to right, gainsboro, #d1c286);
        box-shadow: 0 2px 10px rgba(0, 0, 0, .4);
        font-size: 16px;
        color: #fff;
        font-weight: 500;
        cursor: pointer;
        border-radius: 5px;
        border: none;
        outline: none;
    }

    .forgot-pass a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
    }

    .forgot-pass a:hover {
        text-decoration: underline;
    }

    .sign-link {
        font-size: 14px;
        text-align: center;
        margin: 25px 0;
    }

    .sign-link p {
        color: #333;
    }

    .sign-link p a {
        color: #d1c286;
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
    }

    .sign-link p a:hover {
        text-decoration: underline;
    }</style>


<script type="text/javascript">

    const wrapper = document.querySelector('.wrapper');
    const signUpLink = document.querySelector('.signUp-link');
    const signInLink = document.querySelector('.signIn-link');

    signUpLink.addEventListener('click', () => {
        wrapper.classList.add('animate-signIn');
        wrapper.classList.remove('animate-signUp');
    });

    signInLink.addEventListener('click', () => {
        wrapper.classList.add('animate-signUp');
        wrapper.classList.remove('animate-signIn');
    });
</script>

