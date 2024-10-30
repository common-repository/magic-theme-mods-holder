<?php
$theme_mods_list = get_option( mtmh()->getPrefixedThemeOptionName( 'theme_mods_list' ), '{}' );
$theme_mods_list = json_decode( $theme_mods_list, true );

?>

<form method="post" action="themes.php?page=mtmh">

    <?php wp_nonce_field( mtmh()->getPrefixedOptionName( 'set_current_theme_mods' ), mtmh()->getPrefixedOptionName( 'set_current_theme_mods_nonce' ) ); ?>
    <?php wp_nonce_field( mtmh()->getPrefixedOptionName( 'remove_current_theme_mods' ), mtmh()->getPrefixedOptionName( 'remove_current_theme_mods_nonce' ) ); ?>

    <table cellspacing="0" id="theme-mods-list-table" class="wp-list-table widefat fixed">

        <caption>
            <?php esc_html_e( 'Set the selected theme mods as the current theme mods.', 'mtmh' ); ?>
        </caption>

        <thead>
            <tr>
                <th style="padding: .5rem; width: 5rem;" class="manage-column column-cb check-column" scope="col">
                    <label style="display: block; width: fit-content;"><span style="display: block; width: fit-content;"><?php esc_html_e( 'Select', 'mtmh' ); ?></span></label>
                </th>
                <th style="" class="manage-column column-name" scope="col">
                    <span><?php esc_html_e( 'Name', 'mtmh' ); ?></span>
                </th>
                <th style="" class="manage-column column-description" scope="col">
                    <span><?php esc_html_e( 'Description', 'mtmh' ); ?></span>
                </th>
                <th style="" class="manage-column column-nav" scope="col">
                    <span><?php esc_html_e( 'With Nav Menu', 'mtmh' ); ?></span>
                </th>
            </tr>
        </thead>

        <tbody>
            <?php 
            if ( is_array( $theme_mods_list ) && 0 < count( $theme_mods_list ) ) {
            foreach ( $theme_mods_list as $theme_mods_index => $theme_mods_data ) {
                require( 'form-current-theme-mods-row.php' );
            }
            }
            ?>
        </tbody>

        <tfoot>
            <tr>
                <th style="padding: .5rem; width: 5rem;" class="manage-column column-cb check-column" scope="col">
                    <label style="display: block; width: fit-content;"><span style="display: block; width: fit-content;"><?php esc_html_e( 'Select', 'mtmh' ); ?></span></label>
                </th>
                <th style="" class="manage-column column-name" scope="col">
                    <span><?php esc_html_e( 'Name', 'mtmh' ); ?></span>
                </th>
                <th style="" class="manage-column column-description" scope="col">
                    <span><?php esc_html_e( 'Description', 'mtmh' ); ?></span>
                </th>
                <th style="" class="manage-column column-nav" scope="col">
                    <span><?php esc_html_e( 'With Nav Menu', 'mtmh' ); ?></span>
                </th>
            </tr>
        </tfoot>

    </table>

    <p><input type="submit" name="set-current-theme-mods" class="button button-primary" value="<?php esc_attr_e( 'Set', 'mtmh' ); ?>"/></p>
    <p><input type="submit" name="remove-current-theme-mods" class="button button-primary" value="<?php esc_attr_e( 'Remove Current Theme Mods', 'mtmh' ); ?>"/></p>

</form>

