<?= $this->extend('headfoot'); ?>
<?= $this->section('content'); ?>

<section class="first-box">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card mb-3">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="<?= !empty($user_data['profile_img']) ? esc('images/' . $user_data['profile_img']) : 'data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1921d4a71ba%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1921d4a71ba%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.41666603088379%22%20y%3D%22104.59999990463257%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E' ?>" class="card-img">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"><?= session()->get('name'); ?></h5>
                <p class="card-text">Address : <?= $user_data['address'] ?></p>
                <p class="card-text">role : <?= $user_data['role'] ?></p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


<section id='products'>
  <div class="container">
    <div class="row">
      <div class="col">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
              <img src="images/post-item1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="images/post-item2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="images/post-item3.jpg" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

      </div>
    </div>
  </div>

</section>
<?= $this->endSection(); ?>