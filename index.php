<?php
session_start();

/*
|--------------------------------------------------------------------------
| Конфигурация
|--------------------------------------------------------------------------
*/
$defaultLang = 'en';
$availableLangs = ['en', 'ru'];
$langDir = __DIR__ . '/lang';

/*
|--------------------------------------------------------------------------
| 1. Определение языка
|--------------------------------------------------------------------------
*/
$lang = $defaultLang;

if (isset($_GET['lang'])) {
    $requestedLang = strtolower(trim($_GET['lang']));

    if (in_array($requestedLang, $availableLangs)) {
        $_SESSION['lang'] = $requestedLang;
        $lang = $requestedLang;
    }
}

elseif (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $availableLangs)) {
    $lang = $_SESSION['lang'];
}

elseif (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {

    $browserLangs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

    foreach ($browserLangs as $browserLang) {
        $code = substr(trim($browserLang), 0, 2);

        if (in_array($code, $availableLangs)) {
            $lang = $code;
            break;
        }
    }
}

/*
|--------------------------------------------------------------------------
| 2. Загрузка файла перевода
|--------------------------------------------------------------------------
*/

$translationFile = $langDir . "/{$lang}.json";

if (!file_exists($translationFile)) {
    $translationFile = $langDir . "/{$defaultLang}.json";
}

$translations = json_decode(file_get_contents($translationFile), true);

if (!is_array($translations)) {
    $translations = [];
}

/*
|--------------------------------------------------------------------------
| 3. Функция перевода
|--------------------------------------------------------------------------
*/

function t($key)
{
    global $translations;

    if (isset($translations[$key])) {
        return $translations[$key];
    } else {
        error_log("Missing translation key: $key");
        return '';
    }
}

?>

<!DOCTYPE html>
<html lang="<?= $lang; ?>">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="format-detection" content="telephone=no">
   <link rel="icon" type="image/webp" href="img/logo.webp">
   <meta name="description" content="">
   <meta property="og:title" content="">
   <meta property="og:description" content="">
   <meta property="og:url" content="">
   <meta property="og:type" content="website">
   <link rel="stylesheet" href="css/settings.css">
   <link rel="stylesheet" href="css/style.min.css">
   <title>Lenor</title>
</head>

<body>
   <div class="wrapper">
      <header class="header">
         <div class="header__body container">
            <div class="header__logo">
               <img src="img/logo.webp" width="176" height="106" alt="logo">
            </div>
         </div>
      </header>
      <main>
         <section class="app">
            <div class="app__body">
               <div class="app__steps">

                  <div class="app__step welcome white-block" id="step-1">
                     <div class="welcome__image">
                        <img src="img/product.webp" width="380" height="247" alt="product">
                     </div>
                     <h2 class="welcome__title">
                        <?= t('welcome_title'); ?>
                     </h2>
                     <div class="welcome__subtitle">
                        <p><?= t('welcome_text_1'); ?></p>
                        <p><?= t('welcome_text_2'); ?></p>
                        <p><?= t('welcome_text_3'); ?></p>
                     </div>
                     <div class="welcome__button">
                        <button type="button" class="button start"><?= t('welcome_button_start'); ?></button>
                     </div>
                  </div>

                  <div class="app__step testing" id="step-2">
                     <div class="testing__pagination">
                        <span class="testing__pagination-bullet active"></span>
                        <span class="testing__pagination-bullet"></span>
                        <span class="testing__pagination-bullet"></span>
                        <span class="testing__pagination-bullet"></span>
                        <span class="testing__pagination-bullet"></span>
                     </div>
                     <div class="testing__items white-block">
                        <div class="testing__item" id="test-1">
                           <h3 class="testing__question"><?= t('test_1_question'); ?></h3>
                           <div class="testing__variants">
                              <button type="button" class="testing__variant"><?= t('test_1_option_1'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_1_option_2'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_1_option_3'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_1_option_4'); ?></button>
                           </div>
                        </div>

                        <div class="testing__item" id="test-2">
                           <h3 class="testing__question"><?= t('test_2_question'); ?></h3>
                           <div class="testing__variants">
                              <button type="button" class="testing__variant"><?= t('test_2_option_1'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_2_option_2'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_2_option_3'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_2_option_4'); ?></button>
                           </div>
                        </div>

                        <div class="testing__item" id="test-3">
                           <h3 class="testing__question"><?= t('test_3_question'); ?></h3>
                           <div class="testing__variants">
                              <button type="button" class="testing__variant"><?= t('test_3_option_1'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_3_option_2'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_3_option_3'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_3_option_4'); ?></button>
                           </div>
                        </div>

                        <div class="testing__item" id="test-4">
                           <h3 class="testing__question"><?= t('test_4_question'); ?></h3>
                           <div class="testing__variants">
                              <button type="button" class="testing__variant"><?= t('test_4_option_1'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_4_option_2'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_4_option_3'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_4_option_4'); ?></button>
                           </div>
                        </div>

                        <div class="testing__item" id="test-5">
                           <h3 class="testing__question"><?= t('test_5_question'); ?></h3>
                           <div class="testing__variants">
                              <button type="button" class="testing__variant"><?= t('test_5_option_1'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_5_option_2'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_5_option_3'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_5_option_4'); ?></button>
                           </div>
                        </div>

                        <div class="testing__item" id="test-6">
                           <h3 class="testing__question"><?= t('test_6_question'); ?></h3>
                           <div class="testing__variants">
                              <button type="button" class="testing__variant"><?= t('test_6_option_1'); ?></button>
                              <button type="button" class="testing__variant"><?= t('test_6_option_2'); ?></button>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="app__step game white-block" id="step-3">
                     <div class="game__boxes">
                        <div id="0" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                        <div id="1" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                        <div id="2" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                        <div id="3" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                        <div id="4" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                        <div id="5" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                        <div id="6" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                        <div id="7" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                        <div id="8" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                        <div id="9" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                        <div id="10" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                        <div id="11" class="game__try game__box">
                           <img class="game__box-2" src="img/box-01.webp" alt="">
                           <img class="game__box-3" src="img/box-03.webp" alt="">
                           <img class="game__box-4" src="img/box-02.webp" alt="">
                        </div>
                     </div>
                  </div>

                  <div class="app__step preorder white-block" id="step-4">
                     <div class="preorder__image">
                        <img src="img/product-2.webp" width="240" height="240" alt="product">
                     </div>
                     <h2 class="preorder__title"><?= t('preorder_title'); ?></h2>
                     <div class="preorder__subtitle popup__subtitle">
                        <p><?= t('preorder_text_1'); ?></p>
                        <p><?= t('preorder_text_2'); ?></p>
                     </div>
                     <div class="preorder__button">
                        <button type="button" class="button"><?= t('preorder_button'); ?></button>
                     </div>
                  </div>

                  <div class="app__step order white-block" id="step-5">
                     <div class="order__head">
                        <div class="order__image">
                           <img src="img/product-2.webp" width="189" height="192" alt="product">
                        </div>
                        <div class="order__product">
                           <div class="order__product-name"><?= t('order_product_name'); ?></div>
                           <div class="order__product-price"><?= t('order_product_price'); ?></div>
                        </div>
                     </div>
                     <h3 class="order__title"><?= t('order_title'); ?></h3>
                     <form class="order__form" method="get" action="https://google.com">
                        <div class="order__form-area">
                           <input minlength="2" name="sub_id_24" id="firstName" placeholder="<?= t('order_placeholder_first_name'); ?>"
                              autocomplete="given-name" required>
                        </div>

                        <div class="order__form-area">
                           <input minlength="2" name="sub_id_25" id="lastName" placeholder="<?= t('order_placeholder_last_name'); ?>"
                              autocomplete="family-name" required>
                        </div>

                        <div class="order__form-area">
                           <input type="email" name="sub_id_27" id="email" placeholder="<?= t('order_placeholder_email'); ?>"
                              autocomplete="email" required>
                        </div>

                        <div class="order__form-area">
                           <div class="order__form-tel">
                              <img src="img/other/flag.webp" class="order__form-tel-flag" width="30" height="20" alt="flag">
                              <span class="order__form-tel-code">+33</span>
                              <input type="number" name="sub_id_26" class="order__form-tel-input"
                                 placeholder="<?= t('order_placeholder_phone'); ?>" autocomplete="tel" inputmode="numeric"
                                 pattern="[0-9]*" required>
                           </div>
                        </div>

                        <div class="order__form-area">
                           <input minlength="3" name="sub_id_22" id="address" placeholder="<?= t('order_placeholder_address'); ?>"
                              autocomplete="address-level1" required>
                        </div>

                        <div class="order__form-area">
                           <input minlength="2" name="sub_id_21" id="city" placeholder="<?= t('order_placeholder_city'); ?>"
                              autocomplete="address-level2" required>
                        </div>

                        <div class="order__form-send">
                           <button type="submit" class="button"><?= t('order_button_next'); ?></button>
                        </div>
                     </form>
                  </div>

               </div>
            </div>
         </section>
      </main>
   </div>

   <div id="thanks-popup" class="thanks-popup popup" role="dialog" aria-modal="true">
      <div class="popup__body white-block">
         <div class="thanks-popup__image">
            <img src="img/box-full.webp" width="240" height="174" alt="box">
         </div>
         <h2 class="thanks-popup__title"><?= t('thanks_popup_title'); ?></h2>
         <div class="thanks-popup__subtitle popup__subtitle">
            <p><?= t('thanks_popup_text_1'); ?></p>
            <p><?= t('thanks_popup_text_2'); ?></p>
         </div>
         <div class="thanks-popup__button popup__button">
            <button type="button" class="button"><?= t('thanks_popup_button'); ?></button>
         </div>
      </div>
   </div>

   <div id="retry-popup" class="retry-popup popup" role="dialog" aria-modal="true">
      <div class="popup__body white-block">
         <div class="retry-popup__image">
            <picture>
               <source srcset="img/other/empty_package.avif" type="image/avif">
               <img src="img/other/empty_package.png" width="112" height="112" alt="empty box">
            </picture>
         </div>
         <h2 class="retry-popup__title"><?= t('retry_popup_title'); ?></h2>
         <div class="retry-popup__subtitle popup__subtitle">
            <p><?= t('retry_popup_text_1'); ?> <span class="retry-count">(2)</span> <?= t('retry_popup_text_1_end'); ?></p>
            <p><?= t('retry_popup_text_2'); ?></p>
         </div>
         <div class="retry-popup__button popup__button">
            <button type="button" class="button"><?= t('retry_popup_button'); ?></button>
         </div>
      </div>
   </div>

   <div id="congrats-popup" class="congrats-popup popup" role="dialog" aria-modal="true">
      <div class="popup__body white-block">
         <div class="congrats-popup__image">
            <img src="img/product.webp" width="240" height="156" alt="product">
         </div>
         <h2 class="congrats-popup__title"><?= t('congrats_popup_title'); ?></h2>
         <div class="congrats-popup__subtitle popup__subtitle">
            <p><?= t('congrats_popup_text_1'); ?></p>
            <p><?= t('congrats_popup_text_2'); ?></p>
            <p><?= t('congrats_popup_text_3'); ?></p>
         </div>
         <div class="congrats-popup__button popup__button">
            <button type="button" class="button"><?= t('congrats_popup_button'); ?></button>
         </div>
      </div>
   </div>

   <script src="js/app.js"></script>

   <script>
      (function () {
         const form = document.querySelector('.order__form');
         if (!form) return;

         // ====== РЕЖИМ ======
         // 'mode-1' → с кодом страны
         // 'mode-2' → без кода страны
         const PHONE_MODE = 'mode-1';
         // ===================

         const telInput = form.querySelector('.order__form-tel-input');
         const telCodeElement = form.querySelector('.order__form-tel-code');
         const submitButton = form.querySelector('button[type="submit"]');

         function normalizePhone(value) {
            return value.replace(/\D/g, '');
         }

         function buildPhoneByMode(mode) {
            const rawNumber = normalizePhone(telInput.value);
            const countryCode = telCodeElement.textContent.trim();

            if (!rawNumber) return '';

            switch (mode) {
               case 'mode-1':
                  return `${countryCode}${rawNumber}`;

               case 'mode-2':
                  return rawNumber;

               default:
                  console.warn('Unknown phone mode');
                  return rawNumber;
            }
         }

         form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (!form.checkValidity()) {
               form.reportValidity();
               return;
            }

            submitButton.disabled = true;

            const finalPhone = buildPhoneByMode(PHONE_MODE);

            if (!finalPhone) {
               telInput.focus();
               submitButton.disabled = false;
               return;
            }

            const formData = new FormData(form);
            formData.set('sub_id_26', finalPhone);

            if (form.method.toLowerCase() === 'get') {
               const params = new URLSearchParams(formData).toString();
               window.location.href = `${form.action}?${params}`;
               return;
            }

            fetch(form.action, {
               method: 'POST',
               body: formData
            })
               .then(res => {
                  if (!res.ok) throw new Error();
                  return res.text();
               })
               .then(() => form.reset())
               .catch(() => submitButton.disabled = false);
         });
      })();
   </script>
</body>

</html>