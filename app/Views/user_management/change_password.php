<?php
$page_session = \Config\Services::session();
?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("mycontent"); ?>
<div class="container-fluid">
  <section id="body-area">
    <h3 class="py-4"><?= $pageinfo->pageHeading ?></h3>

    <?php if (isset($validation)) : ?>
      <div class="alert alert-danger"><?= $validation->listErrors(); ?></div>
    <?php endif; ?>

    <?php if ($page_session->getTempdata('success')) : ?>
      <div id="hideMsg" class="alert alert-success"><?= $page_session->getTempdata('success'); ?></div>
    <?php endif; ?>

    <?php if ($page_session->getTempdata('error')) : ?>
      <div id="hideMsg" class="alert alert-danger"><?= $page_session->getTempdata('error'); ?></div>
    <?php endif; ?>

    <?= form_open(); ?>
    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-4" id="basic-addon1">Old Password</span>
        <input type="text" class="form-control" placeholder="Old Password" aria-label="Old Password" aria-describedby="basic-addon1" name="oldpassword" value="<?= set_value('oldpassword'); ?>">
        <span style="color: red;">
          <?php
          // if (isset($validation)) {
          //   if ($validation->hasError('oldpassword')) {
          //     echo $validation->getError('oldpassword');
          //   }
          // }

          // get Validation Function from Form_helper
          //echo validation_error($validation, 'oldpassword');
          ?>
        </span>
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-4" id="basic-addon1">New Password</span>
        <input type="text" class="form-control" placeholder="New Password" aria-label="New Password" aria-describedby="basic-addon1" name="newpassword" value="<?= set_value('newpassword'); ?>">
        <span style="color: red;">
          <?php
          // if (isset($validation)) {
          //   if ($validation->hasError('newpassword')) {
          //     echo $validation->getError('newpassword');
          //   }
          // }

          // get Validation Function from Form_helper
          //echo validation_error($validation, 'newpassword');
          ?>
        </span>
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-4" id="basic-addon1">Confirm Password</span>
        <input type="text" class="form-control" placeholder="Confirm New Password" aria-label="Confirm New Password" aria-describedby="basic-addon1" name="cnewpassword" value="<?= set_value('cnewpassword'); ?>">
        <span style="color: red;">
          <?php
          // if (isset($validation)) {
          //   if ($validation->hasError('cnewpassword')) {
          //     echo $validation->getError('cnewpassword');
          //   }
          // }

          // get Validation Function from Form_helper
          //echo validation_error($validation, 'cnewpassword');
          ?>
        </span>
      </div>
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-primary mr-4" name="update" value="Change Password">
    </div>

    <?= form_close() ?>
  </section>
</div>
<?= $this->endSection(); ?>