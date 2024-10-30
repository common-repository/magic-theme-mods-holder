<?php
if ( ! isset( $_POST[ mtmh()->getPrefixedOptionName( 'update_theme_mods_list_nonce' ) ] ) ) {
    return;
}

// Nonce
check_admin_referer( mtmh()->getPrefixedOptionName( 'update_theme_mods_list' ), mtmh()->getPrefixedOptionName( 'update_theme_mods_list_nonce' ) );

// Submit Button
if ( ! isset( $_POST['update-theme-mods-list'] ) ) {
    return;
}

// Post Data
if ( ! isset( $_POST['table-theme-mods-data'] ) 
    || ! is_array( $_POST['table-theme-mods-data'] ) 
    || 0 >= count( $_POST['table-theme-mods-data'] )
) {
    return;
}

$input = $_POST['table-theme-mods-data'];
$holder = array();
foreach ( $input as $index => $data ) {

    $name  = sanitize_text_field( $data['name'] );
    $desc  = sanitize_text_field( $data['desc'] );
    $index = absint( $data['index'] );
    $nav   = sanitize_text_field( isset( $data['nav'] ) && 'on' === $data['nav'] ? 'on' : '' );

    if ( isset( $data['delete'] ) && 'delete' === $data['delete'] ) {
        delete_option( mtmh()->getPrefixedThemeOptionName( "theme_mods_$index" ) );
        continue;
    }

    $name  = sanitize_text_field( $data['name'] );
    $desc  = sanitize_text_field( $data['desc'] );
    $index = absint( $data['index'] );
    $nav   = sanitize_text_field( isset( $data['nav'] ) && 'on' === $data['nav'] ? 'on' : '' );

    $holder[ $index ] = [
        'name'  => $name,
        'desc'  => $desc,
        'index' => $index,
        'nav'   => $nav,
    ];
}

$holder = json_encode( $holder, JSON_UNESCAPED_UNICODE );
update_option( mtmh()->getPrefixedThemeOptionName( 'theme_mods_list' ), $holder );