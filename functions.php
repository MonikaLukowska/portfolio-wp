<?php



function frona_files() {
  if (strstr($_SERVER['SERVER_NAME'], 'frona.local')) {
    wp_enqueue_script('main-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
  } else {
    wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.8120c0fc854589b08ec7.js'), NULL, '1.0', true);
    wp_enqueue_script('main-js', get_theme_file_uri('/bundled-assets/scripts.265cff9f0e782e0347cd.js'), NULL, '1.0', true);
    wp_enqueue_style('drim-robotics-main-styles', get_theme_file_uri('/bundled-assets/styles.265cff9f0e782e0347cd.css'));
  }
  
}

add_action('wp_enqueue_scripts', 'frona_files');

function frona_features() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'frona_features');



// options Page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}


// disable WordPress Admin
show_admin_bar(false);

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







