<nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid d-flex justify-content-between">
    <div class="d-flex align-items-center">
      <img src="<?= base_url('image/navbar-logo.png') ?>" alt="" width="80">
      <a class="navbar-brand fs-4 fw-semibold" href="#">Sistem informasi Kasir</a>
    </div>
    <div id="navbarNav" class="px-3">
      <ul class="navbar-nav">
        <li class="nav-item d-flex align-items-center">
          <?php if (logged_in()) : ?>
            <a class="auth btn fs-5 fw-semibold" aria-current="page" href="/logout">
              <i class="bi bi-box-arrow-right fs-5"></i>
            </a>
          <?php else : ?>
            <a class="auth btn fs-5 fw-semibold" aria-current="page" href="/login">
              <i class="bi bi-door-open-fill"></i>
            </a>
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>