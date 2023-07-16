<?php include "./includes/header.php";?>
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="breadcrumb_iner text-center">
                      <div class="breadcrumb_iner_item">
                          <h2>تواصل معنا</h2>
                          <p class="breadcrumbs"><span class="mr-2"><a href="index.php">الرئيسية <i class="fa fa-chevron-left"></i></a></span> <span>تواصل معنا<i class="fa fa-chevron-left"></i></span></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- breadcrumb start-->

  <!-- ================ contact section start ================= -->
  <section class="contact-section section_padding">
    <div class="container">
  
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">تواصل معنا</h2>
        </div>
        <div class="col-lg-8">
          <form class="form-contact contact_form" action="contacter.php" method="post" id="contactForm" novalidate="novalidate">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'أدخل رسالتك'" placeholder="أدخل رسالتك"></textarea>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="nom" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'أدخل اسمك'" placeholder="أدخل اسمك">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'أدخل عنوان البريد الإلكتروني'" placeholder="أدخل عنوان البريد الإلكتروني">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'أدخل الموضوع'" placeholder="أدخل الموضوع">
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button button-contactForm btn_1">إرسال الرسالة</button>
            </div>
          </form>
        </div>
        <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>الجزائر.</h3>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3>00 (440) 9865 562</h3>
              
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3>mathprof214@gmail.com</h3>
              <p>أرسل استفسارك في أي وقت!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->
  
<?php include "./includes/footer.php"?>