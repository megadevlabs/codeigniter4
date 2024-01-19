<?php
$page_session = \Config\Services::session();
?>
<?= $this->extend('layouts/base'); ?>

<?php /*$this->section('show_username');*/ ?>
<!-- <span>Welcome to <?php /*echo $userdata->username;*/ ?></span> -->
<?php /*$this->endSection();*/ ?>

<?= $this->section('mycontent'); ?>
<div class="container-fluid">
  <div class="row">

    <h4 class="mt-4"><?= $pageinfo->pageHeading; ?></h4>

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

    <?php if (count($employees) > 0) : ?>
    <?php else : ?>
      <h5>Sorry! No Employees Found.</h5>
    <?php endif; ?>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Mobile</th>
          <th scope="col">Salary</th>
          <th scope="col">Designation</th>
          <th scope="col">City</th>
          <th scope="col">Created_at</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($employees as $emp) : ?>
          <tr>
            <th scope="row"><?= $emp->id; ?></th>
            <th scope="row"><?= $emp->name; ?></th>
            <td><?= $emp->email; ?></td>
            <td><?= $emp->mobile; ?></td>
            <td><?= $emp->salary; ?></td>
            <td><?= $emp->designation; ?></td>
            <td><?= $emp->city; ?></td>
            <td><?= $emp->created_at; ?></td>
            <td>
              <a href="<?= base_url(); ?>employee/editemp/<?= $emp->id; ?>" class="btn btn-info">Edit</a>
              <a href="<?= base_url(); ?>employee/deleteemp/<?= $emp->id; ?>" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>

  </div>
</div>
<?= $this->endSection(); ?>