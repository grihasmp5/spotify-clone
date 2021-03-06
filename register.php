<?php
    include("includes/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");
    
    $account = new Account($con);

    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");
 
    function getInputValue($name) {
        if (isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Slotify</title>

    <link rel="stylesheet" type="text/css" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>

<body>
    
<?php
    if(isset($_POST['registerButton'])) {
      echo '<script>
            $(document).ready(function() {
            $("#loginForm").hide();
            $("#registerForm").show();
        });
        </script>';
    }
    else {
      echo '<script>
            $(document).ready(function() {
            $("#loginForm").show();
            $("#registerForm").hide();
        });
        </script>';
        
    }
?>        

    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <!-- Login form -->
                <form action="register.php" method="POST" id="loginForm">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFail); ?>
                        <label for="loginUsername">Username: </label>
                            <input type="text" id="loginUsername" name="loginUsername" placeholder="e.g. rickSanchez" value="<?php getInputValue('loginUsername') ?>"
                            required>
                    </p>
                    <p>
                        <label for="loginPassword">Password:</label>
                        <input type="password" id="loginPassword" name="loginPassword" placeholder="e.g. Sanchez123"
                            required>
                    </p>

                    <button type="submit" name="loginButton">LOG IN</button>

                    <div class="hasAccountText">

                        <span id="hideLogin">Don't have an account yet ? Signup
                            here.
                        </span>

                    </div>

                </form>

                <!-- Register form -->
                <form action="register.php" autocomplete="off" method="POST" id="registerForm">
                    <h2>Create your free account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$usernameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>
                        <label for="registerUsername">Username: </label>
                        <input type="text" id="registerUsername" name="registerUsername"
                            value="<?php getInputValue("registerUsername") ?>" placeholder="e.g. rickSanchez" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                        <label for="firstName">First Name: </label>
                        <input type="text" id="firstName" name="firstName" value="<?php getInputValue('firstName') ?>"
                            placeholder="e.g. Rick" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                        <label for="lastName">Last Name: </label>
                        <input type="text" id="lastName" name="lastName" value="<?php getInputValue('lastName') ?>"
                            placeholder="e.g. Sanchez" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>
                        <label for="email">Email: </label>
                        <input type="email" id="email" name="email" value="<?php getInputValue('email') ?>"
                            placeholder="e.g. rick@gmail.com" required>
                    </p>
                    <p>
                        <label for="email2">Confirm Email: </label>
                        <input type="email" id="email2" name="email2" value="<?php getInputValue('email2') ?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordCharacters); ?>
                        <label for="registerPassword">Password:</label>
                        <input type="password" id="registerPassword" name="registerPassword"
                            placeholder="e.g. stupidMorty123" required>
                    </p>
                    <p>
                        <label for="registerPassword2">Confirm Password: </label>
                        <input type="password" id="registerPassword2" name="registerPassword2" required>
                    </p>

                    <button type="submit" name="registerButton">SIGN UP</button>

                    <div class="hasAccountText">
                        <span id="hideRegister">Already have an account ? Login here</span>
                    </div>

                </form>
            </div>
            
            <div id="loginText">
                <h1>Get great music right now</h1>
                <h2>Get great music right now</h2>
                <ul>
                    <li>Discover music you'll fall in love with</li>
                    <li>Create your own playlist</li>
                    <li>Follow artists to keep up to date</li>
                </ul>
            </div>
        
        </div>
    </div>
</body>

</html>
