document.addEventListener('DOMContentLoaded', function () {
  const chapitreList = document.querySelectorAll('.chapitreList');
  const miniChapitreList = document.querySelectorAll('.miniChapitre');
  const listes = document.querySelectorAll('.listes');
  const bccoursList = document.querySelectorAll('.bccours');
  const quizzes = document.querySelectorAll('.quizzes');



  chapitreList.forEach(function (chapitre) {
      chapitre.addEventListener('click', function () {
          const chapterId = this.id.split('_')[1];

          miniChapitreList.forEach(function (miniChapitre) {
              if (miniChapitre.id === 'miniChapitre_' + chapterId) {
                  miniChapitre.classList.toggle('show');
              } else {
                  miniChapitre.classList.remove('show');
              }
          });
      });
  });

  listes.forEach(function (liste) {
      liste.addEventListener('click', function (e) {
          e.stopPropagation();
          const subChapterId = this.id.split('_')[1];
          const bccours = document.getElementById('bccours_' + subChapterId);
          bccours.classList.toggle('show');
      });
  });

  var widgetTitle = document.querySelector('.widget_title');

  widgetTitle.addEventListener('click', function () {
      this.classList.toggle('open');
  });

  // Get the elements
  const videoElement = document.getElementById('cc');
  const singlePostElement = document.querySelector('.posts-list');
  const vidio = document.querySelector('.vidio-list');

  // Add click event listener to the video element
  videoElement.addEventListener('click', function () {
      // Hide the single post element
      singlePostElement.style.display = 'none';
      // Show the vidio post element
      vidio.style.display = 'block';
  });
});
  // Get the elements
  const videoElement = document.getElementById('cc');
const singlePostElement = document.querySelector('.posts-list');
const vidio = document.querySelector('.vidio-list');

// Add click event listener to the video element
videoElement.addEventListener('click', function () {
// Hide the single post element
singlePostElement.style.display = 'none';
// Show the vidio post element
vidio.style.display = 'block';
});

// Add click event listener to course items
const courseItems = document.querySelectorAll('.courseItem');
courseItems.forEach(function (courseItem) {
courseItem.addEventListener('click', function (e) {
  e.stopPropagation();
  const courseId = this.id.split('_')[1];
  const quizzes = document.getElementById('quizzes_' + courseId);
  quizzes.classList.toggle('show');
});
});


  // Event listeners for chapitre, souschapitre, cours, and quiz
  document.querySelectorAll('.chapitreList').forEach((element) => {
    element.addEventListener('click', () => {
      const chapitreId = element.id.split('_')[1];
      updateURL(chapitreId, 'chapitre');
    });
  });

  document.querySelectorAll('.listes').forEach((element) => {
    element.addEventListener('click', () => {
      const souschapitreId = element.id.split('_')[1];
      updateURL(souschapitreId, 'souschapitre');
    });
  });

  document.querySelectorAll('.courseItem').forEach((element) => {
    element.addEventListener('click', () => {
      const coursId = element.id.split('_')[1];
      updateURL(coursId, 'cours');
    });
  });

  document.querySelectorAll('.d-flex').forEach((element) => {
    if (element.id.startsWith('quiz_')) {
      element.addEventListener('click', () => {
        const quizId = element.id.split('_')[1];
        updateURL(quizId, 'quiz');
      });
    }
  });

document.addEventListener('DOMContentLoaded', function () {
  // Event listener for quiz items
  document.querySelectorAll('.quizItem').forEach((element) => {
    element.addEventListener('click', function () {
      const quizId = element.id.split('_')[1];
   
    });
  });
});
