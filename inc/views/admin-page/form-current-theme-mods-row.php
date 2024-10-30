<?php
//$theme_mods_data
$theme_mods_name  = $theme_mods_data['name'];
$theme_mods_desc  = $theme_mods_data['desc'];
$theme_mods_index = $theme_mods_data['index'];
$theme_mods_nav   = isset( $theme_mods_data['nav'] ) && 'on' === $theme_mods_data['nav'] ? 'on' : '';
?>

<tr>

    <th class="check-column">
        <input type="radio" name="selected-theme-mods" class="regular-checkbox selected-tm" value="<?php echo esc_attr( $theme_mods_index ); ?>" />
    </th>
    <td><p><?php echo esc_html( $theme_mods_name ); ?></p></td>
    <td><p><?php echo esc_html( $theme_mods_desc ); ?></p></td>
    <td><p><?php echo esc_html( 'on' === $theme_mods_nav ? 'With Nav Menu' : 'Without Nav Menu' ); ?></p></td>

</tr>


