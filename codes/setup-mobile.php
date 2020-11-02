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
	// 'setup_video_block_style', 
	$css_ids = array( 'ea-style', 'wp-block-library', 'setup_log_style', 'megamenu' );


	// check if user is signed in
	if( !is_user_logged_in() ) {
		$css_ids[] = 'dashicons';
	}


	foreach( $css_ids as $ids ) {
		setup_check_enqueued_styles( $ids );	
	}

}


//INITIALIZE MOBILE DETECT PLUGIN
$detect = new Mobile_Detect;
// Any mobile device (phones or tablets).
if( $detect->isMobile() ) {

	$mobile = 1;

    // FORCE LAYOUT - REMOVE SIDEBAR
    add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// DEREGISTER OTHER STYLING ON MOBILE ONLY
	/*add_action( 'wp_print_styles', 'setup_dequeue_styling_for_mobile', 100 );
	add_action( 'wp_enqueue_scripts', 'setup_dequeue_styling_for_mobile' );
	add_action( 'wp_footer', 'setup_dequeue_styling_for_mobile' );*/

    // NAVIGATORS | REMOVE
    //add_action( 'init', 'setup_remove_navigators', 0 );
	// remove_action( 'genesis_after_header', 'genesis_do_nav' );
	// remove_action( 'genesis_after_header', 'genesis_do_subnav' );
    // NAVIGATOR | ADD MOBILE MENU
    add_action( 'genesis_after_header', 'setup_add_mobile_menu_fn' ); 

    // LIST JS HANDLERS AND DEQUEUE THEM
    add_action( 'wp_print_scripts', 'setup_dequeue_enqueued_scripts_fn' );
    add_action( 'wp_footer', 'setup_dequeue_enqueued_scripts_fn' );

	// JS HEAD
	add_action( 'wp_head', 'setup_mobile_js_inline_head', 2 );

	// JS FOOTER
	add_action( 'wp_footer', 'setup_mobile_js_inline_footer', 1000 );

	// CTA
	add_action( 'genesis_before_content', 'setup_cta_icons_function' );

} else {

	// viewer is using desktop
	$mobile = 0;

}





// INLINE STYLESHEET IN HEAD
add_action( 'wp_head', 'setup_inline_styles_in_head', 1 );
function setup_inline_styles_in_head() {

	global $mobile;

    ?><style><?php

	    if( $mobile ) {

	        // MOBILE STYLESHEET
	        $main_css = file_get_contents( get_stylesheet_directory_uri().'/assets/css/mobile-min.css' );

	    } else {

	        // MAIN STYLESHEET | NO NEED TO VALIDATE IF FILE EXISTS
	        $main_css = file_get_contents( get_stylesheet_directory_uri().'/assets/css/main-min.css' );

	    }

	    if( !empty( $main_css ) ) {

	        $lookie = array(
	        	'/images/',
	        	'/fonts/',
	        );

	        foreach( $lookie as $look_for ) {
		        //$look_for = '/images/';
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
	    $upload_dir = wp_upload_dir(); //wp-content/uploads/maxmegamenu/style.css
	    $max_mm = file_get_contents( $upload_dir['baseurl'].'/maxmegamenu/style.css' );
	    if( !empty( $max_mm ) ) {
	    	echo $max_mm;
	    }

	    // DASHICONS
	    $dashicons_css = file_get_contents( includes_url().'css/dashicons.min.css' );
	    if( !empty( $dashicons_css ) ) {
	        echo $dashicons_css;
	    }

	    $wp_block_library = file_get_contents( includes_url().'css/dist/block-library/style.min.css' );
	    if( !empty( $wp_block_library ) ) {
	    	echo $wp_block_library;
	    }

	    // SETUP LOG
	    $setup_log_styles = file_get_contents( plugins_url().'/setup-log/css/setup_log_style.css' );
	    if( !empty( $setup_log_styles ) ) {
	    	echo $setup_log_styles;
	    }

	    // SETUP VIDEO BLOCK
	    $setup_video_block_styles = file_get_contents( plugins_url().'setup-video-block/css/setup-video-block-style.css' );
	    if( !empty( $setup_video_block_styles ) ) {
	    	echo $setup_video_block_styles;
	    }

    ?></style><?php

}


// REGISTER CUSTOM MENU FOR MOBILE
add_action( 'init', 'setup_register_custom_menu_fn' );
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

}


// DEREGISTER OTHER STYLING ON MOBILE ONLY FUNCTION
/*function setup_dequeue_styling_for_mobile() {
	
	$array = array( 'dashicons', 'wp-block-library', 'setup_log_style', 'megamenu' );
	foreach( $array as $ids ) {
		setup_check_enqueued_styles( $ids );	
	}

}*/


// ECHO JAVASCRIPTS
function setup_mobile_js_inline_head() {
	
	$js_array = array(
		includes_url().'/js/jquery/jquery.js',
		includes_url().'/js/jquery/ui/core.min.js',
		includes_url().'/js/jquery/ui/effect.min.js',
		includes_url().'/js/jquery/ui/effect-slide.min.js',
		includes_url().'/js/jquery/ui/effect-fade.min.js',
		includes_url().'/js/jquery/ui/widget.min.js',
		includes_url().'/js/jquery/ui/accordion.min.js',
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
	//var_dump($wp_scripts);
	foreach( $wp_scripts->queue as $handle ) :
		//echo $wp_scripts->queue['wplink'];
		//echo $handle;
		//echo '<hr>';
		setup_check_enqueued_javascript( $handle );
	endforeach;

}


// INLINE JAVASCRIPT IN FOOTER
function setup_mobile_js_inline_footer() {
	/*
		smush-lazy-load
		ea-global
		comment-reply
		setup_log_script
		hoverIntent

		https://staging-corsite.kinsta.cloud/wp-includes/js/hoverIntent.min.js?ver=1.8.1
		https://staging-corsite.kinsta.cloud/wp-content/plugins/setup-log/js/asset.js
		https://staging-corsite.kinsta.cloud/wp-content/themes/cor-2020/assets/js/global-min.js?ver=1602221100
		https://staging-corsite.kinsta.cloud/wp-includes/js/comment-reply.min.js?ver=5.5.1
		https://staging-corsite.kinsta.cloud/wp-content/themes/genesis/lib/js/skip-links.min.js?ver=3.3.3

		https://staging-corsite.kinsta.cloud/wp-content/plugins/setup-video-block/js/asset.js?ver=1.0
		https://staging-corsite.kinsta.cloud/wp-content/plugins/urc-plugin-repo/js/asset_accordion_min.js?ver=5.5.1

		ADS
		
		// create a plugin for pulling images
		//	- add a place to specify external images to be used as icons
		//	- link to page

		// signature - try if we can replace the content when viewed in mobile
	*/
	$js_array = array(
		plugins_url().'/wp-smush-pro/app/assets/js/smush-lazy-load.min.js',
		plugins_url().'/megamenu/js/maxmegamenu.js',
		plugins_url().'/setup-social-toolbar/js/asset-min.js',
		plugins_url().'/setup-youtube/js/asset-2-min.js',
//		plugins_url().'/setup-video-block/js/asset.js',
	);

	if( is_array( $js_array ) ) {
		setup_echo_javascripts( $js_array );
	}

}


// NAVIGATORS | REMOVE
if( !function_exists( 'setup_remove_navigators' ) ) {
 
    function setup_remove_navigators() {
			        
        foreach( get_registered_nav_menus() as $key => $value ) {

        	if( $key == 'primary' || $key == 'secondary' ) {

        		unregister_nav_menu( $key );

        	}

        }

    }
    
}


// CSS Minifier => http://ideone.com/Q5USEF + improvement(s)
if( !function_exists( 'setup_minify_css' ) ) {

    function setup_minify_css( $input ) {

        // https://gist.github.com/Rodrigo54/93169db48194d470188f

        if(trim($input) === "") return $input;
        return preg_replace(
            array(
                // Remove comment(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
                // Remove unused white-space(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
                // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
                '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
                // Replace `:0 0 0 0` with `:0`
                '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
                // Replace `background-position:0` with `background-position:0 0`
                '#(background-position):0(?=[;\}])#si',
                // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
                '#(?<=[\s:,\-])0+\.(\d+)#s',
                // Minify string value
                '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
                '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
                // Minify HEX color code
                '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
                // Replace `(border|outline):none` with `(border|outline):0`
                '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
                // Remove empty selector(s)
                '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
            ),
            array(
                '$1',
                '$1$2$3$4$5$6$7',
                '$1',
                ':0',
                '$1:0 0',
                '.$1',
                '$1$3',
                '$1$2$4$5',
                '$1$2$3',
                '$1:0',
                '$1$2'
            ),
        $input);

    }

}


//if( !function_exists( 'setup_remove_comments_from_css' ) ) {

//	function setup_remove_comments_from_css( $output ) {

//		$pattern = '!/\*[^*]*\*+([^/][^*]*\*+)*/!'; 

//		$str = preg_replace( $pattern, '', $output );

//	}

//}


// JAVASCRIPT MINIFIER
/*if( !function_exists( 'setup_minify_javascript' ) ) {
    
    function setup_minify_javascript( $input ) {

        if(trim($input) === "") return $input;
        return preg_replace(
            array(
                // Remove comment(s)
                '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
                // Remove white-space(s) outside the string and regex
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
                // Remove the last semicolon
                '#;+\}#',
                // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
                '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
                // --ibid. From `foo['bar']` to `foo.bar`
                '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
            ),
            array(
                '$1',
                '$1$2',
                '}',
                '$1$3',
                '$1.$3'
            ),
        $input);

    }

}


// JAVASCRIPT | REMOVE COMMENTS FROM FILE
if( !function_exists( 'setup_remove_comments_from_js' ) ) {

	function setup_remove_comments_from_js( $output ) {

		$pattern = '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))/';
		$output = preg_replace( $pattern, '', $output );

		return nl2br($output);

	}
}*/
