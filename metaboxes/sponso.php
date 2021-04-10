<?php

class SponsoMetaBox {
	const META_KEY	= 'montheme_sponso';
    const NONCE = 'montheme_sponso_nonce';

    public static function register() {
        add_action('add_meta_boxes', [self::class, 'add'], 10, 2);
        add_action('save_post', [self::class, 'save']);
    }

	public static function add($postType, $post) {
        // les deux params c'est pour la secu par niveau. 
        // le user sans publish_post capabilities ne poura pas voire la checkbox sponsoring sur un post
        if($postType === 'post' && current_user_can('publish_post', $post)) {
            add_meta_box(self::META_KEY, 'Sponsoring', [self::class, 'render'], 'post', 'side');
        }
	}
	
	public static function render ($post) {
        $value = get_post_meta($post->ID, self::META_KEY, true);
        wp_nonce_field(self::NONCE, self::NONCE); // on enregistre un nonce
        ?>
            <input type="hidden" value="0" name="<?= self::META_KEY ?>">
            <input type="checkbox" value="1" name="<?= self::META_KEY ?>" <?php  checked($value, '1') ?>>
         <label for="monthemesponso">Cet articel est sponsorisé ?</label>	 
        <?php
    }
	
	public static function save($post){
        // current_user_can: only user with publish_post capacities can edit sponsor box
        if(array_key_exists(self::META_KEY, $_POST) 
        && current_user_can('publish_post', $post) 
        && wp_verify_nonce($_POST[self::NONCE], self::NONCE)) { // au moment du POST le nonce doit être le mm que celui enregistré au render. le user ne doit pas le changer
            if($_POST[self::META_KEY] === '0') {
                delete_post_meta($post, self::META_KEY);
            } else {
                update_post_meta($post, self::META_KEY, 1);
            }
        }
	}
}

?>