<?php
session_start();
$json_users = file_get_contents('uuser.json');
if ($json_users) {
    $users = json_decode($json_users);
} else {
    $users = [];
}

// echo "<pre>";
// print_r($users);
// echo "</pre>";
$errors = [];
// khai báo biến id để nhận biến id ở $_REQUEST["id"]
$id = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? $_REQUEST["id"] : "";
if (!$id) {
    header("location:login.php");
}
$users = json_decode($json_users);
// tìm id user để tìm đc user của cái id đó 
$foundId    = "";
foreach ($users as $key => $user) {
    if ($user->id == $id) {
        $foundId = $user;
        break;
    }
}
echo "<pre>";
print_r($foundId);
echo "</pre>";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Username  =  $_REQUEST['Username'];
    $email     =  $_REQUEST['email'];
    $password  =  $_REQUEST['password'];

    if ($Username == '') {
        $errors['Username'] = 'Username is required field !';
    }

    if ($email == '') {
        $errors['email'] = 'Email is required field !';
    }

    if ($password == '') {
        $errors['password'] = 'Password is required field !';
    }

    if (count($errors) == 0) {
        $data = $_REQUEST;
        foreach ($users as $key => $user) {
            if ($user->id == $id) {
                $users[$key]->email         = $data["email"];
                $users[$key]->password      = $data["password"];
                $users[$key]->Username      = $data["Username"];
                break;
            }
        }
        $_SESSION['alert'] = "Cập nhật thành công tài khoản: $user->Username  " ;
        $userString = json_encode($users);
        $_SESSION ['user'] = $foundId;
        file_put_contents("uuser.json", $userString);
        header("location: user.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" value="<?= $foundId->Username ?>" name="Username">
        <input type="text" value="<?= $foundId->email ?>" name="email">
        <input type="text" value="<?= $foundId->password ?>" name="password">
        <button type="submit" class="btn btn-danger">submit </button>
    </form>
</body>

</html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">