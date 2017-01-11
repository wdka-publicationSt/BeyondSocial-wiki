<?php
/**
 * BeyondSocial - This skin is developed for the project Beyond Social, 
 * in the context of the Willem de Kooning Academy in Rotterdam. 
 * The skin is very much based on the Vector skin.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup Skins
 */

/**
 * SkinTemplate class for BeyondSocial skin
 * @ingroup Skins
 */
class SkinBeyondSocial extends SkinTemplate {
	public $skinname = 'beyondsocial';
	public $stylename = 'BeyondSocial';
	public $template = 'BeyondSocialTemplate';
	/**
	 * @var Config
	 */
	private $beyondsocialConfig;

	public function __construct() {
		$this->beyondsocialConfig = ConfigFactory::getDefaultInstance()->makeConfig( 'beyondsocial' );
	}

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param OutputPage $out Object to initialize
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

		if ( $this->beyondsocialConfig->get( 'BeyondSocialResponsive' ) ) {
			$out->addMeta( 'viewport', 'width=device-width, initial-scale=1, maximum-scale=1' );
			$out->addModuleStyles( 'skins.beyondsocial.styles.responsive' );
		}

		$out->addModules( 'skins.beyondsocial.js' );
	}

	/**
	 * Loads skin and user CSS files.
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$styles = [ 'mediawiki.skinning.interface', 'skins.beyondsocial.styles' ];
		Hooks::run( 'SkinBeyondSocialStyleModules', [ $this, &$styles ] );
		$out->addModuleStyles( $styles );
	}

	/**
	 * Override to pass our Config instance to it
	 */
	public function setupTemplate( $classname, $repository = false, $cache_dir = false ) {
		return new $classname( $this->beyondsocialConfig );
	}
}
