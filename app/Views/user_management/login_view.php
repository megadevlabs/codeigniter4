  <?php
  $page_session = \CodeIgniter\Config\Services::session();
  ?>
  <?= $this->extend("layouts/base.php"); ?>
  <?= $this->section("mycontent"); ?>
  <script>
    setTimeout(function() {
      $('#hideMsg').hide();
    }, 3000);
  </script>
  <section id="body-area">
    <h3 class="py-4"><?= $pageinfo->pageHeading ?></h3>
    <?php /*if (isset($validation)) :*/ ?>
    <h5><?php /*$validation->listErrors();*/ ?></h5>
    <?php /*endif;*/ ?>

    <?php if ($page_session->getTempdata('success')) : ?>
      <div id="hideMsg" class="alert alert-success"><?= $page_session->getTempdata('success'); ?></div>
    <?php endif; ?>

    <?php if ($page_session->getTempdata('error')) : ?>
      <div id="hideMsg" class="alert alert-danger"><?= $page_session->getTempdata('error'); ?></div>
    <?php endif; ?>

    <?php if (isset($validation)) : ?>
      <div class="alert alert-danger">
        <?= $validation->listErrors(); ?>
      </div>
    <?php endif; ?>

    <?= form_open() ?>
    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-2" id="basic-addon1">Email</span>
        <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email" value="<?= set_value('email'); ?>">
        <span style="color: red;">
          <?php
          // if (isset($validation)) {
          //   if ($validation->hasError('email')) {
          //     echo $validation->getError('email');
          //   }
          // }

          // get Validation Function from Form_helper
          //echo validation_error($validation, 'email');
          ?>
        </span>
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-2" id="basic-addon1">Password</span>
        <input type="text" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password" value="<?= set_value('password'); ?>">
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

    <div class="form-group">
      <input type="submit" class="btn btn-primary mr-4" value="Login">
      <a href="">Forgot Password?</a>
    </div>

    <?php /*if (isset($loginButton)) :*/ ?>
    <div class="form-group">
      <a href="<?php /*$loginButton;*/ ?>">
        <img src="<?= base_url('public/images/google.webp'); ?>" width="300" alt="Login With Google">
      </a>
    </div>
    <?php /*endif;*/ ?>

    <div class="form-group">
      <a href="">
        <img src="<?= base_url('public/images/facebook.png'); ?>" width="300" alt="Login With Facebook">
      </a>
    </div>

    <?= form_close() ?>
  </section>
  <?= $this->endSection(); ?>