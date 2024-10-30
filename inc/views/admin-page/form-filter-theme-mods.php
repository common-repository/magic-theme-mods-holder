<?php
$theme_mods_list = get_option( mtmh()->getPrefixedThemeOptionName( 'theme_mods_list' ), '{}' );
$theme_mods_list = json_decode( $theme_mods_list, true );
if ( ! is_array( $theme_mods_list ) || 0 >= count( $theme_mods_list ) ) return;

// Archive
$defaults = array(
    'front-page' => 'current',
    'home-page' => 'current',
    'singular-page' => 'current',
    'archive-page' => 'current',
);
$post_types = get_post_types( [ 'public' => true ], 'objects' );
foreach ( $post_types as $key => $post_type ) {
    $defaults["{$key}-page"] = 'current';
}
$each_page_theme_mods = get_option( mtmh()->getPrefixedThemeOptionName( 'each_page_theme_mods' ), '{}' );
$each_page_theme_mods = json_decode( $each_page_theme_mods, true );
if ( null === $each_page_theme_mods ) $each_page_theme_mods = array();
$each_page_theme_mods = wp_parse_args( $each_page_theme_mods, $defaults );


// Post Types
$post_types = get_post_types( [ 'public' => true ], 'objects' );

?>
<form method="post" action="themes.php?page=mtmh">

    <?php wp_nonce_field( mtmh()->getPrefixedOptionName( 'filter_theme_mods' ), mtmh()->getPrefixedOptionName( 'filter_theme_mods_nonce' ) ); ?>

    <table class="form-table">

        <caption>
            <?php esc_html_e( 'Register Current Theme Mods Settings with an label and description.', 'mtmh' ); ?>
        </caption>

        <tbody>

            <tr>
                <th><label for="front-page-theme-mods">
                    <strong><?php esc_html_e( 'Front Page', 'mtmh' ); ?></strong>
                </label></th>
                <td>
                    <select id="front-page-theme-mods" name="filter-theme-mods[front-page]">
                        <option value="current"><?php esc_html_e( 'Current', 'mtmh' ); ?></option>
                        <?php foreach ( $theme_mods_list as $key => $data ) { 
                            $data_name  = $data['name'];
                            $data_index = $data['index'];
                        ?>
                            <option value="<?php echo esc_attr( $data_index ); ?>" <?php selected( $data_index, $each_page_theme_mods['front-page'] ); ?>><?php echo esc_html( $data_name ); ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th><label for="home-page-theme-mods">
                    <strong><?php esc_html_e( 'Home Page', 'mtmh' ); ?></strong>
                </label></th>
                <td>
                    <select id="home-page-theme-mods" name="filter-theme-mods[home-page]">
                        <option value="current"><?php esc_html_e( 'Current', 'mtmh' ); ?></option>
                        <?php foreach ( $theme_mods_list as $key => $data ) {
                            $data_name  = $data['name'];
                            $data_index = $data['index'];
                        ?>
                            <option value="<?php echo esc_attr( $data_index ); ?>" <?php selected( $data_index, $each_page_theme_mods['home-page'] ); ?>><?php echo esc_html( $data_name ); ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th><label for="singular-page-theme-mods">
                    <strong><?php esc_html_e( 'Singular Page', 'mtmh' ); ?></strong>
                </label></th>
                <td>
                    <select id="singular-page-theme-mods" name="filter-theme-mods[singular-page]">
                        <option value="current"><?php esc_html_e( 'Current', 'mtmh' ); ?></option>
                        <?php foreach ( $theme_mods_list as $key => $data ) {
                            $data_name  = $data['name'];
                            $data_index = $data['index'];
                        ?>
                            <option value="<?php echo esc_attr( $data_index ); ?>" <?php selected( $data_index, $each_page_theme_mods['singular-page'] ); ?>><?php echo esc_html( $data_name ); ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th><label for="archive-page-theme-mods">
                    <strong><?php esc_html_e( 'Archive Page', 'mtmh' ); ?></strong>
                </label></th>
                <td>
                    <select id="archive-page-theme-mods" name="filter-theme-mods[archive-page]">
                        <option value="current"><?php esc_html_e( 'Current', 'mtmh' ); ?></option>
                        <?php foreach ( $theme_mods_list as $key => $data ) {
                            $data_name  = $data['name'];
                            $data_index = $data['index'];
                        ?>
                            <option value="<?php echo esc_attr( $data_index ); ?>" <?php selected( $data_index, $each_page_theme_mods['archive-page'] ); ?>><?php echo esc_html( $data_name ); ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <?php foreach ( $post_types as $key => $post_type ) { 
                $post_type_theme_mods  = get_option( mtmh()->getPrefixedThemeOptionName( "{$key}_page_theme_mods" ), 'current' );
            ?>
                <tr>
                    <th><label for="<?php echo esc_attr( "{$key}-theme-mods" ); ?>">
                        <strong><?php echo esc_html( $post_type->label ); ?></strong>
                    </label></th>
                    <td>
                        <select id="<?php echo esc_attr( "{$key}-theme-mods" ); ?>" name="<?php echo esc_attr( "filter-theme-mods[{$key}-page]" ); ?>">
                            <option value="current"><?php esc_html_e( 'Current', 'mtmh' ); ?></option>
                            <?php foreach ( $theme_mods_list as $data ) {
                                $data_name  = $data['name'];
                                $data_index = $data['index'];
                            ?>
                                <option value="<?php echo esc_attr( $data_index ); ?>" <?php selected( $data_index, $each_page_theme_mods["{$key}-page"] ); ?>><?php echo esc_html( $data_name ); ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            <?php } ?>

            <tr>
                <th><input type="submit" name="filter-theme-mods[set]" class="button button-primary" value="<?php esc_attr_e( 'Filter Theme Mods', 'mtmh' ); ?>"/></th>
            </tr>

        </tbody>
    </table>

    

</form>
