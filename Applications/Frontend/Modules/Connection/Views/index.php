<?php $this->html()->js('isotope.min.js'); ?>
<?php $this->html()->js('jquery.infinitescroll.min.js'); ?>

<div class="mt30">
  <div id="container">
    <?php foreach ($colleagues as $colleague): ?>
      <div class="post">
          <a href="<?php echo $this->html()->url('colleague/'.$colleague->id()); ?>" data-toggle="modal">
              <div class="picture">
                  <?php
                  $photo = '/img/colleagues/'.$colleague->id().'.jpg';
                  if (file_exists(WEBROOT.$photo)) {
                      ?><img src="<?php echo $this->html()->url($photo); ?>" alt="<?php echo $colleague->first_name(). ' ' .$colleague->name(); ?>"><?php
                  } else {
                      ?><img src="<?php echo $this->html()->url('/img/nophoto.jpg'); ?>" alt="No photo"><?php
                  }
                  ?>
              </div>
              <div class="information">
                <h5>
                  <?php echo $colleague->first_name(); ?> <?php echo $colleague->name(); ?>
                </h5>

                <p><?php echo $colleague->id(); ?></p>
              </div>
          </a>
      </div>
    <?php endforeach ?>
  </div>
</div>
