<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="hero_area">





  <!-- price section -->
  <section class="price_section layout_padding">
    <div class="container">
      <div class="price_container">
        <?php foreach ($data['allItems'] as $zedka) : ?>
          <div class="box">
              <div class="name">
                <h6>
                <?= $zedka->name_product ?>
                </h6>
              </div>
              <div class="img-box ">
                <img  src="<?= URLROOT .'/img/upload/'. $zedka->img_product ?>" >
              </div>
              <div class="detail-box">
            
                <h5>
                  $ <span><?= $zedka->price_product ?></span>
                </h5>
                <a href="#">
                  Buy Now
                </a>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
    </section>

  <!-- end price section -->




  <?php require APPROOT . '/views/inc/footer.php'; ?>