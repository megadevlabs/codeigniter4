<?php
// echo "<pre>";
// print_r($errors);
// echo $pageinfo->pageTitle;
// exit;
$page_session = \Config\Services::session();
?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("mycontent"); ?>
<div class="container-fluid">
  <section id="body-area">
    <h3 class="py-4"><?= $pageinfo->pageHeading ?></h3>

    <?php if (!empty($errors)) : ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $field => $error) : ?>
          <p><?= $error; ?></p>
        <?php endforeach; ?>
      </div>
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
        <span class="input-group-text col-4" id="basic-addon1">Name</span>
        <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" name="name" value="<?= set_value('name'); ?>">
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-4" id="basic-addon1">Email</span>
        <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email" value="<?= set_value('email'); ?>">
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-4" id="basic-addon1">Mobile</span>
        <input type="text" class="form-control" placeholder="Mobile" aria-label="Mobile" aria-describedby="basic-addon1" name="mobile" value="<?= set_value('mobile'); ?>">
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-4" id="basic-addon1">Salary</span>
        <input type="text" class="form-control" placeholder="Salary" aria-label="Salary" aria-describedby="basic-addon1" name="salary" value="<?= set_value('salary'); ?>">
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-4" id="basic-addon1">Designation</span>
        <input type="text" class="form-control" placeholder="Designation" aria-label="Designation" aria-describedby="basic-addon1" name="designation" value="<?= set_value('designation'); ?>">
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-4" id="basic-addon1">City</span>
        <input type="text" class="form-control" placeholder="City" aria-label="City" aria-describedby="basic-addon1" name="city" value="<?= set_value('city'); ?>">
      </div>
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-primary mr-4" name="add" value="Add Employee">
    </div>

    <?= form_close() ?>
  </section>
</div>
<?= $this->endSection(); ?>