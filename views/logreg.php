<script src="https://code.jquery.com/jquery-3.6.3.slim.js" integrity="sha256-DKU1CmJ8kBuEwumaLuh9Tl/6ZB6jzGOBV/5YpNE2BWc=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../styles/logreg.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
<link rel='stylesheet' type='text/css' href='https://kit-pro.fontawesome.com/releases/v5.13.0/css/pro.min.css'>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<div class="logreg">
    <div id='log' class="log">

        <form action="../controller/register.php" method="post">
            <h2>Register</h2>
            <label for="name">Username:</label>
            <input id='username2' autocomplete="off" type="text" name="name" placeholder="Username" />
            <label for="pass">Password:</label>
            <p><input id="pass3" placeholder="Password" type="password" name="pass" />
                <i class="far fa-eye" id="togglePassword3"></i>
            </p>
            <label for="pass2">Confirm Password:</label>
            <p><input id="pass2" placeholder="Confirm Password" type="password" name="pass2" />
                <i class="far fa-eye" id="togglePassword2"></i>
            </p>
            <input type="submit" name="submit" value="Register" />
            <div class="switch" id='switchreg'><span>Login Instead?</span></div>
        </form>
    </div>

    <div id='reg' class="reg">

        <form action="../controller/login" method="post">
            <h2>Login</h2>
            <label for="name">Username:</label>
            <input autocomplete="off" type="text" placeholder="Username" name="name" />

            <label for="pass">Password:</label>
            <p>
                <input id='pass1' placeholder="Password" type="password" name="pass" />
                <i class="far fa-eye" id="togglePassword1"></i>
            </p>
            <input type="submit" name="submit" value="Login" />
            <div class="switch" id='switchlog'><span>Register Instead?</span></div>
        </form>
    </div>
    <div class="anonymous">
        <a href="../controller/anonymous">Continue as Anonymous</a>
    </div>
    <div id="messages" class="messages"></div>
</div>
<script src='../includes/logreg.js'></script>