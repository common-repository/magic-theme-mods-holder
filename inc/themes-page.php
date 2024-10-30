<?php

class WPTMHThemesPage {
    
    private static $instance = null;

    public static function getInstance() 
    {
        if ( null === self::$instance ) self::$instance = new Self();
        return self::$instance;
    }

    private function __construct()
    {
        $this->initHooks();
    }

    function initHooks()
    {
        add_action( 'admin_menu', [ $this, 'adminMenu' ] );
        add_action( 'admin_init', [ $this, 'update' ] );
    }

    function adminMenu()
    {
        add_theme_page(
            __( 'Theme Mods Holder', MagicThemeModsHolder::TEXTDOMAIN ),
            __( 'Theme Mods Holder', MagicThemeModsHolder::TEXTDOMAIN ),
            'manage_options',
            'mtmh',
            [ $this, 'renderPage' ]
        );

    }

    /**
     * Views
     */
        function renderPage()
        {
            require_once( 'views/admin-page.php' );
        }

    /**
     * Updates
     */
        function update()
        {
            if ( isset( $_POST['current-theme-mods'] ) ) require_once( 'exec/updates/admin-page/register-theme-mods.php' );
            elseif ( isset( $_POST['update-theme-mods-list'] ) ) require_once( 'exec/updates/admin-page/update-table.php' );
            elseif ( isset( $_POST['set-current-theme-mods'] ) ) require_once( 'exec/updates/admin-page/set-current-theme-mods.php' );
            elseif ( isset( $_POST['remove-current-theme-mods'] ) ) require_once( 'exec/updates/admin-page/remove-current-theme-mods.php' );
            elseif ( isset( $_POST['filter-theme-mods'] ) ) require_once( 'exec/updates/admin-page/filter-theme-mods.php' );
        }

        function updateTable()
        {
            require_once( 'exec/updates/admin-page/update-table.php' );
        }

        function registerCurrentThemeMods()
        {
            require_once( 'exec/updates/admin-page/register-theme-mods.php' );
        }


    /**
     * Sanitizer
     */
        function sanitizeRegisteredThemeModsData( $input )
        {

            $new_input = [];
            if( isset( $input['name'] ) )
                $new_input['name'] = sanitizeThemeModsName( $input['name'] );
    
            if( isset( $input['desc'] ) )
                $new_input['desc'] = sanitizeThemeModsDescription( $input['desc'] );
    
            return $new_input;
        }

        function sanitizeThemeModsName( $name )
        {
            $sanitized = sanitize_text_field( $name );
            return $sanitized;
        }

        function sanitizeThemeModsDescription( $desc )
        {
            $sanitized = sanitize_text_field( $desc );
            return $sanitized;
        }

}

