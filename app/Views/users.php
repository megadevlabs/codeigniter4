  <?= $this->extend("layouts/base.php"); ?>
  <?= $this->section("mycontent"); ?>

  <section id="header">
    <h1>Website Header</h1>
  </section>
  <section id="body-area">
    <h1><?= $pageHeading ?></h1>
    <h3>Users List</h3>
    <?php
      print_r($users);
      foreach($users AS $user){
        echo "<h4>Username: {$user->email} Password: {$user->phone}</h4>";
      }
    ?>

  </section>

  <?= $this->endSection(); ?>