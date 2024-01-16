<?= $this->extend("layouts/base"); ?>
<?= $this->section("mycontent"); ?>
<div class="container-fluid">
  <section id="body-area">
    <h3 class="py-4"><?= $pageinfo->pageHeading ?></h3>

    <?php if (isset($validation)) : ?>
      <div class="alert alert-danger">
        <?= $validation->listErrors(); ?>
      </div>
    <?php endif; ?>

    <?= form_open_multipart(); ?>
    <div class="col-4">
      <div class="input-group mb-3">
        <span class="input-group-text col-3" id="basic-addon1">Avatar Upload </span>
        <input type="file" class="form-control" placeholder="Avatar Upload" aria-label="Avatar Upload" aria-describedby="basic-addon1" name="avatar[]" multiple="multiple">
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

      <div class="form-group mb-3">
        <input type="submit" class="btn btn-primary mr-4" value="Upload">
      </div>

    </div>
    <?= form_close(); ?>

  </section>
</div>
<?= $this->endSection(); ?>