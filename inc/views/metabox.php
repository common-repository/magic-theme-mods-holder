<?php $post_id = intval( $post->ID );
$default = 'none';
$selected_theme_mods = get_post_meta( $post_id, mtmh()->getPrefixedPostMetaName( 'selected_theme_mods' ), true );
if ( ! is_numeric( $selected_theme_mods ) ) $selected_theme_mods = $default;

$theme_mods_list = get_option( mtmh()->getPrefixedThemeOptionName( 'theme_mods_list' ), '{}' );
$theme_mods_list = json_decode( $theme_mods_list, true );
if ( null === $theme_mods_list ) {
    $theme_mods_list = array();
}

wp_nonce_field( 'mtmh_metabox', 'mtmh_metabox_nonce' );
?>

<label>
    <?php esc_html_e( 'Magic Theme Mods:', 'mtmh' ) ?>
    <select name="mtmh-theme-mods">
        <option value="<?php echo esc_attr( $default ); ?>"><?php esc_html_e( 'None', 'mtmh' ); ?></option>
        <?php if ( is_array( $theme_mods_list ) && 0 < count( $theme_mods_list ) ) { ?>
            <?php foreach( $theme_mods_list as $index => $theme_mods_data ) { ?>
                <option value="<?php echo esc_attr( $index ); ?>" <?php selected( $selected_theme_mods, $theme_mods_data['index'] ); ?>><?php echo esc_html( $theme_mods_data['name'] ); ?></option>
            <?php } ?>
        <?php } ?>

    </select>
</label>

