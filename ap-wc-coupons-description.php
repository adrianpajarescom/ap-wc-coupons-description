<?php

/**
 * Plugin Name:       adrianpajares.com - WooCommerce Coupon Description
 * Plugin URI:        https://adrianpajares.com/
 * Description:       Plugin to changes the coupon label output from Coupon: {code} to Coupon: {description} in WooCommerce.
 * Version:           1.0
 * Author:            adrianpajares.com
 * License:           MIT
*/

function swwp_change_coupon_preview( $label, $coupon ) {

	// WC 3.0+ compatibility
	if ( is_callable( array( $coupon, 'get_description' ) ) ) {
		$description = $coupon->get_description();
	} else {
		$coupon_post = get_post( $coupon->id );
		$description = ! empty( $coupon_post->post_excerpt ) ? $coupon_post->post_excerpt : null;
	}

	return $description ? sprintf( esc_html__( 'Coupon: %s', 'woocommerce' ), $description ) : esc_html__( 'Coupon', 'woocommerce' );
}
add_filter( 'woocommerce_cart_totals_coupon_label', 'swwp_change_coupon_preview', 10, 2 );
