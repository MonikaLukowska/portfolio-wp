<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
  <meta name="Description" content="Fronaweb - nowoczesne strony www i sklepy internetowe.">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fronaweb</title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header class="header">
      <div class="container container--wide">
        <div class="header__row">
          <button class="header__logoCol" aria-label="scroll top">
            <img class="header__logo" src="/wp-content/themes/frona/images/logo.svg" alt="Fronaweb.pl">
          </button>
          <div class="header__navCol">
            <nav class="nav">
              <ul class="nav__list">
                <li class="nav__list__item"><a class="nav__list__link" href="#services">Oferta</a></li>
                <li class="nav__list__item"><a class="nav__list__link" href="#work">Portfolio</a></li>
                <li class="nav__list__item"><a class="nav__list__link" href="#process">Proces</a></li>
                <li class="nav__list__item"><a class="nav__list__link" href="#about">O mnie</a></li>
                <li class="nav__list__item"><a class="nav__list__link" href="#contact">Kontakt</a></li>
              </ul>
            </nav>
            <button class="header__burger hide-lg" aria-label="Toggle Menu">
              <div class="header__burger__bar header__burger__bar--top"></div>
              <div class="header__burger__bar header__burger__bar--middle"></div>
              <div class="header__burger__bar header__burger__bar--bottom"></div>
          </button> 
          </div>
        </div>
      </div>
    </header>
    <div class="wave">
      <svg xmlns="http://www.w3.org/2000/svg" width="4651.735" height="2439.5" viewBox="0 0 4651.735 2439.5">
        <path id="wave" d="M0,2439.5l110.8-284.354c110.8-287.4,315.686-332.823,538.582-376.276,220.634-40.4,458.634-71.22,678.3,10.351,222.9,78.521,361.383,120.077,581.049-126.16,221.926-241.663,1171.826,182.468,1394.722,22.375,220.958-160.092,417.026-120.128,414.229-116.467,7.023.342,224.675,16.962,257.979,8.829,5.458,2.577,126.884-2.556,132.294,0,46.647,9.115,104.6-5.964,239.523,95.229L4651.735,1951.6V0H0Z" fill="#020ca3"/>
      </svg>
    </div>

    
