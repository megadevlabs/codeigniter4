  <?php
  $page_session = \Config\Services::session();
  ?>
  <?= $this->extend("layouts/base"); ?>
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

    <?= form_open() ?>
    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-2" id="basic-addon1">Username</span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="username" value="<?= set_value('username'); ?>">
        <span style="color: red;">
          <?php
          // if (isset($validation)) {
          //   if ($validation->hasError('username')) {
          //     echo $validation->getError('username');
          //   }
          // }

          // get Validation Function from Form_helper
          echo validation_error($validation, 'username');
          ?>
        </span>
      </div>
    </div>

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
          echo validation_error($validation, 'email');
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
          echo validation_error($validation, 'password');
          ?>
        </span>
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-2" id="basic-addon1">C-Password</span>
        <input type="text" class="form-control" placeholder="Confirm Password" aria-label="cpassword" aria-describedby="basic-addon1" name="cpassword" value="<?= set_value('cpassword'); ?>">
        <span style="color: red;">
          <?php
          // if (isset($validation)) {
          //   if ($validation->hasError('cpassword')) {
          //     echo $validation->getError('cpassword');
          //   }
          // }

          // get Validation Function from Form_helper
          echo validation_error($validation, 'cpassword');
          ?>
        </span>
      </div>
    </div>

    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-2" id="basic-addon1">Mobile</span>
        <input type="text" class="form-control" placeholder="Mobile" aria-label="Mobile" aria-describedby="basic-addon1" name="mobile" value="<?= set_value('mobile'); ?>">
        <span style="color: red;">
          <?php
          // if (isset($validation)) {
          //   if ($validation->hasError('mobile')) {
          //     echo $validation->getError('mobile');
          //   }
          // }

          // get Validation Function from Form_helper
          echo validation_error($validation, 'mobile');
          ?>
        </span>
      </div>
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Create Account">
    </div>

    <?= form_close() ?>
  </section>
  <?= $this->endSection(); ?>