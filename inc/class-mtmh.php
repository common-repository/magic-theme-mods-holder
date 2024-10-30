<?php
final class MagicThemeModsHolder {

    const TEXTDOMAIN   = 'mtmh';
    const UNIQUE_KEY   = 'mtmh';

    const OPTION_KEY   = 'theme_mods_list';
    const POSTMETA_KEY = 'theme_mods';

    private static $instance = null;
    
    
	/** 
	 * Properties
	**/
		/**
		 * Theme Data
		 * @var array
		**/
		private $themeDirName = '';

		/**
		 * Get Theme Data
		 * @param string $key
		 * @return mixed
		 */
		public function getThemeDir()
		{
			if ( empty( $this->themeDirName ) ) {
				return false;
			}
			return $this->themeDirName;
		}


    public static function getInstance()
    {
        if ( null === self::$instance ) self::$instance = new Self();
        return self::$instance;
    }

    private function __construct()
    {
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    function init() 
    {
        $this->inc();
        $this->initVars();
        $this->initClasses();
    }

    private function inc()
    {
        require_once( 'themes-page.php' );
        require_once( 'metabox.php' );
        require_once( 'filters.php' );
    }

    private function initVars()
    {
        $this->themeDirName = preg_replace( '/[^0-9a-zA-Z\_]/i', '_', basename( get_template_directory_uri() ) );
    }

    private function initClasses()
    {
        $this->filters   = WPTMHFilters::getInstance();
        if ( is_admin() ) {
            $this->adminPage = WPTMHThemesPage::getInstance();
            $this->metabox   = WPTMHMetaBox::getInstance();
        }
    }

    /**
	 * Tools
	**/
		/**
		 * Sanitize unique prefix
		 * @param  [string] $prefix
		 * @param  [string] $sep
		 * @return [string]
		**/
		public function sanitizeUniquePrefix( $prefix, $sep = '_' )
		{
			return strtolower( preg_replace( '/[^a-zA-Z0-9]+/i', $sep, $prefix ) );
		}

		/**
		 * Sanitize unique prefix
		 * @param  [string] $prefix
		 * @param  [string] $sep
		 * @return [string]
		**/
		public function sanitizeInputNamePrefix( $prefix, $sep = '_' )
		{

			return strtolower( preg_replace( '/[^a-zA-Z0-9\[\]]+/i', $sep, $prefix ) );

		}

		/**
		 * Returns the key
		 * @uses  [string] self::UNIQUE_KEY
		 * @return [string]
		**/
		public function getPrefixKey()
		{
			return self::UNIQUE_KEY;
		}

		/**
		 * Returns the key
		 * @uses  [string] $this->theme_data['Name']
		 * @return [string]
		**/
		public function getThemePrefixKey()
		{
			return str_replace( array( ' ', '-' ), '_', strtolower( self::UNIQUE_KEY . '_' . $this->themeDirName ) );
		}

		/**
		 * Get prefixed name
		 * @param  [string] $name
		 * @param  [string] $sep
		 * @return [string]
		**/
		public function getPrefixedName( $name, $sep = '_' )
		{

			return $this->sanitizeUniquePrefix( implode( $sep, array(
				self::UNIQUE_KEY,
				$name
			) ), $sep );

		}

		/**
		 * Get prefixed name with theme name
		 * @param  [string] $name
		 * @param  [string] $sep
		 * @return [string]
		**/
		public function getThemePrefixedName( $name, $sep = '_' )
		{
			return $this->sanitizeUniquePrefix( implode( $sep, array(
				self::UNIQUE_KEY,
				$this->themeDirName,
				$name
			) ), $sep );
		}

		/**
		 * Get prefixed option name
		 * @param  [string] $name
		 * @param  [string] $sep
		 * @return [string]
		**/
		public function getPrefixedOptionName( $name, $sep = '_' )
		{
			return $this->sanitizeInputNamePrefix( implode( $sep, array(
				self::UNIQUE_KEY,
				$name
			) ), $sep );
		}

		/**
		 * Get prefixed option name
		 * @param  [string] $name
		 * @param  [string] $sep
		 * @return [string]
		**/
		public function getPrefixedThemeOptionName( $name, $sep = '_' )
		{
			return $this->sanitizeInputNamePrefix( implode( $sep, array(
				self::UNIQUE_KEY,
				$this->themeDirName,
				$name
			) ), $sep );
		}

		/**
		 * Get prefixed option name
		 * @param  [string] $name
		 * @param  [string] $sep
		 * @return [string]
		**/
		public function getPrefixedPostMetaName( $name, $sep = '_' )
		{
			return $this->sanitizeInputNamePrefix( '_' . implode( $sep, array(
				self::UNIQUE_KEY,
				$name
			) ), $sep );
		}

		/**
		 * Get prefixed option name
		 * @param  [string] $name
		 * @param  [string] $sep
		 * @return [string]
		**/
		public function getPrefixedThemePostMetaName( $name, $sep = '_' )
		{
			return $this->sanitizeInputNamePrefix( '_' . implode( $sep, array(
				self::UNIQUE_KEY,
				$this->themeDirName,
				$name
			) ), $sep );
		}

		/**
		 * Get prefixed action hook
		 * @param  [string] $name
		 * @param  [string] $sep
		 * @return [string]
		**/
		public function getPrefixedActionHook( $name, $sep = '_' )
		{
			return $this->sanitizeUniquePrefix( implode( $sep, array(
				self::UNIQUE_KEY,
				'action',
				$name
			) ), $sep );
		}

		/**
		 * Get prefixed filter hook
		 * @param  [string] $name
		 * @param  [string] $sep
		 * @return [string]
		**/
		public function getPrefixedFilterHook( $name, $sep = '_' )
		{
			return $this->sanitizeUniquePrefix( implode( $sep, array(
				self::UNIQUE_KEY,
				'filter',
				$name
			) ), $sep );
		}



}
