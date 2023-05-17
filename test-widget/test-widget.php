<?php
/**
 * Plugin Name: Custom Elementor Addon
 * Description: Custom Elementor Addon for start something new.
 * Plugin URI:  https://araf.space/
 * Version:     1.0.0
 * Author:      Araf 
 * Author URI:  https://araf.space/
 * Text Domain: custom_elementor_widget
 */
namespace ElementorCustom;

class Custom {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function widget_scripts() {
		
	}

	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/test.php' );

	}

	function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'custom-category',
			[
				'title' => __( 'Custom Addon', 'custom_elementor_widget' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	public function register_widgets() {
		$this->include_widgets_files();
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Test() );
	}

	public function __construct() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories'] );
	}
}

Custom::instance();
