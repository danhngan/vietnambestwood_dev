<?php
class Custom_Field {
    public $field_id;
    public $field_name;
    public $field_key;
    public $field_val;


    public function __construct($field_id,$field_name,$field_key,$field_val){
        $this->field_id = $field_id;
        $this->field_name = $field_name;
        $this->field_key = $field_key;
        $this->field_val = $field_val;
    }

    public function to_row(){
        $output = '<tr><th scope="row">'.$this->field_name.'</th>';
        $output .= '<td><label for="key_'.$this->field_id.'">Key: </label>';
        $output .= '<input type="text" id="key_'.$this->field_id.'" name="key_'.$this->field_id.'" value="'.$this->field_key.'">';
        $output .= '<td><label for="val_'.$this->field_id.'">Value: </label>';
        $output .= '<input type="text" id="val_'.$this->field_id.'" name="val_'.$this->field_id.'" value="'.$this->field_val.'">';
        $output .= '</td></tr>';
        return $output;
    }
}

class Custom_Media_Field {
    public $field_id;
    public $field_name;
    public $field_val;


    public function __construct($field_id,$field_name,$field_val){
        $this->field_id = $field_id;
        $this->field_name = $field_name;
        $this->field_val = $field_val;
    }

    public function to_row(){
        $output = '<tr><th scope="row">'.$this->field_name.'</th>';
        $output .= '<td>';
        $output .= '<img src="'.$this->field_val.'" draggable="false" alt="" width="150" height="150">';
        $output .= '</td>';
        $output .= '<td><button id="'.$this->field_id.'_close_btn'.'" type="button" class="dismiss-media-btn btn">Dismiss</button></td></tr>';
        return $output;
    }
}

class Custom_Meta_Box {
    public $box_id;
    public $box_title;
    public $script_path;
    public $meta_field_id;

    public function __construct($box_id, $box_title, $script_path){
        $this->box_id = $box_id;
        $this->meta_field_id = $box_id.'_field';
        $this->box_title = $box_title;
        $this->script_path = $script_path;
    }
	/**
	 * Set up and add the meta box.
	 */
	public function add() {
		$screens = ['post'];
		foreach ( $screens as $screen ) {
			add_meta_box(
				$this->box_id,          // Unique ID
				$this->box_title, // Box title
				[$this,'html'],   // Content callback, must be of type callable
				$screen                  // Post type
			);
		}
	}


	/**
	 * Save the meta box selections.
	 *
	 * @param int $post_id  The post ID.
	 */
	public function save( int $post_id ) {
        update_post_meta(
            $post_id,
            $this->meta_field_id,
            array(
                array('key'=>'key1','val'=>'val1'),
                array('key'=>'key2','val'=>'val2'),
            )
        );
		// if ( array_key_exists( $this->meta_field_id, $_POST ) ) {
			
		// }
	}


	/**
	 * Display the meta box HTML to the user.
	 *
	 * @param WP_Post $post   Post object.
	 */
	public function html( $post ) {
		$fields_meta = get_post_meta( $post->ID, $this->meta_field_id, true );
        if (!$fields_meta){
            $fields_meta = array();
        }
        $fields = array();
        for($i=0;$i<count($fields_meta);$i++) {
            $field_id = $this->box_id . '_' . (string)($i+1);
            $field_name = $this->box_title . ' ' . (string)($i+1);
            $field_key = $fields_meta[$i]['key'];
            $field_val = $fields_meta[$i]['val'];
            $fields[] = new Custom_Field($field_id,$field_name,$field_key,$field_val);
        }
	?>
    <div>
        <button id="add_new_<?php echo $this->box_id;?>_btn" type="button">Add new</button>
    </div>
    <div>
        <table id="<?php echo $this->box_id;?>_table">
        <tbody>
                <?php 
                foreach ($fields as $field){
                    echo $field->to_row();
                    }
                ?>
        </tbody>
        </table>
    </div>
    <div>
        <button id="submit_<?php echo $this->box_id;?>_btn" type="button">Submit</button>
    </div>
	<?php
    }
    public function register_scripts(){
        // get current admin screen, or null
    $screen = get_current_screen();
    // verify admin screen object
    if (is_object($screen)) {
        // enqueue only for specific post types
        if (in_array($screen->post_type, ['post'])) {
            // enqueue script
            wp_enqueue_script($this->box_id.'_scripts', $this->script_path, ['jquery'],'1.07');
            // localize script, create a custom js object
            wp_localize_script(
                $this->box_id.'_scripts',
                'field_obj',
                [
                    'url' => admin_url('admin-ajax.php'),
                    'box_id' => $this->box_id,
                    'box_title' => $this->box_title,
                    'action' => $this->box_id.'_save',
                    'meta_field' => $this->meta_field_id
                ]
            );
        }
}
}
    public function ajax_handler() {
    // Handle the ajax request here
    if ( array_key_exists( 'data', $_POST ) ) {
        $post_id = (int) $_POST['post_ID'];
        if ( current_user_can( 'edit_post', $post_id ) ) {
            update_post_meta(
                $post_id,
                $this->meta_field_id,
                $_POST['data']
            );
        }
    }
 
    wp_die(); // All ajax handlers die when finished
}
}



class Custom_Media_Box {
    public $box_id;
    public $box_title;
    public $script_path;
    public $meta_field_id;

    public function __construct($box_id, $box_title, $script_path){
        $this->box_id = $box_id;
        $this->meta_field_id = $box_id.'_field';
        $this->box_title = $box_title;
        $this->script_path = $script_path;
    }
	/**
	 * Set up and add the meta box.
	 */
	public function add() {
		$screens = ['post'];
		foreach ( $screens as $screen ) {
			add_meta_box(
				$this->box_id,          // Unique ID
				$this->box_title, // Box title
				[$this,'html'],   // Content callback, must be of type callable
				$screen                  // Post type
			);
		}
	}


	/**
	 * Save the meta box selections.
	 *
	 * @param int $post_id  The post ID.
	 */
	public function save( int $post_id ) {
        update_post_meta(
            $post_id,
            $this->meta_field_id,
            array(
                '/wp-content/uploads/2023/12/footer-back-ground-300x206.jpg'
            )
        );
		// if ( array_key_exists( $this->meta_field_id, $_POST ) ) {
			
		// }
	}


	/**
	 * Display the meta box HTML to the user.
	 *
	 * @param WP_Post $post   Post object.
	 */
	public function html( $post ) {
		$images = get_post_meta($post->ID, $this->meta_field_id, true);
        if (!$images){
            $images = array();
        }
        $fields = array();
        for($i=0;$i<count($images);$i++) {
            $field_id = $this->box_id . '_' . (string)($i+1);
            $field_name = $this->box_title . ' ' . (string)($i+1);
            $field_val = $images[$i];
            $fields[] = new Custom_Media_Field($field_id,$field_name,$field_val);
        }
    ?>
    <div>
        <button id="<?php echo $this->box_id.'_upload';?>" type="button"><?php _e('Upload Image'); ?></button>
    </div>
    <table id="<?php echo $this->box_id.'_table';?>">
        <tbody>
        <?php 
        foreach ($fields as $field){
            echo $field->to_row();
            }
        ?>
        </tbody>
    </table>
	<?php
    }
    public function register_scripts(){
        // get current admin screen, or null
    $screen = get_current_screen();
    // verify admin screen object
    if (is_object($screen)) {
        // enqueue only for specific post types
        wp_enqueue_media();
        if (in_array($screen->post_type, ['post'])) {
            // enqueue script
            wp_enqueue_script($this->box_id.'_scripts', $this->script_path, ['jquery'],'0.091');
            // localize script, create a custom js object
            wp_localize_script(
                $this->box_id.'_scripts',
                'media_obj',
                [
                    'url' => admin_url('admin-ajax.php'),
                    'box_id' => $this->box_id,
                    'box_title' => $this->box_title,
                    'action' => $this->box_id.'_save',
                    'meta_field' => $this->meta_field_id
                ]
            );
        }
}
}
    public function ajax_handler() {
    // Handle the ajax request here
    if ( array_key_exists( 'data', $_POST ) ) {
        $post_id = (int) $_POST['post_ID'];
        if ( current_user_can( 'edit_post', $post_id ) ) {
            update_post_meta(
                $post_id,
                $this->meta_field_id,
                $_POST['data']
            );
        }
    }
 
    wp_die(); // All ajax handlers die when finished
}
}