<?php 

	
	/**
	 * 功能：禁用google fonts(copy : www.frontopen.com)
	 * 说明：必需先加载require ('../wp-include/plugin.php'),因为调用add_filter()函数;
	 * 该php需放到wp-setting.php里require，因为基本上展示页面都会require wp-load.php
	 * 之后wp-load.php->wp-config.php->wp.settings.php
	 * 
	 * 
	 */
	class Disable_Google_Fonts {
		public function __construct() {
			add_filter( 'gettext_with_context', array( $this, 'disable_open_sans' ), 888, 4 );
		}
		public function disable_open_sans( $translations, $text, $context, $domain ) {
			if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
				$translations = 'off';
			}
			return $translations;
		}
	}
	$disable_google_fonts = new Disable_Google_Fonts;
	$disable_google_fonts =null;//释放对象
 ?>