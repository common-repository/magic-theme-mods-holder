<?php

class WPTMHFilters {

    private static $instance = null;

    private $themeMods = array();
    private $filterThemeMods = '';

    public static function getInstance()
    {
        if ( null === self::$instance ) self::$instance = new Self();
        return self::$instance;
    }

    private function __construct() 
    {
        add_action( 'wp', [ $this, 'init' ], 0 );
    }

    function init()
    {
        if ( is_customize_preview() ) return;

        $theme_slug = get_option( 'stylesheet' );
        $this->filterThemeMods = "option_theme_mods_{$theme_slug}";

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
        $this->eachPageThemeMods = wp_parse_args( $each_page_theme_mods, $defaults );


        if ( is_home() && is_front_page() ) {

        } elseif ( is_front_page() ) {
            $this->initEachPageThemeMods( 'front' );
        } elseif ( is_home() ) { 
            $this->initEachPageThemeMods( 'home' );
        } elseif ( is_singular() ) {
            $this->initEachPageThemeMods( 'singular' );
            $this->initSingularVars();
        } elseif ( is_archive() ) {
            $this->initEachPageThemeMods( 'archive' );
        }

        add_filter( $this->filterThemeMods, [ $this, 'filterThemeMods' ] );

    }

    function initEachPageThemeMods( $page_type )
    {
        $theme_mods_index = $this->eachPageThemeMods["{$page_type}-page"];
        if ( ! in_array( $theme_mods_index, [ null, false, 'none', 'current' ], true ) ) {
            $selected_theme_mods = get_option( mtmh()->getPrefixedThemeOptionName( "theme_mods_$theme_mods_index" ), '{}' );
            $selected_theme_mods = json_decode( $selected_theme_mods, true );
            if ( null !== $selected_theme_mods && is_array( $selected_theme_mods ) && 0 < count( $selected_theme_mods ) ) $this->themeMods = wp_parse_args( $selected_theme_mods, $this->themeMods );
        }
    }

    function initSingularVars()
    {
        global $post;
        $theme_mods_index = $this->eachPageThemeMods["{$post->post_type}-page"];
        if ( ! in_array( $theme_mods_index, [ null, false, 'none', 'current' ], true ) ) {
            $selected_theme_mods = get_option( mtmh()->getPrefixedThemeOptionName( "theme_mods_$theme_mods_index" ), '{}' );
            $selected_theme_mods = json_decode( $selected_theme_mods, true );
            if ( null !== $selected_theme_mods && is_array( $selected_theme_mods ) && 0 < count( $selected_theme_mods ) ) $this->themeMods = wp_parse_args( $selected_theme_mods, $this->themeMods );
        }

        // Get Post Meta
        $theme_mods_index = intval( get_post_meta( $post->ID, mtmh()->getPrefixedPostMetaName( 'selected_theme_mods' ), true ) );
        if ( in_array( $theme_mods_index, [ null, false, 'none', 'current' ], true ) ) return;
        $selected_theme_mods = get_option( mtmh()->getPrefixedThemeOptionName( "theme_mods_{$theme_mods_index}" ), '{}' );
        $selected_theme_mods = json_decode( $selected_theme_mods, true );
        if ( null !== $selected_theme_mods && is_array( $selected_theme_mods ) && 0 < count( $selected_theme_mods ) ) $this->themeMods = wp_parse_args( $selected_theme_mods, $this->themeMods );
    }

    function filterThemeMods( $theme_mods )
    {
        $theme_mods = wp_parse_args( $this->themeMods, $theme_mods );
        return $theme_mods;
    }

}