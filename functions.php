<?php
require_once(get_template_directory() . '/includes/multilanguage.php');


function drim_robotics_files() {
  if (strstr($_SERVER['SERVER_NAME'], 'drimrobotics.local')) {
    wp_enqueue_script('main-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
  } else {
    wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.7b7d5b3e0cb077c24b46.js'), NULL, '1.0', true);
    wp_enqueue_script('main-js', get_theme_file_uri('/bundled-assets/scripts.1fc0c61b5a9b33701481.js'), NULL, '1.0', true);
    wp_enqueue_style('drim-robotics-main-styles', get_theme_file_uri('/bundled-assets/styles.1fc0c61b5a9b33701481.css'));
  }
  
}

add_action('wp_enqueue_scripts', 'drim_robotics_files');

function drim_robotics_features() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('widgets');
  add_image_size('top_banner',1440,346,true);
  add_image_size('top_banner_mob',600,400,true);
  add_image_size('cta',1440,650,true);
  add_image_size('cta',600,500,true);
  add_image_size('featured', 800, 400, true);
  register_nav_menu('header_nav', 'Header Menu');
}

add_action('after_setup_theme', 'drim_robotics_features');

function add_additional_class_on_li($classes, $item, $args) {
  if(isset($args->add_li_class)) {
      $classes[] = $args->add_li_class;
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

// options Page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}


// disable WordPress Admin
show_admin_bar(false);


// prevent ACF updates
function filter_plugin_updates( $value ) {
    unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    return $value;
}

add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );


//remove dots from archives excerpt
 function new_excerpt_more( $more ) {
 	return '';
 }
 add_filter('excerpt_more', 'new_excerpt_more');

//excerpt length
 function isacustom_excerpt_length($length) {
   global $post;
   if ($post->post_type == 'post'  && !is_home())
   return 27;

   if(is_home()) {
     return 40;
   }
   $latest_cpt = get_posts("post_type=historie-sukcesu&numberposts=1");
   $id = $latest_cpt[0]->ID;

  //  if(is_page(pll_get_post(159)) && ){
  //  return 40;
  //  }

   if($post->post_type == 'historie-sukcesu') {
     return 15;
   }
 
   }
   add_filter('excerpt_length', 'isacustom_excerpt_length');

   function set_custom_excerpt_length( $length ) {
    global $custom_excerpt_length;
    if( ! isset( $custom_excerpt_length ) ) {
        return $length;
    }
    return $custom_excerpt_length;
}

function my_excerpt( $post_id = null, $length = 55 ) {
    global $custom_excerpt_length, $post;
    $custom_excerpt_length = $length;
    if( is_null( $post_id ) ) {
        $post_id = $post->ID;
    }
    add_filter( 'excerpt_length', 'set_custom_excerpt_length', 999 );
    echo get_the_excerpt( $post_id );
    remove_filter( 'excerpt_length', 'set_custom_excerpt_length', 999 );
}

//cf7 p span tags
remove_filter('acf_the_content', 'wpautop' );

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('wpcf7_form_elements', function($content) {
  $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

  return $content;
});



// Allow SVG
add_action("init", function() {
  // First line of defence defused
  add_filter('upload_mimes', function ($mimes) {
      $mimes['svg'] = 'image/svg+xml';
      return $mimes;
  });

  // Add the XML Declaration if it's missing (otherwise WordPress does not allow uploads)
  add_filter("wp_handle_upload_prefilter", function ($upload) {
      if (!empty($upload["type"]) && $upload["type"] === "image/svg+xml") {
          $contents = file_get_contents($upload["tmp_name"]);
          if (strpos($contents, "<?xml") === false) {
              file_put_contents($upload["tmp_name"], '<?xml version="1.0" encoding="UTF-8"?>' . $contents);
          }
      }
      return $upload;
  }, 10, 1);
});

/** remove WP version number */

// remove version from head
remove_action('wp_head', 'wp_generator');

// remove version from rss
add_filter('the_generator', '__return_empty_string');

// remove version from scripts and styles
function shapeSpace_remove_version_scripts_styles($src) {
	if (strpos($src, 'ver=')) {
		$src = remove_query_arg('ver', $src);
	}
	return $src;
}
add_filter('style_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);

// fix custom post types
flush_rewrite_rules( false );

/**Eliminate Render blocking js */
function defer_parsing_of_js( $url ) {
  if ( is_user_logged_in() ) return $url; //don't break WP Admin
  if ( FALSE === strpos( $url, '.js' ) ) return $url;
  if ( strpos( $url, 'jquery.js' ) ) return $url;
  return str_replace( ' src', ' defer src', $url );
}
add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );







