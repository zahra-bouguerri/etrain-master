 <?php include "./includes/header.php"?>
 <!-- FIRST CASE-->
        <h1 class="p-relative">لوحة التحكم</h1>
        <div class="wrapper d-grid gap-20">
          <!-- Start Welcome Widget -->
          <div class="welcome bg-white rad-10 txt-c-mobile block-mobile">
            <div class="intro p-20 d-flex space-between bg-eee">
              <div>
                <h2 class="m-0">مرحباً</h2>
                <p class="c-grey mt-5">الزيرو</p>
              </div>
              <img class="hide-mobile" src="imgs/welcome.png" alt="" />
            </div>
            <img src="./assets/imgs/avatar.png" alt="" class="avatar" />
            <div class="body txt-c d-flex p-20 mt-20 mb-20 block-mobile">
              <div>أسامة الزيرو <span class="d-block c-grey fs-14 mt-10">مطور</span></div>
              <div>80 <span class="d-block c-grey fs-14 mt-10">مشروع</span></div>
              <div>$8500 <span class="d-block c-grey fs-14 mt-10">مكسب</span></div>
            </div>
            <a href="profile.html" class="visit d-block fs-14 bg-blue c-white w-fit btn-shape">الملف الشخصي</a>
          </div>
          <!-- End FIRST CASE -->
          <!-- SECOND CASE-->
          <div class="quick-draft p-20 bg-white rad-10">
            <h2 class="mt-0 mb-10">مسودة سريعة</h2>
            <p class="mt-0 mb-20 c-grey fs-15">اكتب مسودة لأفكارك</p>
            <form>
              <input class="d-block mb-20 w-full p-10 b-none bg-eee rad-6" type="text" placeholder="عنوان" />
              <textarea class="d-block mb-20 w-full p-10 b-none bg-eee rad-6" placeholder="أفكارك"></textarea>
              <input class="save d-block fs-14 bg-blue c-white b-none w-fit btn-shape" type="submit" value="Save" />
            </form>
          </div>
        
          <!--end SECOND CASE-->
          <div class="latest-uploads p-20 bg-white rad-10">
            <h2 class="mt-0 mb-20">أحدث التحميلات</h2>
            <ul class="m-0">
              <li class="between-flex pb-10 mb-10">
                <div class="d-flex align-center">
                  <img class="mr-10" src="imgs/pdf.svg" alt="" />
                  <div>
                    <span class="d-block">ملفي.pdf</span>
                    <span class="fs-15 c-grey">الزيرو</span>
                  </div>
                </div>
                <div class="bg-eee btn-shape fs-13">2.9 ميجابايت</div>
              </li>
              <li class="between-flex pb-10 mb-10">
                <div class="d-flex align-center">
                  <img class="mr-10" src="imgs/avi.svg" alt="" />
                  <div>
                    <span class="d-block">ملف الفيديو.avi</span>
                    <span class="fs-15 c-grey">المشرف</span>
                  </div>
                </div>
                <div class="bg-eee btn-shape fs-13">4.9 ميجابايت</div>
              </li>
              <li class="between-flex pb-10 mb-10">
                <div class="d-flex align-center">
                  <img class="mr-10" src="imgs/psd.svg" alt="" />
                  <div>
                    <span class="d-block">ملف Psd.pdf</span>
                    <span class="fs-15 c-grey">أسامة</span>
                  </div>
                </div>
                <div class="bg-eee btn-shape fs-13">4.5 ميجابايت</div>
              </li>
              <li class="between-flex pb-10 mb-10">
                <div class="d-flex align-center">
                  <img class="mr-10" src="imgs/zip.svg" alt="" />
                  <div>
                    <span class="d-block">ملف Zip.pdf</span>
                    <span class="fs-15 c-grey">المستخدم</span>
                  </div>
                </div>
                <div class="bg-eee btn-shape fs-13">8.9 ميجابايت</div>
              </li>
              <li class="between-flex pb-10 mb-10">
                <div class="d-flex align-center">
                  <img class="mr-10" src="imgs/dll.svg" alt="" />
                  <div>
                    <span class="d-block">ملف DLL.pdf</span>
                    <span class="fs-15 c-grey">المشرف</span>
                  </div>
                </div>
                <div class="bg-eee btn-shape fs-13">4.9 ميجابايت</div>
              </li>
              <li class="between-flex">
                <div class="d-flex align-center">
                  <img class="mr-10" src="imgs/eps.svg" alt="" />
                  <div>
                    <span class="d-block">ملف EPS.pdf</span>
                    <span class="fs-15 c-grey">المصمم</span>
                  </div>
                </div>
                <div class="bg-eee btn-shape fs-13">8.9 ميجابايت</div>
              </li>
            </ul>
          </div>
          <!-- Start Ticket Widget -->
     <!-- بداية عنصر واجهة تذكرة الدعم -->
<div class="tickets p-20 bg-white rad-10">
  <h2 class="mt-0 mb-10">إحصائيات المستخدمين</h2>
  <p class="mt-0 mb-20 c-grey fs-15">كل شيء عن المستخدمين </p>
  <div class="d-flex txt-c gap-20 f-wrap">
    <div class="box p-20 rad-10 fs-13 c-grey">
      <i class="fa-regular fa-rectangle-list fa-2x mb-10 c-orange"></i>
      <span class="d-block c-black fw-bold fs-25 mb-5">2500</span>
      العدد الاجمالي للدروس 
    </div>
    <div class="box p-20 rad-10 fs-13 c-grey">
      <i class="fa-solid fa-spinner fa-2x mb-10 c-blue"></i>
      <span class="d-block c-black fw-bold fs-25 mb-5">500</span>
      العدد الاجمالي للاساتذة
    </div>
    <div class="box p-20 rad-10 fs-13 c-grey">
      <i class="fa-regular fa-circle-check fa-2x mb-10 c-green"></i>
      <span class="d-block c-black fw-bold fs-25 mb-5">1900</span>
      المشتركين
    </div>
    <div class="box p-20 rad-10 fs-13 c-grey">
      <i class="fa-regular fa-rectangle-xmark fa-2x mb-10 c-red"></i>
      <span class="d-block c-black fw-bold fs-25 mb-5">100</span>
      العدد الاجمالي للاسئلة
    </div>
  </div>
</div>
<!-- نهاية عنصر واجهة تذكرة الدعم -->

          <!-- End Ticket Widget -->          
        
        </div>
         <!-- Start 2 EME LIGNE-->
        
         <div class="projects p-20 bg-white rad-10 m-20">
          <h2 class="mt-0 mb-20">منهج الرياضيات الخاص بالسنة اولى ثانوي علمي</h2>
          <div class="responsive-table">
            <table class="fs-15 w-full">
              <thead>
                <tr>
                  <td>الوحدات التعليمية</td>
                  <td>الوحدات الجزئية</td>
                  <td>الدروس</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td rowspan="3">الوحدة التعلمية الاولى</td>
                  <td>الوحدة الجزئية الاولى</td>
                  <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
                </tr>
                <tr>
                  <td>الوحدة الجزئية الثانية</td>
                  <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
                </tr>
                <tr>
                  <td>الوحدة الجزئية الثالثة</td>
                  <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
                </tr>
                <tr>
                  <td rowspan="3">الوحدة التعلمية الثانية</td>
                  <td>الوحدة الجزئية الاولى</td>
                  <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
                </tr>
                <tr>
                  <td>الوحدة الجزئية الثانية</td>
                  <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
                </tr>
                <tr>
                  <td>الوحدة الجزئية الثالثة</td>
                  <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
                </tr>
                <tr>
                  <td rowspan="3">الوحدة التعلمية الثالثة</td>
                  <td>الوحدة الجزئية الاولى</td>
                  <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
                </tr>
                <tr>
                  <td>الوحدة الجزئية الثانية</td>
                  <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
                </tr>
                <tr>
                  <td>الوحدة الجزئية الثالثة</td>
                  <td>الدرس الاول</br>الدرس الثاني</br>الدرس الثالث</br>الدرس الرابع</br></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
              </div>
          <!--END 2 EME LIGNE -->
        </div>
      </div>
    </div>
  </body>
  <script src="./assets/js/script.js"></script>
</html>
<!-- Start latest uploads-->

</div>
