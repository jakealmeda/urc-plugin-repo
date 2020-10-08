<?php

/* ----------------------------------------------------------------------------
 * OPTIMIZE
 * ------------------------------------------------------------------------- */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


//INITIALIZE MOBILE DETECT PLUGIN
$detect = new Mobile_Detect;


add_action( 'wp_print_styles', 'setup_dequeue_css_function', 100 ); // dequeue styles
add_action( 'wp_enqueue_scripts', 'setup_dequeue_css_function' );
add_action( 'wp_head', 'setup_inline_styles_in_head', 1 ); // inline non-critical in wp_head


// DEREGISTER STYLES
function setup_dequeue_css_function() {

    setup_check_enqueued_styles( 'ea-style' );

}


// HEAD | INLINE STYLES
function setup_inline_styles_in_head() {

    ?><style><?php

    if( $detect->isMobile() ) {
        // MOBILE STYLESHEET
        $main_css = file_get_contents( get_stylesheet_directory_uri().'/assets/css/mobile-min.css' );
    } else {
        // MAIN STYLESHEET
        $main_css = file_get_contents( get_stylesheet_directory_uri().'/assets/css/main-min.css' );
    }

    if( !empty( $main_css ) ) {
        $look_for = '/images/';
        $replace_with = get_stylesheet_directory_uri().'/assets'.$look_for;
        echo str_replace( '..'.$look_for, $replace_with, $main_css );
    }

    // MAILCHIMP
    /*$mailchimp_css = file_get_contents( 'https://cdn-images.mailchimp.com/embedcode/classic-10_7.css' );
    if( !empty( $mailchimp_css ) ) {
        echo setup_minify_css( $mailchimp_css );
    }*/

    // DASHICONS
    $dashicons_css = file_get_contents( includes_url().'/css/dashicons.min.css' );
    if( !empty( $dashicons_css ) ) {
        echo $dashicons_css;
    }

    ?></style><?php

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
