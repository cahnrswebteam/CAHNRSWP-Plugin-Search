<?php
/**
* Plugin Name: CAHNRSWP Custom Search Bar
* Plugin URI:  http://cahnrs.wsu.edu/communications/
* Description: Adds custom search bar shortcode
* Version:     0.0.1
* Author:      CAHNRS Communications, Danial Bleile
* Author URI:  http://cahnrs.wsu.edu/communications/
* License:     Copyright Washington State University
* License URI: http://copyright.wsu.edu
*/
class Init_CAHNRSWP_Search_Bar {
	
	private static $instance = null;
	
	public static function get_instance(){ 
		
		if( null == self::$instance ) { 
			self::$instance = new self;
		} // end if
		
		return self::$instance;
	} // end get_instance
	
	private function __construct(){
		
		add_action( 'init', array( $this , 'cahnrswp_register_shortcodes' ) );
		
		add_filter( 'pre_get_posts', array( $this , 'cahnrswp_pre_get_posts' ) , 10, 1 );
		
	} // end constructor
	
	public function cahnrswp_register_shortcodes(){
		
		add_shortcode( 'CAHNRSWPSEARCH', array( $this , 'CAHNRSWPSEARCH_do_shortcode' ) );
		
	}
	
	public function CAHNRSWPSEARCH_do_shortcode( $atts ){
		
		$a = shortcode_atts( array(
        	'taxid' => false,
        	'taxtype' => false,
    		), $atts );
		
		ob_start();
		
		include plugin_dir_path( __FILE__ ).'inc/search-form.php';
		
		return ob_get_clean();
	}
	
	public function cahnrswp_pre_get_posts ( $query ){
		
		if( isset( $_GET['taxid'] ) && $_GET['taxid'] ) {
			
			$taxid = $_GET['taxid'];
			
			$taxtype = 'cat';
			
			if( is_numeric ( $taxid ) ) {
			
				$query->set( $taxtype , $taxid );
				
			}
			
		} // end if taxterm
		
	}
	
	
	
} // end class CAHNRSWP_search_bar

class CAHNRSWP_search_bar_model {
	
	
	public function __construct(){
	}
	
} // end class CAHNRSWP_search_bar_model

class CAHNRSWP_search_bar_view {
	private $control;
	private $model;
	
	public function __construct( $control , $model ){
		
		$this->control = $control;
		$this->model = $model;
		
	} // end __construct
	
	
} // end class CAHNRSWP_search_bar_view

$CAHNRSWP_search_bar = Init_CAHNRSWP_Search_Bar::get_instance();