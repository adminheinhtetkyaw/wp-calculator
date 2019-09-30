<?php
/**
 * Plugin Name:     Calculators
 * Plugin URI:      demo.gresak.net
 * Description:     Plugin with various calculators that you can add to pages using shortcodes
 * Author:          Gregor Gresak
 * Author URI:      https://gresak.net
 * Text Domain:     calculators
 * Domain Path:     /languages
 * Version:         1.1.2
 *
 * @package         Calculators
 */


Calculators::instance();

class Calculators {

	protected $version;

	protected $url;

	protected $path;

	private static $instance;

	protected function __construct() {
		$this->set_version();
		$this->set_plugin_url();
		$this->set_path();
		add_action('wp_enqueue_scripts', array($this, "load_scripts"));
		add_shortcode( 'calculator', array($this,"calculators") );
	}

	public function calculators($atts) {
		if(empty($atts)) return;
		$file = $this->path."calculators/".$atts[0].".php";
		if(file_exists($file)) {
			return file_get_contents($file);
		}

		//include_once 
	}

	public function load_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_style( "calculators_css", $this->url."css/style.css", false, $this->version );
	}

	protected function set_plugin_url() {
		$this->url = trailingslashit(plugin_dir_url(__FILE__));
	}

	protected function set_path() {
		$this->path = trailingslashit(dirname(__FILE__));
	}

	protected function set_version() {
		$theme = wp_get_theme();
		$wp_version = get_bloginfo( 'version' );
		$data = get_file_data(__FILE__,array('Version' => 'Version'));
		$this->version =  $wp_version ."." . $data['Version'];
	}

	public static function instance() {
		if (null === static::$instance) {
            static::$instance = new static();
        }
        
        return static::$instance;
	}

}
