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
          <div class="header__logoCol">
            <img class="header__logo" src="/wp-content/themes/frona/images/logo.svg">
          </div>
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

    
