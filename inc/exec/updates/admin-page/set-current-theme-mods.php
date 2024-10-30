<?php
if ( ! isset( $_POST[ mtmh()->getPrefixedOptionName( 'set_current_theme_mods_nonce' ) ] ) ) {
    return;
}

check_admin_referer( mtmh()->getPrefixedOptionName( 'set_current_theme_mods' ), mtmh()->getPrefixedOptionName( 'set_current_theme_mods_nonce' ) );

// Post Data
if ( ! isset( $_POST['selected-theme-mods'] ) 
    || ! is_numeric( $_POST['selected-theme-mods'] ) 
    || 0 > intval( $_POST['selected-theme-mods'] )
) {
    return;
}

// Theme Mods Name
$input = intval( $_POST['selected-theme-mods'] );

// Get Registered Theme Mods
$theme_mods = get_option( mtmh()->getPrefixedThemeOptionName( sprintf( 'theme_mods_%d', $input ) ), '{}' );
$theme_mods = json_decode( $theme_mods, true );
if ( null === $theme_mods || ! is_array( $theme_mods ) || 0 >= count( $theme_mods ) ) return;

// Nav Menu
$nav_menu_location = get_theme_mod( 'nav_menu_locations' );
remove_theme_mods();
set_theme_mod( 'nav_menu_locations', $nav_menu_location );

// Each Theme Mod
foreach ( $theme_mods as $key => $data ) {
    set_theme_mod( $key, $data );
}

