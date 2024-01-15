<?= $this->extend('layouts/base'); ?>

<?php /*$this->section('show_username');*/ ?>
<!-- <span>Welcome to <?php /*echo $userdata->username;*/ ?></span> -->
<?php /*$this->endSection();*/ ?>

<?= $this->section('mycontent'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="jumbotron jumbotron-fluid">
      <div class="container-fluid">
        <h2 class="display-3 fw-bold">Welcome to <?= $userdata->username; ?></h2>
        <?php if ($userdata->profile_pic !== '') : ?>
          <img class="py-4" height='180' src="" alt="Avatar Image">
        <?php else : ?>
          <img class="py-4" height='180' src="<?= base_url(); ?>public/images/avatar.png" alt="Avatar Image">
        <?php endif; ?>
        <h4 class="display-6 fw-bold">Mobile - <?= $userdata->mobile; ?></h4>
        <h4 class="display-6 fw-bold">Email - <?= $userdata->email; ?></h4>
        <hr class="my-2">
        <p>More info</p>
        <p class="lead">
          <a class="btn btn-danger btn-lg" href="<?= base_url(); ?>/dashboard/logout" role=" button">Logout</a>
        </p>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>