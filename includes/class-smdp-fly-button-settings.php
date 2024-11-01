<?php

if ( ! defined( 'ABSPATH' ) ) exit;



class smdp_Fly_Button_Settings {

	/**
	 * The single instance of smdp_Fly_Button_Settings.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The main plugin object.
	 * @var 	object
	 * @access  public
	 * @since 	1.0.0
	 */
	public $parent = null;

	/**
	 * Prefix for plugin settings.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $base = '';

	/**
	 * Available settings for plugin.
	 * @var     array
	 * @access  public
	 * @since   1.0.0
	 */
	public $settings = array();

	public function __construct ( $parent ) {
		$this->parent = $parent;

		$this->base = 'smdps_';

		// Initialise settings
		add_action( 'init', array( $this, 'init_settings' ), 11 );

		// Register plugin settings
		add_action( 'admin_init' , array( $this, 'register_settings' ) );

		// Add settings page to menu
		add_action( 'admin_menu' , array( $this, 'add_menu_item' ) );

		// Add settings link to plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( $this->parent->file ) , array( $this, 'add_settings_link' ) );
	}

	/**
	 * Initialise settings
	 * @return void
	 */
	public function init_settings () {
		$this->settings = $this->settings_fields();
	}

	/**
	 * Add settings page to admin menu
	 * @return void
	 */
	public function add_menu_item () {
		$page = add_options_page( __( 'Plugin Settings', 'smdp-fly-button' ) , __( 'SMDP Fly Button Settings', 'smdp-fly-button' ) , 'manage_options' , $this->parent->_token . '_settings' ,  array( $this, 'settings_page' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'settings_assets' ) );
	}

	/**
	 * Load settings JS & CSS
	 * @return void
	 */
	public function settings_assets () {

		// We're including the farbtastic script & styles here because they're needed for the colour picker
		// If you're not including a colour picker field then you can leave these calls out as well as the farbtastic dependency for the wpt-admin-js script below
		wp_enqueue_style( 'farbtastic' );
    	wp_enqueue_script( 'farbtastic' );

    	// We're including the WP media scripts here because they're needed for the image upload field
    	// If you're not including an image upload then you can leave this function call out
    	wp_enqueue_media();

    	wp_register_script( $this->parent->_token . '-settings-js', $this->parent->assets_url . 'js/settings' . $this->parent->script_suffix . '.js', array( 'farbtastic', 'jquery' ), '1.0.0' );
    	wp_enqueue_script( $this->parent->_token . '-settings-js' );
	}

	/**
	 * Add settings link to plugin list table
	 * @param  array $links Existing links
	 * @return array 		Modified links
	 */
	public function add_settings_link ( $links ) {
		$settings_link = '<a href="options-general.php?page=' . $this->parent->_token . '_settings">' . __( 'Settings', 'smdp-fly-button' ) . '</a>';
  		array_push( $links, $settings_link );
  		return $links;
	}

	/**
	 * Build settings fields
	 * @return array Fields to be displayed on settings page
	 */
	private function settings_fields () {



                        
                $settings['flybuttonstng'] = array(
			'title'					=> __( 'Fly Button Main Settings', 'smdp-fly-button' ),
			'description'			=> __( 'These are main settings for Fly Button.', 'smdp-fly-button' ),
			'fields'				=> array(
                            		
                            
                            
                            array(
					'id' 			=> 'smdp_btnlink_url',
					'label'			=> __( 'Target link url', 'smdp-fly-button' ),
					'description'	=> __( 'This is url for button action.', 'smdp-fly-button' ),
					'type'			=> 'url',
					'default'		=> '#',
                        		'placeholder'	=>  ''
				),
                            
                              array(
					'id' 			=> 'smdp_btnlink_target',
					'label'			=> __( 'Open target on new tab', 'smdp-fly-button' ),
					'description'	=> __( 'Open target on new tab', 'smdp-fly-button' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				),
                            
                            
                            
                                                        array(
					'id' 			=> 'smdp_btn_title',
					'label'			=> __( 'Button title', 'smdp-fly-button' ),
					'description'	=> __( 'This is the button title.', 'smdp-fly-button' ),
					'type'			=> 'text',
					'default'		=> '',
                        		'placeholder'	=>  'Title'
				),
                            
                            
                                                                                    array(
					'id' 			=> 'smdp_btn_descr',
					'label'			=> __( 'Button description', 'smdp-fly-button' ),
					'description'	=> __( 'This is the button description.', 'smdp-fly-button' ),
					'type'			=> 'text',
					'default'		=> '',
                        		'placeholder'	=>  'Description'
				),
                            
                            
                                    array(
					'id' 			=> 'smdp_btn_frontpage_only',
					'label'			=> __( 'Show only on front page', 'smdp-fly-button' ),
					'description'	=> __( 'Show only on front page', 'smdp-fly-button' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				), 
                            

                            
                                                                array(
					'id' 			=> 'smdp_btn_contntopen',
					'label'			=> __( 'Button content always open', 'smdp-fly-button' ),
					'description'	=> __( 'Button content always open', 'smdp-fly-button' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				), 
                            
                            
                            
                           
			)
		);

                
                
                
                                $settings['btnhtmlsetting'] = array(
			'title'					=> __( 'Button html settings', 'smdp-fly-button' ),
			'description'			=> __( 'These are html settings for Button.', 'smdp-fly-button' ),
			'fields'				=> array(
				array(
					'id' 			=> 'smdp_bckgrd_color',
					'label'			=> __( 'Background colour', 'smdp-fly-button' ),
					'description'	=> __( 'This is the background color of button.', 'smdp-fly-button' ),
					'type'			=> 'color',
					'default'		=> '#ffba00'
				),
                            
                            
                            
                                                        		array(
					'id' 			=> 'smdp_icn_color',
					'label'			=> __( 'Icon colour', 'smdp-fly-button' ),
					'description'	=> __( 'This is the icon color of button.', 'smdp-fly-button' ),
					'type'			=> 'color',
					'default'		=> '#ffdd00'
				),
                            
                                                          array(
                            					'id' 			=> 'smdp_btn_fa_cls',
					'label'			=> __( 'Button icon class', 'smdp-fly-button' ),
					'description'	=> __( 'Button awesome icon class e.g.  fas fa-arrow-alt-circle-right', 'smdp-fly-button' ),
					'type'			=> 'text',
					'default'		=> 'fa fa-shield',
                        		'placeholder'	=>  'fas fa-arrow-alt-circle-right'
				),
                            
                            
                                                        				array(
					'id' 			=> 'smdp_btn_icn_topmargin',
					'label'			=> __( 'Icon top margin (px)' , 'smdp-fly-button' ),
					'description'	=> __( 'This is the icon top margin e.g. 20', 'smdp-fly-button' ),
					'type'			=> 'number',
					'default'		=> '5',
					'placeholder'	=> __( '5', 'smdp-fly-button' )
				),
                            
                                                                                    		array(
					'id' 			=> 'smdp_fnt_color',
					'label'			=> __( 'Font colour', 'smdp-fly-button' ),
					'description'	=> __( 'This is the font color of button.', 'sm-prdct-import' ),
					'type'			=> 'color',
					'default'		=> '#000000'
				),
                            
                            
                                                                              array(
					'id' 			=> 'smdp_btn_icn_size',
					'label'			=> __( 'Button Icon Size', 'smdp-fly-button' ),
					'description'	=> __( 'This is the size of icon  e.g. 20px or large', 'smdp-fly-button' ),
					'type'			=> 'text',
					'default'		=> 'large',
                        		'placeholder'	=>  'large'
				),
                            
                            
                            
                            
                                                                                                       array(
					'id' 			=> 'smdp_btn_bottomdist',
					'label'			=> __( 'Button distance from bottom', 'smdp-fly-button' ),
					'description'	=> __( 'This is the button distance from bottom e.g. 80% or 240px', 'smdp-fly-button' ),
					'type'			=> 'text',
					'default'		=> '80%',
                        		'placeholder'	=>  '80%'
				),
                                      array(
                            					'id' 			=> 'smdp_btn_bottomdist_mobi',
					'label'			=> __( 'For mobiles button distance from bottom', 'smdp-fly-button' ),
					'description'	=> __( 'For mobiles this is the button distance from bottom e.g. 80% or 240px', 'smdp-fly-button' ),
					'type'			=> 'text',
					'default'		=> '80%',
                        		'placeholder'	=>  '80%'
				),
                            
                            
                            
                            
                                                        				array(
					'id' 			=> 'smdp_btn_leftdistanse',
					'label'			=> __( 'Button left distanse (px)' , 'smdp-fly-button' ),
					'description'	=> __( 'This is the left distanse e.g. 25', 'smdp-fly-button' ),
					'type'			=> 'number',
					'default'		=> '25',
					'placeholder'	=> __( '25', 'smdp-fly-button' )
				),
                            
                            
			)
		);
                
                
                
                
                
                

		$settings = apply_filters( $this->parent->_token . '_settings_fields', $settings );

		return $settings;
	}

        

        
	/**
	 * Register plugin settings
	 * @return void
	 */
	public function register_settings () { 
            global $wpdb;
		if ( is_array( $this->settings ) ) {

			// Check posted/selected tab
			$current_section = '';
			if ( isset( $_POST['tab'] ) && $_POST['tab'] ) {
                            
                            
				$current_section = sanitize_key($_POST['tab']);
                                
                                
			} else {
				if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
                                    
                                    
					$current_section = sanitize_key($_GET['tab']);
                                        
                                        
				}
			}

			foreach ( $this->settings as $section => $data ) {

				if ( $current_section && $current_section != $section ) continue;
				// Add section to page
				add_settings_section( $section, $data['title'], array( $this, 'settings_section' ), $this->parent->_token . '_settings' );

				foreach ( $data['fields'] as $field ) {

					// Validation callback for field
					$validation = '';
					if ( isset( $field['callback'] ) ) {
						$validation = $field['callback'];
					}

					// Register field
					$option_name = $this->base . $field['id'];
                                        
                                        
					register_setting( $this->parent->_token . '_settings', $option_name, $validation );

                            
					// Add field to page
					add_settings_field( $field['id'], $field['label'], array( $this->parent->admin, 'display_field' ), $this->parent->_token . '_settings', $section, array( 'field' => $field, 'prefix' => $this->base ) );
                                        
                                        
                                        
				}

				if ( ! $current_section ) break;
			}
		}
	}


        

        

	public function settings_section ( $section ) {
            ?>
		<p><?php echo esc_html($this->settings[ $section['id'] ]['description']) ; ?></p>
               <?php  
	}

	/**
	 * Load settings page content
	 * @return void
	 */
	public function settings_page () {
$html = '';
            
                            $allowed_tags = array(
    'div'    => array(),
    'label'   => array(),            
    'form' => array(),
    'span' => array(),               
    'table'    => array(),
    'tr'  => array(),
    'td' => array(),
    'input' => array(),
    'img'    => array(
        'style' => array(),
        'src' => array(),
        'alt' => array()
    ),
    'strong' => array(),
    'a'      => array(
        'href'  => array(),
        'title' => array(),
        'rel' => array(),
        'onclick' => array(),
        'class' => array(),
        'data-wpel-link' => array()
    ),
);
            
            ?>
		// Build page HTML
               <div class="wrap" id="' <?php echo esc_html($this->parent->_token . '_settings') ;?>">
              
                
               
                   <h2> <?php echo esc_html(__( 'SMDP Plugin Settings' , 'smdp-fly-button' )); ?></h2>
 
                            
                            <?php 
 
 
 
			$tab = '';
			if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
				$tab .= sanitize_key($_GET['tab']);
			}

			// Show page tabs
			if ( is_array( $this->settings ) && 1 < count( $this->settings ) ) {

                            ?>
                            
                   <h2 class="nav-tab-wrapper">

                                <?php
				$c = 0;
				foreach ( $this->settings as $section => $data ) {

					// Set tab class
					$class = 'nav-tab';
					if ( ! isset( $_GET['tab'] ) ) {
						if ( 0 == $c ) {
							$class .= ' nav-tab-active';
						}
					} else {
						if ( isset( $_GET['tab'] ) && $section == $_GET['tab'] ) {
							$class .= ' nav-tab-active';
						}
					}

					// Set tab link
					$tab_link = add_query_arg( array( 'tab' => $section ) );
					if ( isset( $_GET['settings-updated'] ) ) {
						$tab_link = remove_query_arg( 'settings-updated', $tab_link );
					}

					// Output tab
                                        
                                        ?>
					<a href="<?php echo esc_url($tab_link); ?>" class="<?php echo esc_attr( $class ); ?>"><?php echo esc_html( $data['title'] ); ?></a>

                                        
                                        <?php
					++$c;
                                                     
				}

                                ?>
                                
                                </h2>
                                
                              <?php  
			}
                        ?>
			<form method="post" action="options.php" enctype="multipart/form-data">
                        <?php
                        
				// Get settings fields
                        
                       echo esc_html(settings_fields( $this->parent->_token . '_settings' ));
                       echo esc_html(do_settings_sections( $this->parent->_token . '_settings' ));
                                
                        ?>
                        <p class="submit">
                        <input type="hidden" name="tab" value="<?php echo esc_attr( $tab ); ?>" />
                        <input name="Submit" type="submit" class="button-primary" value="<?php echo esc_attr( __( 'Save Settings' , 'smdp-fly-button' ) ); ?>" /></p></form></div>
      
<?php                
	}

	/**
	 * Main smdp_Fly_Button_Settings Instance
	 *
	 * Ensures only one instance of smdp_Fly_Button_Settings is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see smdp_Fly_Button()
	 * @return Main smdp_Fly_Button_Settings instance
	 */
	public static function instance ( $parent ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $parent );
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->parent->_version );
	} // End __clone()

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->parent->_version );
	} // End __wakeup()

}


