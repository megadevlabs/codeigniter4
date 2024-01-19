<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $pageinfo->pageTitle ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url(); ?>">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="<?= base_url(); ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>

            <?php if (session()->has("logged_user")) : ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Uploads
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="<?= base_url(); ?>fileupload/">Single Upload</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a class="dropdown-item" href="<?= base_url(); ?>fileupload/multiupload">Multiple Uploads</a></li>
                  <div class="dropdown-divider"></div>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Employees
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="<?= base_url(); ?>employee/addemp/">Add Employee</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a class="dropdown-item" href="<?= base_url(); ?>employee/viewEmp">View Employee</a></li>
                  <div class="dropdown-divider"></div>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php /*$this->renderSection('show_username');*/ ?>
                  Welcome to <?php echo $userdata->username; ?>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="<?= base_url(); ?>dashboard/">Dashboard</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a class="dropdown-item" href="<?= base_url(); ?>dashboard/edit_profile">Edit Profile</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a class="dropdown-item" href="<?= base_url(); ?>dashboard/avatar">Upload Avatar</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a class="dropdown-item" href="<?= base_url(); ?>dashboard/change_password">Change Password</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a class="dropdown-item" href="<?= base_url(); ?>dashboard/login_activity">Login Activity</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a class="dropdown-item" href="<?= base_url(); ?>dashboard/logout">Logout</a></li>
                </ul>
              </li>
            <?php else : ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>users/registration">Registration</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>login">Login</a>
              </li>
            <?php endif; ?>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <div style="display:block;min-height:80vh;height:auto;">
      <?= $this->renderSection("mycontent"); ?>
    </div>

    <footer class="bg-dark mt-4">
      <p class="py-4 text-white text-center">&copy;Copyright 2023 - All right reserved.</p>
      <!-- <h5>Custom Library Use -> <?php /*$hosst;*/ ?></h5> -->
    </footer>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>