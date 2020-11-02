<?php

function setup_cta_icons_function() {

	$content = '<!-- wp:html -->
			<div class="module ctamain">
			<a class="item image link" href="https://staging.understandingrelationships.com/free-ebook" data-type="page" data-id="1536" data-id="freeebook"><figure class="wp-block-image size-large"><img src="https://staging.understandingrelationships.com/wp-content/uploads/cta-mobile-free-ebook.jpg" alt="" class="wp-image-41159"/></figure></a>
			<div class="items info">
			<h3 class="item title">Get eBook for FREE!</h3>
			<a class="item cta-button">CLICK HERE</a>
			<p class="fontsize-smaller margin-smaller-top">* When you signup for our newsletter</p>
			</div>
			</div>
			<p class="fontsize-tiny color-darkgray">Enter your name &amp; email in the boxes above to gain access to FREE Digital Online Versions of my popular eBooks &amp; audio course. When you click the “Instant Access” button, you will gain access to the members area of my website to read my eBooks, &amp; listen to the audio lessons right in your web browser! You’ll also get my best pickup, dating, relationship &amp; life success secrets &amp; strategies in my FREE newsletter. All information is 100% confidential.</p>
			<!-- /wp:html -->

			<!-- wp:group {"className":"group\u002d\u002dgrid-2columns"} -->
			<div class="wp-block-group group--grid-2columns"><div class="wp-block-group__inner-container"><!-- wp:html -->
			<div class="module ctamain icon">
			<a class="item image link" href="https://staging.understandingrelationships.com/products" data-type="page" data-id="1519"><figure class="wp-block-image size-large is-resized"><img src="https://staging.understandingrelationships.com/wp-content/uploads/cta-mobile-coaching-icon.png" alt="" class="wp-image-41163" width="50" height="50"></figure></a>
			<div class="items info">
			<h3 class="item title">Coaching</h3>
			</div>
			</div>
			<!-- /wp:html -->

			<!-- wp:html -->
			<div class="module ctamain icon">
			<a class="item image link" href="https://teespring.com/stores/coach-corey-wayne"><figure class="wp-block-image size-large is-resized"><img src="https://staging.understandingrelationships.com/wp-content/uploads/cta-mobile-products-icon.png" alt="" class="wp-image-41161" width="50" height="50"></figure></a>
			<div class="items info">
			<h3 class="item title">Buy Merch</h3>
			</div>
			</div>
			<!-- /wp:html -->

			<!-- wp:html -->
			<div class="module ctamain icon">
			<a class="item image link" href="https://staging.understandingrelationships.com/sidebar/donate" data-type="page" data-id="26341"><figure class="wp-block-image size-large is-resized"><img src="https://staging.understandingrelationships.com/wp-content/uploads/cta-mobile-donate-icon.png" alt="" class="wp-image-41164" width="50" height="50"></figure></a>
			<div class="items info">
			<h3 class="item title">Donate</h3>
			</div>
			</div>
			<!-- /wp:html -->

			<!-- wp:html -->
			<div class="module ctamain icon">
			<a class="item image link" href="https://staging.understandingrelationships.com/products" data-type="page" data-id="1519"><figure class="wp-block-image size-large is-resized"><img src="https://staging.understandingrelationships.com/wp-content/uploads/cta-mobile-all-books-icon.png" alt="" class="wp-image-41162" width="50" height="50"></figure></a>
			<div class="items info">
			<h3 class="item title">All Books</h3>
			</div>
			</div>
			<!-- /wp:html --></div></div>
			<!-- /wp:group -->';

    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );
    echo $content;

}