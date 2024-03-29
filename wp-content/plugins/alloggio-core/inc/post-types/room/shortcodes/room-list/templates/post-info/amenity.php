<?php
$term_values = get_the_terms( get_the_ID(), 'amenity' );

if ( ! empty( $term_values ) && ! is_wp_error( $term_values ) ) { ?>
	<div class="qodef-e-amenity-items">
		<?php foreach ( $term_values as $term_value ) {
			$term_svg_icon        = get_term_meta( $term_value->term_id, 'qodef_amenity_svg_icon', true );
			$term_svg_custom_icon = get_term_meta( $term_value->term_id, 'qodef_amenity_custom_svg_icon', true );
			
			if ( ! empty( $term_svg_icon ) || ! empty( $term_svg_custom_icon ) ) { ?>
				<div class="qodef-e-amenity-item qodef-ei">
					<div class="qodef-ei-link">
						<span class="qodef-ei-svg">
							<?php if ( ! empty( $term_svg_icon ) ) {
								alloggio_core_template_part( 'post-types/room', 'templates/parts/icons/' . esc_attr( $term_svg_icon ), '', array( 'icon_class' => esc_attr( $term_svg_icon ) ) );
							} elseif ( ! empty( $term_svg_custom_icon ) ) {
								echo qode_framework_wp_kses_html( 'html', $term_svg_custom_icon );
							} ?>
						</span>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
<?php }
