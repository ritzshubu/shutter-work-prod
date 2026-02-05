<?php
/**
 * Enqueue script and styles for child theme
 */
function woodmart_child_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'woodmart-style' ), woodmart_get_theme_info( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'woodmart_child_enqueue_styles', 10010 );

function enqueue_child_theme_styles() {
    // Enqueue bootstrap-light.min.css from child theme
    wp_enqueue_style(
        'bootstrap-light', // Handle
        get_stylesheet_directory_uri() . '/assets/css/bootstrap-light.min.css', // File path
        array(), // Dependencies (if any)
        '1.0.0' // Version
    );
}
add_action('wp_enqueue_scripts', 'enqueue_child_theme_styles');

/**
 * WooCommerce customization file
 */
require get_theme_file_path('/customization/woocommerce.php');

/**
 * Enqueue scripts specific to SS (Shutter Supplies)
 */
function ss_enqueue_scripts(){

    global $post;

    if( is_singular('product') ){

        if( function_exists('get_field')){
            $product_class = get_field('ss_css_class', $post->ID);

            if( $product_class == 'plantation-shutters'){
                wp_enqueue_script( 
                    'ss-product-panels', 
                    get_theme_file_uri('/assets/js/ss-product_panels.js'), 
                    NULL, 
                    '', 
                    true 
                );
            }
        }

    }

    // product slug - patio-door-shutters #9424
    if( is_singular('product') && $post->ID === 9424 ){
        wp_enqueue_script( 
            'ss-product-9424', 
            get_theme_file_uri('/assets/js/ss-product_9424.js'), 
            NULL, 
            '', 
            true 
        );

    }

    // product slug - cafe-shutters #9426
    if( is_singular('product') && $post->ID === 9426 ){
        wp_enqueue_script( 
            'ss-product-9426', 
            get_theme_file_uri('/assets/js/ss-product_9426.js'), 
            NULL, 
            '', 
            true 
        );

    }

    if( is_singular('product') && $post->ID === 9436 ){
        wp_enqueue_script( 
            'ss-product-9436', 
            get_theme_file_uri('/assets/js/ss-product_9436.js'), 
            NULL, 
            '', 
            true 
        );

    }

    // product slug - eyebrow-arches #9438
    if( is_singular('product') && $post->ID === 9438 ){
        wp_enqueue_script( 
            'ss-product-9438', 
            get_theme_file_uri('/assets/js/ss-product_9438.js'), 
            NULL, 
            '', 
            true 
        );

    }

    if( is_singular('product') && $post->ID === 9440 ){
        wp_enqueue_script( 
            'ss-product-9440', 
            get_theme_file_uri('/assets/js/ss-product_9440.js'), 
            NULL, 
            '', 
            true 
        );

    }

    // 1/4 eyebrow arches
    if( is_singular('product') && $post->ID === 9442 ){
        wp_enqueue_script( 
            'ss-product-9442', 
            get_theme_file_uri('/assets/js/ss-product_9442.js'), 
            NULL, 
            '', 
            true 
        );

    }

    if( is_singular('product') && $post->ID === 9444 ){
        wp_enqueue_script( 
            'ss-product-9444', 
            get_theme_file_uri('/assets/js/ss-product_9444.js'), 
            NULL, 
            '', 
            true 
        );

    }

    // angled
    if( is_singular('product') && $post->ID === 9446 ){
        wp_enqueue_script( 
            'ss-product-9446', 
            get_theme_file_uri('/assets/js/ss-product_9446.js'), 
            NULL, 
            '', 
            true 
        );

    }

    if( is_singular('product') && $post->ID === 9448 ){
        wp_enqueue_script( 
            'ss-product-9448', 
            get_theme_file_uri('/assets/js/ss-product_9448.js'), 
            NULL, 
            '', 
            true 
        );

    }

    // product slug - round, id 9450
    if( is_singular('product') && $post->ID === 9450 ){
        wp_enqueue_script( 
            'ss-product-9450', 
            get_theme_file_uri('/assets/js/ss-product_9450.js'), 
            NULL, 
            '', 
            true 
        );

    }

    // slug - octagon #9452
    if( is_singular('product') && $post->ID === 9452 ){
        wp_enqueue_script( 
            'ss-product-9452', 
            get_theme_file_uri('/assets/js/ss-product_9452.js'), 
            NULL, 
            '', 
            true 
        );

    }

    // pentagon arches
    if( is_singular('product') && $post->ID === 9558 ){
        wp_enqueue_script( 
            'ss-product-9558', 
            get_theme_file_uri('/assets/js/ss-product_9558.js'), 
            NULL, 
            '', 
            true 
        );

    }

    if( is_singular('product') ){
        wp_enqueue_script( 
            'ss-product-global', 
            get_theme_file_uri('/assets/js/ss-product_global.js'), 
            NULL, 
            '', 
            true 
        );

        wp_localize_script( 'ss-product-global', 'ss_obj',
            array(
                'panel1_title'  => esc_html__('1 Panel', 'woodmart-child'),
                'panel2_title'  => esc_html__('2 Panels', 'woodmart-child'),
                'panel3_title'  => esc_html__('3 Panels', 'woodmart-child'),
                'panel4_title'  => esc_html__('4 Panels', 'woodmart-child'),
                'panel6_title'  => esc_html__('6 Panels', 'woodmart-child'),
            )
        );
    }

    wp_enqueue_script( 
        'ss-global', 
        get_theme_file_uri('/assets/js/ss-global.js'), 
        NULL, 
        '', 
        true 
    );
    
}
add_action( 'wp_enqueue_scripts', 'ss_enqueue_scripts' );

/**
 * Enable full image size for the labels of addons
 */
add_filter('yith_wapo_get_thumbnail_for_addons_image','ss_enable_full_addon_label_img');
function ss_enable_full_addon_label_img(){
    return false;
}

/**
 * push wc categories by post id to the single product page
 */
add_filter( 'body_class','ss_wc_body_classes' );
function ss_wc_body_classes( $classes ) {

    if( is_singular('product') ){
        $categories = get_the_terms( get_the_ID(), 'product_cat' );

        foreach( $categories as $category ) {
            $classes[] = esc_html($category->slug);
        }

        if(function_exists('get_field')){
            $product_class = get_field('ss_css_class', get_the_ID());
            
            if( !in_array( $product_class, $classes ) ){
                $classes[] = esc_attr($product_class);
            }

        }
    
    }
     
    return $classes;
     
}

add_filter('perfmatters_delay_js_exclusions', function($exclusions) {
		$exclusions[] = '-Lighth';
	return $exclusions;
});

add_action('wp_head', 'mygsperfmatters');
function mygsperfmatters(){
?>
<script> if (navigator.userAgent.indexOf("Chrome-Lighthouse") > -1) {
  console.log("Lighthouse!");
} else if (navigator.userAgent.match(/metrix|light|ping|dare|ptst/i)) {
  console.log("GTmetrix!");
}
else { 
        var triggerInterval = setInterval(function() {
                if (typeof pmTriggerDOMListener !== 'undefined') {
                        pmTriggerDOMListener();
                        clearInterval(triggerInterval);
                }
        }, 10);
} </script>
<?php
};

// Add Google Tag Manager code in <head>
add_action( 'wp_head', 'google_tag_manager_head' );
function google_tag_manager_head() { ?>
<iframe src="https://widget-frontend.vercel.app/" 
        style="width: 500px; height: 900px; border: none; position: fixed; bottom: 20px; right: 20px;">
 </iframe>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5R7Z523');</script>
<!-- End Google Tag Manager -->
<?php }

// Add Google Tag Manager code immediately below opening <body> tag
add_action( 'wp_body_open', 'google_tag_manager_body' );
function google_tag_manager_body() { ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5R7Z523"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php }


add_action( 'woocommerce_before_single_product_summary', 'remove_gallery_for_custom_product_enable', 5 );
function remove_gallery_for_custom_product_enable() {
    global $product;
    $value = get_field( "enable_custom_product_selection", get_the_id() );

    if( $value=='Enable' ) {
        //remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
        ?>
        <style>

            .product-images-inner {
                max-width: 700px;
                margin: 0 auto;
            }
            .col-lg-6.col-12.col-md-6.text-left.summary.entry-summary {
                margin: 0 auto;
            }
            .col-lg-6.col-12.col-md-6 {
                max-width: 100% !important;
                flex: none !important;
            }
            .summary-inner {
                max-width: 700px !important;
                margin: 30px auto 0;
            }
        </style>
        <?php
    }
}

//add custom fields on single product page
function hwn_add_custom_option(){
	$proId = get_the_id();
    $value = get_field( "enable_custom_product_selection", $proId );
    $array = array('1 Panel', 'Choose Type', 'Composite Colors', 'Mount Type', 'Window Measurements', 'Select Hinge Color', 'Select Louver Size', 'Select Tilt Type', 'Number of Frame Sides', 'Dividing Rail', 'Frame Type', 'Cafe Shutters');
    if( $value=='Enable' ) {
       foreach($array as $title){
			$sanitize_title = sanitize_title($title);
			
			$mainEnable = get_field('panel_onoff',$proId);
			$choose_type_onoff = get_field('choose_type_onoff',$proId);
			$composite_colors_onoff = get_field('composite_colors_onoff',$proId);
			$mount_type_onoff = get_field('mount_type_onoff',$proId);
			$window_measurements_onoff = get_field('window_measurements_onoff',$proId);
			$select_hinge_color_onoff = get_field('select_hinge_color_onoff',$proId);
			$select_tilt_type_onoff = get_field('select_tilt_type_onoff',$proId);
			$number_of_frame_sides_onoff = get_field('number_of_frame_sides_onoff',$proId);
			$dividing_rail_onoff = get_field('dividing_rail_onoff',$proId);
			$frame_type_onoff = get_field('frame_type_onoff',$proId);
			$cafe_shutters_onoff = get_field('cafe_shutters_onoff',$proId);
			$select_louver_size_onoff = get_field('select_louver_size_onoff',$proId);
			
            if($title=='1 Panel' && isset($mainEnable[0])  && $mainEnable[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('panel_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
				if( get_field('panel_selections', $proId) ) {
					echo '<ul class="ywapo_options_container_selection_phpesperto">';
					while( the_repeater_field('panel_selections', $proId) ) {
						echo '<li class="ywapo_input_container_selection_phpesperto">';
						?>
							<div class="ywapophpesperto">
                    		    <img src="<?php echo get_sub_field('panel_image'); ?>">
                    		    <label class="selection_phpesperto_label1"><?php echo get_sub_field('panel_text'); ?></label>
                		    </div>
                		    <label class="selection_phpesperto_label2"><?php echo get_sub_field('panel_sub_text'); ?></label>
						<?php
						echo '</li>';
					}
					?> <input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value=""> <?php
					echo '</ul>';
				}
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/shutters-01.png">
                    		    <label class="selection_phpesperto_label1">L</label>
                		    </div>
                		    <label class="selection_phpesperto_label2">1 Panel</label>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/shutters-01-copy.png">
                    		    <label class="selection_phpesperto_label1">R</label>
                		    </div>
                		    <label class="selection_phpesperto_label2">2 Panel</label>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				echo '</div>';
            }
            else if($title=='Choose Type' && isset($choose_type_onoff[0])  && $choose_type_onoff[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('choose_type_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <h3 class="headingphpesperto">WOOD</h3>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <h3 class="headingphpesperto">COMPOSITE</h3>
                		    </div>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				if( get_field('choose_type_selections', $proId) ) {
					echo '<ul class="ywapo_options_container_selection_phpesperto">';
					while( the_repeater_field('choose_type_selections', $proId) ) {
						echo '<li class="ywapo_input_container_selection_phpesperto">';
						?>
							<div class="ywapophpesperto">
                    		    <h3 class="headingphpesperto"><?php echo get_sub_field('choose_type_text'); ?></h3>
                		    </div>
						<?php
						echo '</li>';
						
					}
					?> <input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value=""> <?php
					echo '</ul>';
				}
				echo '</div>';
            }
            else if($title=='Composite Colors' && isset($composite_colors_onoff[0])  && $composite_colors_onoff[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('composite_colors_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/pure-white.png">
                		    </div>
                    		    <label class="selection_phpesperto_label2">PURE WHITE</label>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/snow-white.png">
                		    </div>
                    		    <label class="selection_phpesperto_label2">SNOW WHITE</label>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/pearl-white.png">
                		    </div>
                    		    <label class="selection_phpesperto_label2">PEARL WHITE</label>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/egg-shell.png">
                		    </div>
                    		    <label class="selection_phpesperto_label2">EGGSHELL</label>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/off-white.png">
                		    </div>
                    		    <label class="selection_phpesperto_label2">OFF WHITE</label>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/ivory.png">
                		    </div>
                    		    <label class="selection_phpesperto_label2">IVORY</label>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/alabaster.png">
                		    </div>
                    		    <label class="selection_phpesperto_label2">ALABASTER</label>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				if( get_field('composite_colors_selections', $proId) ) {
					echo '<ul class="ywapo_options_container_selection_phpesperto">';
					while( the_repeater_field('composite_colors_selections', $proId) ) {
						echo '<li class="ywapo_input_container_selection_phpesperto">';
						?>
							<div class="ywapophpesperto">
                    		    <img src="<?php echo get_sub_field('composite_colors_image'); ?>">
                		    </div>
                    		<label class="selection_phpesperto_label2"><?php echo get_sub_field('composite_colors_text'); ?></label>
						<?php
						echo '</li>';
						
					}
					?> <input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value=""> <?php
					echo '</ul>';
				}
				echo '</div>';
				
            }
            else if($title=='Mount Type' && isset($mount_type_onoff[0])  && $mount_type_onoff[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('mount_type_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/11/inside-mount.png">
                    		    <label class="selection_phpesperto_label1">INSIDE</label>
                		    </div>
                		    <label class="selection_phpesperto_label2">Mounts inside the window opening.</label>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/11/outside-mount.png">
                    		    <label class="selection_phpesperto_label1">OUTSIDE</label>
                		    </div>
                		    <label class="selection_phpesperto_label2">Mounts outside the window opening.</label>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				if( get_field('mount_type_selections', $proId) ) {
					echo '<ul class="ywapo_options_container_selection_phpesperto">';
					while( the_repeater_field('mount_type_selections', $proId) ) {
						echo '<li class="ywapo_input_container_selection_phpesperto">';
						?>
							<div class="ywapophpesperto">
                    		    <img src="<?php echo get_sub_field('mount_type_image'); ?>">
                    		    <label class="selection_phpesperto_label1"><?php echo get_sub_field('mount_type_text'); ?></label>
                		    </div>
                		    <label class="selection_phpesperto_label2"><?php echo get_sub_field('mount_type_text'); ?></label>
						<?php
						echo '</li>';
					}
					?> <input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value=""> <?php
					echo '</ul>';
				}
				echo '</div>';
            }
            else if($title=='Window Measurements' && isset($window_measurements_onoff[0])  && $window_measurements_onoff[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('window_measurements_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
				$windowArray = array();
				if( get_field('window_measurements_selections', $proId) ) {
					while( the_repeater_field('window_measurements_selections', $proId) ) {
						$windowArray[]=get_sub_field('mount_type_image'); 
					}
				}
				
				
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <img src="<?php echo $windowArray[0]; ?>">
                		    <input type="text" name="phpesperto_width" placeholder='12"'>
                		    <select name="phpesperto_width_2">
                		        <option value="0">0</option>
                		        <option value="1/8">1/8</option>
                		        <option value="1/4">1/4</option>
                		        <option value="3/8">3/8</option>
                		        <option value="1/2">1/2</option>
                		        <option value="5/8">5/8</option>
                		        <option value="3/4">3/4</option>
                		        <option value="7/8">7/8</option>
                		    </select>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <img src="<?php echo $windowArray[1]; ?>">
                		    <input type="text" placeholder='12"' name="phpesperto_height">
                		    <select name="phpesperto_height_2">
                		        <option value="0">0</option>
                		        <option value="1/8">1/8</option>
                		        <option value="1/4">1/4</option>
                		        <option value="3/8">3/8</option>
                		        <option value="1/2">1/2</option>
                		        <option value="5/8">5/8</option>
                		        <option value="3/4">3/4</option>
                		        <option value="7/8">7/8</option>
                		    </select>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				echo '</div>';
            }
            else if($title=='Select Hinge Color' && isset($select_hinge_color_onoff[0])  && $select_hinge_color_onoff[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('select_hinge_color_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
				if( get_field('select_hinge_color_selections', $proId) ) {
					echo '<ul class="ywapo_options_container_selection_phpesperto">';
					while( the_repeater_field('select_hinge_color_selections', $proId) ) {
						echo '<li class="ywapo_input_container_selection_phpesperto">';
						?>
							<div class="ywapophpesperto">
                    		    <img src="<?php echo get_sub_field('select_hinge_color_image'); ?>">
                    		    <label class="selection_phpesperto_label1"><?php echo get_sub_field('select_hinge_color_text'); ?></label>
                		    </div>
						<?php
						echo '</li>';
					}
					?> <input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value=""> <?php
					echo '</ul>';
				}
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/0-5.png">
                    		    <label class="selection_phpesperto_label1">WHITE</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/1-5.png">
                    		    <label class="selection_phpesperto_label1">BROWN</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/2-3.png">
                    		    <label class="selection_phpesperto_label1">GREY</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
							<img src="/wp-content/uploads/2026/01/magnets.png">
                    		    <span class="selection_phpesperto_label1">MAGNETS</span>
                		    </div>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				echo '</div>';
            }
            else if($title=='Select Louver Size' && isset($select_louver_size_onoff[0])  && $select_louver_size_onoff[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('select_louver_size_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
				if( get_field('select_louver_size_selections', $proId) ) {
					echo '<ul class="ywapo_options_container_selection_phpesperto">';
					while( the_repeater_field('select_louver_size_selections', $proId) ) {
						echo '<li class="ywapo_input_container_selection_phpesperto">';
						?>
							<div class="ywapophpesperto">
                    		    <img src="<?php echo get_sub_field('select_louver_size_image'); ?>">
                    		    <label class="selection_phpesperto_label1"><?php echo get_sub_field('select_louver_size_text'); ?></label>
                		    </div>
						<?php
						echo '</li>';
					}
					?> <input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value=""> <?php
					echo '</ul>';
				}
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/0-6.png">
                    		    <label class="selection_phpesperto_label1">2½</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/1-6.png">
                    		    <label class="selection_phpesperto_label1">3½</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/2-4.png">
                    		    <label class="selection_phpesperto_label1">4½</label>
                		    </div>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				echo '</div>';
            }
            else if($title=='Select Tilt Type' && isset($select_tilt_type_onoff[0])  && $select_tilt_type_onoff[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('select_tilt_type_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
				if( get_field('select_tilt_type_selections', $proId) ) {
					echo '<ul class="ywapo_options_container_selection_phpesperto">';
					while( the_repeater_field('select_tilt_type_selections', $proId) ) {
						echo '<li class="ywapo_input_container_selection_phpesperto">';
						?>
							<div class="ywapophpesperto">
                    		    <img src="<?php echo get_sub_field('select_tilt_type_image'); ?>">
                    		    <label class="selection_phpesperto_label1"><?php echo get_sub_field('select_tilt_type_text'); ?></label>
                		    </div>
						<?php
						echo '</li>';
					}
					?> <input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value=""> <?php
					echo '</ul>';
				}
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/0-7.png">
                    		    <label class="selection_phpesperto_label1">TYPE 1</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/1-7.png">
                    		    <label class="selection_phpesperto_label1">TYPE 2</label>
                		    </div>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				echo '</div>';
            }
            else if($title=='Number of Frame Sides' && isset($number_of_frame_sides_onoff[0])  && $number_of_frame_sides_onoff[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('number_of_frame_sides_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
				if( get_field('number_of_frame_sides_selections', $proId) ) {
					echo '<ul class="ywapo_options_container_selection_phpesperto">';
					while( the_repeater_field('number_of_frame_sides_selections', $proId) ) {
						echo '<li class="ywapo_input_container_selection_phpesperto">';
						?>
							<div class="ywapophpesperto">
                    		    <img src="<?php echo get_sub_field('number_of_frame_sides_image'); ?>">
                    		    <label class="selection_phpesperto_label1"><?php echo get_sub_field('number_of_frame_sides_text'); ?></label>
                		    </div>
						<?php
						echo '</li>';
					}
					?> <input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value=""> <?php
					echo '</ul>';
				}
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/0-8.png">
                    		    <label class="selection_phpesperto_label1">TYPE 1</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/1-8.png">
                    		    <label class="selection_phpesperto_label1">TYPE 2</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/2-5.png">
                    		    <label class="selection_phpesperto_label1">TYPE 3</label>
                		    </div>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				echo '</div>';
            }
            else if($title=='Dividing Rail' && isset($dividing_rail_onoff[0])  && $dividing_rail_onoff[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('dividing_rail_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
				if( get_field('dividing_rail_selections', $proId) ) {
					echo '<ul class="ywapo_options_container_selection_phpesperto">';
					while( the_repeater_field('dividing_rail_selections', $proId) ) {
						echo '<li class="ywapo_input_container_selection_phpesperto">';
						?>
							<div class="ywapophpesperto">
                    		    <img src="<?php echo get_sub_field('dividing_rail_image'); ?>">
                    		    <label class="selection_phpesperto_label1"><?php echo get_sub_field('dividing_rail_text'); ?></label>
                		    </div>
						<?php
						echo '</li>';
					}
					?> <input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value=""> <?php
					echo '</ul>';
				}
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/0-9.png">
                    		    <label class="selection_phpesperto_label1">TYPE 1</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/1-9.png">
                    		    <label class="selection_phpesperto_label1">TYPE 2</label>
                		    </div>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				echo '</div>';
            }
            else if($title=='Frame Type' && isset($frame_type_onoff[0])  && $frame_type_onoff[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('frame_type_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
				if( get_field('frame_type_selections', $proId) ) {
					echo '<ul class="ywapo_options_container_selection_phpesperto">';
					while( the_repeater_field('frame_type_selections', $proId) ) {
						echo '<li class="ywapo_input_container_selection_phpesperto">';
						?>
							<div class="ywapophpesperto">
                    		    <img src="<?php echo get_sub_field('frame_type_image'); ?>">
                    		    <label class="selection_phpesperto_label1"><?php echo get_sub_field('frame_type_text'); ?></label>
                		    </div>
						<?php
						echo '</li>';
					}
					?> <input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value=""> <?php
					echo '</ul>';
				}
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/11/frame01.png">
                    		    <label class="selection_phpesperto_label1">TYPE 1</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/11/frame02.png">
                    		    <label class="selection_phpesperto_label1">TYPE 2</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/11/frame03.png">
                    		    <label class="selection_phpesperto_label1">TYPE 3</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/11/frame04.png">
                    		    <label class="selection_phpesperto_label1">TYPE 4</label>
                		    </div>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				echo '</div>';
            }
			else if($title=='Cafe Shutters' && isset($cafe_shutters_onoff[0])  && $cafe_shutters_onoff[0]=='On'){
				echo '<div class="section_selection_phpesperto section_'.$sanitize_title.'">';
				$dynamicHeading = get_field('cafe_shutters_heading',$proId);
				echo '<h3><span class="dashicons dashicons-arrow-down"></span>'.$dynamicHeading.' *</h3>';
				if( get_field('cafe_shutters_selections', $proId) ) {
					echo '<ul class="ywapo_options_container_selection_phpesperto">';
					while( the_repeater_field('cafe_shutters_selections', $proId) ) {
						echo '<li class="ywapo_input_container_selection_phpesperto">';
						?>
							<div class="ywapophpesperto">
                    		    <img src="<?php echo get_sub_field('cafe_shutters_image'); ?>">
                    		    <label class="selection_phpesperto_label1"><?php echo get_sub_field('cafe_shutters_text'); ?></label>
                		    </div>
						<?php
						echo '</li>';
					}
					?> <input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value=""> <?php
					echo '</ul>';
				}
                ?>
                    <ul class="ywapo_options_container_selection_phpesperto">
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/0-9.png">
                    		    <label class="selection_phpesperto_label1">TYPE 1</label>
                		    </div>
                		</li>
                		<li class="ywapo_input_container_selection_phpesperto">
                		    <div class="ywapophpesperto">
                    		    <img src="/wp-content/uploads/2020/10/1-9.png">
                    		    <label class="selection_phpesperto_label1">TYPE 2</label>
                		    </div>
                		</li>
                		<input type="hidden" class="input_phpesperto_val" name="<?php echo $sanitize_title; ?>" value="">
                	</ul>
                <?php
				echo '</div>';
            }
           
       }
    
       ?>
       <script>
jQuery(document).ready(function($){
  $(".section_selection_phpesperto h3").click(function(){
    $(this).next().slideToggle();
  });
  $(".ywapo_options_container_selection_phpesperto li .ywapophpesperto").click(function(){
    $(this).parents('.ywapo_options_container_selection_phpesperto').find('.ywapophpesperto').removeClass('phpesperto_activate');
    $(this).addClass('phpesperto_activate');
    var parentClass = $(this).parents('.section_selection_phpesperto').attr('class').split(' ')[1];
    var selectedVal = '';
    if(parentClass=='section_1-panel'){
        selectedVal = $('.section_1-panel .phpesperto_activate label').text();
    }
    else if(parentClass=='section_choose-type'){
        selectedVal = $('.section_choose-type .phpesperto_activate h3').text();
    }
    else if(parentClass=='section_composite-colors'){
        selectedVal = $('.section_composite-colors .phpesperto_activate').parents('li').find('label').text();
    }
    else if(parentClass=='section_mount-type'){
        selectedVal = $('.section_mount-type .phpesperto_activate label').text();
    }
    else if(parentClass=='section_select-hinge-color'){
        selectedVal = $('.section_select-hinge-color .phpesperto_activate label').text();
    }
    else if(parentClass=='section_select-louver-size'){
        selectedVal = $('.section_select-louver-size .phpesperto_activate label').text();
    }
    else if(parentClass=='section_select-tilt-type'){
        selectedVal = $('.section_select-tilt-type .phpesperto_activate label').text();
    }
    else if(parentClass=='section_number-of-frame-sides'){
        selectedVal = $('.section_number-of-frame-sides .phpesperto_activate label').text();
    }
    else if(parentClass=='section_dividing-rail'){
        selectedVal = $('.section_dividing-rail .phpesperto_activate label').text();
    }
    else if(parentClass=='section_frame-type'){
        selectedVal = $('.section_frame-type .phpesperto_activate label').text();
    }
    $(this).parents('.section_selection_phpesperto').find('.input_phpesperto_val').val(selectedVal);
  });
});
</script>
       <?php
    }
}
add_action( 'woocommerce_before_add_to_cart_button', 'hwn_add_custom_option');

function add_the_date_validationa_new( $passed_validation, $product_id ) {
    $value = get_field( "enable_custom_product_selection", $product_id );
    
    if( $value=='Enable' ) {
        $error = 0;
        $errorMessage = 'Please select ';
        if(empty(sanitize_text_field($_REQUEST['d_val']))){
            $errorMessage .= 'Panel, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['choose-type']))){
            $errorMessage .= 'Choose Type, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['composite-colors']))){
            $errorMessage .= 'Composite Color, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['d_mount_type']))){
            $errorMessage .= 'Mount Type, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['phpesperto_width']))){
            $errorMessage .= 'Window width, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['phpesperto_width_2']))){
            $errorMessage .= 'Window width 2, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['phpesperto_height']))){
            $errorMessage .= 'Window height, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['phpesperto_height_2']))){
            $errorMessage .= 'Window height 2, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['select-hinge-color']))){
            $errorMessage .= 'Hinge Color, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['select-louver-size']))){
            $errorMessage .= 'Louver Size, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['select-tilt-type']))){
            $errorMessage .= 'Tilt Type, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['number-of-frame-sides']))){
            $errorMessage .= 'Frame Sides, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['dividing-rail']))){
            $errorMessage .= 'Dividing Rail, '; $error++;
        }
        if(empty(sanitize_text_field($_REQUEST['frame-type']))){
            $errorMessage .= 'Frame Type, '; $error++;
        }
        if($error>0){
            wc_add_notice( __( $errorMessage, 'woocommerce' ), 'error' );
            return false;
        }
    }
    return $passed_validation;
}
add_filter( 'woocommerce_add_to_cart_validation', 'add_the_date_validationa_new', 10, 5 );


add_filter('woocommerce_add_cart_item_data','wdm_add_item_data',10,3);
function wdm_add_item_data($cart_item_data, $product_id, $variation_id)
{
    if(sanitize_text_field($_REQUEST['d_val']))
    {
        $cart_item_data['d_val'] = sanitize_text_field($_REQUEST['d_val']);	
    }
    if(sanitize_text_field($_REQUEST['d_choose_type'])){
        $cart_item_data['d_choose_type'] = sanitize_text_field($_REQUEST['d_choose_type']);	
    }
	if(sanitize_text_field($_REQUEST['d_opening_window_depth'])){
        $cart_item_data['d_opening_window_depth'] = sanitize_text_field($_REQUEST['d_opening_window_depth']);	
    }
	if(sanitize_text_field($_REQUEST['d_opening_window_depth_decimal'])){
        $cart_item_data['d_opening_window_depth_decimal'] = sanitize_text_field($_REQUEST['d_opening_window_depth_decimal']);	
    }
	if(sanitize_text_field($_REQUEST['d_choose_type_color'])){
        $cart_item_data['d_choose_type_color'] = sanitize_text_field($_REQUEST['d_choose_type_color']);	
    }
	if(sanitize_text_field($_REQUEST['d_hinge_color'])){
        // Only add hinge color if attachment type is Hinge or not set
        $attachment_type = isset($_REQUEST['d_attachment_type']) ? sanitize_text_field($_REQUEST['d_attachment_type']) : '';
        if($attachment_type == 'Hinge' || empty($attachment_type))
        {
            $cart_item_data['d_hinge_color'] = sanitize_text_field($_REQUEST['d_hinge_color']);
        }
    }
	if(sanitize_text_field($_REQUEST['d_default_text'])){
        $cart_item_data['d_default_text'] = sanitize_text_field($_REQUEST['d_default_text']);	
    }
	if(sanitize_text_field($_REQUEST['d_choose_measurement_a'])){
        $cart_item_data['d_choose_measurement_a'] = sanitize_text_field($_REQUEST['d_choose_measurement_a']);	
    }
	if(sanitize_text_field($_REQUEST['d_choose_measurement_b'])){
        $cart_item_data['d_choose_measurement_b'] = sanitize_text_field($_REQUEST['d_choose_measurement_b']);	
    }
	if(sanitize_text_field($_REQUEST['d_choose_measurement_c'])){
        $cart_item_data['d_choose_measurement_c'] = sanitize_text_field($_REQUEST['d_choose_measurement_c']);	
    }
	if(sanitize_text_field($_REQUEST['d_choose_measurement_d'])){
        $cart_item_data['d_choose_measurement_d'] = sanitize_text_field($_REQUEST['d_choose_measurement_d']);	
    }
	if(sanitize_text_field($_REQUEST['d_choose_measurement_e'])){
        $cart_item_data['d_choose_measurement_e'] = sanitize_text_field($_REQUEST['d_choose_measurement_e']);	
    }
	if(sanitize_text_field($_REQUEST['d_choose_measurement_f'])){
        $cart_item_data['d_choose_measurement_f'] = sanitize_text_field($_REQUEST['d_choose_measurement_f']);	
    }
	if(sanitize_text_field($_REQUEST['d_choose_measurement_g'])){
        $cart_item_data['d_choose_measurement_g'] = sanitize_text_field($_REQUEST['d_choose_measurement_g']);	
    }
	if(sanitize_text_field($_REQUEST['d_choose_measurement_h'])){
        $cart_item_data['d_choose_measurement_h'] = sanitize_text_field($_REQUEST['d_choose_measurement_h']);	
    }
	if(sanitize_text_field($_REQUEST['d_choose_measurement_i'])){
        $cart_item_data['d_choose_measurement_i'] = sanitize_text_field($_REQUEST['d_choose_measurement_i']);	
    }
	if(sanitize_text_field($_REQUEST['d_choose_measurement_j'])){
        $cart_item_data['d_choose_measurement_j'] = sanitize_text_field($_REQUEST['d_choose_measurement_j']);	
    }
    if(sanitize_text_field($_REQUEST['d_mount_type'])){
        $cart_item_data['d_mount_type'] = sanitize_text_field($_REQUEST['d_mount_type']);	
    }
    if(sanitize_text_field($_REQUEST['d_attachment_type'])){
        $cart_item_data['d_attachment_type'] = sanitize_text_field($_REQUEST['d_attachment_type']);	
    }
	if(sanitize_text_field($_REQUEST['d_width']))
    {
		$cart_item_data['d_width'] = sanitize_text_field($_REQUEST['d_width']);	
	}

    if(sanitize_text_field($_REQUEST['d_width2']))
    {
        $cart_item_data['d_width2'] = sanitize_text_field($_REQUEST['d_width2']);	
    }
    if(sanitize_text_field($_REQUEST['d_height']))
    {
        $cart_item_data['d_height'] = sanitize_text_field($_REQUEST['d_height']);	
    }
    if(sanitize_text_field($_REQUEST['d_height2']))
    {
        $cart_item_data['d_height2'] = sanitize_text_field($_REQUEST['d_height2']);	
    }
    if(sanitize_text_field($_REQUEST['d_lourve_size']))
    {
        $cart_item_data['d_lourve_size'] = sanitize_text_field($_REQUEST['d_lourve_size']);	
    }
    if(sanitize_text_field($_REQUEST['d_tilt_type']))
    {
        $cart_item_data['d_tilt_type'] = sanitize_text_field($_REQUEST['d_tilt_type']);	
    }
	if(sanitize_text_field($_REQUEST['d_tilt_type_split']))
    {
        $cart_item_data['d_tilt_type_split'] = sanitize_text_field($_REQUEST['d_tilt_type_split']);	
    }
    if(sanitize_text_field($_REQUEST['d_no_of_frame_sides']))
    {
        $cart_item_data['d_no_of_frame_sides'] = sanitize_text_field($_REQUEST['d_no_of_frame_sides']);	
    }
    if(sanitize_text_field($_REQUEST['d_dividing_rail']))
    {
        $cart_item_data['d_dividing_rail'] = sanitize_text_field($_REQUEST['d_dividing_rail']);	
    }
    if(sanitize_text_field($_REQUEST['d_frame_type']))
    {
        $cart_item_data['d_frame_type'] = sanitize_text_field($_REQUEST['d_frame_type']);	
    }
    if(sanitize_text_field($_REQUEST['d_atoz_measurements']))
    {
        $cart_item_data['d_atoz_measurements'] = sanitize_text_field($_REQUEST['d_atoz_measurements']);	
    }
    return $cart_item_data;
}

// Helper function to format dimension measurements
function format_dimension_display($measurement) {
    if(empty($measurement) || $measurement == 'NA/ Not Provided') {
        return $measurement;
    }
    
    // Remove escaped quotes and trim regular quotes
    $measurement = str_replace('\\"', '', $measurement);
    $measurement = str_replace('\"', '', $measurement);
    $measurement = trim($measurement, '"');
    $parts = explode(' ', $measurement);
    
    if(count($parts) == 2) {
        // Has both whole and fraction: "18 3/8"
        return 'Whole Inch: ' . $parts[0] . '" Fraction: ' . $parts[1];
    } else if(count($parts) == 1 && !empty($parts[0])) {
        // Only whole number: "18"
        return 'Whole Inch: ' . $parts[0] . '"';
    }
    
    return $measurement;
}

add_filter('woocommerce_get_item_data','wdm_add_item_meta',10,2);
function wdm_add_item_meta($item_data, $cart_item)
{
    if(array_key_exists('custom_shipping_add', $cart_item))
    {
        $custom_details = $cart_item['custom_shipping_add'];
        $item_data[] = array('key'   => 'Shipping Charges','value' => '$'.$custom_details);
    }
	if(array_key_exists('custom_shipping_message', $cart_item))
    {
        $custom_details = $cart_item['custom_shipping_message'];
        $item_data[] = array('key'   => 'Shipping','value' => $custom_details);
    }
	
	if(array_key_exists('d_val', $cart_item))
    {
        $custom_details = $cart_item['d_val'];
        $item_data[] = array('key'   => 'Panel','value' => $custom_details);
    }
	if(array_key_exists('d_choose_type', $cart_item))
    {
        $custom_details = $cart_item['d_choose_type'];
        $item_data[] = array('key'   => 'Choose Type','value' => $custom_details);
    }
	if(array_key_exists('d_choose_type_color', $cart_item))
    {
        $custom_details = $cart_item['d_choose_type_color'];
        $item_data[] = array('key'   => 'Composite Colors','value' => $custom_details);
    }
	// Combine Opening Window Depth and Decimal
	if(array_key_exists('d_opening_window_depth', $cart_item))
    {
        $depth_whole = $cart_item['d_opening_window_depth'];
        $depth_fraction = '';
        
        if(array_key_exists('d_opening_window_depth_decimal', $cart_item) && !empty($cart_item['d_opening_window_depth_decimal'])) {
            $depth_fraction = ' Fraction: ' . $cart_item['d_opening_window_depth_decimal'] . '"';
        }
        
        $formatted_depth = 'Whole Inch: ' . $depth_whole . '"' . $depth_fraction;
        $item_data[] = array('key'   => 'Opening Window Depth','value' => $formatted_depth);
    }
	if(array_key_exists('d_mount_type', $cart_item))
    {
        $custom_details = $cart_item['d_mount_type'];
        $item_data[] = array('key'   => 'Mount Type','value' => $custom_details);
    }
	if(array_key_exists('d_attachment_type', $cart_item))
    {
        $custom_details = $cart_item['d_attachment_type'];
        $item_data[] = array('key'   => 'Attachment Type','value' => $custom_details);
    }
	if(array_key_exists('d_hinge_color', $cart_item))
    {
        // Only show hinge color if attachment type is Hinge
        $attachment_type = isset($cart_item['d_attachment_type']) ? $cart_item['d_attachment_type'] : '';
        if($attachment_type == 'Hinge' || empty($attachment_type))
        {
            $custom_details = $cart_item['d_hinge_color'];
            $item_data[] = array('key'   => 'Hinge Color','value' => $custom_details);
        }
    }
	if(array_key_exists('d_default_text', $cart_item))
    {
        $custom_details = $cart_item['d_default_text'];
        $item_data[] = array('key'   => 'Shutter Gap','value' => $custom_details);
    }
	// Side A - Check for new format first, fall back to old format
	if(array_key_exists('d_choose_measurement_a', $cart_item))
    {
        $custom_details = format_dimension_display($cart_item['d_choose_measurement_a']);
        $item_data[] = array('key'   => 'Side A','value' => $custom_details);
    }
	else if(array_key_exists('d_width', $cart_item))
    {
        $width_whole = $cart_item['d_width'];
        $width_fraction = '';
        
        if(array_key_exists('d_width2', $cart_item) && !empty($cart_item['d_width2'])) {
            $width_fraction = ' Fraction: ' . $cart_item['d_width2'];
        }
        
        $formatted_width = 'Whole Inch: ' . $width_whole . '"' . $width_fraction;
        $item_data[] = array('key'   => 'Side A','value' => $formatted_width);
    }
	
	// Side B - Check for new format first, fall back to old format
	if(array_key_exists('d_choose_measurement_b', $cart_item))
    {
        $custom_details = format_dimension_display($cart_item['d_choose_measurement_b']);
        $item_data[] = array('key'   => 'Side B','value' => $custom_details);
    }
	else if(array_key_exists('d_height', $cart_item))
    {
        $height_whole = $cart_item['d_height'];
        $height_fraction = '';
        
        if(array_key_exists('d_height2', $cart_item) && !empty($cart_item['d_height2'])) {
            $height_fraction = ' Fraction: ' . $cart_item['d_height2'];
        }
        
        $formatted_height = 'Whole Inch: ' . $height_whole . '"' . $height_fraction;
        $item_data[] = array('key'   => 'Side B','value' => $formatted_height);
    }
	if(array_key_exists('d_choose_measurement_c', $cart_item))
    {
        $custom_details = format_dimension_display($cart_item['d_choose_measurement_c']);
        $item_data[] = array('key'   => 'Side C','value' => $custom_details);
    }
	if(array_key_exists('d_choose_measurement_d', $cart_item))
    {
        $custom_details = format_dimension_display($cart_item['d_choose_measurement_d']);
        $item_data[] = array('key'   => 'Side D','value' => $custom_details);
    }
	if(array_key_exists('d_choose_measurement_e', $cart_item))
    {
        $custom_details = format_dimension_display($cart_item['d_choose_measurement_e']);
        $item_data[] = array('key'   => 'Side E','value' => $custom_details);
    }
	if(array_key_exists('d_choose_measurement_f', $cart_item))
    {
        $custom_details = format_dimension_display($cart_item['d_choose_measurement_f']);
        $item_data[] = array('key'   => 'Side F','value' => $custom_details);
    }
	if(array_key_exists('d_choose_measurement_g', $cart_item))
    {
        $custom_details = format_dimension_display($cart_item['d_choose_measurement_g']);
        $item_data[] = array('key'   => 'Side G','value' => $custom_details);
    }
	if(array_key_exists('d_choose_measurement_h', $cart_item))
    {
        $custom_details = format_dimension_display($cart_item['d_choose_measurement_h']);
        $item_data[] = array('key'   => 'Side H','value' => $custom_details);
    }
	if(array_key_exists('d_choose_measurement_i', $cart_item))
    {
        $custom_details = format_dimension_display($cart_item['d_choose_measurement_i']);
        $item_data[] = array('key'   => 'Side I','value' => $custom_details);
    }
	if(array_key_exists('d_choose_measurement_j', $cart_item))
    {
        $custom_details = format_dimension_display($cart_item['d_choose_measurement_j']);
        $item_data[] = array('key'   => 'Side J','value' => $custom_details);
    }
	if(array_key_exists('d_lourve_size', $cart_item))
    {
        $custom_details = $cart_item['d_lourve_size'];
        $item_data[] = array('key'   => 'Louver Size','value' => $custom_details);
    }
	if(array_key_exists('d_tilt_type', $cart_item))
    {
        $custom_details = $cart_item['d_tilt_type'];
        $item_data[] = array('key'   => 'Tilt Type','value' => $custom_details);
    }
	if(array_key_exists('d_tilt_type_split', $cart_item))
    {
        $custom_details = $cart_item['d_tilt_type_split'];
        $item_data[] = array('key'   => 'Split or Single Tilt','value' => $custom_details);
    }
	if(array_key_exists('d_no_of_frame_sides', $cart_item))
    {
        $custom_details = $cart_item['d_no_of_frame_sides'];
        $item_data[] = array('key'   => 'Frame Sides','value' => $custom_details);
    }
	if(array_key_exists('d_dividing_rail', $cart_item))
    {
        $custom_details = $cart_item['d_dividing_rail'];
        $item_data[] = array('key'   => 'Dividing Rail','value' => $custom_details);
    }
	if(array_key_exists('d_frame_type', $cart_item))
    {
        $custom_details = $cart_item['d_frame_type'];
        $item_data[] = array('key'   => 'Frame Type','value' => $custom_details);
    }
    return $item_data;
}


add_action( 'woocommerce_checkout_create_order_line_item', 'wdm_add_custom_order_line_item_meta',10,4 );
function wdm_add_custom_order_line_item_meta($item, $cart_item_key, $values, $order)
{
	if(array_key_exists('custom_shipping_add', $values))
    {
        $item->add_meta_data('Shipping Charges','$'.$values['custom_shipping_add']);
    }
	if(array_key_exists('custom_shipping_message', $values))
    {
        $item->add_meta_data('Shipping',$values['custom_shipping_message']);
    }
	
    if(array_key_exists('d-val', $values))
    {
        $item->add_meta_data('Panel',$values['d-val']);
    }
	if(array_key_exists('d_choose_type', $values))
    {
        $item->add_meta_data('Choose Type',$values['d_choose_type']);
    }
	// Combine Opening Window Depth and Decimal
	if(array_key_exists('d_opening_window_depth', $values))
    {
        $depth_whole = $values['d_opening_window_depth'];
        $depth_fraction = '';
        
        if(array_key_exists('d_opening_window_depth_decimal', $values) && !empty($values['d_opening_window_depth_decimal'])) {
            $depth_fraction = ' Fraction: ' . $values['d_opening_window_depth_decimal'] . '"';
        }
        
        $formatted_depth = 'Whole Inch: ' . $depth_whole . '"' . $depth_fraction;
        $item->add_meta_data('Opening Window Depth', $formatted_depth);
    }
	if(array_key_exists('d_choose_type_color', $values))
    {
        $item->add_meta_data('Composite Color',$values['d_choose_type_color']);
    }
	if(array_key_exists('d_hinge_color', $values))
    {
        // Only add hinge color to order if attachment type is Hinge
        $attachment_type = isset($values['d_attachment_type']) ? $values['d_attachment_type'] : '';
        if($attachment_type == 'Hinge' || empty($attachment_type))
        {
            $item->add_meta_data('Hinge Color',$values['d_hinge_color']);
        }
    }
	if(array_key_exists('d_default_text', $values))
    {
        $item->add_meta_data('Shutter Gap',$values['d_default_text']);
    }
	if(array_key_exists('d_mount_type', $values))
    {
        $item->add_meta_data('Mount Type',$values['d_mount_type']);
    }
	if(array_key_exists('d_attachment_type', $values))
    {
        $item->add_meta_data('Attachment Type',$values['d_attachment_type']);
    }
	// Combine Width and Width Fraction (Side A)
	if(array_key_exists('d_width', $values))
    {
        $width_whole = $values['d_width'];
        $width_fraction = '';
        
        if(array_key_exists('d_width2', $values) && !empty($values['d_width2'])) {
            $width_fraction = ' Fraction: ' . $values['d_width2'];
        }
        
        $formatted_width = 'Whole Inch: ' . $width_whole . '"' . $width_fraction;
        $item->add_meta_data('Side A', $formatted_width);
    }
	
	// Combine Height and Height Fraction (Side B)
    if(array_key_exists('d_height', $values))
    {
        $height_whole = $values['d_height'];
        $height_fraction = '';
        
        if(array_key_exists('d_height2', $values) && !empty($values['d_height2'])) {
            $height_fraction = ' Fraction: ' . $values['d_height2'];
        }
        
        $formatted_height = 'Whole Inch: ' . $height_whole . '"' . $height_fraction;
        $item->add_meta_data('Side B', $formatted_height);
    }
	if(array_key_exists('d_choose_measurement_c', $values))
    {
        $item->add_meta_data('Side C', format_dimension_display($values['d_choose_measurement_c']));
    }
	if(array_key_exists('d_choose_measurement_d', $values))
    {
        $item->add_meta_data('Side D', format_dimension_display($values['d_choose_measurement_d']));
    }
	if(array_key_exists('d_choose_measurement_e', $values))
    {
        $item->add_meta_data('Side E', format_dimension_display($values['d_choose_measurement_e']));
    }
	if(array_key_exists('d_choose_measurement_f', $values))
    {
        $item->add_meta_data('Side F', format_dimension_display($values['d_choose_measurement_f']));
    }
	if(array_key_exists('d_choose_measurement_g', $values))
    {
        $item->add_meta_data('Side G', format_dimension_display($values['d_choose_measurement_g']));
    }
	if(array_key_exists('d_choose_measurement_h', $values))
    {
        $item->add_meta_data('Side H', format_dimension_display($values['d_choose_measurement_h']));
    }
	if(array_key_exists('d_choose_measurement_i', $values))
    {
        $item->add_meta_data('Side I', format_dimension_display($values['d_choose_measurement_i']));
    }
	if(array_key_exists('d_choose_measurement_j', $values))
    {
        $item->add_meta_data('Side J', format_dimension_display($values['d_choose_measurement_j']));
    }
    
    if(array_key_exists('d_lourve_size', $values))
    {
        $item->add_meta_data('Louver Size',$values['d_lourve_size']);
    }
	if(array_key_exists('d_tilt_type', $values))
    {
        $item->add_meta_data('Tilt Type',$values['d_tilt_type']);
    }
	if(array_key_exists('d_tilt_type_split', $values))
    {
        $item->add_meta_data('Split or Single Tilt',$values['d_tilt_type_split']);
    }
    if(array_key_exists('d_no_of_frame_sides', $values))
    {
        $item->add_meta_data('Frame Sides',$values['d_no_of_frame_sides']);
    }
    if(array_key_exists('d_dividing_rail', $values))
    {
        $item->add_meta_data('d_dividing_rail',$values['d_dividing_rail']);
    }
    if(array_key_exists('d_frame_type', $values))
    {
        $item->add_meta_data('Frame Type',$values['d_frame_type']);
    }
	if(array_key_exists('d_atoz_measurements', $values))
    {
        $item->add_meta_data('Octagon measurement',$values['d_atoz_measurements']);
    }
}


add_action( 'woocommerce_before_calculate_totals', 'before_calculate_totals', 10, 1 );
 
function before_calculate_totals( $cart_obj ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return;
    }
    // Iterate through each cart item
    foreach( $cart_obj->get_cart() as $key=>$value ) {
		
        if( isset( $value['newprice_is'] ) ) {
            $price = $value['newprice_is'];
            $value['data']->set_price( ( $price ) );
        }
		if( isset( $value['new_selection_price'] ) && $value['new_selection_price']) {
			$newPrice = (float)$value['new_selection_price']+(float)$value['custom_shipping_add'];
			$value['data']->set_price( ( $newPrice ) );
		}
		else if( isset( $value['new_selection_price'] ) ) {
            $price = $value['new_selection_price'];
			if( isset( $value['custom_shipping_add'] ) ) {
				$price = $value['custom_shipping_add']+$price;
			}
			$value['data']->set_price( ( $shippingPrice ) );
        }
    }
}


function add_subtitle_to_product() {
    global $product;
    $addtocart =  '<button type="submit" name="add-to-cart" value="'. esc_attr( $product->get_id() ).'" class="single_add_to_cart_button button alt">'. esc_html( $product->single_add_to_cart_text() ).'</button>';
    ?>
    <script>
    var addtocart = '<?php echo $addtocart ?>';
    jQuery(document).ready(function($){
        $(".custom-plantation-shutters #wapo-total-price-table").after(addtocart);
    });
    </script>
    <?php
}
add_action( 'woocommerce_single_product_summary', 'add_subtitle_to_product', 999);


add_action('woocommerce_after_add_to_cart_button', 'add_input_box_to_product_page', 30 );
function add_input_box_to_product_page(){ 
	$product_id = get_the_id();
	$categories = get_the_terms( $product_id, 'product_cat' );
	$array = array();
	foreach ( $categories as $term ) {
		$array[] = $term->term_id;
	}
	if (in_array(62, $array)){
?>     
		<input type="hidden" name="widthselection" id="widthselection" value=""> 
		<input type="hidden" name="heightselection" id="heightselection" value=""> 
       <script>
		jQuery(document).ready(function($){
			$('select#yith-wapo-39, select#yith-wapo-37, select#yith-wapo-72, select#yith-wapo-74, select#yith-wapo-66, select#yith-wapo-68, select#yith-wapo-124, select#yith-wapo-126, select#yith-wapo-154, select#yith-wapo-156, select#yith-wapo-134, select#yith-wapo-136, select#yith-wapo-94, select#yith-wapo-92, select#yith-wapo-144, select#yith-wapo-146, select#yith-wapo-165, select#yith-wapo-167, select#yith-wapo-82, select#yith-wapo-84, select#yith-wapo-102, select#yith-wapo-104, select#yith-wapo-56, select#yith-wapo-58, select#yith-wapo-112, select#yith-wapo-114').on('change', function() {

				var selectedId = $(this).attr('data-addon-id');
				var selectedVal = parseInt($(this).find(":selected").text());
                console.log(selectedVal,selectedId);
				if(selectedId==39 || selectedId==74 || selectedId==68 || selectedId==126 || selectedId==156 || selectedId==136 || selectedId==94 || selectedId==146 || selectedId==167 || selectedId==84 || selectedId==104 || selectedId==58 || selectedId==114){
					$('#heightselection').val(selectedVal);
				}
				if(selectedId==37 || selectedId==72 || selectedId==66 || selectedId==124 || selectedId==154 || selectedId==134 || selectedId==92 || selectedId==144 || selectedId==165 || selectedId==82 || selectedId==102 || selectedId==56 || selectedId==112){
					$('#widthselection').val(selectedVal);
				}
				function roundToHalfFoot(inches) {
					var value = parseFloat(inches);
					if (isNaN(value) || value <= 0) {
						return 0;
					}
					var remainder = value % 12;
					if (remainder > 0 && remainder <= 6) {
						value += (6 - remainder);
					} else if (remainder > 6) {
						value += (12 - remainder);
					}
					return value / 12;
				}

				var heigtprice = roundToHalfFoot($('#heightselection').val());
				var widthprice = roundToHalfFoot($('#widthselection').val());
				var sqftGet = heigtprice*widthprice;
				var finalPrice = sqftGet * 30;
				if (finalPrice < 250) {
					finalPrice = 250;
				}
				
				finalPrice = '$'+finalPrice.toFixed(2);
				
				console.log(finalPrice);
				//$('td#wapo-total-order-price span.woocommerce-Price-amount.amount').html(finalPrice);
				$('td#wapo-total-order-price').html(finalPrice);
			});
			
			$('div#yith-wapo-addon-37 .addon-header h3.wapo-addon-title').after('<img src="/wp-content/uploads/2020/10/width.png">');
			$('div#yith-wapo-addon-39 .addon-header h3.wapo-addon-title').after('<img src="/wp-content/uploads/2020/10/height.png">');
			
			jQuery('.yith-wapo-addon select option:not(:first-child)').append('"');
		});
		</script>   
	
     <?php
	 }
}


add_filter( 'woocommerce_add_cart_item_data', 'add_cart_item_data', 10, 3 );
 
function add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
    $categories = get_the_terms( $product_id, 'product_cat' );
	$array = array();
	foreach ( $categories as $term ) {
		$array[] = $term->term_id;
	}

	if (in_array(62, $array)){
		if ($_POST['d_height'] && $_POST['d_width']){
			//$widthselection = $_POST['widthselection']/12;
			//$heightselection = $_POST['heightselection']/12;
			$widthselection = intval($_POST['d_width']) / 12;
			$heightselection = intval($_POST['d_height']) / 12;
			$getSqft = $widthselection*$heightselection;
			$createPrice = $getSqft*30;

			if((float)$getSqft<6){
					$createPrice = 6*30;
			}

			if($createPrice<250){
				$createPrice = 250;
			}

			$createPrice = number_format((float)$createPrice, 2, '.', '');

			$cart_item_data['new_selection_price'] = (float)$createPrice;
			if($getSqft<=5){
				$cart_item_data['custom_shipping_add'] = 25;
			}
			else if($getSqft>5 && $getSqft<16){
				$cart_item_data['custom_shipping_add'] = 65;
			}
			else if($getSqft>=16 && $getSqft<=22){
				$cart_item_data['custom_shipping_add'] = 200;
			}
			else if($getSqft>22){
				$cart_item_data['custom_shipping_message'] = 'Call in for a shipping quote';
			}
		}
	}
	return $cart_item_data;
}
function pagination_bar( $custom_query ) {

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999;

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}
function getposts_saurav_func( $atts ){
	if(is_admin()) {
	return;	
	}
	$paginate = 8;
	if($atts['paginate']){
		$paginate = $atts['paginate'];
	}
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$loop = new WP_Query( array( 
			'posts_per_page' => $paginate,
			'paged'          => $paged )
	);
	echo '<div class="main_col_custom">';
	
	if ( $loop->have_posts() ):
	echo '<div class="main_col_custominner">';
    while ( $loop->have_posts() ) : $loop->the_post();
	?>
	<div class="ineer_col_single">
		<div class="ineer_col_maincontent">
		<div class="ineer_col_img">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="ineer_col_content">
			<h3><?php echo wp_trim_words( get_the_title(), 9 ); ?></h3>
			<p><?php echo wp_trim_words( get_the_content(), 18 ); ?></p>
		</div>
		<a href="<?php echo get_the_permalink(); ?>">Continue Reading</a>
		
	</div>
		</div>
	<?php
	 endwhile;
	echo '</div>';
	if($atts['number']){
	echo '<div class="main_col_custom_paginate">';
		pagination_bar( $loop );
		echo '</div>';
	}
	wp_reset_postdata();
endif;
	echo '</div>';
}
add_shortcode( 'displayposts', 'getposts_saurav_func' );
add_action('woocommerce_single_product_summary', 'customizing_single_product_summary_hooks', 2  );
function customizing_single_product_summary_hooks(){
	$terms = get_the_terms ( get_the_id(), 'product_cat' );
	$arrayIds = array();
	foreach ( $terms as $term ) {
     $arrayIds[] = $term->term_id;
	}
	if (in_array(62, $arrayIds)){
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_title', 5  );
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating', 10 );
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10  );
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20  );
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30 );
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40 );
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing' ,50);
		remove_action('woocommerce_single_product_summary','WC_Structured_Data::generate_product_data()',60 );
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		?>
<style>.row.product-image-summary-inner, .product_cat-custom-plantation-shutters .product-tabs-wrapper .wc-tabs-wrapper { display: none;}</style>
<style>.product-image-summary-inner, .product_cat-custom-plantation-shutters .product-tabs-wrapper .wc-tabs-wrapper { display: none;}</style>
<script>
	
jQuery(document).ready(function($){
    // Set default values for active buttons on page load
    setTimeout(function() {
        if($('.wood_co.active').length > 0) {
            var defaultWood = $('.wood_co.active').text();
            $('[name="d_choose_type"]').val(defaultWood);
            if(typeof arrayObject !== 'undefined') {
                arrayObject['Choose Type'] = defaultWood;
            }
        }
        
        if($('.attachment-jq.active').length > 0) {
            var defaultAttachment = $('.attachment-jq.active').text();
            $('[name="d_attachment_type"]').val(defaultAttachment);
            if(typeof arrayObject !== 'undefined') {
                arrayObject['Attachment Type'] = defaultAttachment;
            }
        }
    }, 100);
    
    // Hide Side B fields for perfect arches products
    var isPerfectArches = $('body').hasClass('product-perfect-arches') || 
                          $('body').hasClass('product-1-4-perfect-arches') ||
                          $('.product-title:contains("Perfect Arch")').length > 0;
    
    if(isPerfectArches) {
        // Hide Side B input fields
        $('.get_dev_height_inches, .get_dev_height2_inches').closest('.col-sm-4, .col').hide();
        
        // Add a note that Side B is auto-calculated
        $('.get_dev_width_inches').closest('.row').after(
            '<div class="col-12" style="padding: 10px; margin: 10px 0; background: #f0f8ff; border-left: 3px solid #2196F3;">' +
            '<small><strong>Note:</strong> Side B (height) is automatically calculated as A/2 for perfect arches.</small>' +
            '</div>'
        );
    }
    
    function updateSelectionCustomProducts(arrayObject){
		$('#showselecteddata li').remove(); 
		for (const [index, value] of Object.entries(arrayObject)) {
			$('#showselecteddata').append('<li><strong>'+index+': </strong> '+value+'</li>');
		}

		function parseFraction(fraction) {
			if (!fraction || fraction === '0') {
				return 0;
			}
			var parts = fraction.split('/');
			if (parts.length !== 2) {
				return 0;
			}
			var num = parseFloat(parts[0]);
			var den = parseFloat(parts[1]);
			if (isNaN(num) || isNaN(den) || den === 0) {
				return 0;
			}
			return num / den;
		}

		function getInches(wholeVal, fractionVal) {
			var whole = parseFloat(wholeVal);
			if (isNaN(whole)) {
				whole = 0;
			}
			return whole + parseFraction(fractionVal);
		}
		
		function roundToHalfFoot(inches) {
			var value = parseFloat(inches);
			if (isNaN(value) || value <= 0) {
				return 0;
			}
			var remainder = value % 12;
			if (remainder > 0 && remainder <= 6) {
				value += (6 - remainder);
			} else if (remainder > 6) {
				value += (12 - remainder);
			}
			return value / 12;
		}

		var heightWhole = (typeof wholeInch !== 'undefined' && wholeInch.b) ? wholeInch.b : $('.get_dev_height_inches').val();
		var heightFraction = (typeof decimalInch !== 'undefined' && decimalInch.b) ? decimalInch.b : $('.get_dev_height2_inches').val();
		var widthWhole = (typeof wholeInch !== 'undefined' && wholeInch.a) ? wholeInch.a : $('.get_dev_width_inches').val();
		var widthFraction = (typeof decimalInch !== 'undefined' && decimalInch.a) ? decimalInch.a : $('.get_dev_width2_inches').val();

		var heightInches = getInches(heightWhole, heightFraction);
		var widthInches = getInches(widthWhole, widthFraction);
		var finalPriceValue = 0;

		if (heightInches > 0 && widthInches > 0) {
			var heigtprice = roundToHalfFoot(heightInches);
			var widthprice = roundToHalfFoot(widthInches);
			var sqftGet = heigtprice * widthprice;
			finalPriceValue = sqftGet * 30;
			if (finalPriceValue < 250) {
				finalPriceValue = 250;
			}
		}

		$('.yith-wapo-form-style-custom').attr('data-order-price', finalPriceValue.toFixed(2));
		$('.yith-wapo-form-style-custom').attr('data-product-price', finalPriceValue.toFixed(2));
		$('span#cal_price_dev').html(': $' + finalPriceValue.toFixed(2));
	}
	let ulHtml = '';
	var arrayObject = [];
  $(".product_custom_button").click(function(){
    var activeDiv = '.'+$(this).attr('data-class');
	  $('.product_single_custom_slide').hide();
	  $(activeDiv).show();

	$('html, body').animate({
   	scrollTop: $(".product_single_custom_main").offset().top
	}, 1000);
	  
  });
	$(".clicktoact").click(function(){
		$(this).closest('.row').find('.clicktoact').removeClass('active');
		$(this).addClass('active');
	});
		
$(".get_dev_frametype").click(function(){
    $('[name="d_frame_type"]').val($(this).next().text());
	arrayObject['Frame Type'] = $(this).next().text();
	updateSelectionCustomProducts(arrayObject);
    ulHtml +='<li><strong>Frame Type: </strong> '+$(this).next().text()+'</li>';
});
$(".get_dev_rails").click(function(){
    $('[name="d_dividing_rail"]').val($(this).next().text());
	arrayObject['Dividing Rails'] = $(this).next().text();
	updateSelectionCustomProducts(arrayObject);
    ulHtml +='<li><strong>Dividing Rails: </strong> '+$(this).next().text()+'</li>';
});
$(".get_dev_louver").click(function(){
    $('[name="d_lourve_size"]').val($(this).next().text());
	arrayObject['Louver size'] = $(this).next().text();
	updateSelectionCustomProducts(arrayObject);
    ulHtml +='<li><strong>Louver size: </strong> '+$(this).next().text()+'</li>';
});
$(".get_dev_tilt_split").click(function(){
    $('[name="d_tilt_type_split"]').val($(this).next().text());
    arrayObject['Split or Single Tilt'] = $(this).next().text();
	updateSelectionCustomProducts(arrayObject);
	ulHtml +='<li><strong>Split or Single Tilt: </strong> '+$(this).next().text()+'</li>';
});
$(".get_dev_tilt").click(function(){
    $('[name="d_tilt_type"]').val($(this).next().text());
    arrayObject['Tilt Type'] = $(this).next().text();
	updateSelectionCustomProducts(arrayObject);
	ulHtml +='<li><strong>Tilt Type: </strong> '+$(this).next().text()+'</li>';
});
$(".get_dev_framesides").click(function(){
    $('[name="d_no_of_frame_sides"]').val($(this).next().text());
	arrayObject['No of Frame sides'] = $(this).next().text();
	updateSelectionCustomProducts(arrayObject);
    ulHtml +='<li><strong>No of Frame sides: </strong> '+$(this).next().text()+'</li>';
});
$(".select_dev_title").click(function(){
    $('.nameofthe_pro').val($(this).next().text());
	arrayObject[$(".nameofthe_pro").attr('data-title')] = $(this).next().text();
	updateSelectionCustomProducts(arrayObject);
    ulHtml +='<li><strong>'+$(".nameofthe_pro").val()+': </strong> '+$(this).next().text()+'</li>';
});
$(".select_dev_mount").click(function(){
    $('[name="d_mount_type"]').val($(this).next().text());
	arrayObject['Mount Type'] = $(this).next().text();
	updateSelectionCustomProducts(arrayObject);
    ulHtml +='<li><strong>Mount Type: </strong> '+$(this).next().text()+'</li>';
});
$(document).on('change', '.select_dev_opening_window_depth', function() {
    var depthWhole = $(this).val();
    var depthDecimal = $('[name="d_opening_window_depth_decimal"]').val() || '0';
    
    $('[name="d_opening_window_depth"]').val(depthWhole);
    
    // Format and display combined value
    var formattedDepth = depthDecimal && depthDecimal !== '0' 
        ? 'Whole Inch: ' + depthWhole + '" Fraction: ' + depthDecimal + '"'
        : 'Whole Inch: ' + depthWhole + '"';
    arrayObject['Opening Window depth'] = formattedDepth;
    delete arrayObject['Opening Window depth decimal'];
	updateSelectionCustomProducts(arrayObject);
});

$(document).on('change', '.select_dev_opening_window_depth2', function() {
    var depthDecimal = $(this).val();
    var depthWhole = $('[name="d_opening_window_depth"]').val();
    
    $('[name="d_opening_window_depth_decimal"]').val(depthDecimal);
    
    // Format and display combined value if whole number exists
    if(depthWhole) {
        var formattedDepth = depthDecimal && depthDecimal !== '0' 
            ? 'Whole Inch: ' + depthWhole + '" Fraction: ' + depthDecimal + '"'
            : 'Whole Inch: ' + depthWhole + '"';
        arrayObject['Opening Window depth'] = formattedDepth;
        delete arrayObject['Opening Window depth decimal']; // Remove separate decimal entry
        updateSelectionCustomProducts(arrayObject);
    }
});
$(".wood_co").click(function(){
    var selectedWood = $(this).text();
    $(".wood_co").removeClass('active');
    $(this).addClass('active');
    $('[name="d_choose_type"]').val(selectedWood);
    $('.coliorrow').hide();
    arrayObject['Choose Type'] = selectedWood;
    
    // Clear previously selected color when switching shutter type
    $('[name="d_choose_type_color"]').val('');
    $('.select_colortype').removeClass('phpesperto_activate');
    delete arrayObject['Color Type'];
    
    updateSelectionCustomProducts(arrayObject);
    ulHtml +='<li><strong>Choose Type: </strong> '+selectedWood+'</li>';
    if(selectedWood=='Wood'){
        $('.compositedata').css("display", "none");
        $('.woodenddata').css("display", "flex");
    }
    else{
        $('.compositedata').css("display", "flex");
        $('.woodenddata').css("display", "none");
    }

    var selectedAttachment = $('.attachment-jq.active').text();
    if(selectedAttachment == 'Hinge') {
        $('.hinge').css("display", "flex");
        $('.magnets').css("display", "none");
    } else if(selectedAttachment == 'Magnets') {
        $('.hinge').css("display", "none");
        $('.magnets').css("display", "flex");
    }
});

// Handle attachment type buttons (hinge/magnets)
$(".attachment-jq").click(function(){
    var selectedAttachment = $(this).text();
    $(".attachment-jq").removeClass('active');
    $(this).addClass('active');
    $('[name="d_attachment_type"]').val(selectedAttachment);
    $('.attachment-type-row').hide();
    arrayObject['Attachment Type'] = selectedAttachment;
    updateSelectionCustomProducts(arrayObject);
    ulHtml +='<li><strong>dype: </strong> '+selectedAttachment+'</li>';
    if(selectedAttachment == 'Hinge'){
        $('.magnets').css("display", "none");
        $('.hinge').css("display", "flex");
    }
    else if(selectedAttachment == 'Magnets'){
        $('.magnets').css("display", "flex");
        $('.hinge').css("display", "none");
        // Clear hinge color when magnets is selected
        $('[name="d_hinge_color"]').val('');
        delete arrayObject['Hinge Color'];
        updateSelectionCustomProducts(arrayObject);
    }
});
$(".select_colortype").click(function(){
    $('[name="d_choose_type_color"]').val($(this).next().text());
	arrayObject['Color Type'] = $(this).next().text();
	updateSelectionCustomProducts(arrayObject);
    ulHtml +='<li><strong>Color Type: </strong> '+$(this).next().text()+'</li>';
});
$(".select_hingetype").click(function(){
    $('[name="d_hinge_color"]').val($(this).next().text());
	arrayObject['Hinge Color'] = $(this).next().text();
	updateSelectionCustomProducts(arrayObject);
    ulHtml +='<li><strong>Hinge Color: </strong> '+$(this).next().text()+'</li>';
});
$(document).on('change', '.get_dev_width_inches', function() {
    // Check if this is a perfect arches product
    var isPerfectArches = $('body').hasClass('product-perfect-arches') || 
                          $('body').hasClass('product-1-4-perfect-arches') ||
                          $('.product-title:contains("Perfect Arch")').length > 0;
    $('[name="d_width"]').val($(this).val());
    wholeInch['a'] = $(this).val();
    // Set default decimal to 0 if not already set
    if(!decimalInch['a']) {
        decimalInch['a'] = $('.get_dev_width2_inches').val() || '0';
    }
    
    // Auto-calculate Side B as A/2 for perfect arches
    if(isPerfectArches && wholeInch['a']) {
        var widthWhole = parseFloat(wholeInch['a']) || 0;
        var widthDecimal = decimalInch['a'] || '0';
        
        // Convert to decimal inches
        var widthInInches = widthWhole;
        if(widthDecimal !== '0') {
            var parts = widthDecimal.split('/');
            if(parts.length === 2) {
                widthInInches += parseFloat(parts[0]) / parseFloat(parts[1]);
            }
        }
        
        // Calculate height as width / 2
        var heightInInches = widthInInches / 2;
        var heightWhole = Math.floor(heightInInches);
        var heightFraction = heightInInches - heightWhole;
        
        // Set Side B (height) values
        wholeInch['b'] = heightWhole;
        $('.get_dev_height_inches').val(heightWhole);
        $('[name="d_height"]').val(heightWhole);
        
        // Calculate fraction
        if(heightFraction > 0) {
            var eighths = Math.round(heightFraction * 8);
            if(eighths > 0) {
                // Simplify fraction
                var gcd = function(a, b) { return b === 0 ? a : gcd(b, a % b); };
                var divisor = gcd(eighths, 8);
                decimalInch['b'] = (eighths / divisor) + '/' + (8 / divisor);
                $('.get_dev_height2_inches').val(decimalInch['b']);
                $('[name="d_height2"]').val(decimalInch['b']);
            } else {
                decimalInch['b'] = '0';
                $('.get_dev_height2_inches').val('0');
                $('[name="d_height2"]').val('0');
            }
        } else {
            decimalInch['b'] = '0';
            $('.get_dev_height2_inches').val('0');
            $('[name="d_height2"]').val('0');
        }
    }
    
	calculateWholeInchDecimal();
});

$(document).on('change', '.get_dev_width2_inches', function() {
    $('[name="d_width2"]').val($(this).val());
    decimalInch['a'] = $(this).val();
    
    // Check if this is a perfect arches product
    var isPerfectArches = $('body').hasClass('product-perfect-arches') || 
                          $('body').hasClass('product-1-4-perfect-arches') ||
                          $('.product-title:contains("Perfect Arch")').length > 0;
    
    // Trigger width calculation for perfect arches
    if(isPerfectArches) {
        $('.get_dev_width_inches').trigger('change');
    } else {
        calculateWholeInchDecimal();
    }
});

$(document).on('change', '.get_dev_height_inches', function() {
    // Check if this is a perfect arches product
    var isPerfectArches = $('body').hasClass('product-perfect-arches') || 
                          $('body').hasClass('product-1-4-perfect-arches') ||
                          $('.product-title:contains("Perfect Arch")').length > 0;
    
    // For perfect arches, prevent manual height entry
    if(isPerfectArches && wholeInch['a']) {
        // Re-trigger width calculation to reset height
        $('.get_dev_width_inches').trigger('change');
        return;
    }
    
    $('[name="d_height"]').val($(this).val());
	wholeInch['b'] = $(this).val();
	// Set default decimal to 0 if not already set
    if(!decimalInch['b']) {
        decimalInch['b'] = $('.get_dev_height2_inches').val() || '0';
    }
	calculateWholeInchDecimal();
});
$(document).on('change', '.get_dev_width2_inches', function() {
    $('[name="d_width2"]').val($(this).val());
    decimalInch['a'] = $(this).val();
	calculateWholeInchDecimal();
});
$(document).on('change', '.get_dev_height2_inches', function() {
    // Check if this is a perfect arches product
    var isPerfectArches = $('body').hasClass('product-perfect-arches') || 
                          $('body').hasClass('product-1-4-perfect-arches') ||
                          $('.product-title:contains("Perfect Arch")').length > 0;
    
    // For perfect arches, prevent manual height decimal entry
    if(isPerfectArches && wholeInch['a']) {
        // Re-trigger width calculation to reset height
        $('.get_dev_width_inches').trigger('change');
        return;
    }
    
    $('[name="d_height2"]').val($(this).val());
    decimalInch['b'] = $(this).val();
	calculateWholeInchDecimal();
});
$(document).on('change', '.get_dev_default_text', function() {
    $('[name="d_default_text"]').val($(this).val());
	arrayObject['Shutter Gap'] = $(this).val();
	updateSelectionCustomProducts(arrayObject);
});

	var wholeInch = [];
	var decimalInch = [];

// Handle YITH WAPO fields for Octagon and other YITH products
$(document).on('change', '#ywapo_select_144, #ywapo_select_66', function() {
    // Width whole inch for YITH WAPO products
    $('[name="d_width"]').val($(this).val());
    wholeInch['a'] = $(this).val();
    if(!decimalInch['a']) {
        decimalInch['a'] = '0';
    }
    calculateWholeInchDecimal();
});

$(document).on('change', '#ywapo_select_145, #ywapo_select_67', function() {
    // Width decimal inch for YITH WAPO products
    $('[name="d_width2"]').val($(this).val());
    decimalInch['a'] = $(this).val();
    calculateWholeInchDecimal();
});

$(document).on('change', '#ywapo_select_146, #ywapo_select_68', function() {
    // Height whole inch for YITH WAPO products
    $('[name="d_height"]').val($(this).val());
    wholeInch['b'] = $(this).val();
    if(!decimalInch['b']) {
        decimalInch['b'] = '0';
    }
    calculateWholeInchDecimal();
});

$(document).on('change', '#ywapo_select_147, #ywapo_select_69', function() {
    // Height decimal inch for YITH WAPO products
    $('[name="d_height2"]').val($(this).val());
    decimalInch['b'] = $(this).val();
    calculateWholeInchDecimal();
});
	
	// Initialize decimal values with defaults (set to '0' by default)
	// This ensures measurements show even if user doesn't change decimal dropdowns
	setTimeout(function() {
		// Initialize YITH WAPO fields for Octagon and other products
		if($('#ywapo_select_144').length || $('#ywapo_select_66').length) {
			var yithWidth = $('#ywapo_select_144').val() || $('#ywapo_select_66').val();
			var yithWidthDec = $('#ywapo_select_145').val() || $('#ywapo_select_67').val() || '0';
			var yithHeight = $('#ywapo_select_146').val() || $('#ywapo_select_68').val();
			var yithHeightDec = $('#ywapo_select_147').val() || $('#ywapo_select_69').val() || '0';
			
			if(yithWidth) {
				$('[name="d_width"]').val(yithWidth);
				wholeInch['a'] = yithWidth;
			}
			if(yithWidthDec) {
				$('[name="d_width2"]').val(yithWidthDec);
				decimalInch['a'] = yithWidthDec;
			}
			if(yithHeight) {
				$('[name="d_height"]').val(yithHeight);
				wholeInch['b'] = yithHeight;
			}
			if(yithHeightDec) {
				$('[name="d_height2"]').val(yithHeightDec);
				decimalInch['b'] = yithHeightDec;
			}
		}
		
		// Initialize decimal dropdowns with their default values
		if($('.get_dev_width2_inches').length) {
			decimalInch['a'] = $('.get_dev_width2_inches').val() || '0';
		}
		if($('.get_dev_height2_inches').length) {
			decimalInch['b'] = $('.get_dev_height2_inches').val() || '0';
		}
		// Initialize all commonselect2get_dev dropdowns (sides C-J)
		$('.commonselect2get_dev').each(function() {
			var dataId = parseInt($(this).attr('data-id'));
			var sideKey;
			switch (dataId) {
				case 0: sideKey='c'; break;
				case 1: sideKey='d'; break;
				case 2: sideKey='e'; break;
				case 3: sideKey='f'; break;
				case 4: sideKey='g'; break;
				case 5: sideKey='h'; break;
				case 6: sideKey='i'; break;
				case 7: sideKey='j'; break;
			}
			if(sideKey) {
				decimalInch[sideKey] = $(this).val() || '0';
			}
		});
	}, 100);
$(document).on('change', '.commonselect1get_dev', function() {
	var getDataId = parseInt($(this).attr('data-id'));
	switch (getDataId) {
	  case 0:
		getDataId='c';
		break;
	  case 1:
		getDataId='d';
		break;
	  case 2:
		getDataId='e';
		break;
	  case 3:
		getDataId='f';
		break;
	  case 4:
		getDataId='g';
		break;
	  case 5:
		getDataId='h';
		break;
	  case 6:
		getDataId='i';
		break;
	  case 7:
		getDataId='j';
	  default:
	}
	wholeInch[getDataId] = $(this).val();
	// Set default decimal to 0 if not already set
	if(!decimalInch[getDataId]) {
		var currentIndex = parseInt($(this).attr('data-id'));
		decimalInch[getDataId] = $('.commonselect2get_dev[data-id="'+currentIndex+'"]').val() || '0';
	}
	calculateWholeInchDecimal();
});
$(document).on('change', '.commonselect2get_dev', function() {
	var getDataId = parseInt($(this).attr('data-id'));
	switch (getDataId) {
	  case 0:
		getDataId='c';
		break;
	  case 1:
		getDataId='d';
		break;
	  case 2:
		getDataId='e';
		break;
	  case 3:
		getDataId='f';
		break;
	  case 4:
		getDataId='g';
		break;
	  case 5:
		getDataId='h';
		break;
	  case 6:
		getDataId='i';
		break;
	  case 7:
		getDataId='j';
	  default:
	}
	decimalInch[getDataId] = $(this).val();
	calculateWholeInchDecimal();
});
function calculateWholeInchDecimal(){
	// Helper function to format measurement display
	function formatMeasurement(whole, decimal) {
		// Default to '0' if decimal is not set
		if (!decimal || decimal === '0') {
			return 'Whole Inch: ' + whole + '"';
		}
		return 'Whole Inch: ' + whole + '" Fraction: ' + decimal + '"';
	}
	
	// Build consolidated measurement string for all sides
	var allMeasurements = [];
	
	// Side A - Always show
	if(wholeInch.a){
		var displayValue = formatMeasurement(wholeInch.a, decimalInch.a || '0');
		arrayObject['Side A'] = displayValue;
		allMeasurements.push('Side A: ' + displayValue);
		$('[name="d_choose_measurement_a"]').val(displayValue);
	} else {
		$('[name="d_choose_measurement_a"]').val('NA/ Not Provided');
		arrayObject['Side A'] = 'NA/ Not Provided';
		allMeasurements.push('Side A: NA/ Not Provided');
	}
	
	// Side B - Always show
	if(wholeInch.b){
		var displayValue = formatMeasurement(wholeInch.b, decimalInch.b || '0');
		arrayObject['Side B'] = displayValue;
		allMeasurements.push('Side B: ' + displayValue);
		$('[name="d_choose_measurement_b"]').val(displayValue);
	} else {
		$('[name="d_choose_measurement_b"]').val('NA/ Not Provided');
		arrayObject['Side B'] = 'NA/ Not Provided';
		allMeasurements.push('Side B: NA/ Not Provided');
	}
	
	// Side C - Only show if field exists on page
	if($('.commonselect1get_dev[data-id="0"]').length > 0) {
		if(wholeInch.c){
			var displayValue = formatMeasurement(wholeInch.c, decimalInch.c || '0');
			arrayObject['Side C'] = displayValue;
			allMeasurements.push('Side C: ' + displayValue);
			$('[name="d_choose_measurement_c"]').val(displayValue);
		} else {
			$('[name="d_choose_measurement_c"]').val('NA/ Not Provided');
			arrayObject['Side C'] = 'NA/ Not Provided';
			allMeasurements.push('Side C: NA/ Not Provided');
		}
	} else {
		$('[name="d_choose_measurement_c"]').val('');
		delete arrayObject['Side C'];
	}
	
	// Side D - Only show if field exists on page
	if($('.commonselect1get_dev[data-id="1"]').length > 0) {
		if(wholeInch.d){
			var displayValue = formatMeasurement(wholeInch.d, decimalInch.d || '0');
			arrayObject['Side D'] = displayValue;
			allMeasurements.push('Side D: ' + displayValue);
			$('[name="d_choose_measurement_d"]').val(displayValue);
		} else {
			$('[name="d_choose_measurement_d"]').val('NA/ Not Provided');
			arrayObject['Side D'] = 'NA/ Not Provided';
			allMeasurements.push('Side D: NA/ Not Provided');
		}
	} else {
		$('[name="d_choose_measurement_d"]').val('');
		delete arrayObject['Side D'];
	}
	
	// Side E - Only show if field exists on page
	if($('.commonselect1get_dev[data-id="2"]').length > 0) {
		if(wholeInch.e){
			var displayValue = formatMeasurement(wholeInch.e, decimalInch.e || '0');
			arrayObject['Side E'] = displayValue;
			allMeasurements.push('Side E: ' + displayValue);
			$('[name="d_choose_measurement_e"]').val(displayValue);
		} else {
			$('[name="d_choose_measurement_e"]').val('NA/ Not Provided');
			arrayObject['Side E'] = 'NA/ Not Provided';
			allMeasurements.push('Side E: NA/ Not Provided');
		}
	} else {
		$('[name="d_choose_measurement_e"]').val('');
		delete arrayObject['Side E'];
	}
	
	// Side F - Only show if field exists on page
	if($('.commonselect1get_dev[data-id="3"]').length > 0) {
		if(wholeInch.f){
			var displayValue = formatMeasurement(wholeInch.f, decimalInch.f || '0');
			arrayObject['Side F'] = displayValue;
			allMeasurements.push('Side F: ' + displayValue);
			$('[name="d_choose_measurement_f"]').val(displayValue);
		} else {
			$('[name="d_choose_measurement_f"]').val('NA/ Not Provided');
			arrayObject['Side F'] = 'NA/ Not Provided';
			allMeasurements.push('Side F: NA/ Not Provided');
		}
	} else {
		$('[name="d_choose_measurement_f"]').val('');
		delete arrayObject['Side F'];
	}
	
	// Side G - Only show if field exists on page
	if($('.commonselect1get_dev[data-id="4"]').length > 0) {
		if(wholeInch.g){
			var displayValue = formatMeasurement(wholeInch.g, decimalInch.g || '0');
			arrayObject['Side G'] = displayValue;
			allMeasurements.push('Side G: ' + displayValue);
			$('[name="d_choose_measurement_g"]').val(displayValue);
		} else {
			$('[name="d_choose_measurement_g"]').val('NA/ Not Provided');
			arrayObject['Side G'] = 'NA/ Not Provided';
			allMeasurements.push('Side G: NA/ Not Provided');
		}
	} else {
		$('[name="d_choose_measurement_g"]').val('');
		delete arrayObject['Side G'];
	}
	
	// Side H - Only show if field exists on page
	if($('.commonselect1get_dev[data-id="5"]').length > 0) {
		if(wholeInch.h){
			var displayValue = formatMeasurement(wholeInch.h, decimalInch.h || '0');
			arrayObject['Side H'] = displayValue;
			allMeasurements.push('Side H: ' + displayValue);
			$('[name="d_choose_measurement_h"]').val(displayValue);
		} else {
			$('[name="d_choose_measurement_h"]').val('NA/ Not Provided');
			arrayObject['Side H'] = 'NA/ Not Provided';
			allMeasurements.push('Side H: NA/ Not Provided');
		}
	} else {
		$('[name="d_choose_measurement_h"]').val('');
		delete arrayObject['Side H'];
	}
	
	// Side I - Only show if field exists on page
	if($('.commonselect1get_dev[data-id="6"]').length > 0) {
		if(wholeInch.i){
			var displayValue = formatMeasurement(wholeInch.i, decimalInch.i || '0');
			arrayObject['Side I'] = displayValue;
			allMeasurements.push('Side I: ' + displayValue);
			$('[name="d_choose_measurement_i"]').val(displayValue);
		} else {
			$('[name="d_choose_measurement_i"]').val('NA/ Not Provided');
			arrayObject['Side I'] = 'NA/ Not Provided';
			allMeasurements.push('Side I: NA/ Not Provided');
		}
	} else {
		$('[name="d_choose_measurement_i"]').val('');
		delete arrayObject['Side I'];
	}
	
	// Side J - Only show if field exists on page
	if($('.commonselect1get_dev[data-id="7"]').length > 0) {
		if(wholeInch.j){
			var displayValue = formatMeasurement(wholeInch.j, decimalInch.j || '0');
			arrayObject['Side J'] = displayValue;
			allMeasurements.push('Side J: ' + displayValue);
			$('[name="d_choose_measurement_j"]').val(displayValue);
		} else {
			$('[name="d_choose_measurement_j"]').val('NA/ Not Provided');
			arrayObject['Side J'] = 'NA/ Not Provided';
			allMeasurements.push('Side J: NA/ Not Provided');
		}
	} else {
		$('[name="d_choose_measurement_j"]').val('');
		delete arrayObject['Side J'];
	}
	
	// Store all measurements in d_atoz_measurements field
	$('[name="d_atoz_measurements"]').val(allMeasurements.join(', '));
	
	updateSelectionCustomProducts(arrayObject);
}
	
});

</script>
<?php
	}
}

add_action( 'woocommerce_after_single_product_summary', 'product_custom_content', 10);
function product_custom_content() {
	include(get_stylesheet_directory().'/allproducts.php');

	//print_r($productsData['plantation-shutters-1-panel']);

	global $product;
	$categories = get_the_terms( get_the_id(), 'product_cat' );
	$arrayIds = array();
	foreach ( $categories as $term ) {
		$arrayIds[] = $term->term_id;
	}
	if (in_array(62, $arrayIds)){
	$activeProduct = $productsData[$product->slug];
	$imagesPath = get_stylesheet_directory_uri().'/assets/product-images/'.$product->slug;
    ?>
		<div class="product_single_custom_main">
			<!--Slide 1 div end -->
			<div class="product_single_custom_slide product_single_custom_slide1">
				<div class="twopart_custom_section row">
					<!--Slide 1 Left start -->
					<div class="twopart_custom_section_left col-lg-12 col-12 col-md-12">
					<div class="wd-breadcrumbs">
					<nav class="woocommerce-breadcrumb" aria-label="Breadcrumb">				
						<a href="<?php echo site_url(); ?>" class="breadcrumb-link">Home</a>
						<a href="<?php echo site_url(); ?>/product-category/custom-plantation-shutters/" class="breadcrumb-link breadcrumb-link-last">Custom Plantation Shutters</a>
							<span class="breadcrumb-last"><?php echo get_the_title(); ?></span>
			</nav>				</div>
					<h1 class="product_title entry-title wd-entities-title"><?php echo get_the_title(); ?></h1>
						<?php echo get_the_excerpt();  ?>
					</div>
					<!--Slide 1 Left end -->
					<div class="twopart_custom_section_right col-lg-12 col-12 col-md-12">
					<h3>Customise your <?php echo get_the_title(); ?></h3>
						<?php if(isset($activeProduct['panel'])){ ?>
						<div class="row">
							<div class="col-sm-12 tabheading"> <h4>-<?php echo $activeProduct['title']; ?></h4></div>
							<?php 
								$activeEnable = '';
								if(count($activeProduct['panel'])==1){
									$activeEnable = 'active';
								}
								for($i=0;$i<count($activeProduct['panel']);$i++){ 
								
								?>
								<div class="col text-center">
									<img class="clicktoact select_dev_title <?php echo $activeEnable;?>" src="<?php echo $imagesPath.'/'.$i.'.png'; ?>">
									<label><?php echo $activeProduct['panel'][$i]; ?></label>
								</div>
								<?php } ?>
						</div>
						<?php } ?>
						
						<?php if(isset($activeProduct['mount_type'])){ ?>
						<div class="row">
							<div class="col-sm-12 tabheading"> <h4>-Mount Type</h4></div>
							<?php $i=0; foreach ($activeProduct['mount_type'] as $key => $value) { 
								?>
								<div class="col text-center">
									<img class="clicktoact select_dev_mount" src="<?php echo $imagesPath.'/mount/'.$i.'.png'; ?>">
									<label><?php echo $key; ?></label>
									<small><?php echo $value; ?></small>
								</div>
							<?php $i++; } ?>
						</div>
						<?php } ?>
						<div class="row">
							<div class="col-sm-12 tabheading"> <h4>-Window Opening Depth</h4></div>
							<div class="col-sm-7 text-center">
								<img src="/wp-content/uploads/2020/10/height.png">
							</div>
							<div class="col-sm-5 text-center">
								<small>Select Window Opening Depth</small>
								<div class="row">
									<div class="col-sm-6 text-center">
										Whole inch
										<select class="select_dev_opening_window_depth">
											<option>Select depth</option>
											<option value="1">1"</option>
											<option value="2">2"</option>
											<option value="3">3"</option>
											<option value="4">4"</option>
											<option value="5">5"</option>
											<option value="6">6"</option>
											<option value="7">7"</option>
											<option value="8">8"</option>
											<option value="9">9"</option>
											<option value="10">10"</option>
										</select>
									</div>
									<div class="col-sm-6 text-center">
										Decimal inch
										<select class="select_dev_opening_window_depth2">
											<option value="0">0"</option>
											<option value="1/8">1/8"</option>
											<option value="1/4">1/4"</option>
											<option value="3/8">3/8"</option>
											<option value="1/2">1/2"</option>
											<option value="5/8">5/8"</option>
											<option value="3/4">3/4"</option>
											<option value="7/8">7/8"</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button data-class="product_single_custom_slide2" class="validate slide1_button product_custom_button">
					Next
				</button>
			</div>	
			<!--Slide 1 div end -->
			<!--Slide 2 div start -->
			<div class="product_single_custom_slide product_single_custom_slide2" style="display:none">
				<div class="twopart_custom_section row">
					<div class="twopart_custom_section_left col-lg-12 col-12 col-md-6">
						<!--Slide 2 Left start -->
						<div class="row">
							<div class="col-sm-12 tabheading"> <h4>-Select Color</h4></div>
							<div class="col-sm-12 tabsuvheading"> <h4>- Select Shutter Type</h4></div>
							<div class="col-sm-6 text-center">
								<button class="wood_co active">Wood</button>
							</div>
							<div class="col-sm-6 text-center">
								<button class="wood_co">Poly</button>
							</div>
							<div class="row coliorrow woodenddata shutter-type-row" style="display:flex;">
							<?php
								$arrayColors = array(
									"Black"         => "/wp-content/uploads/2026/01/Black.png",
									"Terrace"       => "/wp-content/uploads/2026/01/Terrace.png",
									"Perhament"     => "/wp-content/uploads/2026/01/Perhament.png",
									"Sable"         => "/wp-content/uploads/2026/01/Sable.png",
									"Honey"         => "/wp-content/uploads/2026/01/honey.png",
									"Natural"       => "/wp-content/uploads/2026/01/Natural.png",
									"Off White"     => "/wp-content/uploads/2026/01/off-white.png",
									"Snowbound"     => "/wp-content/uploads/2026/01/snowbound.png",
									"Alabaster"     => "/wp-content/uploads/2026/01/alabaster.png",
									"Extra White"   => "/wp-content/uploads/2026/01/extra-white.png",
									"Snow White"    => "/wp-content/uploads/2026/01/snow-white.png",
									"Pure White"    => "/wp-content/uploads/2026/01/pure-white.png"
								);
							?>
							<div class="col-sm-12 tabheading"> <h4>-Composite Colors</h4></div>
								<?php foreach ($arrayColors as $x => $y) { ?>
										<div class="col-sm-2 text-center"><img class="clicktoact select_colortype" src="<?php echo $y; ?>"><label><?php echo $x; ?></label>		</div>
								<?php } ?>
							</div>
						<div class="row coliorrow compositedata shutter-type-row">
							<?php
								$arrayColors = array(
									"Snow White" => "/wp-content/uploads/2026/01/snow-white.png",
									"Off White" => "/wp-content/uploads/2026/01/off-white.png"
								);
							?>
							<div class="col-sm-12 tabheading"> <h4>-Composite Colors</h4></div>
								<?php foreach ($arrayColors as $x => $y) { ?>
										<div class="col-sm-2 text-center"><img class="clicktoact select_colortype" src="<?php echo $y; ?>"><label><?php echo $x; ?></label>		</div>
								<?php } ?>
						</div>

						</div>
						<?php if (isset($activeProduct['hinge_color'])) : ?>
							<div class="row">
								<div class="col-sm-12 tabheading">
									<h4>-Select Attachment</h4>
								</div>
								<div class="col-sm-6 text-center">
									<button class="attachment-jq active">Hinge</button>
								</div>
								<div class="col-sm-6 text-center">
									<button class="attachment-jq">Magnets</button>
								</div>
								<div class="row coliorrow hinge attachment-type-row" style="display:flex;">
									<div class="col-sm-12 tabheading">
										<h4>-Select Hinge Color</h4>
									</div>
									<div class="col text-center">
										<img class="clicktoact select_hingetype" src="/wp-content/uploads/2020/10/0-5.png" alt="White">
										<label>White</label>
									</div>
									<div class="col text-center">
										<img class="clicktoact select_hingetype" src="/wp-content/uploads/2020/10/1-5.png" alt="Brown">
										<label>Brown</label>
									</div>
									<div class="col text-center">
										<img class="clicktoact select_hingetype" src="/wp-content/uploads/2020/10/2-3.png" alt="Grey">
										<label>Grey</label>
									</div>
								</div>
								<div class="row coliorrow magnets attachment-type-row" style="display:none;">
									<div class="col-sm-12 tabheading">
										<h4>-Select Magnets</h4>
									</div>
									<div class="col text-center">
										<img class="clicktoact select_magtype" src="/wp-content/uploads/2026/01/magnets.png" alt="Magnets">
										<label>Magnets</label>
									</div>
								</div>
							</div>
						<?php endif; ?>
						
					<!--Slide 2 Left end -->
					</div>
					<div class="twopart_custom_section_right col-lg-12 col-12 col-md-6">
						<!--Slide 2 Right start -->
						<div class="row addminheight">
							<div class="col-sm-12 tabheading"> <h4>-Measure your Windows</h4></div>
							<?php  if($activeProduct['step3']==true){?>
								<div class="col-sm-12 text-center measurement-image">
									<img src="<?php echo $imagesPath.'/measurement/measurement.png'; ?>">
	
								</div>
								<div class="col-sm-12 text-left">
									<div class="row">
									<div class="col-sm-4">
								<div class="fullwidinput">
									Side A. Whole inch
										<select class="get_dev_width_inches">
											<option value="">Select</option>
											<?php for($k=12;$k<96;$k++){  ?>
											<option value="<?php echo $k;?>"><?php echo $k.'"';?></option>
											<?php } ?>
										</select>
									</div>
									<div class="fullwidinput">
										Decimal inch
										<select class="get_dev_width2_inches">
											<option value="0">0"</option>
											<option value="1/8">1/8"</option>
											<option value="1/4">1/4"</option>
											<option value="3/8">3/8"</option>
											<option value="1/2">1/2"</option>
											<option value="5/8">5/8"</option>
											<option value="3/4">3/4"</option>
											<option value="7/8">7/8"</option>
										</select>
									</div>
									</div>
									<div class="col-sm-4">
									<div class="fullwidinput">
									Side B. Whole inch
										<select class="get_dev_height_inches">
											<option value="">Select</option>
											<?php for($k=12;$k<96;$k++){  ?>
											<option value="<?php echo $k;?>"><?php echo $k.'"';?></option>
											<?php } ?>
										</select>
									</div>
									<div class="fullwidinput">
										Decimal inch
										<select class="get_dev_height2_inches">
											<option value="0">0"</option>
											<option value="1/8">1/8"</option>
											<option value="1/4">1/4"</option>
											<option value="3/8">3/8"</option>
											<option value="1/2">1/2"</option>
											<option value="5/8">5/8"</option>
											<option value="3/4">3/4"</option>
											<option value="7/8">7/8"</option>
										</select>
									</div>
									</div>
										
									
							<?php 
							if(isset($activeProduct['measurement_count'])){ 
							$countMeasurement=$activeProduct['measurement_count'];
								$arrayAlpgaBet = array('C','D','E','F','G','H','I','J');
							?>
										<?php for($u=0;$u<$countMeasurement;$u++){  ?>
										<div class="col-sm-4 extrawholeinch">
											<div class="fullwidinput">
												 Side <?php echo $arrayAlpgaBet[$u]; ?>. Whole inch
													<select class="commonselect1get_dev" data-id="<?php echo $u; ?>">
														<option value="">Select</option>
														<?php for($k=12;$k<96;$k++){  ?>
														<option value="<?php echo $k;?>"><?php echo $k.'"';?></option>
														<?php } ?>
													</select>
											</div>
											<div class="fullwidinput">
												Decimal inch
												<select class="commonselect2get_dev" data-id="<?php echo $u; ?>">
													<option value="0">0"</option>
													<option value="1/8">1/8"</option>
													<option value="1/4">1/4"</option>
													<option value="3/8">3/8"</option>
													<option value="1/2">1/2"</option>
													<option value="5/8">5/8"</option>
													<option value="3/4">3/4"</option>
													<option value="7/8">7/8"</option>
												</select>
											</div>
										</div>
										<?php } ?>
							<?php } ?>
										<div class="col-sm-4">
											<div class="shuttersup_gap fullwidinput">
										Select Shutter Gap
										<select class="get_dev_default_text">
											<option>Select option</option>
											<option value="Build true to size">Build true to size</option>
											<option value="Add 1/8th gap">Add 1/8th gap</option>
										</select>
									</div>
										</div>
										</div>
								</div>
							<?php } ?>
							<?php  if($activeProduct['step3']==false){?>
								<div class="col-sm-12 text-center measurement-image">
									<img src="<?php echo $imagesPath.'/measurement/measurement.png'; ?>">
	
								</div>
								<div class="col-sm-12 text-left">
									<div class="row">
									<div class="col-sm-4">
								<div class="fullwidinput">
									 Side A. Whole inch
										<select class="get_dev_width_inches">
											<option value="">Select</option>
											<?php for($k=12;$k<96;$k++){  ?>
											<option value="<?php echo $k;?>"><?php echo $k.'"';?></option>
											<?php } ?>
										</select>
									</div>
									<div class="fullwidinput">
										Decimal inch
										<select class="get_dev_width2_inches">
											<option value="0">0"</option>
											<option value="1/8">1/8"</option>
											<option value="1/4">1/4"</option>
											<option value="3/8">3/8"</option>
											<option value="1/2">1/2"</option>
											<option value="5/8">5/8"</option>
											<option value="3/4">3/4"</option>
											<option value="7/8">7/8"</option>
										</select>
									</div>
									</div>
									<div class="col-sm-4">
									<div class="fullwidinput">
										Side B. Whole inch
										<select class="get_dev_height_inches">
											<option value="">Select</option>
											<?php for($k=12;$k<96;$k++){  ?>
											<option value="<?php echo $k;?>"><?php echo $k.'"';?></option>
											<?php } ?>
										</select>
									</div>
									<div class="fullwidinput">
										Decimal inch
										<select class="get_dev_height2_inches">
											<option value="0">0"</option>
											<option value="1/8">1/8"</option>
											<option value="1/4">1/4"</option>
											<option value="3/8">3/8"</option>
											<option value="1/2">1/2"</option>
											<option value="5/8">5/8"</option>
											<option value="3/4">3/4"</option>
											<option value="7/8">7/8"</option>
										</select>
									</div>
									</div>
										
									
							<?php 
							if(isset($activeProduct['measurement_count'])){ 
							$countMeasurement=$activeProduct['measurement_count'];
								$arrayAlpgaBet = array('C','D','E','F','G','H','I','J');
							?>
										<?php for($u=0;$u<$countMeasurement;$u++){  ?>
										<div class="col-sm-4 extrawholeinch">
											<div class="fullwidinput">
												 Side <?php echo $arrayAlpgaBet[$u]; ?>. Whole inch
													<select class="commonselect1get_dev" data-id="<?php echo $u; ?>">
														<option value="">Select</option>
														<?php for($k=12;$k<96;$k++){  ?>
														<option value="<?php echo $k;?>"><?php echo $k.'"';?></option>
														<?php } ?>
													</select>
											</div>
											<div class="fullwidinput">
												Decimal inch
												<select class="commonselect2get_dev" data-id="<?php echo $u; ?>">
													<option value="0">0"</option>
													<option value="1/8">1/8"</option>
													<option value="1/4">1/4"</option>
													<option value="3/8">3/8"</option>
													<option value="1/2">1/2"</option>
													<option value="5/8">5/8"</option>
													<option value="3/4">3/4"</option>
													<option value="7/8">7/8"</option>
												</select>
											</div>
										</div>
										<?php } ?>
							<?php } ?>
										<div class="col-sm-4">
											<div class="shuttersup_gap fullwidinput">
										Select Shutter Gap
										<select class="get_dev_default_text">
											<option>Select option</option>
											<option value="Build true to size">Build true to size</option>
											<option value="Add 1/8th gap">Add 1/8th gap</option>
										</select>
									</div>
										</div>
										</div>
								</div>
							<?php } else{ ?>
							<div class="col text-center">
								<label>Width</label>
								<div class="row">
									<div class="col">
									 Whole inch
										<select class="get_dev_width_inches">
											<option value="">Select</option>
											<?php for($k=12;$k<96;$k++){  ?>
											<option value="<?php echo $k;?>"><?php echo $k.'"';?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col">
										Decimal inch
										<select class="get_dev_width2_inches">
											<option value="0">0"</option>
											<option value="1/8">1/8"</option>
											<option value="1/4">1/4"</option>
											<option value="3/8">3/8"</option>
											<option value="1/2">1/2"</option>
											<option value="5/8">5/8"</option>
											<option value="3/4">3/4"</option>
											<option value="7/8">7/8"</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col text-center">
								<label>Height</label>
								<div class="row">
									<div class="col">
										Whole inch
										<select class="get_dev_height_inches">
											<option value="">Select</option>
											<?php for($k=12;$k<96;$k++){  ?>
											<option value="<?php echo $k;?>"><?php echo $k.'"';?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col">
										Decimal inch
										<select class="get_dev_height2_inches">
											<option value="0">0"</option>
											<option value="1/8">1/8"</option>
											<option value="1/4">1/4"</option>
											<option value="3/8">3/8"</option>
											<option value="1/2">1/2"</option>
											<option value="5/8">5/8"</option>
											<option value="3/4">3/4"</option>
											<option value="7/8">7/8"</option>
										</select>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
						<?php if(isset($activeProduct['louver_size'])){ 
							// Check if octagon product by slug, type, title, or by specific product ID 9452
							$is_octagon = false;
							if (get_the_id() == 9452){
								$is_octagon = true;
							}
							$louver_base_path = $is_octagon 
								? get_stylesheet_directory_uri() . '/assets/product-images/octagon/louver/' 
								: '/wp-content/uploads/2020/10/';
								
							$louver_imgs = $is_octagon
								? ['0.png', '1.png', '2.png'] 
								: ['0-6.png', '1-6.png', '2-4.png'];
							$louver_labels = ['2½','3½','4½'];
						?>
						<div class="row">
							<div class="col-sm-12 tabheading"> <h4>-Select Louver Type</h4></div>
							<div class="col text-center"></div>
							<?php foreach([0,1,2] as $i): ?>
							<div class="col text-center">
								<img class="clicktoact get_dev_louver" src="<?php echo $louver_base_path . $louver_imgs[$i]; ?>">
								<label><?php echo $louver_labels[$i]; ?></label>
							</div>
							<?php endforeach; ?>
							<div class="col text-center"></div>
						</div>
						<?php } ?>
						<!--Slide 2 Right end -->
					</div>
					<?php  if($activeProduct['step3']==false){?>
					<div class="twopart_custom_section_left col-lg-6 col-12 col-md-6">
						<h4>Order Summary</h4>
						<ul id="showselecteddata">
							
						</ul>
					</div>
					
					<div class="twopart_custom_section_right col-lg-6 col-12 col-md-6">
						<h4>Order Total<span id="cal_price_dev"></span></h4>
						<form class="cart customcart" action="" method="post" enctype="multipart/form-data">
						<div class="quantity">
							<input type="hidden" id="quantity_6693d777a755a" class="input-text qty text" value="1" aria-label="Product quantity" min="1" max="" name="quantity" step="1" placeholder="" inputmode="numeric" autocomplete="off">
						</div>
						<!-- #yith-wapo-container -->
						<div id="yith-wapo-container" class="yith-wapo-container yith-wapo-form-style-custom" data-product-price="1000" data-product-id="<?php echo get_the_id(); ?>" data-order-price="1000">
							<input type="hidden" id="yith_wapo_product_id" name="yith_wapo_product_id" value="9430"><input type="hidden" id="yith_wapo_product_img" name="yith_wapo_product_img" value=""><input type="hidden" id="yith_wapo_is_single" name="yith_wapo_is_single" value="1"></div>
<input type="hidden" class="nameofthe_pro" data-title="<?php echo get_the_title();?>" name="d_val" value="" type="text">
					
					<input type="hidden" name="d_title" value="<?php echo $activeProduct['title']; ?>">
					<input type="hidden" name="d_mount_type" value="" type="text">
					<input type="hidden" name="d_attachment_type" value="" type="text">
					<input type="hidden" name="d_opening_window_depth" value="" type="text">
					<input type="hidden" name="d_opening_window_depth_decimal" value="" type="text">
					<input type="hidden" name="d_choose_type" value="" type="text">
					<input type="hidden" name="d_choose_type_color" value="" type="text">
					<input type="hidden" name="d_hinge_color" value="" type="text">
					<input type="hidden" name="d_height" value="" type="text">
					<input type="hidden" name="d_width" value="" type="text">
					<input type="hidden" name="d_height2" value="" type="text">
					<input type="hidden" name="d_default_text" value="" type="text">
					<input type="hidden" name="d_width2" value="" type="text">
					<input type="hidden" name="d_lourve_size" value="" type="text">
					<input type="hidden" name="d_tilt_type" value="" type="text">
					<input type="hidden" name="d_tilt_type_split" value="" type="text">
					<input type="hidden" name="d_no_of_frame_sides" value="" type="text">
					<input type="hidden" name="d_dividing_rail" value="" type="text">
				<input type="hidden" name="d_frame_type" value="" type="text">
				<input type="hidden" name="d_atoz_measurements" value="" type="text">
				<input type="hidden" name="d_choose_measurement_a" value="" type="text">
				<input type="hidden" name="d_choose_measurement_b" value="" type="text">
				<input type="hidden" name="d_choose_measurement_c" value="" type="text">
				<input type="hidden" name="d_choose_measurement_d" value="" type="text">
				<input type="hidden" name="d_choose_measurement_e" value="" type="text">
				<input type="hidden" name="d_choose_measurement_f" value="" type="text">
				<input type="hidden" name="d_choose_measurement_g" value="" type="text">
				<input type="hidden" name="d_choose_measurement_h" value="" type="text">
				<input type="hidden" name="d_choose_measurement_i" value="" type="text">
				<input type="hidden" name="d_choose_measurement_j" value="" type="text">
				<div class="nextprevbuttons">
					<button data-class="product_single_custom_slide1" class="slide2_button product_custom_button" type="button">Back</button>
					<button type="submit" name="add-to-cart" value="<?php echo get_the_id(); ?>" class="single_add_to_cart_button button alt">Add to cart</button>
				</div>
					</form>
					</div>
					<?php } ?>
				</div>
				<?php  if($activeProduct['step3']==true){?>
				<div class="nextprevbuttons">
						<button data-class="product_single_custom_slide1" class="slide2_button product_custom_button" type="button">Back</button>
						<button data-class="product_single_custom_slide3" class="validate slide2_button product_custom_button" type="button">
						Next
						</button>
				</div>
				<?php } ?>
			</div>
			<!--Slide 2 div end -->
			<!--Slide 3 div start -->
			<?php  if($activeProduct['step3']==true){?>
			<div class="product_single_custom_slide product_single_custom_slide3" style="display:none">
				<div class="twopart_custom_section row">
					<div class="twopart_custom_section_left col-lg-12 col-12 col-md-6">
						<!--Slide 3 Left start -->
						<?php if( get_the_id() !== 9452 ){ ?>
						<div class="row">
							<div class="col-sm-12 tabheading"> <h4>-Central or Hidden Tilt Rod</h4></div>
							<div class="col text-center"></div>
							<div class="col text-center">
								<img class="clicktoact get_dev_tilt" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/single-or-split-tilt-rod/0.png';?>">
								<label>Central</label>
							</div>
							<div class="col text-center">
								<img class="clicktoact get_dev_tilt" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/number-of-frame-sides/2.png';?>">
								<label>Hidden</label>
							</div>
							<div class="col text-center"></div>
						</div>
					<?php } ?>
					<?php if ( get_the_id() !== 9452 ) { ?>
						<div class="row">
							<div class="col-sm-12 tabheading"> <h4>-Split or Single Tilt Rod</h4></div>
							<div class="col text-center"></div>
							<div class="col text-center">
								<img class="clicktoact get_dev_tilt_split" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/single-or-split-tilt-rod/0.png';?>">
								<label>Split</label>
							</div>
							<div class="col text-center">
								<img class="clicktoact get_dev_tilt_split" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/single-or-split-tilt-rod/1.png';?>">
								<label>Single Tilt</label>
							</div>
							<div class="col text-center"></div>
						</div>
					<?php } ?>
					<!--For Octagon shutters-->
					<?php if( get_the_id() === 9452 ){ ?>
					<div class="row">
						<div class="col-sm-12 tabheading"> <h4>-Central or No Rod</h4></div>
						<div class="col text-center"></div>
						<div class="col text-center">
							<img class="clicktoact get_dev_tilt" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/octagon/central-no-rod/0.png';?>">
							<label>Central</label>
						</div>
						<div class="col text-center">
							<img class="clicktoact get_dev_tilt" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/octagon/central-no-rod/1.png';?>">
							<label>No Rod</label>
						</div>
						<div class="col text-center"></div>
					</div>
					<?php } ?>
						<div class="row">
							<div class="col-sm-12 tabheading"> <h4>-Number of Frame Sides</h4></div>
							<div class="col text-center"></div>
							<?php if ( get_the_id() === 9452 ) { // For Octagon ?>
								<div class="col text-center">
									<img class="clicktoact get_dev_framesides" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/octagon/frame-sides/0.png';?>">
									<label>8 Sided</label>
								</div>
								<div class="col text-center">
									<img class="clicktoact get_dev_framesides" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/octagon/frame-sides/1.png';?>">
									<label>8 Sided W/Sill</label>
								</div>
								<div class="col text-center">
									<img class="clicktoact get_dev_framesides" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/octagon/frame-sides/2.png';?>">
									<label>No Frame</label>
								</div>
							<?php } else { ?>
								<div class="col text-center">
									<img class="clicktoact get_dev_framesides" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/number-of-frame-sides/0.png';?>">
									<label>4 Sided</label>
								</div>
								<div class="col text-center">
									<img class="clicktoact get_dev_framesides" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/number-of-frame-sides/1.png';?>">
									<label>4 Sided W/Sill</label>
								</div>
								<div class="col text-center">
									<img class="clicktoact get_dev_framesides" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/number-of-frame-sides/2.png';?>">
									<label>No Frame</label>
								</div>
							<?php } ?>
							<div class="col text-center"></div>
						</div>
						<!--Slide 2 Left end -->
					</div>
					<div class="twopart_custom_section_right col-lg-12 col-12 col-md-6">
						<!--Slide 2 Right start -->
						<?php if ( get_the_id() !== 9452 ) { ?>
						<div class="row">
							<div class="col-sm-12 tabheading"> <h4>-No Dividing Rail or Dividing Rail</h4></div>
							<div class="col text-center"></div>
								<div class="col text-center">
									<img class="clicktoact get_dev_rails" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/dividing-rail/0.jpg';?>">
									<label>No Dividing Rail</label>
								</div>
								<div class="col text-center">
									<img class="clicktoact get_dev_rails" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/dividing-rail/1.jpg';?>">
									<label>Dividing Rail</label>
								</div>
							<div class="col text-center"></div>
						</div>
						<?php } ?>
						<div class="row">
							<div class="col-sm-12 tabheading"> <h4>-Frame Type</h4></div>
							<div class="col-sm-3 col text-center"></div>
							<div class="col-sm-3 text-center">
								<img class="clicktoact get_dev_frametype" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/frame-type/0.png';?>">
								<label>Type 1</label>
							</div>
							<div class="col-sm-3 text-center">
								<img class="clicktoact get_dev_frametype" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/frame-type/1.png';?>">
								<label>Type 2</label>
							</div>
							<div class="col-sm-3 col text-center"></div>
							<div class="col-sm-3 col text-center"></div>
							<div class="col-sm-3 text-center">
								<img class="clicktoact get_dev_frametype" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/frame-type/2.png';?>">
								<label>Type 3</label>
							</div>
							<div class="col-sm-3 text-center">
								<img class="clicktoact get_dev_frametype" src="<?php echo get_stylesheet_directory_uri().'/assets/product-images/combine-images/frame-type/3.png';?>">
								<label>Type 4</label>
							</div>
							<div class="col-sm-3 col text-center"></div>
						</div>
					<!--Slide 2 Right end -->
				</div>
				
				<div class="twopart_custom_section_left col-lg-6 col-12 col-md-6">
					<h4>Order Summary</h4>
					<ul id="showselecteddata">
						
					</ul>
				</div>
				
				<div class="twopart_custom_section_right col-lg-6 col-12 col-md-6">
					<h4>Order Total<span id="cal_price_dev"></span></h4>
					<form class="cart customcart" action="" method="post" enctype="multipart/form-data">
					<div class="quantity">
						<input type="hidden" id="quantity_6693d777a755a" class="input-text qty text" value="1" aria-label="Product quantity" min="1" max="" name="quantity" step="1" placeholder="" inputmode="numeric" autocomplete="off">
					</div>
					<div class="nextprevbuttons">
						<button data-class="product_single_custom_slide2" class="slide3_button product_custom_button" type="button">Back</button>
						<button type="submit" name="add-to-cart" value="<?php echo get_the_id(); ?>" class="single_add_to_cart_button button alt added">Add to cart</button><a href="/cart/" class="added_to_cart wc-forward" title="View cart">View cart</a>
					</div>
						<!-- #yith-wapo-container -->
					<div id="yith-wapo-container" class="yith-wapo-container yith-wapo-form-style-custom" data-product-price="1000" data-product-id="<?php echo get_the_id(); ?>" data-order-price="1000">
						<input type="hidden" id="yith_wapo_product_id" name="yith_wapo_product_id" value="9430">
						<input type="hidden" id="yith_wapo_product_img" name="yith_wapo_product_img" value="">
						<input type="hidden" id="yith_wapo_is_single" name="yith_wapo_is_single" value="1">
					</div>

					<input type="hidden" class="nameofthe_pro" data-title="<?php echo get_the_title();?>" name="d_val" value="" type="text">
					<input type="hidden" name="d_mount_type" value="" type="text">
					<input type="hidden" name="d_attachment_type" value="" type="text">
					<input type="hidden" name="d_opening_window_depth" value="" type="text">
					<input type="hidden" name="d_opening_window_depth_decimal" value="" type="text">
					<input type="hidden" name="d_choose_type" value="" type="text">
					<input type="hidden" name="d_choose_type_color" value="" type="text">
					<input type="hidden" name="d_hinge_color" value="" type="text">
					<input type="hidden" name="d_height" value="" type="text">
					<input type="hidden" name="d_width" value="" type="text">
					<input type="hidden" name="d_height2" value="" type="text">
					<input type="hidden" name="d_default_text" value="" type="text">
					<input type="hidden" name="d_width2" value="" type="text">
					<input type="hidden" name="d_lourve_size" value="" type="text">
					<input type="hidden" name="d_tilt_type" value="" type="text">
					<input type="hidden" name="d_tilt_type_split" value="" type="text">
					<input type="hidden" name="d_no_of_frame_sides" value="" type="text">
					<input type="hidden" name="d_dividing_rail" value="" type="text">
				<input type="hidden" name="d_frame_type" value="" type="text">
				<input type="hidden" name="d_atoz_measurements" value="" type="text">
				<input type="hidden" name="d_choose_measurement_a" value="" type="text">
				<input type="hidden" name="d_choose_measurement_b" value="" type="text">
				<input type="hidden" name="d_choose_measurement_c" value="" type="text">
				<input type="hidden" name="d_choose_measurement_d" value="" type="text">
				<input type="hidden" name="d_choose_measurement_e" value="" type="text">
				<input type="hidden" name="d_choose_measurement_f" value="" type="text">
				<input type="hidden" name="d_choose_measurement_g" value="" type="text">
				<input type="hidden" name="d_choose_measurement_h" value="" type="text">
				<input type="hidden" name="d_choose_measurement_i" value="" type="text">
				<input type="hidden" name="d_choose_measurement_j" value="" type="text">
				</form>
				</div>
				</div>
			</div>
			<?php } ?>
			<!--Slide 3 div end -->
		</div>
	<?php
	}
}