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
        <span class="input-group-text col-4" id="basic-addon1">Username</span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="username" value="<?= $userdata->username; ?>">
        <span class="text-danger"> <?= validation_error($validation, 'username'); ?> </span>
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-4" id="basic-addon1">Mobile</span>
        <input type="text" class="form-control" placeholder="Mobile" aria-label="Mobile" aria-describedby="basic-addon1" name="mobile" value="<?= $userdata->mobile; ?>">
        <span class="text-danger"> <?= validation_error($validation, 'mobile'); ?> </span>
      </div>
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-primary mr-4" name="update" value="Update Profile">
    </div>

    <?= form_close() ?>
  </section>
</div>
<?= $this->endSection(); ?>