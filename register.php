<?php
class User
{
    public $id;
    public $Username;
    public $email;
    public $password;

    public function __construct($Username, $email, $password)
    {
        $this->Username = $Username;
        $this->email = $email;
        $this->password = $password;
    }
}
$errors = [];
$show_alert = (isset($_REQUEST['show_alert'])) ? $_REQUEST['show_alert'] : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Username   = $_REQUEST['Username'];
    $email      = $_REQUEST['email'];
    $password   = $_REQUEST['password'];

    if ($Username == "") {
        $errors['username'] = " Username is required field !";
    }
    if ($email    == "") {
        $errors['email'] = " Email is required field !";
    }
    if ($password == "") {
        $errors['password'] = " Password is required field !";
    }
    if (count($errors) == 0) {

        $objUser = new User($Username, $email, $password);
        $objUser->Username     = $Username;
        $objUser->email        = $email;
        $objUser->password     = $password;
        $objUser->id     = time();


        $fileJson = "uuser.json";
        $user = $_REQUEST;
        $users = file_get_contents($fileJson);
        if ($users == " ") {
            $users = [];
        } else {
            $users = json_decode($users, true);
        }

        $users[] = $objUser;
        $data = json_encode($users);
        file_put_contents($fileJson, $data);
        header("Location: login.php?show_alert=1");
    }
    
}
?>
<!DOCTYPE html>
<html>
<div class="container">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: black;
        }

        * {
            box-sizing: border-box;
        }

        /* Add padding to containers */
        .container {
            padding: 16px;
            background-color: white;
        }

        /* Full-width input fields */
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Overwrite default styles of hr */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for the submit button */
        .registerbtn {
            background-color: #04AA6d;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity: 1;
        }

        /* Add a blue text color to links */
        a {
            color: dodgerblue;
        }

        /* Set a grey background color and center the text of the "sign in" section */
        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }
    </style>
</div>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <?php if ($show_alert) : ?>
        <div class="btn btn-info" role="alert">
            Đăng ký thành công, vui lòng nhấn vào <a href="login.php">đây</a>
            để tới trang đăng nhập
        </div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="container">
            <h1 class="text-center">Register</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Username" name="Username" id="Username" required>
            <small class="form-text text-danger">
                <?= (isset($errors['username'])) ? $errors['username'] : " "; ?>
            </small>
            <label for="psw"><b>Password</b></label>
            <input type="text" placeholder="Enter email" name="email" id="email" required>
            <small class="form-text text-danger">
                <?= (isset($errors['email'])) ? $errors['email'] : " "; ?>
            </small>
            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="password" id="psw-repeat" required>
            <small class="form-text text-danger">
                <?= (isset($errors['password'])) ? $errors['password'] : ""; ?>
            </small>
            <hr>
            <p>By creating an account you agree to our <a href="trangtrolai.php">Terms & Privacy</a>.</p>

            <button type="submit" class="registerbtn"><a href="trangtrolai.php"></a>Register</button>
        </div>

        <div class="container signin">
            <p>Already have an account? <a href="trangtrolai.php">Sign in</a>.</p>
        </div>
    </form>

</body>

</html>