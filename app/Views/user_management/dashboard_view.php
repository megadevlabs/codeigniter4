<?= $this->extend('layouts/base'); ?>

<?php /*$this->section('show_username');*/ ?>
<!-- <span>Welcome to <?php /*echo $userdata->username;*/ ?></span> -->
<?php /*$this->endSection();*/ ?>

<?= $this->section('mycontent'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="jumbotron jumbotron-fluid">
      <div class="container-fluid">
        <?php if ($userdata->profile_pic !== '') : ?>
          <img class="py-4" height='180' src="" alt="Avatar Image">
        <?php else : ?>
          <img class="py-4" height='180' src="<?= base_url(); ?>public/images/avatar.png" alt="Avatar Image">
        <?php endif; ?>
        <h2 class="display-3 fw-bold">Welcome to <?= $userdata->username; ?></h2>
        <h4 class="display-7 fw-bold">Mobile - <?= $userdata->mobile; ?></h4>
        <h4 class="display-7 fw-bold">Email - <?= $userdata->email; ?></h4>
        <hr class="my-2">
        <p>More info</p>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>