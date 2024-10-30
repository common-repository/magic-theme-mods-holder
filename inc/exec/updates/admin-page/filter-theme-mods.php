<?php
if ( ! isset( $_POST[ mtmh()->getPrefixedOptionName( 'filter_theme_mods_nonce' ) ] ) ) {
    return;
}

check_admin_referer( mtmh()->getPrefixedOptionName( 'filter_theme_mods' ), mtmh()->getPrefixedOptionName( 'filter_theme_mods_nonce' ) );

// Post Data
if ( ! isset( $_POST['filter-theme-mods'] ) 
    || ! is_array( $_POST['filter-theme-mods'] ) 
    || 2 > count( $_POST['filter-theme-mods'] )
) {
    return;
}

$input = $_POST['filter-theme-mods'];
$sanitized = array();
foreach ( $input as $key => $theme_mods_index ) {
    if ( 'current' === $theme_mods_index ) {
        $sanitized[ $key ] = sanitize_text_field( $theme_mods_index );
    }
    elseif( is_numeric( $theme_mods_index ) ) {
        $sanitized[ $key ] = absint( $theme_mods_index );
    }
}

$sanitized = json_encode( $sanitized, JSON_UNESCAPED_UNICODE );
$each_page_theme_mods = update_option( mtmh()->getPrefixedThemeOptionName( 'each_page_theme_mods' ), $sanitized );

