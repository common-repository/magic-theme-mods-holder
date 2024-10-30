<?php


class WPTMHMetaBox {

    private static $instance = null;

    private $postTypes = array();

    public static function getInstance()
    {
        if ( null === self::$instance ) self::$instance = new Self();
        return self::$instance;
    }

    private function __construct()
    {
        $this->initVars();
        $this->initHook();
    }

    private function initVars()
    {
        $this->postTypes = get_post_types( array( 'public' => true ) );
    }

    private function initHook()
    {

        add_action( 'save_post', [ $this, 'update' ] );
        add_action( 'add_meta_boxes', [ $this, 'addMetaBox' ] );

    }

    /**
     * Update
     * @param int $post_id
     */
    public function update( $post_id )
    {
        require_once( 'exec/updates/metabox.php' );
    }

    /**
     * Add Metaboxes
     * @param string $post_type
     * @param object $post
    **/
    public function addMetaBox( $post_type = '', $post = '' ) {

        if ( ! in_array( $post_type, $this->postTypes ) 
            || 'add_meta_boxes' !== current_filter()
        ) {
            return;
        }

        add_meta_box(
            'mtmh_theme_mods',
            __( 'Theme Mods', 'mtmh' ),
            [ $this, 'render' ],
            $post_type,
            'side',
            'default',
            []
        );

    }

    public function render( $post, $args = [] )
    {
        require_once( 'views/metabox.php' );
    }

}
