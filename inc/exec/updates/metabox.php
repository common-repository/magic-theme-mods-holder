<?php
if ( ! isset( $_POST['mtmh_metabox_nonce'] ) ) {
    return;
}

check_admin_referer( 'mtmh_metabox', 'mtmh_metabox_nonce' );

if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
}

if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

} else {

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

}

if ( ! isset( $_POST['mtmh-theme-mods'] ) ) {
    return;
}

$mtmh_theme_mods = sanitize_text_field( $_POST['mtmh-theme-mods'] );
update_post_meta( $post_id, mtmh()->getPrefixedPostMetaName( 'selected_theme_mods' ), $mtmh_theme_mods );

