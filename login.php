<?php
session_start();
$json_users = file_get_contents('uuser.json');
if ($json_users) {
  $users = json_decode($json_users);
} else {
  $users = [];
}
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];

  $can_do = true;
  if (count($errors) === 0) {
    foreach ($users as $user) {
      if ($user->email == $email|| $user->password == $password) {
        
        $_SESSION['user'] = $user;
        $can_do = false;
        header("Location: user.php");
      } else {
        header("Location: trangtrolai.php");
      }
    }
  }
}
?>
<div class="container">
  <div class="row">
    <div class="col-1g-12">
      <h3 class="text-center">login</h3>
      <?php if ($user) :?>
        <div class="alert alert-success" role="alert">
      <?= $user = (empty($user)) ?   "  " . $user : " You have successfully registered !" ; ?>
        </div>
      <?php endif; ?>
      <form action="" method="POST">
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <button type="submit" class="form-control btn btn-info">login</button><hr>
        <button type="submit" class="form-control btn btn-danger"><a href="register.php"></a>clone</button>
      </form>

      <body>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      </body>

      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      </head>
      <style>
        form {
          width: 100%;
          border: 2px solid rgb(153, 168, 153);
          padding: 20px;
          margin: 0 auto;
          font-weight: 100%;
        }

        form label {
          width: 50px;
          padding: 13px;
        }

        body {
          background: rgb(213, 555, 999);
          height: 100%;
          width: 100%;
        }

        input[type=text],
        select {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
        }

        input[type=submit] {
          width: 100%;
          background-color: #4CAF50;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          border-radius: 4px;
          cursor: pointer;
        }

        input[type=submit]:hover {
          background-color: #45a049;
        }

        div {
          border-radius: 5px;
          background-color: #f2f2f2;
          padding: 20px;
        }
      </style>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">