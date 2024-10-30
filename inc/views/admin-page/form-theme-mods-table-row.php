<?php
//$theme_mods_data
$theme_mods_name  = $theme_mods_data['name'];
$theme_mods_desc  = $theme_mods_data['desc'];
$theme_mods_index = $theme_mods_data['index'];
$theme_mods_nav   = isset( $theme_mods_data['nav'] ) && 'on' === $theme_mods_data['nav'] ? 'on' : '';
?>

<tr>

    <th class="check-column">
        <input type="checkbox" name="<?php echo esc_attr( sprintf( 'table-theme-mods-data[%d][delete]', $theme_mods_index ) ) ?>" class="regular-checkbox selected-tm-input" value="delete" />
        <input type="hidden" name="<?php echo esc_attr( sprintf( 'table-theme-mods-data[%d][index]', $theme_mods_index ) ) ?>" value="<?php echo esc_attr( $theme_mods_index ); ?>" />
    </th>
    <td><input type="text" name="<?php echo esc_attr( sprintf( 'table-theme-mods-data[%d][name]', $theme_mods_index ) ) ?>" value="<?php echo esc_attr( $theme_mods_name ); ?>" /></td>
    <td><input type="text" name="<?php echo esc_attr( sprintf( 'table-theme-mods-data[%d][desc]', $theme_mods_index ) ) ?>" value="<?php echo esc_attr( $theme_mods_desc ); ?>" /></td>
    <td><input type="checkbox" name="<?php echo esc_attr( sprintf( 'table-theme-mods-data[%d][nav]', $theme_mods_index ) ) ?>" value="on" <?php checked( 'on', $theme_mods_nav ); ?>" /></td>

</tr>


