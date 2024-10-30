<?php
if ( ! isset( $_POST[ mtmh()->getPrefixedOptionName( 'register_theme_mods_nonce' ) ] ) ) {
    return;
}

check_admin_referer( mtmh()->getPrefixedOptionName( 'register_theme_mods' ), mtmh()->getPrefixedOptionName( 'register_theme_mods_nonce' ) );

if ( ! isset( $_POST['current-theme-mods'] ) || ! isset( $_POST['current-theme-mods']['register'] ) || ! isset( $_POST['current-theme-mods']['name'] ) ) {
    return;
}

    
$input = $_POST['current-theme-mods'];
$name = sanitize_text_field( $input['name'] );
$desc = sanitize_text_field( $input['desc'] );
$nav = sanitize_text_field( isset( $input['nav'] ) && 'on' === $input['nav'] ? 'on' : '' );
$theme_mods_data = [
    'name' => $name,
    'desc' => $desc,
    'nav'  => $nav
];

$theme_mods_list = get_option( mtmh()->getPrefixedThemeOptionName( 'theme_mods_list' ), '{}' );
$theme_mods_list = json_decode( $theme_mods_list, true );
if ( null === $theme_mods_list ) {
    $theme_mods_list = array();
}

if ( in_array( $theme_mods_data, $theme_mods_list ) ) {
    return;
}

// Index
$theme_mods_count = absint( get_option( mtmh()->getPrefixedThemeOptionName( 'theme_mods_count' ), 0 ) );
$theme_mods_data['index'] = $theme_mods_count;

// Current Theme Mods
$current_theme_mods = get_theme_mods();
if ( '' === $nav ) unset( $current_theme_mods['nav_menu_locations'] );
$current_theme_mods = json_encode( $current_theme_mods, JSON_UNESCAPED_UNICODE );
update_option( mtmh()->getPrefixedThemeOptionName( sprintf( 'theme_mods_%d', $theme_mods_count ) ), $current_theme_mods );

// Push and Update
array_push( $theme_mods_list, $theme_mods_data );
$theme_mods_list = json_encode( $theme_mods_list, JSON_UNESCAPED_UNICODE );
update_option( mtmh()->getPrefixedThemeOptionName( 'theme_mods_list' ), $theme_mods_list );

// Next Count
$theme_mods_count++;
update_option( mtmh()->getPrefixedThemeOptionName( 'theme_mods_count' ), $theme_mods_count );



