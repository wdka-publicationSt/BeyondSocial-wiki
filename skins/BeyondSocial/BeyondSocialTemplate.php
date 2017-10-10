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
 * QuickTemplate class for BeyondSocial skin
 * @ingroup Skins
 */
class BeyondSocialTemplate extends BaseTemplate {
	/* Functions */

	/**
	 * Outputs the entire contents of the (X)HTML page
	 */
	public function execute() {
		// Build additional attributes for navigation urls
		$nav = $this->data['content_navigation'];

		if ( $this->config->get( 'BeyondSocialUseIconWatch' ) ) {
			$mode = $this->getSkin()->getUser()->isWatched( $this->getSkin()->getRelevantTitle() )
				? 'unwatch'
				: 'watch';

			if ( isset( $nav['actions'][$mode] ) ) {
				$nav['views'][$mode] = $nav['actions'][$mode];
				$nav['views'][$mode]['class'] = rtrim( 'icon ' . $nav['views'][$mode]['class'], ' ' );
				$nav['views'][$mode]['primary'] = true;
				unset( $nav['actions'][$mode] );
			}
		}

		$xmlID = '';
		foreach ( $nav as $section => $links ) {
			foreach ( $links as $key => $link ) {
				if ( $section == 'views' && !( isset( $link['primary'] ) && $link['primary'] ) ) {
					$link['class'] = rtrim( 'collapsible ' . $link['class'], ' ' );
				}

				$xmlID = isset( $link['id'] ) ? $link['id'] : 'ca-' . $xmlID;
				$nav[$section][$key]['attributes'] =
					' id="' . Sanitizer::escapeId( $xmlID ) . '"';
				if ( $link['class'] ) {
					$nav[$section][$key]['attributes'] .=
						' class="' . htmlspecialchars( $link['class'] ) . '"';
					unset( $nav[$section][$key]['class'] );
				}
				if ( isset( $link['tooltiponly'] ) && $link['tooltiponly'] ) {
					$nav[$section][$key]['key'] =
						Linker::tooltip( $xmlID );
				} else {
					$nav[$section][$key]['key'] =
						Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( $xmlID ) );
				}
			}
		}
		$this->data['namespace_urls'] = $nav['namespaces'];
		$this->data['view_urls'] = $nav['views'];
		$this->data['action_urls'] = $nav['actions'];
		$this->data['variant_urls'] = $nav['variants'];

		// Reverse horizontally rendered navigation elements
		if ( $this->data['rtl'] ) {
			$this->data['view_urls'] =
				array_reverse( $this->data['view_urls'] );
			$this->data['namespace_urls'] =
				array_reverse( $this->data['namespace_urls'] );
			$this->data['personal_urls'] =
				array_reverse( $this->data['personal_urls'] );
		}

		$this->data['pageLanguage'] =
			$this->getSkin()->getTitle()->getPageViewLanguage()->getHtmlCode();

		// Output HTML Page
		$this->html( 'headelement' );
		?>
		<div id="mw-page-base" class="noprint"></div>
		<div id="mw-head-base" class="noprint"></div>


		<div id="wrapper">
			<div id="container">
				<!-- *************************************** -->
				<!-- ** order of nav & content is swapped ** -->
				<!-- *************************************** -->
				<div id="mw-navigation">

					<!-- *************************************** -->
					<!-- *** personal menu moved to here     *** -->
					<!-- *************************************** -->		
					<?php $this->renderNavigation( 'PERSONAL' ); ?>

					<!-- *************************************** -->
					<!-- *** Beyond Social Title added       *** -->
					<!-- *************************************** -->
					<a id="bs-title-link" href="<?php $this->text( 'scriptpath' ); ?>"><div id="bs-title"><?php $this->text( 'sitename' ); ?></div></a>
					<div id="bs-title-tagline">platform for researching social design</div>
					
					<!-- *************************************** -->
					<!-- *** personal menu removed here      *** -->
					<!-- *************************************** -->	

					<!-- ****************************************** -->
					<!-- *** mw-head (now sidebar) removed here *** -->
					<!-- ****************************************** -->	

					<!-- *************************************** -->
					<!-- *** mw-Panel removed here (=Footer now)*** -->
					<!-- *************************************** -->
				</div>

				<div id="content" class="mw-body" role="main">
					<a id="top"></a>

					<?php
					if ( $this->data['sitenotice'] ) {
						?>
						<div id="siteNotice"><?php $this->html( 'sitenotice' ) ?></div>
					<?php
					}
					?>
					<?php
					if ( is_callable( [ $this, 'getIndicators' ] ) ) {
						echo $this->getIndicators();
					}
					// Loose comparison with '!=' is intentional, to catch null and false too, but not '0'
					if ( $this->data['title'] != '' ) {
					?>
					<h1 id="firstHeading" class="firstHeading" lang="<?php $this->text( 'pageLanguage' ); ?>"><?php
						 $this->html( 'title' )
					?></h1>

					<?php
					} ?>
					<?php $this->html( 'prebodyhtml' ) ?>
					<div id="bodyContent" class="mw-body-content">
						<?php
						if ( $this->data['isarticle'] ) {
							?>
							<div id="siteSub"><?php $this->msg( 'tagline' ) ?></div>
						<?php
						}
						?>
						<div id="contentSub"<?php $this->html( 'userlangattributes' ) ?>><?php
							$this->html( 'subtitle' )
						?></div>
						<?php
						if ( $this->data['undelete'] ) {
							?>
							<div id="contentSub2"><?php $this->html( 'undelete' ) ?></div>
						<?php
						}
						?>
						<?php
						if ( $this->data['newtalk'] ) {
							?>
							<div class="usermessage"><?php $this->html( 'newtalk' ) ?></div>
						<?php
						}
						?>
						<!--  jump to nav removed here  -->
						<?php
						$this->html( 'bodycontent' );
						// printfooter() REMOVED HERE
						// CAT LINKS REMOVED HERE
						// dataAfterContent REMOVED HERE
						?>
						<div class="visualClear"></div>
						<?php $this->html( 'debughtml' ); ?>
					</div>
				</div>
				<!-- ***************************************** -->
				<!-- *** mw-head (=now sidebar) moved to here *** -->
				<!-- ***************************************** -->
				<div id="mw-head">
					<div id="left-navigation">
						<?php $this->renderNavigation( [ 'NAMESPACES', 'VARIANTS' ] ); ?>
					</div>

					<div id="right-navigation">
						<?php $this->renderNavigation( [ 'VIEWS', 'ACTIONS' ] ); ?>
						<?php $this->renderNavigation( [ 'SEARCH' ] ); ?>
					</div>

					<div id="page-info">
					<!-- ********************************************** -->
					<!-- *** Footer info moved to here as page info *** -->
					<!-- ********************************************** -->
						<!-- "This page is last modifief by ..." -->
						<!-- List with Footer Links -->
						<?php
						foreach ( $this->getFooterLinks() as $category => $links ) {
							?>
							<ul id="page-info-<?php echo $category ?>">
								<?php
								foreach ( $links as $link ) {
									?>
									<li id="page-info-<?php echo $category ?>-<?php echo $link ?>"><?php $this->html( $link ) ?></li>
								<?php
								}
								?>
							</ul>
						<?php
						}
						?>
						<!-- ****************************** -->
						<!-- *** CATLINKS moved to here *** -->
						<!-- ****************************** -->
						<?php
							if ( $this->data['catlinks'] ) {
								$this->html( 'catlinks' );
							}
						?>
					</div>
				</div>
			</div> <!-- end of container -->

			<!-- ***************************************** -->
			<!-- *** mw-panel (=Footer now) moved to here *** -->
			<!-- *** used as footer                    *** -->
			<!-- ***************************************** -->
			<div id="mw-panel">
				<!-- *************************************** -->
				<!-- *** 'SEARCH' added here             *** -->
				<!-- *************************************** -->
				<?php $this->renderNavigation( [ 'SEARCH' ] ); ?>

				<!-- *************************************** -->
				<!-- *** footericons added here          *** -->
				<!-- *************************************** -->
				<?php $footericons = $this->getFooterIcons( 'icononly' );
				if ( count( $footericons ) > 0 ) {
					?>
					<ul id="footer-icons" class="noprint">
						<?php
						foreach ( $footericons as $blockName => $footerIcons ) {
							?>
							<li id="footer-<?php echo htmlspecialchars( $blockName ); ?>ico">
								<?php
								foreach ( $footerIcons as $icon ) {
									echo $this->getSkin()->makeFooterIcon( $icon );
								}
								?>
							</li>
						<?php
						}
						?>
						<li><a href="http://www.wdka.nl/" target="_blank"><img width="50px" src="/wiki/skins/BeyondSocial/images/wdkalogo_bw.svg"></a></li>
						<li><a href="http://www.wdka.nl/" target="_blank"><img width="50px" src="/wiki/skins/BeyondSocial/images/wdkalogo_2.svg"></a></li>
						<li><a href="https://www.wdka.nl/research/hybrid-publishing" target="_blank"><img width="50px" src="/wiki/skins/BeyondSocial/images/HP_Logo.jpeg"></a></li>
					</ul>
				<?php
				}
				?>			

				<div id="p-logo" role="banner"><a class="mw-wiki-logo" href="<?php
					echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] )
					?>" <?php
					echo Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( 'p-logo' ) )
					?>></a></div>

				<?php $this->renderPortals( $this->data['sidebar'] ); ?>
			</div>


			<div id="footer" role="contentinfo"<?php $this->html( 'userlangattributes' ) ?>>

				<!-- FOOTER INFO HERE REMOVED -->
				<!-- FOOTER ICONS HERE REMOVED -->

			</div>
			<?php $this->printTrail(); ?>

		</div> <!-- end of wrapper -->
	</body>
</html>
<?php
	}

	/**
	 * Render a series of portals
	 *
	 * @param array $portals
	 */
	protected function renderPortals( $portals ) {
		// Force the rendering of the following portals
		if ( !isset( $portals['SEARCH'] ) ) {
			$portals['SEARCH'] = true;
		}
		if ( !isset( $portals['TOOLBOX'] ) ) {
			$portals['TOOLBOX'] = true;
		}
		if ( !isset( $portals['LANGUAGES'] ) ) {
			$portals['LANGUAGES'] = true;
		}
		// Render portals
		foreach ( $portals as $name => $content ) {
			if ( $content === false ) {
				continue;
			}

			// Numeric strings gets an integer when set as key, cast back - T73639
			$name = (string)$name;

			switch ( $name ) {
				case 'SEARCH':
					break;
				case 'TOOLBOX':
					$this->renderPortal( 'tb', $this->getToolbox(), 'toolbox', 'SkinTemplateToolboxEnd' );
					break;
				case 'LANGUAGES':
					if ( $this->data['language_urls'] !== false ) {
						$this->renderPortal( 'lang', $this->data['language_urls'], 'otherlanguages' );
					}
					break;
				default:
					$this->renderPortal( $name, $content );
					break;
			}
		}
	}

	/**
	 * @param string $name
	 * @param array $content
	 * @param null|string $msg
	 * @param null|string|array $hook
	 */
	protected function renderPortal( $name, $content, $msg = null, $hook = null ) {
		if ( $msg === null ) {
			$msg = $name;
		}
		$msgObj = wfMessage( $msg );
		$labelId = Sanitizer::escapeId( "p-$name-label" );
		?>
		<div class="portal" role="navigation" id='<?php
		echo Sanitizer::escapeId( "p-$name" )
		?>'<?php
		echo Linker::tooltip( 'p-' . $name )
		?> aria-labelledby='<?php echo $labelId ?>'>
			<h3<?php $this->html( 'userlangattributes' ) ?> id='<?php echo $labelId ?>'><?php
				echo htmlspecialchars( $msgObj->exists() ? $msgObj->text() : $msg );
				?></h3>

			<div class="body">
				<?php
				if ( is_array( $content ) ) {
					?>
					<ul>
						<?php
						foreach ( $content as $key => $val ) {
							echo $this->makeListItem( $key, $val );
						}
						if ( $hook !== null ) {
							Hooks::run( $hook, [ &$this, true ] );
						}
						?>
					</ul>
				<?php
				} else {
					echo $content; /* Allow raw HTML block to be defined by extensions */
				}

				$this->renderAfterPortlet( $name );
				?>
			</div>
		</div>
	<?php
	}

	/**
	 * Render one or more navigations elements by name, automatically reveresed
	 * when UI is in RTL mode
	 *
	 * @param array $elements
	 */
	protected function renderNavigation( $elements ) {
		// If only one element was given, wrap it in an array, allowing more
		// flexible arguments
		if ( !is_array( $elements ) ) {
			$elements = [ $elements ];
			// If there's a series of elements, reverse them when in RTL mode
		} elseif ( $this->data['rtl'] ) {
			$elements = array_reverse( $elements );
		}
		// Render elements
		foreach ( $elements as $name => $element ) {
			switch ( $element ) {
				case 'NAMESPACES':
					?>
					<div id="p-namespaces" role="navigation" class="beyondsocialTabs<?php
					if ( count( $this->data['namespace_urls'] ) == 0 ) {
						echo ' emptyPortlet';
					}
					?>" aria-labelledby="p-namespaces-label">
						<h3 id="p-namespaces-label"><?php $this->msg( 'namespaces' ) ?></h3>
						<ul<?php $this->html( 'userlangattributes' ) ?>>
							<?php
							foreach ( $this->data['namespace_urls'] as $link ) {
								?>
								<li <?php echo $link['attributes'] ?>><span><a href="<?php
										echo htmlspecialchars( $link['href'] )
										?>" <?php
										echo $link['key'];
										if ( isset ( $link['rel'] ) ) {
											echo ' rel="' . htmlspecialchars( $link['rel'] ) . '"';
										}
										?>><?php
											echo htmlspecialchars( $link['text'] )
											?></a></span></li>
							<?php
							}
							?>
						</ul>
					</div>
					<?php
					break;
				case 'VARIANTS':
					?>
					<div id="p-variants" role="navigation" class="beyondsocialMenu<?php
					if ( count( $this->data['variant_urls'] ) == 0 ) {
						echo ' emptyPortlet';
					}
					?>" aria-labelledby="p-variants-label">
						<?php
						// Replace the label with the name of currently chosen variant, if any
						$variantLabel = $this->getMsg( 'variants' )->text();
						foreach ( $this->data['variant_urls'] as $link ) {
							if ( stripos( $link['attributes'], 'selected' ) !== false ) {
								$variantLabel = $link['text'];
								break;
							}
						}
						?>
						<h3 id="p-variants-label">
							<span><?php echo htmlspecialchars( $variantLabel ) ?></span><a href="#"></a>
						</h3>

						<div class="menu">
							<ul>
								<?php
								foreach ( $this->data['variant_urls'] as $link ) {
									?>
									<li<?php echo $link['attributes'] ?>><a href="<?php
										echo htmlspecialchars( $link['href'] )
										?>" lang="<?php
										echo htmlspecialchars( $link['lang'] )
										?>" hreflang="<?php
										echo htmlspecialchars( $link['hreflang'] )
										?>" <?php
										echo $link['key']
										?>><?php
											echo htmlspecialchars( $link['text'] )
											?></a></li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
					<?php
					break;
				case 'VIEWS':
					?>
					<div id="p-views" role="navigation" class="beyondsocialTabs<?php
					if ( count( $this->data['view_urls'] ) == 0 ) {
						echo ' emptyPortlet';
					}
					?>" aria-labelledby="p-views-label">
						<h3 id="p-views-label"><?php $this->msg( 'views' ) ?></h3>
						<ul<?php $this->html( 'userlangattributes' ) ?>>
							<?php
							foreach ( $this->data['view_urls'] as $link ) {
								?>
								<li<?php echo $link['attributes'] ?>><span><a href="<?php
										echo htmlspecialchars( $link['href'] )
										?>" <?php
										echo $link['key'];
										if ( isset ( $link['rel'] ) ) {
											echo ' rel="' . htmlspecialchars( $link['rel'] ) . '"';
										}
										?>><?php
											// $link['text'] can be undefined - bug 27764
											if ( array_key_exists( 'text', $link ) ) {
												echo array_key_exists( 'img', $link )
													? '<img src="' . $link['img'] . '" alt="' . $link['text'] . '" />'
													: htmlspecialchars( $link['text'] );
											}
											?></a></span></li>
							<?php
							}
							?>

							<!-- *************************************** -->
							<!-- *** p-cactions moved to this <UL>   *** -->
							<!-- *************************************** -->
							<?php
								foreach ( $this->data['action_urls'] as $link ) {
							?>
								<li
									<?php 
										echo $link['attributes'] 
									?>>
									<!-- *************************************** -->
									<!-- *** span element added here         *** -->
									<!-- *************************************** -->
									<span>
										<a href="<?php echo htmlspecialchars( $link['href'] ) ?>"<?php echo $link['key'] ?>>
										<?php 
											echo htmlspecialchars( $link['text'] )
										?>
										</a>
									</span>
								</li>
							<?php
								}
							?>
							<!-- ***************************************************** -->
							<!-- *** added the share option here, thanks Template! *** -->
							<!-- ***************************************************** -->
							<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
							<li id="share">
								<span id="shareButtons">Share
									<a target="_blank" id="shareTwitter" href="">
										<i class="fa fa-twitter-square" aria-hidden="true"></i>
									</a>
									<a href="" id="shareFacebook" target="_blank">
										<i class="fa fa-facebook-square" aria-hidden="true"></i>
									</a>
								</span>
							</li>
							<!-- *********************************** -->
							<!-- *** added the print option here *** -->
							<!-- *********************************** -->
							<li id="print">
								<a id="printButton" href="javascript:window.print()">Print</a>
							</li>
						</ul>
					</div>

					<?php
					break;
				case 'PERSONAL':
					?>
					<div id="p-personal" role="navigation" class="<?php
					if ( count( $this->data['personal_urls'] ) == 0 ) {
						echo ' emptyPortlet';
					}
					?>" aria-labelledby="p-personal-label">
						<h3 id="p-personal-label"><?php $this->msg( 'personaltools' ) ?></h3>
						<ul<?php $this->html( 'userlangattributes' ) ?>>
							<?php

							$notLoggedIn = '';

							if ( !$this->getSkin()->getUser()->isLoggedIn() &&
								User::groupHasPermission( '*', 'edit' ) ){

								$notLoggedIn =
									Html::rawElement( 'li',
										[ 'id' => 'pt-anonuserpage' ],
										$this->getMsg( 'notloggedin' )->escaped()
									);

							}

							$personalTools = $this->getPersonalTools();

							$langSelector = '';
							if ( array_key_exists( 'uls', $personalTools ) ) {
								$langSelector = $this->makeListItem( 'uls', $personalTools[ 'uls' ] );
								unset( $personalTools[ 'uls' ] );
							}

							if ( !$this->data[ 'rtl' ] ) {
								echo $langSelector;
								echo $notLoggedIn;
							}

							foreach ( $personalTools as $key => $item ) {
								echo $this->makeListItem( $key, $item );
							}

							if ( $this->data[ 'rtl' ] ) {
								echo $notLoggedIn;
								echo $langSelector;
							}
							?>
						</ul>
					</div>
					<?php
					break;
				case 'SEARCH':
					?>
					<div id="p-search" role="search">
						<h3<?php $this->html( 'userlangattributes' ) ?>>
							<label for="searchInput"><?php $this->msg( 'search' ) ?></label>
						</h3>

						<form action="<?php $this->text( 'wgScript' ) ?>" id="searchform">
							<div<?php echo $this->config->get( 'BeyondSocialUseSimpleSearch' ) ? ' id="simpleSearch"' : '' ?>>
							<?php
							echo $this->makeSearchInput( [ 'id' => 'searchInput' ] );
							echo Html::hidden( 'title', $this->get( 'searchtitle' ) );
							// We construct two buttons (for 'go' and 'fulltext' search modes),
							// but only one will be visible and actionable at a time (they are
							// overlaid on top of each other in CSS).
							// * Browsers will use the 'fulltext' one by default (as it's the
							//   first in tree-order), which is desirable when they are unable
							//   to show search suggestions (either due to being broken or
							//   having JavaScript turned off).
							// * The mediawiki.searchSuggest module, after doing tests for the
							//   broken browsers, removes the 'fulltext' button and handles
							//   'fulltext' search itself; this will reveal the 'go' button and
							//   cause it to be used.
							echo $this->makeSearchButton(
								'fulltext',
								[ 'id' => 'mw-searchButton', 'class' => 'searchButton mw-fallbackSearchButton' ]
							);
							echo $this->makeSearchButton(
								'go',
								[ 'id' => 'searchButton', 'class' => 'searchButton' ]
							);
							?>
							</div>
						</form>
					</div>
					<?php

					break;
			}
		}
	}
}
