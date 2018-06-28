<?php
/**
 * 150 Books (child theme of Twenty Ten)
 *
 * This was developed in 2010 as part of the MIT 150 celebration.
 * It has been under minimal maintenance since that time.
 *
 * @package 150books
 * @since 1.0.0
 */

/**
 * Filter media comment status.
 *
 * @param string  $open Uncertain.
 * @param integer $post_id The Post ID we are filtering.
 */
function mitlib_filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if ( 'attachment' == $post->post_type ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'mitlib_filter_media_comment_status', 10, 2 );

/**
 * Force URLs in srcset attributes into HTTPS scheme.
 *
 * @link https://wordpress.org/support/topic/responsive-images-src-url-is-https-srcset-url-is-http-no-images-loaded?replies=19#post-7767555
 * @param object $sources Uncertain.
 */
function ssl_srcset( $sources ) {
	foreach ( $sources as &$source ) {
		$source['url'] = set_url_scheme( $source['url'], 'https' );
	}

	return $sources;
}
add_filter( 'wp_calculate_image_srcset', 'ssl_srcset' );
