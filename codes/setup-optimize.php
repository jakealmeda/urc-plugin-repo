<?php

/* ----------------------------------------------------------------------------
 * OPTIMIZE
 * ------------------------------------------------------------------------- */
//js/jquery/jquery.js
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


add_action( 'wp_print_styles', 'setup_dequeue_css_function' ); // dequeue styles
add_action( 'wp_print_scripts', 'setup_remove_js_function' ); // dequeue javascript
    //add_action( 'wp_footer', 'setup_remove_js_footer_function' );
add_action( 'wp_head', 'setup_inline_styles_in_head', 1 ); // inline non-critical in wp_head
    //add_action( 'wp_head', 'setup_inline_javascript_in_head' );
    //add_action( 'wp_head', 'setup_inline_jquery' ); // 
add_action( 'wp_footer', 'setup_inline_javascript_in_footer', 200 ); // inline megamaxmenu javascript
    //add_action( 'wp_footer', 'setup_remove_soliloquy_css' );
    //add_action( 'wp_footer', 'setup_inline_styles_in_footer' );


// DISPLAY JAVASCRIPT HANDLERS (REGISTERED NAMES)
//add_action( 'wp_print_scripts', 'wsds_detect_enqueued_scripts' );
/*add_action( 'wp_footer', 'wsds_detect_enqueued_scripts' );
function wsds_detect_enqueued_scripts() {
    global $wp_scripts;
    foreach( $wp_scripts->queue as $handle ) :
        echo $handle . ' | ';
    endforeach;
}*/


// INLINE JQUERY
/*function setup_inline_jquery() {
    //https://staging.understandingrelationships.com/wp-includes/js/jquery/jquery.js

    ?><script type='text/javascript' id='setup_jquery'><?php
        echo file_get_contents( includes_url().'/js/jquery/jquery.js' );
    ?></script><?php
}*/


// DEREGISTER STYLES
function setup_dequeue_css_function() {

//    if( !is_admin() && !is_user_logged_in() ) {

        //setup_dequeue_styles( 'ea-style' ); // MAIN THEME FILE
        setup_check_enqueued_styles( 'ea-style' );
        //setup_dequeue_styles( 'wp-block-library' ); // GUTENBERG CSS
        setup_check_enqueued_styles( 'wp-block-library' );


        // MEGA MENU | CSS
        // Follow the guide found in the link below to inline the said CSS (minified)
        // https://www.megamenu.com/documentation/general-settings/


        // DASHICONS | dequeue if not admin pane
//        if( !is_admin() && !is_user_logged_in() ) {
            setup_check_enqueued_styles( 'dashicons' );
//        }

//    }

}


// DEREGISTER STYLES | SOLILOQUY
/*function setup_remove_soliloquy_css() {

    // https://staging.understandingrelationships.com/wp-content/plugins/soliloquy/assets/css/soliloquy.css?ver=2.5.9
    setup_check_enqueued_styles( 'soliloquy-style-css' );
    
}*/


// REMOVE JAVASCRIPTS FROM WP ENQUEUED SCRIPTS
function setup_remove_js_function() {

    // MEGA MENU | JS
    setup_check_enqueued_javascript( 'megamenu' );

    //setup_dequeue_scripts( 'jquery' );
    

}


// REMOVE JAVASCRIPTS FROM FOOTER
/*function setup_remove_js_footer_function() {

    // SOLILOQUY
    setup_check_enqueued_javascript( 'soliloquy-script' );

}*/


// HEADER | INLINE JAVASCRIPT
/*function setup_inline_javascript_in_head() {

    ?><script><?php

        // https://staging.understandingrelationships.com/wp-content/plugins/soliloquy/assets/js/min/soliloquy-min.js?ver=2.5.9
        $soliloquy_js = file_get_contents( plugins_url().'/soliloquy/assets/js/min/soliloquy-min.js' );
        if( !empty( $soliloquy_js ) ) {
            echo setup_minify_javascript( $soliloquy_js );
        }

    ?></script><?php

}*/


// FOOTER | INLINE JAVASCRIPT
function setup_inline_javascript_in_footer() {

    ?><script><?php

        //https://staging.understandingrelationships.com/wp-content/plugins/megamenu/js/maxmegamenu.js
        $max_mega_menu_js = file_get_contents( plugins_url().'/megamenu/js/maxmegamenu.js' );
        if( !empty( $max_mega_menu_js ) ) {
            echo setup_minify_javascript( $max_mega_menu_js );
        }

        // Soliloquy breaks with this hack
        // https://staging.understandingrelationships.com/wp-content/plugins/soliloquy/assets/js/min/soliloquy-min.js?ver=2.5.9
        /*$soliloquy_js = file_get_contents( plugins_url().'/soliloquy/assets/js/min/soliloquy-min.js' );
        if( !empty( $soliloquy_js ) ) {
            echo setup_minify_javascript( $soliloquy_js );
        }*/

    ?></script><?php

}


// HEAD | INLINE STYLES
function setup_inline_styles_in_head() {

    //if( !is_admin() && !is_user_logged_in() ) {

        ?><style><?php

            // MAIN THEME'S STYLES
            $main_css = file_get_contents( get_stylesheet_directory_uri().'/assets/css/main-min.css' );
            //echo '<h1>'.$main_css.'</h1>';
            if( !empty( $main_css ) ) {
                $look_for = '/images/';
                $replace_with = get_stylesheet_directory_uri().'/assets'.$look_for;
                echo str_replace( '..'.$look_for, $replace_with, $main_css );
            }

            // DASHICONS
            //https://staging.understandingrelationships.com/wp-includes/css/dashicons.min.css
            //if( !is_admin() && !is_user_logged_in() ) {

                $dashicons_css = file_get_contents( includes_url().'/css/dashicons.min.css' );
                if( !empty( $dashicons_css ) ) {
                    echo $dashicons_css;
                }

            //}

            // SOLILOQUY
            /*$sol_plug_dir = plugins_url().'/soliloquy/assets/css/';
            $soliloquy_css = file_get_contents( $sol_plug_dir.'soliloquy.css' );
            if( !empty( $soliloquy_css ) ) {
                echo str_replace( 'images/', $sol_plug_dir.'images/', $soliloquy_css );
                //echo setup_minify_css( $soliloquy_css );
            }*/

        ?></style><?php

    //}

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


// 
// CSS Minifier => http://ideone.com/Q5USEF + improvement(s)
/*function setup_minify_css( $input ) {

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

}*/

/*
// JAVASCRIPT MINIFIER
if( !function_exists( 'setup_minify_javascript' ) ) {
    
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
*/
