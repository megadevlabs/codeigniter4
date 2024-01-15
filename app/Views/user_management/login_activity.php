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
        <h2 class="display-3 fw-bold"> Welcome To <?= $userdata->username; ?> </h2>
        <h4 class="display-7 fw-bold">Mobile - <?= $userdata->mobile; ?></h4>
        <h4 class="display-7 fw-bold">Email - <?= $userdata->email; ?></h4>
        <hr class="mt-4">

      </div>
    </div>

    <h4 class="mt-4">Login Activity</h4>
    <?php if (count($login_info) > 0) : ?>
    <?php else : ?>
      <h5>Sorry! No Login Activity Found.</h5>
    <?php endif; ?>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Login Time</th>
          <th scope="col">Logout Time</th>
          <th scope="col">User Agent</th>
          <th scope="col">IP Address</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($login_info as $info) : ?>
          <tr>
            <th scope="row"><?= $info->id; ?></th>
            <td><?= date("l dS M Y h:i:s A", strtotime($info->login_time)); ?></td>
            <td><?= $info->logout_time; ?></td>
            <td><?= $info->agent; ?></td>
            <td><?= $info->ip; ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>

  </div>
</div>
<?= $this->endSection(); ?>