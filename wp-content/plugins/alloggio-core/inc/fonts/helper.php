<?php

if ( ! function_exists( 'alloggio_core_choosen_google_fonts_list' ) ) {
	/**
	 * Function that returns array of custom fonts
	 * @return array
	 */
	function alloggio_core_choosen_google_fonts_list() {
		$google_fonts_list = array();
		$google_fonts      = alloggio_core_get_option_value( 'admin', 'qodef_choose_google_fonts' );
		
		if ( ! empty( $google_fonts ) && is_array( $google_fonts ) ) {
			foreach ( $google_fonts as $google_font ) {
				$google_fonts_list[] = qode_framework_get_formatted_font_family( $google_font['qodef_choose_google_font'] );
			}
		}
		
		return $google_fonts_list;
	}
}

if ( ! function_exists( 'alloggio_core_add_choosen_google_fonts_to_list' ) ) {
	/**
	 * Function that returns array of custom fonts
	 * @return array
	 */
	function alloggio_core_add_choosen_google_fonts_to_list( $complete_fonts_array ) {
		$google_fonts_list = array();
		$google_fonts      = alloggio_core_choosen_google_fonts_list();
		
		if ( ! empty( $google_fonts ) && is_array( $google_fonts ) ) {
			foreach ( $google_fonts as $google_font ) {
				$google_font_key                       = qode_framework_get_formatted_font_family( $google_font, true );
				$google_fonts_list[ $google_font_key ] = $google_font;
			}
		}
		
		return array_merge( $complete_fonts_array, $google_fonts_list );
	}
	
	add_filter( 'qode_framework_filter_complete_fonts_list', 'alloggio_core_add_choosen_google_fonts_to_list' );
}

if ( ! function_exists( 'alloggio_core_custom_fonts_list' ) ) {
	/**
	 * Function that returns array of custom fonts
	 * @return array
	 */
	function alloggio_core_custom_fonts_list() {
		$custom_fonts_list = array();
		$custom_fonts      = alloggio_core_get_post_value_through_levels( 'qodef_custom_fonts' );
		
		if ( ! empty( $custom_fonts ) && is_array( $custom_fonts ) ) {
			foreach ( $custom_fonts as $custom_font ) {
				$custom_fonts_list[] = $custom_font['qodef_custom_font_name'];
			}
		}
		
		return $custom_fonts_list;
	}
}

if ( ! function_exists( 'alloggio_core_add_custom_fonts_to_list' ) ) {
	/**
	 * Function that returns array of custom fonts
	 * @return array
	 */
	function alloggio_core_add_custom_fonts_to_list( $complete_fonts_array ) {
		$custom_fonts_list = array();
		$custom_fonts      = alloggio_core_custom_fonts_list();
		
		if ( ! empty( $custom_fonts ) && is_array( $custom_fonts ) ) {
			foreach ( $custom_fonts as $custom_font ) {
				$custom_font_key                       = str_replace( ' ', '+', $custom_font );
				$custom_fonts_list[ $custom_font_key ] = $custom_font;
			}
		}
		
		return array_merge( $complete_fonts_array, $custom_fonts_list );
	}
	
	add_filter( 'qode_framework_filter_complete_fonts_list', 'alloggio_core_add_custom_fonts_to_list' );
}

if ( ! function_exists( 'alloggio_core_is_custom_font' ) ) {
	/**
	 * Function that checks if given font is native font
	 *
	 * @param string $font_family
	 *
	 * @return bool
	 */
	function alloggio_core_is_custom_font( $font_family ) {
		return in_array( qode_framework_get_formatted_font_family( $font_family ), alloggio_core_custom_fonts_list() );
	}
}

if ( ! function_exists( 'alloggio_core_disable_google_font' ) ) {
	/**
	 * Function that remove google fonts from fonts array
	 * @return array
	 */
	function alloggio_core_disable_google_font( $fonts ) {
		
		if ( alloggio_core_get_post_value_through_levels( 'qodef_enable_google_fonts' ) == 'no' ) {
			return array();
		}
		
		return $fonts;
	}
	
	add_filter( 'qode_framework_filter_google_fonts', 'alloggio_core_disable_google_font' );
}

if ( ! function_exists( 'alloggio_core_disable_google_font_options' ) ) {
	/**
	 * Function that remove Google fonts from fonts array
	 *
	 * @param array $fonts
	 *
	 * @return array
	 */
	function alloggio_core_disable_google_font_options( $fonts ) {
		if ( 'no' === alloggio_core_get_post_value_through_levels( 'qodef_enable_google_fonts' ) ) {
			return array();
		}
		return $fonts;
	}
	add_filter( 'qode_framework_filter_google_fonts', 'alloggio_core_disable_google_font_options' );
}


if ( ! function_exists( 'alloggio_core_disable_google_font' ) ) {
	/**
	 * Function that remove Google fonts loading
	 *
	 * @return bool
	 */
	function alloggio_core_disable_google_font() {
		return 'no' !== alloggio_core_get_post_value_through_levels( 'qodef_enable_google_fonts' );
	}
	add_filter( 'alloggio_filter_enable_google_fonts', 'alloggio_core_disable_google_font' );
}

if ( ! function_exists( 'alloggio_core_custom_font_style' ) ) {
	function alloggio_core_custom_font_style( $style ) {
		$custom_fonts = alloggio_core_get_post_value_through_levels( 'qodef_custom_fonts' );
		
		if ( ! empty( $custom_fonts ) && is_array( $custom_fonts ) ) {
			foreach ( $custom_fonts as $custom_font ) {
				$comma = '';
				
				if ( $custom_font['qodef_custom_font_name'] != '' ) {
					$style .= '@font-face {';
					$style .= 'font-family: ' . esc_attr( $custom_font['qodef_custom_font_name'] ) . ';';
					$style .= 'src:';
					if ( $custom_font['qodef_custom_font_woff2'] != '' ) {
						$style .= 'url(' . esc_url( wp_get_attachment_url( $custom_font['qodef_custom_font_woff2'] ) ) . ') format("woff2")';
						$comma = ',';
					}
					if ( $custom_font['qodef_custom_font_woff'] != '' ) {
						$style .= $comma . 'url(' . esc_url( wp_get_attachment_url( $custom_font['qodef_custom_font_woff'] ) ) . ') format("woff")';
						$comma = ',';
					}
					if ( $custom_font['qodef_custom_font_ttf'] != '' ) {
						$style .= $comma . 'url(' . esc_url( wp_get_attachment_url( $custom_font['qodef_custom_font_ttf'] ) ) . ') format("truetype")';
						$comma = ',';
					}
					if ( $custom_font['qodef_custom_font_otf'] != '' ) {
						$style .= $comma . 'url(' . esc_url( wp_get_attachment_url( $custom_font['qodef_custom_font_otf'] ) ) . ') format("truetype")';
					}
					$style .= ';}';
				}
			}
		}
		
		return $style;
	}
	
	add_filter( 'alloggio_filter_add_inline_style', 'alloggio_core_custom_font_style' );
}

if ( ! function_exists( 'alloggio_core_add_google_fonts_to_define_font_list' ) ) {
	function alloggio_core_add_google_fonts_to_define_font_list( $fonts ) {
		$font_field_array = alloggio_core_choosen_google_fonts_list();
		
		if ( count( $font_field_array ) > 0 ) {
			foreach ( $font_field_array as $font_option ) {
				$fonts[] = str_replace( '+', ' ', $font_option );
			}
		}
		
		return $fonts;
	}
	
	add_filter( 'alloggio_filter_google_fonts_list', 'alloggio_core_add_google_fonts_to_define_font_list' );
}

if ( ! function_exists( 'alloggio_core_add_weights_to_font_weight_list' ) ) {
	function alloggio_core_add_weights_to_font_weight_list( $font_weights ) {
		$options = alloggio_core_get_post_value_through_levels( 'qodef_google_fonts_weight' );

		if ( ! empty( $options ) && is_array( $options ) ) {
			$font_weights = array_merge( $font_weights, array_filter( $options, 'strlen' ) );
		}

		return $font_weights;
	}
	
	add_filter( 'alloggio_filter_google_fonts_weight_list', 'alloggio_core_add_weights_to_font_weight_list' );
}

if ( ! function_exists( 'alloggio_core_add_subsets_to_subset_list' ) ) {
	function alloggio_core_add_subsets_to_subset_list( $font_subsets ) {
		$options = alloggio_core_get_post_value_through_levels( 'qodef_google_fonts_subset' );

		if ( ! empty( $options ) && is_array( $options ) ) {
			$font_subsets = array_merge( $font_subsets, array_filter( $options, 'strlen' ) );
		}

		return $font_subsets;
	}
	
	add_filter( 'alloggio_filter_google_fonts_subset_list', 'alloggio_core_add_subsets_to_subset_list' );
}
