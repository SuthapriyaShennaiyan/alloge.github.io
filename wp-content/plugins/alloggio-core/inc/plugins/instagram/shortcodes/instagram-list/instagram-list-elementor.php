<?php

class AlloggioCoreElementorInstagramList extends AlloggioCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'alloggio_core_instagram_list' );

		parent::__construct( $data, $args );
	}
}

if ( qode_framework_is_installed( 'instagram' ) ) {
	alloggio_core_register_new_elementor_widget( new AlloggioCoreElementorInstagramList() );
}
