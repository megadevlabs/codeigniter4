<?= $this->extend('layouts/base'); ?>

<?= $this->section('mycontent'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="jumbotron jumbotron-fluid">
      <div class="container-fluid">
        <div style="display:block;height:80vh;">
          <h2 class="display-3 fw-bold">Welcome to CI4 Home Page</h2>
          <h1>CodeIgniter Version <?= CodeIgniter\CodeIgniter::CI_VERSION ?></h1>
          <hr class="my-2">
          <p>More info</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>