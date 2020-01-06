<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.gcgeo.com/
 * @since      1.0.0
 *
 * @package    Cgp_Shortcodes
 * @subpackage Cgp_Shortcodes/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cgp_Shortcodes
 * @subpackage Cgp_Shortcodes/public
 * @author     gcgeo <vautour.pascal@gmail.com>
 */
class Cgp_Shortcodes_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cgp_Shortcodes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cgp_Shortcodes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'bootstrap-css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), '4.3.1', 'all');
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cgp-shortcodes-public.css', array(), $this->version, 'all' );
		


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cgp_Shortcodes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cgp_Shortcodes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script('bootstrap-js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js', array('jquery'), '4.3.1', true );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cgp-shortcodes-public.js', array( 'jquery' ), $this->version, false );
	
	}

	public function hello_world_shortcode() {
		return <<<HTML
		<html>
		<div class="card">
		    <div class="card-body">
		        <h5 class="card-title">Hello world!</h5>
		        <h6 class="card-subtitle mb-2 text-muted">Up and running</h6>
				<p class="card-text">This is a confirmation that the cgp-shortcodes plugin is properly working</p>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
		            <strong>Success!</strong> Dismiss this to test the javascript!
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
		    </div>
		</div>
		<html>
HTML;
	}	

}