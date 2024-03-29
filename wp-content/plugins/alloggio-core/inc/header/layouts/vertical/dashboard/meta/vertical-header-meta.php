<?php

if ( ! function_exists( 'alloggio_core_add_vertical_header_meta' ) ) {
	function alloggio_core_add_vertical_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_vertical_header_section',
				'title'      => esc_html__( 'Vertical Header', 'alloggio-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'vertical',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_vertical_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'alloggio-core' ),
				'description' => esc_html__( 'Enter header background color', 'alloggio-core' )
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_vertical_header_background_image',
				'title'       => esc_html__( 'Header Background Image', 'alloggio-core' ),
				'description' => esc_html__( 'Enter header background image', 'alloggio-core' )
			)
		);

	}
	
	add_action( 'alloggio_core_action_after_page_header_meta_map', 'alloggio_core_add_vertical_header_meta' );
}