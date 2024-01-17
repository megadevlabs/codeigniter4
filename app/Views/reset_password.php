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
        <span class="input-group-text col-4" id="basic-addon1">New Password</span>
        <input type="text" class="form-control" placeholder="New Password" aria-label="New Password" aria-describedby="basic-addon1" name="password" value="<?= set_value('password'); ?>">
        <span style="color: red;">
          <?php
          // if (isset($validation)) {
          //   if ($validation->hasError('password')) {
          //     echo $validation->getError('password');
          //   }
          // }

          // get Validation Function from Form_helper
          //echo validation_error($validation, 'password');
          ?>
        </span>
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-4" id="basic-addon1">Confirm Password</span>
        <input type="text" class="form-control" placeholder="Confirm New Password" aria-label="Confirm New Password" aria-describedby="basic-addon1" name="cpassword" value="<?= set_value('cpassword'); ?>">
        <span style="color: red;">
          <?php
          // if (isset($validation)) {
          //   if ($validation->hasError('cpassword')) {
          //     echo $validation->getError('cpassword');
          //   }
          // }

          // get Validation Function from Form_helper
          //echo validation_error($validation, 'cpassword');
          ?>
        </span>
      </div>
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-primary mr-4" name="update" value="Reset Password">
    </div>

    <?= form_close() ?>
  </section>
</div>
<?= $this->endSection(); ?>