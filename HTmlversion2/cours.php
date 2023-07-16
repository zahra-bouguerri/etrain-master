<?php include "./includes/header.php";?>


      <div class="content w-full">
        <div class="projects p-20 bg-white rad-10 m-20">
          <h2 class="mt-0 mb-20">ادارة الدروس</h2>
          <select class="select-field">
            <option value="option1">اختر السنة</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
          </select>
          <select class="select-field">
            <option value="option1">اختر الشعبة</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
          </select>
          <select class="select-field">
            <option value="option1">اختر الوحدة التعلمية</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
          </select>
          <select class="select-field">
            <option value="option1">اختر الوحدة الجزئية</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
          </select>
          <select class="select-field">
            <option value="option1">اختر الدرس</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
          </select>
          <div class="responsive-table">
            <div id="question-container">
                <li class="add-question-btn "><a href="quizs.html" style="color: rgb(255, 255, 255);">     <i class="fas fa-plus"></i>           اضافة تقويم</a></li>
    
                <li class="add-question-btn">
                  <label for="videoFile" class="add-question-btn">
                    <i class="fas fa-plus"></i>
                    <span>اضافة فيديو</span>
                    <input type="file" id="videoFile" accept="video/*" onchange="handleFileSelect(event)" style="display: none;">
                  </label>
                </li>

                  <video id="videoPlayer" controls style="display: none;"></video>


              
            </div>

          </div>
        </div>
      </div>

    </div>
    


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>


    function handleFileSelect(event) {
    const file = event.target.files[0];
    const videoPlayer = document.getElementById("videoPlayer");
    
    if (file) {
        const fileURL = URL.createObjectURL(file);
        videoPlayer.src = fileURL;
        videoPlayer.style.display = "block";
    }
    }
    
   




    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>