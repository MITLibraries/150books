<?php

if ( ! function_exists( 'filter_media_comment_status' ) ) {
  function filter_media_comment_status( $open, $post_id ) {
		$post = get_post( $post_id );
		if( $post->post_type == 'attachment' ) {
			return false;
		}
		return $open;
	}
	add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );
}

/**
 * Force URLs in srcset attributes into HTTPS scheme.
 * @link https://wordpress.org/support/topic/responsive-images-src-url-is-https-srcset-url-is-http-no-images-loaded?replies=19#post-7767555
 */
function ssl_srcset( $sources ) {
	foreach ( $sources as &$source ) {
		$source['url'] = set_url_scheme( $source['url'], 'https' );
	}

	return $sources;
}
add_filter( 'wp_calculate_image_srcset', 'ssl_srcset' );

?>