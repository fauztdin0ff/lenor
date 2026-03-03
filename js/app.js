
/*==========================================================================
App
============================================================================*/
function animateSwitch(currentEl, nextEl) {
   return new Promise(resolve => {

      function handleFadeOut(e) {
         if (e.propertyName !== 'opacity') return;

         currentEl.removeEventListener('transitionend', handleFadeOut);
         currentEl.classList.add('hidden');
         nextEl.classList.remove('hidden');
         nextEl.offsetHeight;
         nextEl.classList.add('is-active');

         resolve();
      }

      currentEl.addEventListener('transitionend', handleFadeOut);
      currentEl.classList.remove('is-active');
   });
}


/*==========================================================================
Steps
============================================================================*/
function initSteps() {
   const steps = document.querySelectorAll('.app__step');
   const welcome = document.getElementById('step-1');
   const testing = document.getElementById('step-2');
   const game = document.getElementById('step-3');
   const startBtn = welcome.querySelector('.button');

   steps.forEach(step => {
      step.classList.add('hidden');
      step.classList.remove('is-active');
   });

   welcome.classList.remove('hidden');
   welcome.classList.add('is-active');

   startBtn.addEventListener('click', () => {
      animateSwitch(welcome, testing);
   });
}


/*==========================================================================
Testing
============================================================================*/
function initTesting() {
   const testingStep = document.getElementById('step-2');
   const questions = Array.from(testingStep.querySelectorAll('.testing__item'));
   const pagination = testingStep.querySelector('.testing__pagination');
   const popup = document.getElementById('thanks-popup');
   let currentIndex = 0;

   pagination.innerHTML = '';

   questions.forEach((_, i) => {
      const bullet = document.createElement('span');
      bullet.className = 'testing__pagination-bullet';
      if (i === 0) bullet.classList.add('active');
      pagination.appendChild(bullet);
   });

   const bullets = pagination.querySelectorAll('.testing__pagination-bullet');

   questions.forEach((q, i) => {
      q.classList.add('hidden');
      q.classList.remove('is-active');

      if (i === 0) {
         q.classList.remove('hidden');
         q.classList.add('is-active');
      }
   });

   questions.forEach((question, index) => {
      const variants = question.querySelectorAll('.testing__variant');

      variants.forEach(btn => {
         btn.addEventListener('click', async () => {

            if (index === questions.length - 1) {

               await new Promise(resolve => {

                  function handleFade(e) {
                     if (e.propertyName !== 'opacity') return;

                     testingStep.removeEventListener('transitionend', handleFade);
                     resolve();
                  }

                  testingStep.addEventListener('transitionend', handleFade);

                  testingStep.classList.remove('is-active');
               });

               testingStep.classList.add('hidden');

               requestAnimationFrame(() => {
                  popup.classList.add('show');
               });

               return;
            }

            const nextQuestion = questions[index + 1];

            await animateSwitch(question, nextQuestion);

            bullets[currentIndex].classList.remove('active');
            bullets[currentIndex + 1].classList.add('active');

            currentIndex++;
         });
      });
   });
}

/*==========================================================================
Game step
============================================================================*/
function initGameStep() {
   const popup = document.getElementById('thanks-popup');
   const popupBtn = popup.querySelector('.button');
   const game = document.getElementById('step-3');

   popupBtn.addEventListener('click', () => {

      popup.classList.remove('show');

      function handleFade(e) {
         if (e.propertyName !== 'opacity') return;

         popup.removeEventListener('transitionend', handleFade);
         popup.classList.add('hidden');
         game.classList.remove('hidden');
         game.offsetHeight;
         game.classList.add('is-active');

         initGame();
      }

      popup.addEventListener('transitionend', handleFade);
   });
}

/*==========================================================================
Game
============================================================================*/
function initGame() {
   const boxesContainer = document.querySelector('.game__boxes');
   const boxes = document.querySelectorAll('.game__box');
   const retryPopup = document.getElementById('retry-popup');
   const congratsPopup = document.getElementById('congrats-popup');
   const retryBtn = retryPopup.querySelector('.button');
   const congratsBtn = congratsPopup.querySelector('.button');
   const retryCountEl = retryPopup.querySelector('.retry-count');
   const step3 = document.getElementById('step-3');
   const step4 = document.getElementById('step-4');
   let attempt = 0;
   let isBlocked = false;
   boxes.forEach(box => {
      box.addEventListener('click', () => {

         if (isBlocked) return;
         if (box.classList.contains('open')) return;

         isBlocked = true;
         attempt++;

         box.classList.add('open');
         boxesContainer.classList.add('no-hover');

         if (attempt < 3) {

            setTimeout(() => {

               const left = 3 - attempt;
               retryCountEl.textContent = `(${left})`;

               retryPopup.classList.add('show');

            }, 1000);
         }

         if (attempt === 3) {

            const prizeImg = document.createElement('img');
            prizeImg.src = 'img/product.webp';
            prizeImg.className = 'game__prize';

            box.appendChild(prizeImg);

            setTimeout(() => {
               congratsPopup.classList.add('show');
            }, 4500);
         }
      });
   });

   retryBtn.addEventListener('click', () => {
      retryPopup.classList.remove('show');

      retryPopup.addEventListener('transitionend', function handler(e) {
         if (e.propertyName !== 'opacity') return;

         retryPopup.removeEventListener('transitionend', handler);
         isBlocked = false;
         boxesContainer.classList.remove('no-hover');
      });
   });

   congratsBtn.addEventListener('click', () => {

      congratsPopup.classList.remove('show');

      congratsPopup.addEventListener('transitionend', function handler(e) {
         if (e.propertyName !== 'opacity') return;
         congratsPopup.removeEventListener('transitionend', handler);
         step3.classList.remove('is-active');
         step3.classList.add('hidden');
         step4.classList.remove('hidden');
         step4.offsetHeight;
         step4.classList.add('is-active');
      });
   });
}


/*==========================================================================
Preorder → Order
============================================================================*/
function initPreorder() {
   const preorder = document.getElementById('step-4');
   const order = document.getElementById('step-5');
   const button = preorder.querySelector('.button');

   button.addEventListener('click', () => {
      animateSwitch(preorder, order);
   });
}

/*==========================================================================
Init
============================================================================*/
document.addEventListener('DOMContentLoaded', () => {
   initSteps();
   initTesting();
   initGameStep();
   initPreorder();
});
