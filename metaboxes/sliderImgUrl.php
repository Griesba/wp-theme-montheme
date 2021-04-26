<?php

class CarouselSlidImgUrl {
    const META_KEY = 'montheme_first_slide_img_url';
    const NONCE = 'montheme_first_slide_nonce';

    public static function register() {
        add_action('add_meta_boxes', [self::class, 'add'], 10, 2);
        add_action('save_post', [self::class, 'save']);
        add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
    }

    public static function registerScripts($suffix) {
        
        //var_dump($suffix); //die();
        if($suffix === 'post.php') {
            wp_register_script('jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', [], false, true);
            //wp_enqueue_script('montheme_scripts', get_template_directory_uri() . '/assets/scripts.js', ['jquery'], false, true);      
            wp_enqueue_script('script-perso', get_template_directory_uri() .'/assets/scripts.js', array('jquery'));      
        }
        
    }

    public static function add($postType, $post) {
        //add_meta_box( self::META_KEY, __( 'Listing Image', 'text-domain' ), 'listing_image_metabox', 'page', 'side', 'low');

        if($postType === 'page' && current_user_can('publish_post', $post)) {
            add_meta_box('listingimagediv', 'Carousel Slide URL', [self::class, 'render'], 'page', 'side');
        }
    }

    public static function render ($post) {
        global $content_width, $_wp_additional_image_sizes;

        $image_id = get_post_meta($post->ID, self::META_KEY, true);

        $old_content_width = $content_width;
        $content_width = 254;

         //var_dump(get_current_screen()); //pour voir le nom de la page
        
        if ( $image_id && get_post( $image_id ) ) {
            var_dump($image_id);
            var_dump(get_post($image_id));
            if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
                $thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
            } else {
                $thumbnail_html = wp_get_attachment_image( $image_id );
            }
            
            if ( ! empty( $thumbnail_html ) ) {
                $content = $thumbnail_html;
                $content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_listing_image_button" >' . esc_html__( 'Remove listing image', 'text-domain' ) . '</a></p>';
                $content .= '<input type="hidden" id="upload_listing_image" name="_listing_cover_image" value="' . esc_attr( $image_id ) . '" />';
            }
    
            $content_width = $old_content_width;
        } else {
            $content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		    $content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set listing image', 'text-domain' ) . '" href="javascript:;" id="upload_listing_image_button" id="set-listing-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set listing image', 'text-domain' ) . '">' . esc_html__( 'Set listing image', 'text-domain' ) . '</a></p>';
		    $content .= '<input type="hidden" id="upload_listing_image" name="_listing_cover_image" value="" />';

        }

        //wp_nonce_field(self::NONCE, self::NONCE); // on enregistre un nonce
        echo $content;

    }

    public static function save($post){
//var_dump($post);
        if( isset( $_POST['_listing_cover_image'] ) ) {
            $image_id = (int) $_POST['_listing_cover_image'];
            update_post_meta( $post, self::META_KEY, $image_id );
        }
	}
}

?>