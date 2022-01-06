<?php
session_start();

$json_users = file_get_contents('uuser.json');
if ($json_users) {
  $users = json_decode($json_users);
} else {
  $users = [];
}
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : ' ';

$alert = (isset($_SESSION['alert']) && !empty($_SESSION['alert'])) ? $_SESSION['alert'] : "";
?>
<audio controls autoplay style="width: 0%">
  <source src="y2mate.com - Lyric HD Bài Ca Tuổi Trẻ  JGKiD KraziNoyze Emcee L Da LAB Vũ Bùi Thu Thủy Linh Cáo Mel G.mp3" type="">
</audio>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="text-center">Users</h3>
      <?php if ($user) : ?>
        <div class="alert alert-success" role="alert">
          <?php echo  $user = (empty($user)) ? " " : " Welcome account , " . $user->Username; ?>
        </div>
      <?php endif; ?>

      <?php if ($alert) : ?>
        <div class="btn btn-danger" role="alert">
          <?php echo (empty($alert)) ? " " :  $alert; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <table class="table">

          <thead>
            <tr>
              <th scope="col"><b>STT</b></th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">Action</th>
            </tr>
          </thead>

          <tbody>

            <?php foreach ($users as $key => $user) :
            ?>
              <tr>
                <th scope="row"><?= $key + 1; ?></th>
                <td><?= $user->Username; ?></td>
                <td><?= $user->email; ?></td>
                <td>
                  <a href="edit.php?id=<?= $user->id; ?>" class="btn btn-info">Edit</a>
                  <a href="delete.php?id=<?= $user->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <style>
    body {
      background: rgb(221, 209, 999);
    }

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
  </style>
  <?php unset($_SESSION["alert"]); ?>