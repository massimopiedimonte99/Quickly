<?php

	// require Walker
	require_once get_template_directory() . '/inc/Walker.php';
	
	// basic theme support
	add_theme_support( 'custom-background' );
	add_theme_support( 'custom-logo' );
	add_theme_support( "custom-header", array() ); 
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', [ 'standard', 'image', 'video', 'quote', 'link' ] );
	add_theme_support( 'html5', array('search-form', 'post-thumbnails',  'comment-list') );
	add_editor_style();

	// enqueue scripts
	function quickly_enqueue_scripts() {

		// default wp script
		if ( is_singular() && comments_open() && get_option('thread_comments') )
  		wp_enqueue_script( 'comment-reply' );

		// css quickly
		wp_register_style( 'quickly', get_template_directory_uri() . '/css/quickly.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'quickly' );

		// font awesome
		wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', array(), '4.7.0', 'all' );
		wp_enqueue_style( 'font-awesome' );

		// css bootstrap
		wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.0.0', 'all' );
		wp_enqueue_style( 'bootstrap' );

		// js bootstrap
		// wp_register_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array( 'jquery' ), '4.0.0', true );
		// wp_enqueue_script( 'bootstrap' );

		// js quickly
		wp_register_script( 'quickly-js', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'quickly-js' );
	}

	// register navbar
	function quickly_register_navbar() {
		register_nav_menu( 'top', "Quickly's Navbar" );
	}

	// sidebar
	function quickly_register_sidebar() {
		$args = array(
			'name'          => __( "Quickly's Sidebar", 'quickly' ),
			'id'            => 'quickly-sidebar',
			'description'   => __("Flexible, Lightweight and Minimal sidebar for your website by Quickly", 'quickly' )
		);
		
		// check whether the sidebar has been activated or not by the user
		// $activate_sidebar = esc_attr( get_option( 'sidebar-status' ) );
		// if( $activate_sidebar === 'yes' ) 
		register_sidebar( $args );
	}

	// change category and tags class
	function change_meta_class( $class, $el ) {
	  return str_replace( '<a','<a class="taxonomies-' . $class . '"', $el );
	}
	
	function quickly_category_class( $html ) {
		$html = change_meta_class( 'category', $html );
    return $html;
	}

	function quickly_tag_class( $html ) {
		$html = change_meta_class( 'tag', $html );
    return $html;
	}

	// change pagination link class for index
	function quickly_posts_link_attributes_next() {
	  return 'class="pagination-link newer"';
	}

	function quickly_posts_link_attributes_older() {
	  return 'class="pagination-link older"';
	}

	// change pagination link class for single
	function quickly_posts_link_attributes_older__single( $format ) {
		$format = str_replace('href=', 'class="previous-article" href=', $format);
    return $format; 
	}

	function quickly_posts_link_attributes_next__single( $format ) {
		$format = str_replace('href=', 'class="next-article" href=', $format);
    return $format; 
	}

	// Quickly submenu in the settings menu to 
	// (de)activate the sidebar in the default WP home page
	// function quickly_menu_page() {
	// 	add_options_page( 'Quickly', 'Sidebar', 'manage_options', 'sidebar-settings', 'quickly_menu_page__html' );
	// }

	// function quickly_menu_page__html() {
	// 	require_once( get_template_directory() . '/inc/templates/quickly-backend-sidebar.php' );
	// }

	// function quickly_menu_page__settings() {
	// 	register_setting( 'quickly-sidebar', 'sidebar-status' );
	// 	add_settings_section( 'quickly-sidebar', "Quickly's Sidebar", 'quickly_menu_page__settings_sidebar_html', 'sidebar-settings' );
	// 	add_settings_field( 'sidebar-status', 'Show the sidebar in your Home Page?', 'quickly_menu_page__settings_field_html', 'sidebar-settings', 'quickly-sidebar' );
	// }

	// function quickly_menu_page__settings_sidebar_html() {
	// 	echo "<p>Quickly's sidebar is optimized to be flexible and responsive but i thought the sidebar doesn't give the idea of minimalism that Quickly is made with.</p>";
	// 	echo "<p>Here you can activate or deactivate the sidebar.</p>";
	// 	echo "<p class='description'>If you've changed the default Home Page, you can do the exact same thing by using Quickly's templates.</p>";
	// }

	// function quickly_menu_page__settings_field_html() {
	// 	$radio_val = esc_attr( get_option( 'sidebar-status' ) );
	// 	$sidebar_yes = $radio_val === 'yes' ? 'checked' : '';
	// 	$sidebar_no = $radio_val === 'no' ? 'checked' : '';
	// 	echo '<label style="margin: 0 10px 0 50px;"><input type="radio" id="sidebar-status" name="sidebar-status" value="yes"'.$sidebar_yes.'>Yes</label>';
	// 	echo '<label><input type="radio" id="sidebar-status" name="sidebar-status" value="no"'.$sidebar_no.'>No</label>';
	// }

	// change class of comment button
	function quickly_button_comment_form( $arg ) {
    $arg['class_submit'] = 'btn btn-outline-secondary btn-comment';
    return $arg;
	}

	// change wp_list_comments() template
	function quickly_list_comments( $comment, $args, $depth ) {
    if ( 'div' === $args['style'] ) {
    $tag       = 'div';
    $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
        <div class="comment-author vcard clearfix"><?php 
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, 150, $default, $alt, array( 'class' => array( 'img-thumbnail', 'rounded-circle' ) ) ); 
            } 
            printf( __( '<cite class="fn">%s</cite>', 'quickly' ), get_comment_author_link() ); ?>
        </div>

        <?php comment_text(); ?>
        <?php 
        if ( $comment->comment_approved == '0' ) { ?>
            <p class="comment-awaiting-moderation"><em style="opacity: .5;"><?php _e( 'Your comment is awaiting moderation.', 'quickly' ); ?></em></p><?php 
        } ?>

        <div class="reply"><?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>
        </div><?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
	}
	
	// custom metabox to add subtitle in article
	// function quickly_article_subtitle() {
	// 	add_meta_box( 'quickly_article_sub', "Quickly's Subtitle", 'quickly_article_subtitle__html', 'post', 'side', 'high' );
	// }

	// function quickly_article_subtitle__html() {
	// 	global $post;  
	// 	$meta = get_post_meta( $post->ID, 'quickly_fields', true );
	// 	echo '<input type="hidden" name="quickly_nonce" value="'.wp_create_nonce( basename(__FILE__) ).'">';
		
	// 	// actual text subtitle
	// 	$subtitle_value = !empty( $meta['subtitle'] ) ? $meta['subtitle'] : ''; 
	// 	echo '<div class="form-group">';
	// 		echo '<label for="quickly_fields[subtitle]" style="display:none;">Subtitle</label>';
	// 		echo '<input type="text" id="quickly_fields[subtitle]" class="form-control" name="quickly_fields[subtitle]" value="'. $subtitle_value .'" placeholder="Eg. The most complete article about penguins!" style="width: 100%;">';
	// 	echo "</div>";
	// }

	// // save metabox fields
	// function quickly_metabox_save_fields( $post_id ) {  
	// 	// verify nonce
	// 	if ( !wp_verify_nonce( $_POST['quickly_nonce'], basename(__FILE__) ) ) return $post_id; 

	// 	// check autosave
	// 	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
		
	// 	// check permissions
	// 	if ( 'page' === $_POST['post_type'] ) {
	// 		if ( !current_user_can( 'edit_page', $post_id ) ) return $post_id;
	// 		elseif ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;
	// 	}
		
	// 	// replace old data w/h the new ones
	// 	$old = get_post_meta( $post_id, 'quickly_fields', true );
	// 	$new = $_POST['quickly_fields'];
		
	// 	// update/delete metabox values
	// 	if ( $new && $new !== $old ) update_post_meta( $post_id, 'quickly_fields', $new );
	// 	elseif ( '' === $new && $old ) delete_post_meta( $post_id, 'quickly_fields', $old );
	// }

	// customization API
	function quickly_customize_register( $wp_customize ) {
		$wp_customize->add_section( 'quickly_customization_api' , array(
	    	'title'      => __( 'Quickly', 'quickly' ),
	    	'priority'   => 30,
		));

		// Main Cover
		$wp_customize->add_setting('main_cover' , array( 'transport' => 'refresh', 'sanitize_callback' => 'quickly_customize_register__sanitize' ));

		$wp_customize->add_control(new WP_Customize_Image_Control( 
			$wp_customize, 'header_main_cover', array(
				'label'      	=> __( 'Main Cover', 'quickly' ),
				'description' => __( 'Set a cover image that all your visitors will see...', 'quickly' ),
				'section'    	=> 'quickly_customization_api',
				'settings'   	=> 'main_cover',
			)
		));
	}

	function quickly_customize_register__sanitize( $file, $mimes ) {
		 //allowed file types
      $mimes = array(
	      'jpg|jpeg|jpe' => 'image/jpeg',
	      'gif'          => 'image/gif',
	      'png'          => 'image/png'
      );
       
      //check file type from file name
      $file_ext = wp_check_filetype( $file, $mimes );
       
      //if file has a valid mime type return it, otherwise return default
      return ( $file_ext['ext'] ? $file : $setting->default );
	}

	// add contact form shortcode
	// function quickly_contact_form() {
	// 	$html =  '
	// 		<div class="col-12 quickly-contact-form-container">
	// 			<form action="#" class="quickly-contact-form">
	// 				<div class="row">
	// 					<div class="col-12 col-md-6 quickly-inline-form">
	// 						<div class="form-group">
	// 							<label class="sr-only" for="email"></label>
	// 							<input id="email" name="email" type="text" class="form-control" placeholder="Eg. mark@gmail.com" value="" size="30">
	// 						</div>
	// 					</div>
	// 					<div class="col-12 col-md-6 quickly-inline-form">
	// 						<div class="form-group">
	// 							<label class="sr-only" for="name"></label>
	// 							<input id="name" name="text" type="text" class="form-control" placeholder="Eg. Mark Johnas" value="" size="30">
	// 						</div>
	// 					</div>
	// 				</div>
	// 				<div class="form-group">
	// 					<label class="sr-only" for="message"></label>
	// 					<textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="'.__( 'Hi, i read your article about...', 'quickly' ).'"></textarea>
	// 				</div>
	// 				<button type="submit" class="btn btn-outline-secondary quickly-btn">'.__( 'Get in touch!', 'quickly' ).'</button>
	// 			</form>
	// 		</div>';

	// 	return $html;
	// }
	
	// removed shortcode due to "plugin_territory feature"
	// add_shortcode('c-form', 'quickly_contact_form'); // add contact form shortcode

	// hooks
	add_action( 'wp_enqueue_scripts', 'quickly_enqueue_scripts' ); // include scripts
	add_action( 'after_setup_theme', 'quickly_register_navbar' ); // register navbar
	add_action( 'widgets_init', 'quickly_register_sidebar' ); // register sidebar
	add_filter( 'the_category', 'quickly_category_class' ); // change category class
	add_filter( 'the_tags', 'quickly_tag_class' ); // change tag class
	add_filter( 'next_posts_link_attributes', 'quickly_posts_link_attributes_older' ); // change pagination link class (index | next)
	add_filter( 'previous_posts_link_attributes', 'quickly_posts_link_attributes_next' ); // change pagination link class (index | previous)
	add_filter( 'next_post_link', 'quickly_posts_link_attributes_next__single' ); // change pagination link class (single | next)
	add_filter( 'previous_post_link', 'quickly_posts_link_attributes_older__single' ); // change pagination link class (single | previous)
	// add_action( 'admin_menu', 'quickly_menu_page' ); // Quickly submenu in the settings menu
	// add_action( 'admin_init', 'quickly_menu_page__settings' ); // Quickly submenu in the settings menu
	add_filter( 'comment_form_defaults', 'quickly_button_comment_form' ); // change class of comment button
	// add_action( 'add_meta_boxes', 'quickly_article_subtitle' ); // add subtitle in the article through custom metabox
	// add_action( 'save_post', 'quickly_metabox_save_fields' ); // save metabox fields
	add_action( 'customize_register', 'quickly_customize_register' ); // customization API