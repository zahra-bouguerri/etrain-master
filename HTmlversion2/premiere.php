  <?php include "./includes/header.php" ?>
 <?php include "./includes/topmenu.php"?>
        
          <!-- fenetre flottante ADD  unit-->
          <div id="addUnitModal" class="modal">
            <div class="modal-content">
              <span class="close" onclick="closeAddUnitModal()">&times;</span>
              <h2>إضافة وحدة تعليمية</h2>
              <form>
                <label for="branch">الشعبة:</label><!-- Utilisation de <br /> au lieu de </br> -->
                <select id="branch" name="branch" required>
                  <option value="" disabled selected>اختر الشعبة</option>
                  <option value="علوم تجريبية">علوم تجريبية</option>
                  <option value="اداب">اداب</option>
                </select><br />
                <label for="branch">الشعبة:</label><!-- Utilisation de <br /> au lieu de </br> -->
                <select id="branch" name="branch" required>
                  <option value="" disabled selected>اختر الشعبة</option>
                  <option value="علوم تجريبية">علوم تجريبية</option>
                  <option value="اداب">اداب</option>
                </select><br /> <!-- Utilisation de <br /> au lieu de </br> -->
                <label for="unitName">ادخل اسم الوحدة:</label><br /> <!-- Utilisation de <br /> au lieu de </br> -->
                <input type="text" id="unitName" name="unitName" required><br /> <!-- Utilisation de <br /> au lieu de </br> -->
                <button type="submit">إضافة</button>
              </form>
            </div>
          </div>
  
            <div id="addPartModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeAddPartModal()">&times;</span>
                <h2>إضافة وحدة جزئية</h2>
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الشعبة</option>
                    <option value="علوم تجريبية">علوم تجريبية</option>
                    <option value="اداب">اداب</option>
                  </select>
                  <label for="branch">الوحدة التعلمية: </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة التعليمية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  <label for="unitName"> الوحدة الجزيئية  </label>
                  <input type="text" id="unitName" name="unitName" required>
                  <button type="submit">إضافة</button>
                </form>
              </div>
            </div>
  
            <div id="addCourModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeAddCourModal()">&times;</span>
                <h2>إضافة درس</h2>
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الشعبة</option>
                    <option value="علوم تجريبية">علوم تجريبية</option>
                    <option value="اداب">اداب</option>
                  </select>
                  <label for="branch">الوحدة التعلمية: </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة التعليمية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
  
                  <label for="branch">الوحدة الجزيئية : </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
  
                  <label for="unitName"> اضافة درس</label>
                  <input type="text" id="unitName" name="unitName" required>
                  <button type="submit">إضافة</button>
                </form>
              </div>
            </div>

            <!-- fenetre flottante delete -->
            <div id="DeleteUnitModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeDeleteUnitModal()">&times;</span>
                <h2>حذف وحدة تعليمية</h2>
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الشعبة</option>
                    <option value="علوم تجريبية">علوم تجريبية</option>
                    <option value="اداب">اداب</option>
                  </select>
                  <label for="unitName">اختر الوحدات المراد حذفها</label>
                  <div id="unitSelection">
                    <input type="checkbox" name="unit" value="وحدة 1">وحدة 1<br>
                    <input type="checkbox" name="unit" value="وحدة 2">وحدة 2<br>
                    <input type="checkbox" name="unit" value="وحدة 3">وحدة 3<br>
                    
                  </div>
                  <button type="submit">حذف</button>
                </form>
              </div>
            </div>
  
            <div id="DeletePartModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeDeletePartModal()">&times;</span>
                <h2> حذف وحدة جزئية</h2>
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الشعبة</option>
                    <option value="علوم تجريبية">علوم تجريبية</option>
                    <option value="اداب">اداب</option>
                  </select>
                  <label for="branch">الوحدة التعلمية: </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة التعليمية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  <label for="branch">الوحدة الجزيئية  المراد حذفها</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  
                  <button type="submit">حذف</button>
                </form>
              </div>
            </div>

            <div id="DeleteCourModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeDeleteCourModal()">&times;</span>
                <h2>حذف درس</h2>
                
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الشعبة</option>
                    <option value="علوم تجريبية">علوم تجريبية</option>
                    <option value="اداب">اداب</option>
                  </select>
                  <label for="branch">الوحدة التعلمية: </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة التعليمية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
  
                  <label for="branch">لوحدة الجزيئية : </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  <label for="unitName">الدروس المراد حذفها</label>
                  <div id="unitSelection">
                    <input type="checkbox" name="unit" value="وحدة 1">وحدة 1<br>
                    <input type="checkbox" name="unit" value="وحدة 2">وحدة 2<br>
                    <input type="checkbox" name="unit" value="وحدة 3">وحدة 3<br>
                    
                  </div>
                  <button type="submit">حذف</button>
                </form>
                 
              </div>
            </div>
  
             <!-- fenetre flottante eedit -->
             <div id="EditUnitModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeEditUnitModal()">&times;</span>
                <h2>تعديل وحدة تعليمية</h2>
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الشعبة</option>
                    <option value="علوم تجريبية">علوم تجريبية</option>
                    <option value="اداب">اداب</option>
                  </select>
                  <label for="unitName">اختر اسم الوحدة المراد تعديلها:</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة</option>
                    <option value="علوم تجريبية">تككامل</option>
                    <option value="اداب">تناسب </option>
                    <option value="اداب">استمرارية</option>
                  </select>
  
                  <label for="unitName">ادخل اسم الوحدة الجديدة :</label>
                  <input type="text" id="unitName" name="unitName" required>
  
                  <button type="submit">تعديل</button>
                </form>
              </div>
            </div>
  
            <div id="EditPartModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeEditPartModal()">&times;</span>
                <h2> تعديل وحدة جزئية</h2>
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الشعبة</option>
                    <option value="علوم تجريبية">علوم تجريبية</option>
                    <option value="اداب">اداب</option>
                  </select>
                  <label for="branch">الوحدة التعلمية: </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة التعليمية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  <label for="branch">الوحدة الجزيئية  المراد تعديلها</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  <label for="unitName">  الوحدة الجزيئية  الجديدة </label>
                  <input type="text" id="unitName" name="unitName" required>
                  <button type="submit">تعديل</button>
                </form>
              </div>
            </div>
  
            <div id="EditCourModal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeEditCourModal()">&times;</span>
                <h2>تعديل درس</h2>
                
                <form>
                  <label for="branch">الشعبة:</label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الشعبة</option>
                    <option value="علوم تجريبية">علوم تجريبية</option>
                    <option value="اداب">اداب</option>
                  </select>
                  <label for="branch">الوحدة التعلمية: </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة التعليمية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
  
                  <label for="branch">لوحدة الجزيئية : </label>
                  <select id="branch" name="branch" required>
                    <option value="" disabled selected>اختر الوحدة الجزئية</option>
                    <option value="علوم تجريبية">وحدة</option>
                    <option value="اداب">وحدة</option>
                  </select>
                  <label for="unitName">عنوان درس المراد تعديله</label>
                  <div id="unitSelection">
                    <input type="checkbox" name="unit" value="وحدة 1">وحدة 1<br>
                    <input type="checkbox" name="unit" value="وحدة 2">وحدة 2<br>
                    <input type="checkbox" name="unit" value="وحدة 3">وحدة 3<br>
                    
                  </div>
                  <label for="unitName"> عنوان درس  الجديد</label>
                  <input type="text" id="unitName" name="unitName" required>
                  <button type="submit">تعديل</button>
                </form>
                 
              </div>
            
        </div>
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
     
    </div>
    
  
        <!-- End Head -->

  </body>

   <script src="./assets/js/script.js"></script>
  
</html>
