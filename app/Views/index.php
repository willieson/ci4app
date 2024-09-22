<?php
$status = session()->get('status');

if ($status == 'true') {
?>

  <?= $this->extend('headfoot'); ?>
  <?= $this->section('content'); ?>

  <section class="first-box">
    <div class="container">
      <div class="row">
        <div class="col">
          <h1>Welcome <?= session()->get('name'); ?> </h1>
        </div>
      </div>
    </div>
  </section>

  <?= $this->endSection(); ?>

<?php
} else {
  return redirect()->to('/login');
}
?>