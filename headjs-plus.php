<?php
/**
Plugin Name: HeadJS Plus
Plugin URI: http://wordpress.org/extend/plugins/headjs-plus/
Description: A plugin to load <a href="http://headjs.com">HeadJS</a> in Wordpress to speedup loading.
Version: 0.96.1
Author: Ramoonus
Author URI: http://www.ramoonus.nl/
*/

// when its not declared
if (!class_exists('headJS_loader')) {
/*
 * headJS_loader is the class that handles ALL of the plugin functionality. It helps us avoid name collisions
 * http://codex.wordpress.org/Writing_a_Plugin#Avoiding_Function_Name_Collisions
 * @package headJS_loader
 */
class headJS_loader {

	/* Initializes the plugin and sets up all actions and hooks necessary.	 */
	function headJS_loader() {
	
		/* No need to run on admin / rss / xmlrpc */
		if (!is_admin() && !is_feed() && !defined('XMLRPC_REQUEST')) {
			$this->_pluginName = 'headjs-plus';
			add_action('init', array($this, 'pre_content'), 99998);
			add_action('wp_footer', array($this, 'post_content'));
		}
		
	}
	
	/* Buffer the output so we can play with it. */
	function pre_content() {
	
		ob_start(array($this, 'modify_buffer'));

		/* Variable for sanity checking */
		$this->buffer_started = true;

    }
	
	/**
	 * Modify the buffer.  Search for any js tags in it and replace them with Head JS calls.
	 *
	 * @return string buffer
	 */
	function modify_buffer($buffer) {
	
		$script_array = array();
		/* Look for any script tags in the buffer */
		preg_match_all('/<script([^>]*?)><\/script>/i', $buffer, $script_tags_match);		
		if (!empty($script_tags_match[0])) {
			foreach ($script_tags_match[0] as $script_tag) {
				if (strpos(strtolower($script_tag), 'text/javascript') !== false) {
					preg_match('/src=[\'"]([^\'"]+)/', $script_tag, $src_match);
					if ($src_match[1]) {
						/* Remove the script tags */
						$buffer = str_replace($script_tag, '', $buffer);
						/* Save the script location */
						$script_array[] = $src_match[1];
					}
				}
			}
		}
	
		/* Sort out the Head JS */
		$headJS = '<script type="text/javascript" src="' . get_bloginfo('wpurl') . '/wp-content/plugins/' . $this->_pluginName . '/js/head.min.js"></script>';
		
		if (!empty($script_array)) {
			$script_array = array_unique($script_array);
			$i=0;
			foreach ($script_array as $script_location) {
				/* Load the scripts into a .js */
				if ($i != 0) { $js_files .= "\n    "; }
				$js_files .= '.js("' . $script_location . '")';
				$i++;
			}
			$headJS .= "\n<script>\nhead" . $js_files . ";\n</script>";
		}
		
		/* Write Head JS before the end of head */
		$buffer = str_replace('</head>', $headJS . "\n</head>", $buffer);
		
		return $buffer;
	}
	
	/* After we are done modifying the contents, flush everything out to the screen.	 */
	function post_content() {
      // sanity checking
      if ($this->buffer_started) {
        ob_end_flush();
      }
    }
	
} // class headJS_loader
} // if !class_exists('headJS_loader')

/* 
 * Instantiate our class
 */
if (class_exists('headJS_loader')) {
  $headJS_loader = new headJS_loader();
}
?>