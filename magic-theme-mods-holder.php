<?php
/**
 * Magic Theme Mods Holder
 * 
 * @package     Magic Theme Mods Holder
 * @author      Nora0123456789
 * @copyright   2018 Nora https://wp-works.com
 * @license     
 * 
 * @wordpress-plugin
 * Plugin Name: Magic Theme Mods Holder
 * Description: Magic Theme Mods Holder
 * Version: 1.0.0
 * Author: nora0123456789
 * Author URI: https://wp-works.com
 * Text Domain: mtmh
 * Domain Path: /i18n/languages
**/

if ( ! defined( 'ABSPATH' ) ) exit;

require_once( 'inc/class-mtmh.php' );

function mtmh()
{
    global $mtmh;
    $mtmh = MagicThemeModsHolder::getInstance();
    return $mtmh;
}
global $mtmh;
$mtmh = mtmh();

