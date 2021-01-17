<?php
// test mobile detect


add_action( 'genesis_before_content', 'x_detector' );
function x_detector() {
	global $post;

	if( $post->post_name == 'test-video-block' ) { // LIVE
	//if( $post->post_name == 'aaa-test-suggested-articles' ) { // TEST

		//INITIALIZE MOBILE DETECT PLUGIN
		$detect = new Mobile_Detect;

		if( $detect->isTablet() || !$detect->isMobile() ) {
			echo '<h1>TABLET / DESKTOP</h1>';
		} else {
			echo '<h1>MOBILE</h1>';
		}

	}
}