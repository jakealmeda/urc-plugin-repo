<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


global $mobile;


// DEREGISTER DEFAULT STYLESHEET
add_action( 'wp_print_styles', 'setup_dequeue_css_function', 100 );
add_action( 'wp_enqueue_scripts', 'setup_dequeue_css_function' );
add_action( 'wp_footer', 'setup_dequeue_css_function' );
function setup_dequeue_css_function() {

	// 'setup_log_style',
	$css_ids = array( 'ea-style', 'wp-block-library', 'megamenu', 'setup_video_block_style' );

	// check if user is signed in, dequeue if not signed in (enqueued if signed in)
	if( !is_user_logged_in() ) {
		$css_ids[] = 'dashicons';
	}

	foreach( $css_ids as $ids ) {//echo $ids.'<br />';
		setup_check_enqueued_styles( $ids );	
	}

}


//INITIALIZE MOBILE DETECT PLUGIN
$detect = new Mobile_Detect;

if( $detect->isTablet() || !$detect->isMobile() ) {

	// viewer is using tablet or desktop | full load
	$mobile = 0;

	// load jQuery to handle hiding/showing the sidebar and CTAs
	add_action( 'wp_footer', 'setup_plug_showshide_sidebar_ctas' );

} else {
	
	// Any mobile device (phones or tablets).
	$mobile = 1;

    // FORCE LAYOUT - REMOVE SIDEBAR
    add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

    // NAVIGATORS | REMOVE PRIMARY & SECONDARY
    // is being handled by navigator-cor.php found in themes/cor-2020/inc
    // NAVIGATOR | ADD MOBILE MENU
//    add_action( 'genesis_after_header', 'setup_add_mobile_menu_fn' );

    // LIST JS HANDLERS AND DEQUEUE THEM
    add_action( 'wp_print_scripts', 'setup_dequeue_enqueued_scripts_fn' );
    add_action( 'wp_footer', 'setup_dequeue_enqueued_scripts_fn' );

	// JS HEAD
	add_action( 'wp_head', 'setup_mobile_js_inline_head', 2 );

	// JS FOOTER
	add_action( 'wp_footer', 'setup_mobile_js_inline_footer', 1000 );

	// CTA
	//add_action( 'genesis_before_content', 'setup_cta_icons_function' );

}/* else {

	// viewer is using desktop
	$mobile = 0;

}*/


// INLINE STYLESHEET IN HEAD
add_action( 'wp_head', 'setup_inline_styles_in_head', 1 );
function setup_inline_styles_in_head() {

	global $mobile;

	// WORDPRESS CONTENT FOLDER
	//$this_dir_theme = WP_CONTENT_DIR.'/themes/cor-2020/';
	$this_dir_theme = get_stylesheet_directory().'/';
	
	// WORDPRESS PLUGINS FOLDER
	$urc_aws_plugdir = setup_return_plugins_maindir().'/';

	// WORDPRESS INCLUDES FOLDER
	//$urc_aws_incdir = includes_url();
	$urc_aws_incdir = ABSPATH . WPINC . '/';

    ?><style><?php
    	
	    if( !empty( $mobile ) ) {

	        // MOBILE STYLESHEET
	        //$main_css = file_get_contents( get_stylesheet_directory_uri().'/assets/css/mobile-min.css' );
	        $main_css = file_get_contents( $this_dir_theme.'assets/css/mobile-min.css' );

	    } else {
	    	
	        // MAIN STYLESHEET | NO NEED TO VALIDATE IF FILE EXISTS
	        //$main_css = file_get_contents( get_stylesheet_directory_uri().'/assets/css/main-min.css' );
	        $main_css = file_get_contents( $this_dir_theme.'assets/css/main-min.css' );

	    }

	    if( !empty( $main_css ) ) {

	    	// initialize array
			$lookie = array(
				'/images/',
				'/fonts/', //$this_dir_theme,
			);

	        foreach( $lookie as $look_for ) {
		        
		        //$replace_with = $look_dir.'assets'.$look_for;
		        //$replace_with = $this_dir_theme.'assets'.$look_for; // AWS
		        $replace_with = get_stylesheet_directory_uri().'/assets'.$look_for;
		        $main_css = str_replace( '..'.$look_for, $replace_with, $main_css );

	        }

	        echo $main_css;
	        
	    }

	    // MAILCHIMP
	    /*$mailchimp_css = file_get_contents( 'https://cdn-images.mailchimp.com/embedcode/classic-10_7.css' );
	    if( !empty( $mailchimp_css ) ) {
	        echo setup_minify_css( $mailchimp_css );
	    }*/

	    // MAX MEGA MENU
	    /*$upload_dir = wp_upload_dir(); //wp-content/uploads/maxmegamenu/style.css
	    $max_mm = file_get_contents( $upload_dir['baseurl'].'/maxmegamenu/style.css' );*/
	    $max_mm = file_get_contents( WP_CONTENT_DIR.'/uploads/maxmegamenu/style.css' );
	    if( !empty( $max_mm ) ) {
	    	echo $max_mm;
	    }
	    
	    // DASHICONS
		if( !is_user_logged_in() ) {

			// inline if user is not logged in
			// do not inline if use is logged in
			$dashicons_css = file_get_contents( $urc_aws_incdir.'css/dashicons.min.css' );
			if( !empty( $dashicons_css ) ) {
				echo $dashicons_css;
			}

		}

	    $wp_block_library = file_get_contents( $urc_aws_incdir.'css/dist/block-library/style.min.css' );
	    if( !empty( $wp_block_library ) ) {
	    	echo $wp_block_library;
	    }

	    // SETUP LOG
	    /*$setup_log_styles = file_get_contents( plugins_url().'/setup-log/css/setup_log_style.css' );
	    if( !empty( $setup_log_styles ) ) {
	    	echo $setup_log_styles;
	    }*/

	    // SETUP VIDEO BLOCK
	    //$setup_video_block_styles = file_get_contents( plugins_url().'setup-video-block/assets/css/setup-video-block-style.css' );
	    $setup_video_block_styles = file_get_contents( $urc_aws_plugdir.'setup-video-block/assets/css/setup-video-block-style.css' );
	    if( !empty( $setup_video_block_styles ) ) {
	    	echo str_replace( '../images/', plugins_url().'/setup-video-block/assets/images/', $setup_video_block_styles );
	    	//echo $setup_video_block_styles;
	    }

    ?></style><?php

}


// REGISTER CUSTOM MENU FOR MOBILE
/*add_action( 'init', 'setup_register_custom_menu_fn' );
function setup_register_custom_menu_fn() {

	register_nav_menu( 'mobile-menu', __( 'Mobile Menu' ) );

}


// ADD MOBILE MENU
function setup_add_mobile_menu_fn() {

	global $mobile;

	if( !is_admin() && !empty( $mobile ) ) {

		?>	
		<div class="nav-primary" id="genesis-nav-primary">
			<div class="wrap">
				<div id="mega-menu-wrap-primary" class="mega-menu-wrap">
					<?php 																		//mega-menu-toggle
					wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'container_class' => 'genesis-nav-menu' ) );
					?>
				</div>
			</div>
		</div>
		<?php

	}

}*/


// ECHO JAVASCRIPTS
function setup_mobile_js_inline_head() {

	//$urc_aws_incdir = includes_url();
	$urc_aws_incdir = ABSPATH . WPINC;
	
	$js_array = array(
		$urc_aws_incdir.'/js/jquery/jquery.js',
		$urc_aws_incdir.'/js/jquery/ui/core.min.js',
		$urc_aws_incdir.'/js/jquery/ui/effect.min.js',
		$urc_aws_incdir.'/js/jquery/ui/effect-slide.min.js',
		$urc_aws_incdir.'/js/jquery/ui/effect-fade.min.js',
//		$urc_aws_incdir.'/js/jquery/ui/widget.min.js',
		$urc_aws_incdir.'/js/jquery/ui/accordion.min.js',
	);
	
	if( is_array( $js_array ) ) {
		setup_echo_javascripts( $js_array );
	}

}


// INLINE JAVASCRIPT IN FOOTER
function setup_mobile_js_inline_footer() {
	/*
		ea-global
		comment-reply
		setup_log_script
		hoverIntent

		https://staging-corsite.kinsta.cloud/wp-includes/js/hoverIntent.min.js?ver=1.8.1
		https://staging-corsite.kinsta.cloud/wp-content/themes/cor-2020/assets/js/global-min.js?ver=1602221100
		https://staging-corsite.kinsta.cloud/wp-includes/js/comment-reply.min.js?ver=5.5.1
		https://staging-corsite.kinsta.cloud/wp-content/themes/genesis/lib/js/skip-links.min.js?ver=3.3.3
		https://staging-corsite.kinsta.cloud/wp-content/plugins/urc-plugin-repo/js/asset_accordion_min.js?ver=5.5.1
	*/
	
	//$urc_aws_plugdir = plugins_url();
	$urc_aws_plugdir = setup_return_plugins_maindir();
	
	$js_array = array(
		$urc_aws_plugdir.'/wp-smush-pro/app/assets/js/smush-lazy-load.min.js',
		$urc_aws_plugdir.'/megamenu/js/maxmegamenu.js',
		$urc_aws_plugdir.'/urc-social-toolbar/js/asset-min.js',
		$urc_aws_plugdir.'/urc-youtube/js/asset-2-min.js',
		$urc_aws_plugdir.'/setup-video-block/js/asset-min.js',
		$urc_aws_plugdir.'/urc-plugin-repo/js/asset.js',
	);
	
	if( is_array( $js_array ) ) {
		setup_echo_javascripts( $js_array );
	}

}


// VALIDATE ENQUEUED STYLE
function setup_check_enqueued_styles( $identifier ) {

    if( wp_style_is( $identifier, 'enqueued' ) ) {

        setup_dequeue_styles( $identifier );

    }

}


// VALIDATE ENQUEUED JAVASCRIPT
function setup_check_enqueued_javascript( $identifier ) {
    
    if( wp_script_is( $identifier, 'enqueued' ) ) {

        setup_dequeue_scripts( $identifier );

    }

}


// FUNCTION TO DEQUEUE STYLE
function setup_dequeue_styles( $identifier ) {

    wp_dequeue_style( $identifier );
    wp_deregister_style( $identifier );

    return TRUE;

}


// FUNCTION TO DEQUEUE SCRIPT
function setup_dequeue_scripts( $identifier ) {

    wp_dequeue_script( $identifier );
    wp_deregister_script( $identifier );

    return TRUE;

}


// ECHO JS SCRIPTS
function setup_echo_javascripts( $js_array ) {
	
	if( is_array( $js_array ) ) {

		?><script><?php

			foreach( $js_array as $js ) {
				
				$o = file_get_contents( $js );
				if( !empty( $o ) ) {
					echo $o;
				}

			}

		?></script><?php
		
	}

}


// DEQUEUE JAVASCRIPTS
function setup_dequeue_enqueued_scripts_fn() {

	global $wp_scripts;
	
	foreach( $wp_scripts->queue as $handle ) :
		//echo $wp_scripts->queue['wplink'];

		// use the line below to validate what scripts are enqueued
		//echo $handle.'<hr>';

		setup_check_enqueued_javascript( $handle );

	endforeach;

}


// NAVIGATORS | REMOVE
/*if( !function_exists( 'setup_remove_navigators' ) ) {
 
    function setup_remove_navigators() {
			        
        foreach( get_registered_nav_menus() as $key => $value ) {

        	if( $key == 'primary' || $key == 'secondary' ) {

        		unregister_nav_menu( $key );

        	}

        }

    }
    
}*/


// HANDLE HIDING/SHOWING OF SIDEBAR AND CTAs
if( !function_exists( 'setup_plug_showshide_sidebar_ctas' ) ) {

	function setup_plug_showshide_sidebar_ctas() {

		global $post;

	    // ACCORDION
	    wp_register_script( 'setup_plug_sidebar_ctas', plugins_url( '../js/asset-desktab.js', __FILE__ ), NULL, '1.0', TRUE );
		// Localize the script with new data
		$translation_array = array(
			'cta_freeebook'		=> $post->post_name,
			'cta_hidepage'		=> urc_hide_subsribe_from_the_following_pages(),
//			'cta_expanded' 		=> setup_cta_expanded(),
			'cta_expanded' 		=> setup_original_subscribe(),
			'cta_fbicons'		=> '<div class="group grid-cta-icon">'.urc_ctas().'</div>',
		);
	    wp_localize_script( 'setup_plug_sidebar_ctas', 'setup_plug_ctas', $translation_array );
	    wp_enqueue_script( 'setup_plug_sidebar_ctas' );
	    //wp_enqueue_script( 'setup_plugin_repo_accordion', plugins_url( 'js/asset.js', __FILE__ ) );

	}

}