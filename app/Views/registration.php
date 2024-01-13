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
  <section id="header">
    <h1>Website Header</h1>
  </section>
  <section id="body-area">
    <h1><?= $pageHeading ?></h1>
    <?php /*if (isset($validation)) :*/ ?>
    <h5><?php /*$validation->listErrors();*/ ?></h5>
    <?php /*endif;*/ ?>

    <?php if ($page_session->getTempdata('success')) : ?>
      <div id="hideMsg" style="background-color: green; color:white; padding:10px 20px;"><?= $page_session->getTempdata('success'); ?></div>
    <?php endif; ?>

    <?php if ($page_session->getTempdata('error')) : ?>
      <div id="hideMsg" style="background-color: red; color:white; padding:10px 20px;"><?= $page_session->getTempdata('error'); ?></div>
    <?php endif; ?>

    <?= form_open() ?>
    <p>
      Username : <input type="text" name="username" id="username" value="<?= set_value('username'); ?>">
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
    </p>
    <p>
      Email : <input type="email" name="email" id="email" value="<?= set_value('email'); ?>">
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
    </p>
    <p>
      Mobile : <input type="text" name="mobile" id="mobile" value="<?= set_value('mobile'); ?>">
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
    </p>
    <p>
      Password : <input type="text" name="password" id="password" value="<?= set_value('password'); ?>">
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
    </p>
    <input type="submit" value="Create Account">
    <?= form_close() ?>
  </section>
  <?= $this->endSection(); ?>