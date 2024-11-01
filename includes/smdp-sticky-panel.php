<?php



if ( ! defined( 'ABSPATH' ) ) exit;


    function smdp_isValidURL($url)
    {
        return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*
        (:[0-9]+)?(/.*)?$|i', $url);
    }



/**
* Below code initialize the fly button.
*/
function smdp_flybutton_call() {
    
    
 
   $smdps_smdp_btn_frontpage_only = get_option( 'smdps_smdp_btn_frontpage_only' );
 if(!isset($smdps_smdp_btn_frontpage_only) || empty($smdps_smdp_btn_frontpage_only)   ) { 
     $smdps_smdp_btn_frontpage_only = '0';          
 } else {
     if ($smdps_smdp_btn_frontpage_only == 'on') {
     $smdps_smdp_btn_frontpage_only = '1'; 
 }         }
    
    
    if ( is_front_page() || $smdps_smdp_btn_frontpage_only == '0') {
        
        
        
            $smdps_smdp_bckgrd_color = get_option( 'smdps_smdp_bckgrd_color' );
 if(!isset($smdps_smdp_bckgrd_color) || empty($smdps_smdp_bckgrd_color)  || !is_email($smdps_smdp_bckgrd_color) ) { 
     $smdps_smdp_bckgrd_color = '#ffba00';            //
 } 
   
        
              $smdps_smdp_icn_color = get_option( 'smdps_smdp_icn_color' );
 if(!isset($smdps_smdp_icn_color) || empty($smdps_smdp_icn_color)   ) { 
     $smdps_smdp_icn_color = '#f00a00';            //
 } 
 
        
        
              $smdps_smdp_fnt_color = get_option( 'smdps_smdp_fnt_color' );
 if(!isset($smdps_smdp_fnt_color) || empty($smdps_smdp_fnt_color)   ) { 
     $smdps_smdp_fnt_color = '#000000';            //
 } 
 
    $smdps_smdp_btnlink_url = get_option( 'smdps_smdp_btnlink_url' );
 if(!isset($smdps_smdp_btnlink_url) || empty($smdps_smdp_btnlink_url)   ) { 
     
     if (!smdp_isValidURL($smdps_smdp_btnlink_url)) {
     $smdps_smdp_btnlink_url = '#';          
     }  
 } 
          
//                          if ($option_name == 'wpt_upd_changed_images_checkbox') {
//                                                 $options = get_option($option_name);
//                                           if ($options == 'on') {
        
//                                     array(
//					'id' 			=> 'smdp_btnlink_target',
//					'label'			=> __( 'Open target on new tab', 'smdp-fly-button' ),
//					'description'	=> __( 'Open target on new tab', 'smdp-fly-button' ),
//					'type'			=> 'checkbox',
//					'default'		=> ''
//				), 
        
    $smdps_smdp_btnlink_target = get_option( 'smdps_smdp_btnlink_target' );
 if(!isset($smdps_smdp_btnlink_target) || empty($smdps_smdp_btnlink_target)   ) { 
     $smdps_smdp_btnlink_target = '';          
 } else {
     if ($smdps_smdp_btnlink_target == 'on') {
     $smdps_smdp_btnlink_target = ' target="_blank" '; 
 }         }
 
 //smdp_btn_title
     $smdps_smdp_btn_title = get_option( 'smdps_smdp_btn_title' );
 if(!isset($smdps_smdp_btn_title) || empty($smdps_smdp_btn_title)   ) { 
     $smdps_smdp_btn_title = 'GO';          
 } 
 
      $smdps_smdp_btn_descr = get_option( 'smdps_smdp_btn_descr' );
 if(!isset($smdps_smdp_btn_descr) || empty($smdps_smdp_btn_descr)   ) { 
     $smdps_smdp_btn_descr = '';          
 } 
 
       $smdps_smdp_btn_bottomdist = get_option( 'smdps_smdp_btn_bottomdist' );
 if(!isset($smdps_smdp_btn_bottomdist) || empty($smdps_smdp_btn_bottomdist)   ) { 
     $smdps_smdp_btn_bottomdist = '80%';          
 } 
 
        $smdps_smdp_btn_bottomdist_mobi = get_option( 'smdps_smdp_btn_bottomdist_mobi' );
 if(!isset($smdps_smdp_btn_bottomdist_mobi) || empty($smdps_smdp_btn_bottomdist_mobi)   ) { 
     $smdps_smdp_btn_bottomdist_mobi = '80%';          
 } 
 
 
 
         $smdps_smdp_btn_icn_size = get_option( 'smdps_smdp_btn_icn_size' );
 if(!isset($smdps_smdp_btn_icn_size) || empty($smdps_smdp_btn_icn_size)   ) { 
     $smdps_smdp_btn_icn_size = 'large';          
 } 
 
 
         $smdps_smdp_btn_fa_cls = get_option( 'smdps_smdp_btn_fa_cls' );
 if(!isset($smdps_smdp_btn_fa_cls) || empty($smdps_smdp_btn_fa_cls)   ) { 
     $smdps_smdp_btn_fa_cls = 'fas fa-arrow-alt-circle-right';          
 } 
 
          $smdp_btn_icn_topmargin = get_option( 'smdps_smdp_btn_icn_topmargin' );
 if(!isset($smdp_btn_icn_topmargin) || empty($smdp_btn_icn_topmargin)   ) { 
     $smdp_btn_icn_topmargin = '5';          
 } 
 
           $smdp_btn_leftdistanse = get_option( 'smdps_smdp_btn_leftdistanse' );
 if(!isset($smdp_btn_leftdistanse) || empty($smdp_btn_leftdistanse)   ) { 
     $smdp_btn_leftdistanse = '25';          
 } 
 
    $smdps_smdp_btn_contntopen = get_option( 'smdps_smdp_btn_contntopen' );
 if(!isset($smdps_smdp_btn_contntopen) || empty($smdps_smdp_btn_contntopen)   ) { 
     $smdps_smdp_btn_contntopen = '0';          
 } else {
     if ($smdps_smdp_btn_contntopen == 'on') {
     $smdps_smdp_btn_contntopen = '1'; 
 }         }
 //
 
 
 
 
 
	?>

<STYLE>
    

.gf_stylespro .sp_flat .button {
   color:white !important;
	background-color:greenyellow;
	
}

	.smdp-sticky-fly-icon {
            margin-top:<?php echo esc_html($smdp_btn_icn_topmargin); ?>px;
            height:50px;
            color:<?php echo esc_html($smdps_smdp_icn_color); ?>;
            font-size: <?php echo esc_html($smdps_smdp_btn_icn_size); ?>;
            vertical-align: middle;
	}

.smdp-sticky-call-container {
    background: <?php echo esc_html($smdps_smdp_bckgrd_color); ?>;
    display: block;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    position: fixed;
    bottom: <?php echo esc_html($smdps_smdp_btn_bottomdist); ?>;
    left: <?php echo esc_html($smdp_btn_leftdistanse); ?>px;
    text-align: center;
    line-height: 50px;
    color: <?php echo esc_html($smdps_smdp_fnt_color); ?> !important;
    z-index: 999;
}

.smdp-sticky-fly-content {
    position: absolute;
    top: 0;
    left: 25px;
    width: 250px;
    padding-left: 25px;
    background:  <?php echo esc_html($smdps_smdp_bckgrd_color); ?>;
    height: 50px;
    z-index: -1;
    border-radius: 0 25px 25px 0;
    opacity: <?php echo esc_html($smdps_smdp_btn_contntopen); ?>;
    transition: all 0.5s ease;
    font-size: 16px;
    line-height: 20px;
}

.smdp-sticky-call-title {
    margin-top: 5px;
}

.smdp-sticky-fly-description {
	font-size: 12px;
}

.smdp-sticky-call-container:hover .smdp-sticky-fly-content {
	opacity: 1;
}



@media (max-width: 768px) {

	.smdp-sticky-call-container {
	    bottom: <?php echo esc_html($smdps_smdp_btn_bottomdist_mobi); ?>;
	    width: 100%;
	    border-radius: 0;
	    left: 0;
	}

	.smdp-sticky-fly-icon {
		display: none;
	}

	.smdp-sticky-fly-content {
		opacity: 1;
		width: 100%;
		left: 0;
		padding-left: 0;
	}
}







</STYLE>

     
	<a <?php echo esc_html($smdps_smdp_btnlink_target); ?> href="<?php echo esc_html($smdps_smdp_btnlink_url); ?>" class="smdp-sticky-call-container">
		<div class="smdp-sticky-fly-icon">	
			<i class="<?php echo esc_html($smdps_smdp_btn_fa_cls); ?>" aria-hidden="true"></i>
		</div>
		<div class="smdp-sticky-fly-content">
			<div class="smdp-sticky-call-title">
				<?php echo esc_html($smdps_smdp_btn_title); ?>
			</div>
			<div class="smdp-sticky-fly-description">
				  <?php echo esc_html($smdps_smdp_btn_descr); ?>
			</div>
		</div>
	</a>
	<?php
    }
}
add_action( 'wp_footer', 'smdp_flybutton_call' , 100);





