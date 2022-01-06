<?php
session_start();
echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

$id = (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) ? $_REQUEST["id"] : "";

$json_users = file_get_contents('uuser.json');
if ($json_users) {
    $users = json_decode($json_users);
} else {
    $users = [];
}
foreach ($users as $key => $user) {
    if ($user->id == $id) {
        unset($users[$key]);
        break;
    }
}
$_SESSION['alert'] = " Xóa thành công ID: $user->id. <br /> Tên: $user->Username.<br /> Email: $user->email ";

$users = array_values($users);
$userString = json_encode($users);
file_put_contents("uuser.json", $userString);
header("location: user.php");