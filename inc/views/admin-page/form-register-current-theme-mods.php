<?php

?>
<form method="post" action="themes.php?page=mtmh">

    <?php wp_nonce_field( mtmh()->getPrefixedOptionName( 'register_theme_mods' ), mtmh()->getPrefixedOptionName( 'register_theme_mods_nonce' ) ); ?>

    <table class="form-table">
        <caption>
            <?php esc_html_e( 'Register Current Theme Mods Settings with an label and description.', 'mtmh' ); ?>
        </caption>
        <tbody>

            <tr>
                <th><label for="current-theme-mods-name">
                    <strong><?php esc_html_e( 'Name', 'mtmh' ); ?></strong>
                </label></th>
                <td><input id="current-theme-mods-name" name="current-theme-mods[name]" type="text" required /></td>
            </tr>

            <tr>
                <th><label for="current-theme-mods-desc">
                    <strong><?php esc_html_e( 'Description', 'mtmh' ); ?></strong>
                </label></th>
                <td><input id="current-theme-mods-desc" name="current-theme-mods[desc]" type="text"/></td>
            </tr>

            <tr>
                <th><label for="current-theme-mods-nav">
                    <strong><?php esc_html_e( 'With Nav Menu?', 'mtmh' ); ?></strong>
                </label></th>
                <td><input id="current-theme-mods-nav" name="current-theme-mods[nav]" type="checkbox" value="on"/></td>
            </tr>

            <tr>
                <th><input type="submit" name="current-theme-mods[register]" class="button button-primary" value="<?php esc_attr_e( 'Register Current Theme Mods', 'mtmh' ); ?>"/></th>
            </tr>

        </tbody>
    </table>

    

</form>
