<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class smdp_Fly_Button_Admin_API {

	/**
	 * Constructor function
	 */
	public function __construct () {
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 10, 1 );
	}

	/**
	 * Generate HTML for displaying fields
	 * @param  array   $field Field data
	 * @param  boolean $echo  Whether to echo the field HTML or return it
	 * @return void
	 */
	public function display_field ( $data = array(), $post = false, $echo = true ) {

		// Get field info
		if ( isset( $data['field'] ) ) {
			$field = $data['field'];
		} else {
			$field = $data;
		}

		// Check for prefix on option name
		$option_name = '';
		if ( isset( $data['prefix'] ) ) {
			$option_name = $data['prefix'];
		}

		// Get saved data
		$data = '';
		if ( $post ) {

			// Get saved field data
			$option_name .= $field['id'];
			$option = get_post_meta( $post->ID, $field['id'], true );

			// Get data to display in field
			if ( isset( $option ) ) {
				$data = $option;
			}

		} else {

			// Get saved option
			$option_name .= $field['id'];
			$option = get_option( $option_name );

			// Get data to display in field
			if ( isset( $option ) ) {
				$data = $option;
			}

		}

		// Show default data if no option saved and default is supplied
		if ( $data === false && isset( $field['default'] ) ) {
			$data = $field['default'];
		} elseif ( $data === false ) {
			$data = '';
		}

		$html = '';

		switch( $field['type'] ) {

			case 'text':
			case 'url':
			case 'email':
                            ?>
				<input id="<?php echo esc_attr( $field['id'] ); ?>" type="text" name="<?php echo esc_attr( $option_name ); ?>" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" value="<?php echo esc_attr( $data ); ?>" />
		<?php
                            break;

			case 'password':
			case 'number':
			case 'hidden':
				$min = '';
				if ( isset( $field['min'] ) ) {
					$min = ' min="' . esc_attr( $field['min'] ) . '"';
				}

				$max = '';
				if ( isset( $field['max'] ) ) {
					$max = ' max="' . esc_attr( $field['max'] ) . '"';
				}
                                
                                ?>
                                
				<input id="<?php echo esc_attr( $field['id'] ); ?>" type="<?php echo esc_attr( $field['type'] ); ?>" name="<?php echo esc_attr( $option_name ); ?>" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" value="<?php echo esc_attr( $data ); ?>" <?php echo esc_attr( $min ); ?> <?php echo esc_attr( $max ); ?>/>
		
                                <?php
                                
                                break;

			case 'text_secret':
                            ?>
				<input id="<?php echo esc_attr( $field['id'] ); ?>" type="text" name="<?php echo esc_attr( $option_name ); ?>" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" value="" />
                            <?php
                            break;

			case 'textarea':
                            ?>
				<textarea id="<?php echo esc_attr( $field['id'] ); ?>" rows="5" cols="50" name="<?php echo esc_attr( $option_name ); ?>" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>"><?php echo esc_attr( $data ); ?></textarea><br/>
	
                                <?php 
                                break;

			case 'checkbox':
				$checked = '';
				if ( $data && 'on' == $data ) {
					$checked = 'checked="checked"';
				}
                                ?>
				<input id="<?php echo esc_attr( $field['id'] ); ?>" type="<?php echo esc_attr( $field['type'] ); ?>" name="<?php echo esc_attr( $option_name ); ?>" <?php echo esc_attr( $checked ); ?> />
                                <?php
                                break;

			case 'checkbox_multi':
				foreach ( $field['options'] as $k => $v ) {
					$checked = false;
					if ( in_array( $k, (array) $data ) ) {
						$checked = true;
					}
                                        ?>
					<p><label for="<?php echo esc_attr( $field['id'] . '_' . $k ); ?>" class="checkbox_multi"><input type="checkbox" <?php echo esc_attr( checked( $checked, true, false )); ?> name="<?php echo esc_attr( $option_name ); ?>[]" value="<?php echo esc_attr( $k ); ?>" id="<?php echo esc_attr( $field['id'] . '_' . $k ); ?>" /> <?php echo esc_attr($v); ?> </label></p>
                                        <?php
                                        }
			break;

			case 'radio':
				foreach ( $field['options'] as $k => $v ) {
					$checked = false;
					if ( $k == $data ) {
						$checked = true;
					}
                                        ?>
					<label for="<?php echo esc_attr( $field['id'] . '_' . $k ); ?>"><input type="radio"  <?php echo esc_attr( checked( $checked, true, false )); ?>  name="<?php echo esc_attr( $option_name ); ?>" value="<?php echo esc_attr( $k ); ?>" id="<?php echo esc_attr( $field['id'] . '_' . $k ); ?>" /> <?php echo esc_attr($v); ?> </label>
                                        <?php 
				}
			break;

			case 'select':
                            ?>
				<select name="<?php echo esc_attr( $option_name ); ?>" id="<?php echo esc_attr( $field['id'] ); ?>">
                            <?php
				foreach ( $field['options'] as $k => $v ) {
					$selected = false;
					if ( $k == $data ) {
						$selected = true;
					}
                                        ?>
					<option <?php echo esc_attr(selected( $selected, true, false )); ?>  value="<?php echo esc_attr( $k ); ?>"><?php echo esc_attr($v); ?></option>
                                        <?php 
                                        }
                                        ?>
                                        </select>
                                        <?php
			break;

			case 'select_multi':
                            ?>
				<select name="<?php echo esc_attr( $option_name ); ?>[]" id="<?php echo esc_attr( $field['id'] ); ?>" multiple="multiple">
                            <?php
                                    foreach ( $field['options'] as $k => $v ) {
					$selected = false;
					if ( in_array( $k, (array) $data ) ) {
						$selected = true;
					}
                                        ?>
					<option <?php echo esc_attr(selected( $selected, true, false )); ?> value="<?php echo esc_attr( $k ); ?>"> <?php echo esc_attr($v); ?> </option>
                                        <?php
                                        
				}
                                ?>
				</select>
                                <?php
			break;

			case 'image':
				$image_thumb = '';
				if ( $data ) {
					$image_thumb = wp_get_attachment_thumb_url( $data );
				}
                                ?>
				<img id="<?php echo esc_attr($option_name); ?>_preview" class="image_preview" src="<?php echo esc_url($image_thumb); ?>" /><br/>
				<input id="<?php echo esc_attr($option_name); ?>_button" type="button" data-uploader_title="<?php echo esc_html(__( 'Upload an image' , 'smdp-fly-button' )); ?>" data-uploader_button_text="<?php echo esc_html(__( 'Use image' , 'smdp-fly-button' )); ?>" class="image_upload_button button" value="<?php echo esc_html(__( 'Upload new image' , 'smdp-fly-button' )); ?>" />
				<input id="<?php echo esc_attr($option_name); ?>_delete" type="button" class="image_delete_button button" value="<?php echo esc_html(__( 'Remove image' , 'smdp-fly-button' )); ?>" />
				<input id="<?php echo esc_attr($option_name); ?>" class="image_data_field" type="hidden" name="<?php echo esc_attr($option_name); ?>" value="<?php echo esc_attr($data); ?>"/><br/>
                                <?php
			break;

			case 'color':
				?><div class="color-picker" style="position:relative;">
			        <input type="text" name="<?php esc_attr_e( $option_name ); ?>" class="color" value="<?php esc_attr_e( $data ); ?>" />
			        <div style="position:absolute;background:#FFF;z-index:99;border-radius:100%;" class="colorpicker"></div>
			    </div>
			    <?php
			break;
			
			case 'editor':
				wp_editor($data, $option_name, array(
					'textarea_name' => $option_name
				) );
			break;

		}

		switch( $field['type'] ) {

			case 'checkbox_multi':
			case 'radio':
			case 'select_multi':
                            ?>
				<br/><span class="description"><?php echo esc_attr($field['description']); ?></span> 
                            <?php
			break;

			default:
				if ( ! $post ) {
                                    ?>
					<label for="<?php echo esc_attr( $field['id'] ); ?>">
                                        <?php
				}
                                ?>
				<span class="description"><?php echo esc_attr($field['description']); ?></span>
                                <?php

				if ( ! $post ) {
                                    ?>
					</label>
                                    <?php
				}
			break;
		}

//		if ( ! $echo ) {
//			return $html;
//		}

		//echo $html;

	}

	/**
	 * Validate form field
	 * @param  string $data Submitted value
	 * @param  string $type Type of field to validate
	 * @return string       Validated value
	 */
	public function validate_field ( $data = '', $type = 'text' ) {

		switch( $type ) {
			case 'text': $data = esc_attr( $data ); break;
			case 'url': $data = esc_url( $data ); break;
			case 'email': $data = is_email( $data ); break;
		}

		return $data;
	}

	/**
	 * Add meta box to the dashboard
	 * @param string $id            Unique ID for metabox
	 * @param string $title         Display title of metabox
	 * @param array  $post_types    Post types to which this metabox applies
	 * @param string $context       Context in which to display this metabox ('advanced' or 'side')
	 * @param string $priority      Priority of this metabox ('default', 'low' or 'high')
	 * @param array  $callback_args Any axtra arguments that will be passed to the display function for this metabox
	 * @return void
	 */
	public function add_meta_box ( $id = '', $title = '', $post_types = array(), $context = 'advanced', $priority = 'default', $callback_args = null ) {

		// Get post type(s)
		if ( ! is_array( $post_types ) ) {
			$post_types = array( $post_types );
		}

		// Generate each metabox
		foreach ( $post_types as $post_type ) {
			add_meta_box( $id, $title, array( $this, 'meta_box_content' ), $post_type, $context, $priority, $callback_args );
		}
	}

	/**
	 * Display metabox content
	 * @param  object $post Post object
	 * @param  array  $args Arguments unique to this metabox
	 * @return void
	 */
	public function meta_box_content ( $post, $args ) {

		$fields = apply_filters( $post->post_type . '_custom_fields', array(), $post->post_type );

		if ( ! is_array( $fields ) || 0 == count( $fields ) ) return;

		echo '<div class="custom-field-panel">' . "\n";

		foreach ( $fields as $field ) {

			if ( ! isset( $field['metabox'] ) ) continue;

			if ( ! is_array( $field['metabox'] ) ) {
				$field['metabox'] = array( $field['metabox'] );
			}

			if ( in_array( $args['id'], $field['metabox'] ) ) {
				$this->display_meta_box_field( $field, $post );
			}

		}

		echo '</div>' . "\n";

	}

	/**
	 * Dispay field in metabox
	 * @param  array  $field Field data
	 * @param  object $post  Post object
	 * @return void
	 */
	public function display_meta_box_field ( $field = array(), $post ) {

		if ( ! is_array( $field ) || 0 == count( $field ) ) return;
        ?>
		<p class="form-field"><label for="<?php echo esc_attr($field['id']); ?>"><?php echo esc_attr($field['label']); ?></label><?php echo esc_attr($this->display_field( $field, $post, false )); ?></p>
        <?php	
	}

	/**
	 * Save metabox fields
	 * @param  integer $post_id Post ID
	 * @return void
	 */
	public function save_meta_boxes ( $post_id = 0 ) {

		if ( ! $post_id ) return;

		$post_type = get_post_type( $post_id );

		$fields = apply_filters( $post_type . '_custom_fields', array(), $post_type );

		if ( ! is_array( $fields ) || 0 == count( $fields ) ) return;

		foreach ( $fields as $field ) {
			if ( isset( $_REQUEST[ $field['id'] ] ) ) {
				update_post_meta( $post_id, $field['id'], $this->validate_field( sanitize_text_field($_REQUEST[ $field['id'] ]), sanitize_text_field($field['type'] )) );
			} else {
				update_post_meta( $post_id, $field['id'], '' );
			}
		}
	}

}
