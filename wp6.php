<?php
/*
Plugin Name: ajax_autocomplete_wp6
Version: 1.0
Author: farah shofiatul
*/


class ajaxAutocomplete{	
	public function __construct(){
		add_shortcode('wp6_training', array($this, 'field'));
		add_action( 'wp_enqueue_scripts', array($this,'autocomplete_enqueue_scripts'));
		add_action( 'wp_ajax_my_action', array($this,'my_action'));
	}

	function field(){
	 	if ( isset( $_POST['cf-submitted'] ) ) {
	 		$title = $_POST["cf-title"];
			$query  = new WP_Query(  
    			array (  
        			'post_type' => 'post',
        			'posts_per_page' => 5
    			)  
			); 
			$post = $query->posts;
			foreach ($post as $value) {
				if (strrchr($value->post_title,$title)){
					echo $value->post_title.'</br>';
					echo $value->post_content.'</br>';
				}
			}		   
    	}	
    		echo '<form action="" method="post">';
			echo '<p>';
			echo 'Tittle <br />';
			echo '<input type="text" name="cf-title"  id="s" value="" size="40" />';
			echo '</p>';
			echo '<p><input type="submit" name="cf-submitted" value="Send"/></p>';
			echo '</form>';
    	
	}

	public function my_action() {
		$data = array();
		$string = $_GET['term'];
		$post_type_query = null;
		$post_type_query  = new WP_Query(  
    		array (  
        		'post_type'      => 'post',  
        		's' => $string 
    		)  
		); 
		$posts_array  = $post_type_query->posts;
		foreach (array_unique(wp_list_pluck( $posts_array, 'post_title' )) as $value) {
			array_push($data, array("id" => $value, "label" => $value, "value"=> $value));
		}
		wp_send_json($data);
    }
	
	public function autocomplete_enqueue_scripts() {
		wp_enqueue_style( 'auto-complete-style', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array('stm-theme-style') ); 		
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('autocomplete-js-2', plugin_dir_url( __FILE__ ).'js/wp6.js', array('jquery'));
		wp_localize_script('autocomplete-js-2', 'autojs', array('ajax_url'=>admin_url('admin-ajax.php')));
	}
}

new ajaxAutocomplete();
?>
