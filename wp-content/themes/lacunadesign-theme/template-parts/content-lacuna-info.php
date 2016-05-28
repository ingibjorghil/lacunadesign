<div class="row">
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active carousel-1">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/img/carousel1.jpg" alt="building2">
        <div class="carousel-caption">
          <div class="col-sm-6 col-sm-offset-3">
            <div class="wrapper-box">
              <h3><?php the_field('headline_slide_1', 178); ?></h3>
              <p><?php the_field('text_slide_1', 178) ?></p>
              <a class="blog-link" href="<?php the_field('link_slide_1', 178) ?>"><?php the_field('link_text_slide_1', 178) ?></a>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/img/carousel2.jpg" alt="building">
        <div class="carousel-caption">
          ...
        </div>
      </div>
    
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="fa fa-angle-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="fa fa-angle-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>