<?php
use WpCafe\Utils\Wpc_Utilities;

//register food list block
function register_food_list_block(){
	register_block_type(
		'wpc/food-menu-list', array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => 'wpc-block-style-css',
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => 'wpc-block-editor-style-css',
			// Enqueue blocks.build.js in the editor only.
			'editor_script' => 'wpc-block-js',
			'render_callback'	=> 'wpc_food_menu_list_callback',
			'api_version' => 1,
			'attributes' => array(
				'food_menu_style' => array(
					'type' => 'string',
					'default'	=> 'style-1'
				),
				'show_thumbnail' => array(
					'type' => 'string',
					'default'	=> 'yes'
				),
				'wpc_menu_cat' => array(
					'type' => 'array',
					'default'	=> []
				),
				'wpc_desc_limit' => array(
					'type' => 'integer',
					'default'	=> 20
				),
				'wpc_show_desc' => array(
					'type' => 'string',
					'default'	=> 'yes'
				),
				'wpc_cart_button_show' => array(
					'type' => 'string',
					'default'	=> 'yes'
				),
				'title_link_show' => array(
					'type' => 'string',
					'default'	=> 'yes'
				),
				'show_item_status' => array(
					'type' => 'string',
					'default'	=> 'yes'
				),
				'wpc_price_show' => array(
					'type' => 'string',
					'default'	=> 'yes'
				),
				'wpc_menu_count' => array(
					'type' => 'integer',
					'default'	=> 20
				),
				'wpc_menu_order' => array(
					'type' => 'string',
					'default' => 'DESC'
				),
			)
		)
	);
}
add_action('init', 'register_food_list_block');

// food menu list block callback
function wpc_food_menu_list_callback($settings){
	//check if woocommerce exists
	if (!class_exists('Woocommerce')) { return; }

	$unique_id = md5(md5(microtime()));

	$style               = $settings["food_menu_style"];
	$show_item_status    = $settings["show_item_status"];
	$show_thumbnail      = $settings["show_thumbnail"];
	$title_link_show     = $settings["title_link_show"];
	$wpc_cart_button     = $settings["wpc_cart_button_show"];
	$wpc_show_desc       = $settings["wpc_show_desc"];
	$wpc_desc_limit      = $settings["wpc_desc_limit"];
	$wpc_menu_cat        = $settings["wpc_menu_cat"];
	$wpc_menu_count      = $settings["wpc_menu_count"];
	$wpc_menu_order      = $settings["wpc_menu_order"];
	$show_thumbnail      = $settings["show_thumbnail"];
	$wpc_price_show      = $settings["wpc_price_show"];
	
	apply_filters( 'elementor/control/search_data' , $settings , $unique_id , 'wpc-menus-list' );

	ob_start();
	?>
	<div class="main_wrapper_<?php echo esc_html($unique_id)?>">
		<div class="list_template_<?php echo esc_html($unique_id) ?> wpc-nav-shortcode wpc-widget-wrapper"  data-id="<?php echo esc_attr($unique_id)?>">
			<?php
            $food_list_args = array(
                'post_type'     => 'product',
                'no_of_product' => $wpc_menu_count,
                'wpc_cat'       => $wpc_menu_cat,
                'order'         => $wpc_menu_order,
            );
			$products = Wpc_Utilities::product_query( $food_list_args );
			include \Wpcafe::plugin_dir() . "widgets/wpc-menus-list/style/{$style}.php";
			?>
		</div>
	</div>
	<?php

	return ob_get_clean();

}
