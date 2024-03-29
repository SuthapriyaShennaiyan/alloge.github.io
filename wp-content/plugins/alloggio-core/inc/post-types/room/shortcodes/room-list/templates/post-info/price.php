<?php
$price = get_post_meta( get_the_ID(), 'qodef_room_single_price', true );

if ( ! empty( $price ) ) {
	$seasonal_price = alloggio_core_get_room_seasonal_price( get_the_ID() );
	
	if ( ! empty( $seasonal_price ) ) {
		$price = $seasonal_price;
	}
	?>
	<span class="qodef-e-price">
		<span class="qodef-e-price-label"><?php esc_html_e( 'from', 'alloggio-core' ); ?></span>
		<span class="qodef-e-price-value"><?php echo sprintf( '%s%s', alloggio_core_get_default_room_variables( 'currency' ), esc_html( $price ) ); ?></span>
	</span>
<?php } ?>