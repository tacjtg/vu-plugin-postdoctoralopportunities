<?php
/*
	Plugin Name: VU Postdoctoral Opportunities Plugin
	Description: Create & Display Postdoctoral Opportunities.
	Author: JTG
	Version: 1.0.0
*/
class VU_Postdocopps_Plugin {

    public function __construct() {
        add_filter( 'acf/settings/path', array( $this, 'update_acf_settings_path' ) );
        add_filter( 'acf/settings/dir', array( $this, 'update_acf_settings_dir' ) );
        add_filter('acf/settings/show_admin', '__return_false');

        include_once( plugin_dir_path( __FILE__ ) . 'vendor/advanced-custom-fields/acf.php' );

		add_action( 'init', array( $this, 'register_postdocopps' ) );
		add_action( 'init', array( $this, 'vu_postdoc_options' ) );
		add_filter( 'manage_postdocopps_posts_columns', array( $this, 'vu_postdoc_admin_columns' ) );
		add_action( 'manage_postdocopps_posts_custom_column', array( $this, 'vu_postdoc_admin_columns_content' ) );
		add_action( 'submitpost_box', array( $this, 'vu_postdoc_title' ) );
		add_action( 'admin_head', array( $this, 'vu_postdoc_admin_styles') );

		add_action( 'wp_enqueue_scripts', array( $this, 'vu_postdoc_frontend_styles' ), 99 );
		add_filter( 'archive_template', array( $this, 'vu_postdoc_archive_template') );
		add_filter( 'single_template', array( $this, 'vu_postdoc_single_template') );
   }

    public function update_acf_settings_path( $path ) {
        $path = plugin_dir_path( __FILE__ ) . 'vendor/advanced-custom-fields/';
        return $path;
    }

    public function update_acf_settings_dir( $dir ) {
        $dir = plugin_dir_url( __FILE__ ) . 'vendor/advanced-custom-fields/';
        return $dir;
    }

	public function register_postdocopps() {
		$labels = array(
			"name" => __( 'Postdoctoral Opportunities', 'twentysixteen' ),
			"singular_name" => __( 'Postdoctoral Opportunity', 'twentysixteen' ),
			);

		$args = array(
			"label" => __( 'Postdoctoral Opportunities', 'twentysixteen' ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"has_archive" => true,
			"show_in_menu" => true,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => array( "slug" => "postdocopps", "with_front" => true ),
			"query_var" => true,
			"menu_icon" => "dashicons-welcome-learn-more",
			"supports" => false,
		);
		register_post_type( "postdocopps", $args );
	}

	public function vu_postdoc_options() {
		if(function_exists("register_field_group")) {
			register_field_group(array (
				'id' => 'acf_postdoctoral-opportunities',
				'title' => 'Postdoctoral Opportunities',
				'fields' => array (
					array (
						'key' => 'field_57470a5852427',
						'label' => 'Name',
						'name' => 'postdoc_name',
						'type' => 'text',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_574708b0f87b8',
						'label' => 'Email',
						'name' => 'postdoc_email',
						'type' => 'email',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_574708c8f87b9',
						'label' => 'Phone',
						'name' => 'postdoc_phone',
						'type' => 'text',
						'default_value' => '',
						'placeholder' => '(000) 000-0000',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_574708f8f87ba',
						'label' => 'Department',
						'name' => 'postdoc_department',
						'type' => 'text',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_57470983f87bb',
						'label' => 'Brief Description',
						'name' => 'postdoc_brief_description',
						'type' => 'textarea',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_574709a3f87bc',
						'label' => 'Full Description',
						'name' => 'postdoc_full_description',
						'type' => 'wysiwyg',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_574709c0f87bd',
						'label' => 'Application Details',
						'name' => 'postdoc_application_details',
						'type' => 'wysiwyg',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'postdocopps',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'default',
					'hide_on_screen' => array (
						0 => 'permalink',
						1 => 'the_content',
						2 => 'excerpt',
						3 => 'custom_fields',
						4 => 'discussion',
						5 => 'comments',
						6 => 'revisions',
						7 => 'slug',
						8 => 'author',
						9 => 'format',
						10 => 'featured_image',
						11 => 'categories',
						12 => 'tags',
						13 => 'send-trackbacks',
					),
				),
				'menu_order' => 0,
			));
		}
	}

	public function vu_postdoc_admin_columns( $columns ) {
		unset($columns['title']);
		unset($columns['date']);
		return array_merge (
			$columns, array (
				'postdoc_name' => __ ( 'Name' ),
				'postdoc_department'   => __ ( 'Department' ),
				'postdoc_brief_description'   => __ ( 'Brief Description' ),
				'postdoc_date'   => __ ( 'Created' )
			)
		);
	}

	public function vu_postdoc_admin_columns_content ( $column ) {
		switch ( $column ) {
			case 'postdoc_name':
				the_field( 'postdoc_name', $post_id );
			break;

			case 'postdoc_department':
				the_field( 'postdoc_department', $post_id );
			break;

			case 'postdoc_brief_description':
				the_field( 'postdoc_brief_description', $post_id );
			break;

			case 'postdoc_date':
				echo get_the_date( $post_id );
			break;
		}
	}

	public function vu_postdoc_title( $new_post_title ) {
		if ( get_post_type() == 'postdocopps' ) {
			global $post_type;
			$post_id = get_the_ID();
		    if( post_type_supports( $post_type, 'title' ) ) {
			    return;
		    }
		    echo '<input type="hidden" name="post_title" value="' . esc_attr( htmlspecialchars( 'opp' . $post_id ) ) . '" id="title" />';
		}
	}

	public function vu_postdoc_admin_styles() {
		if ( get_post_type() == 'postdocopps' ) {
		    $output_css = '<style type="text/css">
		    	@media (min-width: 768px) {
		        	.column-postdoc_name { width: 20%; }
					.column-postdoc_department { width: 20%; }
					.column-postdoc_brief_description { width: 45%; }
					.column-postdoc_date { width: 15%; }
		        }
		    </style>';
		    echo $output_css;
		}
	}

	public function vu_postdoc_frontend_styles2() {
		if ( get_post_type() == 'postdocopps' ) {
			echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';
			echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">';
			echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';
		}
	}

	public function vu_postdoc_frontend_styles() {
		if ( get_post_type() == 'postdocopps'  ) {
			 $pluginpath = plugin_dir_url( __FILE__ );
			 wp_enqueue_style( 'style-table', $pluginpath . 'css/style-table.css' );
			 wp_enqueue_script( 'js-table', $pluginpath . 'js/table.js' );

		}
	}

	public function vu_postdoc_archive_template( $archive_template ) {
		global $post;
		if ( is_post_type_archive ( 'postdocopps' ) ) {
			$archive_template = dirname( __FILE__ ) . '/archive-postdocopps.php';
		}
		return $archive_template;
	}

	public function vu_postdoc_single_template( $single_template ) {
		global $post;
		if ( $post->post_type == 'postdocopps' ) {
			$single_template = dirname( __FILE__ ) . '/single-postdocopps.php';
		}
		return $single_template;
	}

}

new VU_Postdocopps_Plugin();