<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


// HIDE SUBSCRIBE FIELDS IN THESE PAGES
function urc_hide_subsribe_from_the_following_pages() {
	return array(
		'free-ebook',
		'members-section',
		'ebook',
		'bookone-audio',
		'booktwo-ebook',
		'audioprogram1',
		'audioprogram2',
		'audioprogram3',
		'audioprogram4',
		'login',
	);
}

//require_once( 'mailchimp-embed.php' );
//require_once( 'md-test.php' );


//add_action( 'genesis_before_content_sidebar_wrap', 'urc_subscribe_function' ); // original
add_action( 'genesis_before_content_sidebar_wrap', 'urc_subscribe_function', 20 );
//add_action( 'genesis_before_content', 'urc_subscribe_function', 30 );
function urc_subscribe_function() {

	//$donate_page = get_permalink( '26341' ); // there might be more than 1 donate page with the same slug

	//$free_ebook_page = get_permalink( get_page_by_path( "free-ebook" ) );
	//$free_ebook_page = setup_free_ebook_daw();

	global $post; //$post->ID
	
	if( $post && in_array( $post->post_name, urc_hide_subsribe_from_the_following_pages() ) ) {

		$hide_on_these_pages = '';

		// insert original subscribe pane if free-ebook page
		/*if( $post->post_name == 'free-ebook' ) {

			//INITIALIZE MOBILE DETECT PLUGIN
			$detects = new Mobile_Detect;
			if( $detects->isTablet() || !$detects->isMobile() ) {
				// do nothing
			} else {
				$hide_on_these_pages = setup_original_subscribe();
			}

		}*/

		// COR wants to hide ctas
		$we_want_to_hide_ctas = '';

	} else {

		$hide_on_these_pages = '';

		// COR wants to hide ctas
		// CTA | Free eBook Compressed | this should be removed if viewed on a desktop but narrow browser
		$we_want_to_hide_ctas = '<div class="group grid-cta-icon">'.setup_cta_compressed().urc_ctas().'</div>';

	}

	// CTA | Free eBook Expanded
	$cta_ebook_expanded = '<div id="cta_expander_target"></div>'; // setup_cta_expanded();

	$content = $hide_on_these_pages.$cta_ebook_expanded.$we_want_to_hide_ctas;

    //$content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );

    // OUTPUT
    ?><div class="module-cta" style="background-color:pink;"><?php
	    echo $content;
	?></div><?php

}


function urc_ctas() {

	$upload_dir = wp_upload_dir();
	$donate_page = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LKGTSSLYJ93J6';
	//$phone_coaching_page = get_permalink( get_page_by_path( "phone-coaching" ) );
	$phone_coaching_page = get_permalink( '22818' );
	$products_page = get_permalink( get_page_by_path( "products" ) );

	return '<div class="module cta-icon"><div class="module-wrap">
				<div><a class="item image link" href="'.$phone_coaching_page.'" data-type="page"><img src="'.$upload_dir[ "baseurl" ].'/cta-mobile-coaching-icon.png" alt="" class="wp-image-41163" width="50" height="50"></a></div>
				<div class="items info"><div><a class="item title link" href="'.$phone_coaching_page.'" data-type="page" data-id="1519">Phone/Skype Coaching Session</a></div></div>
			</div></div>
			<div class="module cta-icon"><div class="module-wrap">
				<div><a class="item image link" href="https://teespring.com/stores/coach-corey-wayne"><img src="'.$upload_dir[ "baseurl" ].'/cta-mobile-products-icon.png" alt="" class="wp-image-41161" width="50" height="50"></a></div>
				<div class="items info"><div><a class="item title link" href="https://teespring.com/stores/coach-corey-wayne">Coach Corey Wayne Merchandise</a></div></div>
			</div></div>
			<div class="module cta-icon"><div class="module-wrap">
				<div><a class="item image link" href="'.$donate_page.'" data-type="page" ><img src="'.$upload_dir[ "baseurl" ].'/cta-mobile-donate-icon.png" alt="" class="width="50" height="50"></a></div>
				<div class="items info"><div><a class="item title link" href="'.$donate_page.'">Make A Donation</a></div></div>
			</div></div>
			<div class="module cta-icon"><div class="module-wrap">
				<div><a class="item image link" href="'.$products_page.'" data-type="page"><img src="'.$upload_dir[ "baseurl" ].'/cta-mobile-all-books-icon.png" alt="" class="wp-image-41162" width="50" height="50"></a></div>
				<div class="items info"><div><a class="item title link" href="'.$products_page.'" data-type="page">Books & Recommended Products</a></div></div>
			</div></div>';

}


/* --------------------------------------------------------------------------------------------
 * | ENQUEUE SCRIPTS
 * ----------------------------------------------------------------------------------------- */
/*add_action( 'wp_footer', 'setup_subscriber_fn', 4 );
function setup_subscriber_fn() {

    wp_register_script( 'setup_subscriber_ctas', plugins_url( '../js/spk_asset_master_plug_v1_min.js', __FILE__ ), NULL, '1.0', TRUE );     

    // Localize the script with new data
    $translation_array = array(
        'spk_master_one_ajax' => plugin_dir_url( __FILE__ ).'../ajax/spk_master_plug_v1_ajax.php',
    );
    wp_localize_script( 'setup_subscriber_ctas', 'spk_master_one', $translation_array );

    // Enqueue script with localized data.
    wp_enqueue_script( 'setup_subscriber_ctas' );

}
*/


// CTA | COMPRESSED
function setup_cta_compressed() {

	$upload_dir = wp_upload_dir();
	$free_ebook_page = setup_free_ebook_daw();

	return '<div class="module cta-icon" id="cta_compressed_target"><div class="module-wrap">
				<div><a class="item image link" href="'.$free_ebook_page.'" data-type="page"><img src="'.$upload_dir[ "baseurl" ].'/cta-mobile-free-ebook-icon.png" alt="" class="wp-image-41165" width="50" height="50"></a></div>
				<div class="items info"><div><a class="item title link" href="'.$free_ebook_page.'" data-type="page" data-id="1519">Free eBooks & Audio Program</a></div></div>
			</div></div>';
}


// CTA | EXPANDED
function setup_cta_expanded() {

	global $post; //$post->ID

	$upload_dir = wp_upload_dir();
	$free_ebook_page = setup_free_ebook_daw();


	// insert original subscribe pane if free-ebook page
	if( $post->post_name == 'free-ebook' ) {

		return NULL;

	} else {

		// id="cta_expander_target"
		return '<div class="module cta-main"><div class="module-wrap">
					<div><a class="item image link" href="'.$free_ebook_page.'" data-type="page" data-id="1536" data-id="freeebook"><img src="'.$upload_dir[ "baseurl" ].'/cta-mobile-free-ebook.jpg" alt="" class="wp-image-41159"/></a></div>
					<div class="items info">
						<h2><a class="item title link" href="'.$free_ebook_page.'">Get eBook for FREE!</a></h2><a class="item cta button" href="'.$free_ebook_page.'">CLICK HERE</a>
					</div>
				</div></div>';
	/*					<div><a class="item title link" href="'.$free_ebook_page.'">Get eBook for FREE!</a></div>
					<div><a class="item cta button" href="'.$free_ebook_page.'">CLICK HERE</a></div>
					<div class="item info fontsize-smaller margin-smaller-top">* Click to gain instant access to FREE Digital Online Versions of my popular eBooks &amp; audio course by signing up to our newsletter. It\'s absolutely FREE; you\'ll recieve the link on your email.</div>
	*/
	}

}

function setup_free_ebook_daw() {
	return get_permalink( get_page_by_path( "free-ebook" ) );
}


/*function setup_paging_page() {

	global $post; //$post->ID
	return $post->post_name;

}*/

/* ######################################################################################################
 * # BELOW 
 * ################################################################################################### */
// load jQuery to handle hiding/showing the sidebar and CTAs
add_action( 'wp_footer', 'setup_plug_showshide_sidebar_ctas' );
// HANDLE HIDING/SHOWING OF SIDEBAR AND CTAs
if( !function_exists( 'setup_plug_showshide_sidebar_ctas' ) ) {

	function setup_plug_showshide_sidebar_ctas() {

		global $post;

	    // ACCORDION
	    wp_register_script( 'setup_plug_sidebar_ctas', plugins_url( 'js/asset-desktab.js', __FILE__ ), NULL, '1.0', TRUE );
		// Localize the script with new data
		$translation_array = array(
			'cta_freeebook'		=> $post->post_name,
			'cta_hidepage'		=> urc_hide_subsribe_from_the_following_pages(),
//			'cta_expanded' 		=> setup_cta_expanded(),
//			'cta_expanded' 		=> setup_original_subscribe(),
			'cta_fbicons'		=> '<div class="group grid-cta-icon">'.urc_ctas().'</div>',
		);
	    wp_localize_script( 'setup_plug_sidebar_ctas', 'setup_plug_ctas', $translation_array );
	    wp_enqueue_script( 'setup_plug_sidebar_ctas' );
	    //wp_enqueue_script( 'setup_plugin_repo_accordion', plugins_url( 'js/asset.js', __FILE__ ) );

	}

}
