<?php
if ( ! isset( $_POST[ mtmh()->getPrefixedOptionName( 'remove_current_theme_mods_nonce' ) ] ) ) {
    return;
}

check_admin_referer( mtmh()->getPrefixedOptionName( 'remove_current_theme_mods' ), mtmh()->getPrefixedOptionName( 'remove_current_theme_mods_nonce' ) );

// Leave Nav Menu and Remove 
$nav_menu_location = get_theme_mod( 'nav_menu_locations' );
remove_theme_mods();
set_theme_mod( 'nav_menu_locations', $nav_menu_location );

