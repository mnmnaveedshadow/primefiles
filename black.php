<?php
include 'includes/header.inc.php'; ?>
<?php include 'includes/navbar.inc.php';

$sql="SELECT * FROM tbl_job";
$rs=$conn->query($sql);


if(ismobile()){
  $image = "images/mob_banner.jpeg";
}
else {
  $image = "images/banner3.jpeg";
}
?>


  <main class="main-content">
    <!--== Start Hero Area Wrapper ==-->
    <section class="home-slider-area">
      <img src="<?= $image ?>" style="width:100%;" alt="">
      <div class="container pt--0 pb--0">
        <div class="row">
          <div class="col-12">
            <div class="play-video-btn">
              <a href="https://www.youtube.com/watch?v=NPe3BUsq1K0" class="video-popup">
                <img src="assets/img/icons/play.png" alt="Image-HasTech">
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Hero Area Wrapper ==-->

    <?php
      if(isMobile()){
    ?>

    <div class="whatsapp">
        <a href="https://wa.me/+97451065170?text=I'm%20interested%20in%20Appling%20Job%20for%20DohaConsulting.com">
            <img src="icons/whatsapp.png" style="width:40px;" alt="">
        </a>
    </div>
    <?php }else{ ?>

    <div class="whatsapp_desktop">
        <a href="https://wa.me/+97451065170?text=I'm%20interested%20in%20Appling%20Job%20for%20DohaConsulting.com">
            <img src="icons/whatsapp.png" style="width:40px;" alt="">
        </a>
    </div>
      <?php } ?>
<br>
<div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="images/new.jpeg" style="width:100%;" alt="">
            </div>
            <div class="col-lg-6">
              <br>
                <h3>Join Us At The QTM 2023</h3>
                <br>
                <p>We are delighted to extend a warm invitation to you to join us at the Made In Qatar 2023 Exhibition.
                   This prestigious event is scheduled to take place from November 29th to December 2nd, 2023, at the Doha Exhibition and Convention Center.</p>
                    <hr>
                    <p>Our team is excited to meet you at the venue. for more information, please feel free to call us on +974 5106 5170 </p>
            </div>
        </div>
</div>

    <!--== Start Job Category Area Wrapper ==-->
    <section class="work-process-area">
      <div class="container" data-aos="fade-down">
        <div class="row">
          <div class="col-12">
            <div class="section-title text-center" >
              <h3 class="title">How It Works?</h3>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="working-process-content-wrap">
              <div class="working-col">
                <!--== Start Work Process ==-->
                <div class="working-process-item">
                  <div class="icon-box">
                    <div class="inner">
                      <img class="icon-img" src="assets/img/icons/w1.png" alt="Image-HasTech">
                      <img class="icon-hover" src="assets/img/icons/w1-hover.png" alt="Image-HasTech">
                    </div>
                  </div>
                  <div class="content">
                    <h4 class="title">Create an Account</h4>
                  </div>
                  <div class="shape-arrow-icon">
                    <img class="shape-icon" src="assets/img/icons/right-arrow.png" alt="Image-HasTech">
                    <img class="shape-icon-hover" src="assets/img/icons/right-arrow2.png" alt="Image-HasTech">
                  </div>
                </div>
                <!--== End Work Process ==-->
              </div>
              <div class="working-col">
                <!--== Start Work Process ==-->
                <div class="working-process-item">
                  <div class="icon-box">
                    <div class="inner">
                      <img class="icon-img" src="assets/img/icons/w2.png" alt="Image-HasTech">
                      <img class="icon-hover" src="assets/img/icons/w2-hover.png" alt="Image-HasTech">
                    </div>
                  </div>
                  <div class="content">
                    <h4 class="title">Create & Upload CV</h4>
                  </div>
                  <div class="shape-arrow-icon">
                    <img class="shape-icon" src="assets/img/icons/right-arrow.png" alt="Image-HasTech">
                    <img class="shape-icon-hover" src="assets/img/icons/right-arrow2.png" alt="Image-HasTech">
                  </div>
                </div>
                <!--== End Work Process ==-->
              </div>
              <div class="working-col">
                <!--== Start Work Process ==-->
                <div class="working-process-item">
                  <div class="icon-box">
                    <div class="inner">
                      <img class="icon-img" src="assets/img/icons/w3.png" alt="Image-HasTech">
                      <img class="icon-hover" src="assets/img/icons/w3-hover.png" alt="Image-HasTech">
                    </div>
                  </div>
                  <div class="content">
                    <h4 class="title">Find Jobs </h4>
                  </div>
                  <div class="shape-arrow-icon">
                    <img class="shape-icon" src="assets/img/icons/right-arrow.png" alt="Image-HasTech">
                    <img class="shape-icon-hover" src="assets/img/icons/right-arrow2.png" alt="Image-HasTech">
                  </div>
                </div>
                <!--== End Work Process ==-->
              </div>
              <div class="working-col">
                <!--== Start Work Process ==-->
                <div class="working-process-item">
                  <div class="icon-box">
                    <div class="inner">
                      <img class="icon-img" style="color:#000;" src="assets/img/icons/w4.png" alt="Image-HasTech">
                      <img class="icon-hover" src="assets/img/icons/w4-hover.png" alt="Image-HasTech">
                    </div>
                  </div>
                  <div class="content">
                    <h4 class="title">Save & Apply</h4>
                  </div>
                  <div class="shape-arrow-icon d-none">
                    <img class="shape-icon" src="assets/img/icons/right-arrow.png" alt="Image-HasTech">
                    <img class="shape-icon-hover" src="assets/img/icons/right-arrow2.png" alt="Image-HasTech">
                  </div>
                </div>
                <!--== End Work Process ==-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Job Category Area Wrapper ==-->

    <!--== Start Recent Job Area Wrapper ==-->
    <section class="recent-job-area bg-color-gray" style="background-image:url('images/job_bg.jpg?v=1');background-size:cover;background-repeat:no-repeat;background-attachment:fixed;">
      <div class="container" data-aos="fade-down">
        <div class="row">
          <div class="col-12">
            <div class="section-title text-center">
              <div style="margin-top:-80px;background:rgba(1, 4, 21, 0.5);padding:15px 10px 10px 10px;border-radius:20px;">
                <h3 class="title" style="color:#fff;opacity:1;">Recent Job Circulars</h3>
              </div>
            </div>
          </div>
        </div>
        <div class="row">

          <?php
          $sqlJobs="SELECT * FROM `tbl_job` ORDER BY `tbl_job`.`j_id` DESC LIMIT 0,8";
          $rsJobs=$conn->query($sqlJobs);

          while ($rowJobs=$rsJobs->fetch_assoc()) {
           ?>

          <div class="col-md-3 col-lg-3">
            <!--== Start Recent Job Item ==-->


            <img src="admin/job_images/<?= $rowJobs['job_img'] ?>" style="width:100%;" alt="">
            <div class="recent-job-item">
            <div class="main-content" style="margin-top:-20px;">
                <h6><?= shorter($rowJobs['j_title'],20) ?></h6>
              </div>
              <div class="recent-job-info" style="margin-bottom:-20px;">
                <a class="btn-theme btn-sm" href="job-details.php?j_id=<?= $rowJobs['j_id'] ?>">Apply Now</a>
              </div>
            </div>
            <!--== End Recent Job Item ==-->
          </div>

        <?php } ?>
      </div>

        </div>
      </div>
    </section>
    <!--== End Recent Job Area Wrapper ==-->

    <!--== Start Work Process Area Wrapper ==-->

    <!--== End Work Process Area Wrapper ==-->

    <!--== Start Divider Area Wrapper ==-->
    <!-- <section class="sec-overlay sec-overlay-theme bg-img" data-bg-img="assets/img/photos/bg1.jpg">
      <div class="container ">
        <div class="row justify-content-center divider-style1">
          <div class="col-lg-10 col-xl-7">
            <div class="divider-content text-center">
              <h4 class="sub-title" data-aos="fade-down">Trial Version Available</h4>
              <h2 class="title" data-aos="fade-down">Download Our Mobile App. <br>You Can Ready Resume & Apply Job.</h2>
              <div class="divider-btn-group">
                <a class="btn-divider" data-aos="fade-down" href="page-not-found.php">
                  <img src="assets/img/photos/google-play.png" width="201" height="63" class="icon" alt="Image-HasTech">
                </a>
                <a class="btn-divider btn-divider-app-store" data-aos="fade-down" href="page-not-found.php">
                  <img src="assets/img/photos/mac-os.png" width="201" height="63" class="icon" alt="Image-HasTech">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-layer-style1"></div>
      <div class="bg-layer-style2"></div>
    </section> -->
    <!--== End Divider Area Wrapper ==-->

    <!--== Start Team Area Wrapper ==-->

    <!--== End Team Area Wrapper ==-->

    <!--== Start Brand Logo Area Wrapper ==-->
    <!-- <div class="brand-logo-area">
      <div class="container pt--0 pb--0" data-aos="fade-down">
        <div class="row">
          <div class="col-12">
            <div class="brand-logo-content" >
              <div class="swiper brand-logo-slider-container">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="brand-logo-item">
                      <img src="companyLogo/1.png" alt="Image-HasTech">
                    </div>

                  </div>
                  <div class="swiper-slide">
                  <div class="brand-logo-item">
                    <img src="companyLogo/2.png" alt="Image-HasTech">
                  </div>
                  </div>
                  <div class="swiper-slide">
                  <div class="brand-logo-item">
                    <img src="companyLogo/3.jfif" alt="Image-HasTech">
                  </div>
                  </div>
                  <div class="swiper-slide">
                  <div class="brand-logo-item">
                    <img src="companyLogo/4.png" alt="Image-HasTech">
                  </div>
                  </div>
                  <div class="swiper-slide">
                  <div class="brand-logo-item">
                    <img src="companyLogo/5.jfif" alt="Image-HasTech">
                  </div>
                  </div>
                  <div class="swiper-slide">
                  <div class="brand-logo-item">
                    <img src="companyLogo/6.jfif" alt="Image-HasTech">
                  </div>
                  </div>
                  <div class="swiper-slide">
                  <div class="brand-logo-item">
                    <img src="companyLogo/7.png" alt="Image-HasTech">
                  </div>
                  </div>
                </div>
              </div>
              <div class="swiper-btn-wrap">
                <div class="brand-swiper-btn-prev">
                  <i class="icofont-long-arrow-left"></i>
                </div>
                <div class="brand-swiper-btn-next">
                  <i class="icofont-long-arrow-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!--== End Brand Logo Area Wrapper ==-->

    <!--== Start Testimonial Area Wrapper ==-->

    <!--== End Testimonial Area Wrapper ==-->

    <!--== Start Blog Area Wrapper ==-->
    <section class="blog-area blog-home-area">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title text-center">
              <h3 class="title">Blogs</h3>
            </div>
          </div>
        </div>
        <div class="row align-items-center post-home-style row-gutter-40">
          <?php

           $sqlBlogs = "SELECT * FROM tbl_blogs ORDER BY `tbl_blogs`.`b_id` DESC";
          $rsBlogs = $conn->query($sqlBlogs);


          if ($rsBlogs->num_rows > 0) {
            $rowBlog = $rsBlogs->fetch_assoc();  ?>
          <div class="col-md-6 col-lg-4" data-aos="fade-right">
            <!--== Start Blog Post Item ==-->
            <div class="post-item">
              <div class="thumb">
                <a href="blog-details.php?bid=<?= $rowBlog['b_id'] ?>"><img src="admin/blogImages/<?= $rowBlog['blog_image'] ?>" alt="Image" style="width:100%;height:270px;"></a>
              </div>
              <div class="content">
                <div class="author">By <?= $rowBlog['b_author'] ?></div>
                <h4 class="title"><a href="blog-details.php?bid=<?= $rowBlog['b_id'] ?>"><?= $rowBlog['b_title'] ?></a></h4>
                <p><?= shorter($rowBlog['b_description'],40) ?></p>
                <div class="meta">
                  <span class="post-date"><?= $rowBlog['b_upload_date'] ?></span>
                  <span class="dots"></span>
                  <span class="post-time"><?= $rowBlog['b_read_time'] ?> min Read Time</span>
                </div>
              </div>
            </div>
            <!--== End Blog Post Item ==-->
          </div>
        <?php } ?>
          <div class="col-md-6 col-lg-4" data-aos="fade-left">
            <!--== Start Blog Post Item ==-->
            <div class="post-item">
              <div class="thumb mb--0">
                <a href="blog-right-sidebar.php"><img src="blogImages/dohamidblogimage.jpg?V=01" alt="Image" width="370" height="440"></a>
              </div>
            </div>
            <!--== End Blog Post Item ==-->
          </div>
          <?php

           $sqlBlogs = "SELECT * FROM tbl_blogs ORDER BY `tbl_blogs`.`b_id` DESC LIMIT 1,2";
          $rsBlogs = $conn->query($sqlBlogs);


          if ($rsBlogs->num_rows > 0) {
            $rowBlog = $rsBlogs->fetch_assoc();  ?>
          <div class="col-md-6 col-lg-4" data-aos="fade-right">
            <!--== Start Blog Post Item ==-->
            <div class="post-item">
              <div class="thumb">
                <a href="blog-details.php?bid=<?= $rowBlog['b_id'] ?>"><img src="admin/blogImages/<?= $rowBlog['blog_image'] ?>" alt="Image" style="width:100%;height:270px;"></a>
              </div>
              <div class="content">
                <div class="author">By <?= $rowBlog['b_author'] ?></div>
                <h4 class="title"><a href="blog-details.php?bid=<?= $rowBlog['b_id'] ?>"><?= $rowBlog['b_title'] ?></a></h4>
                <p><?= shorter($rowBlog['b_description'],40) ?></p>
                <div class="meta">
                  <span class="post-date"><?= $rowBlog['b_upload_date'] ?></span>
                  <span class="dots"></span>
                  <span class="post-time"><?= $rowBlog['b_read_time'] ?> min Read Time</span>
                </div>
              </div>
            </div>
            <!--== End Blog Post Item ==-->
          </div>
        <?php } ?>
        </div>
      </div>
    </section>
    <!--== End Blog Area Wrapper ==-->
  </main>

<?php include 'includes/footer.inc.php'; ?>
