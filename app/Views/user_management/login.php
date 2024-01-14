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
    <h3 class="py-4"><?= $pageHeading ?></h3>
    <?php /*if (isset($validation)) :*/ ?>
    <h5><?php /*$validation->listErrors();*/ ?></h5>
    <?php /*endif;*/ ?>

    <?php if ($page_session->getTempdata('success')) : ?>
      <div id="hideMsg" class="alert alert-success"><?= $page_session->getTempdata('success'); ?></div>
    <?php endif; ?>

    <?php if ($page_session->getTempdata('error')) : ?>
      <div id="hideMsg" class="alert alert-error"><?= $page_session->getTempdata('error'); ?></div>
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
          //echo validation_error($validation, 'username');
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
      <input type="submit" class="btn btn-primary" value="Login">
      <a href="">Forgot Password?</a>
    </div>
    </div>

    <div class="form-group">
      <a href="">Login With Google</a>
    </div>
    </div>

    <div class="form-group">
      <a href="">Login With Facebook</a>
    </div>

    <?= form_close() ?>
  </section>
  <?= $this->endSection(); ?>