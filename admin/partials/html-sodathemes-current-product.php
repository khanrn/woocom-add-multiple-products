<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://sodathemes.com
 * @since      2.0.0
 *
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap about-wrap">
	<h1><?php printf( __( 'Woocom Add Multiple Products %s' ), $this->version ); ?></h1>

	<div class="about-text" style="min-height: 0">
		<?php printf( __( 'Settings page is only available for pro version.' ), $this->version ); ?>
	</div>
	<a class="button button-primary" target="_blank" href="http://bit.ly/dwqa-markdown">Go Premium!</a>
	<div class="wp-badge" style="
	background-image: url(<?php echo plugin_dir_url('') . $this->sodathemes_wamp . '/admin/img/logo.png'?>);
    background-color: #284142;
    color: #fff;">SODATHEMES</div>
	
	<div class="headline-feature feature-section one-col" style="max-width: 100%">
		<h2 style="text-align: left"><?php _e( 'Woocom Add Multiple Products Pro' ); ?></h2>
		<div class="two-col">
			<div class="col">
				<h3><?php _e( 'Introducing Twenty Sixteen' ); ?></h3>
				<p><?php _e( 'Our newest default theme, Twenty Sixteen, is a modern take on a classic blog design.' ); ?></p>
				<p><?php _e( 'Twenty Sixteen was built to look great on any device. A fluid grid design, flexible header, fun color schemes, and more, will make your content shine.' ); ?></p>
				<div class="horizontal-image">
					<div class="content">
						<!-- <img class="feature-image horizontal-screen" src="https://s.w.org/images/core/4.4/twenty-sixteen-dark-fullsize-2x.png?2" alt=""  srcset="https://s.w.org/images/core/4.4/twenty-sixteen-dark-smartphone-1x.png?2 268w, https://s.w.org/images/core/4.4/twenty-sixteen-dark-smartphone-2x.png?2 535w, https://s.w.org/images/core/4.4/twenty-sixteen-dark-desktop-1x.png?2 558w, https://s.w.org/images/core/4.4/twenty-sixteen-dark-fullsize-1x.png?2 783w, https://s.w.org/images/core/4.4/twenty-sixteen-dark-desktop-2x.png?2 1116w, https://s.w.org/images/core/4.4/twenty-sixteen-dark-fullsize-2x.png?2 1566w" sizes="(max-width: 500px) calc((100vw - 40px) * .8), (max-width: 782px) calc((100vw - 70px) * .8), (max-width: 960px) calc((100vw - 116px) * .5216), (max-width: 1290px) calc((100vw - 240px) * .5216), 548px" /> -->
					</div>
				</div>
			</div>
			<div class="col feature-image">
				<!-- <img class="vertical-screen" src="https://s.w.org/images/core/4.4/twenty-sixteen-red-fullsize-2x.png" alt="" srcset="https://s.w.org/images/core/4.4/twenty-sixteen-red-smartphone-1x.png 107w, https://s.w.org/images/core/4.4/twenty-sixteen-red-smartphone-2x.png 214w, https://s.w.org/images/core/4.4/twenty-sixteen-red-desktop-1x.png 252w, https://s.w.org/images/core/4.4/twenty-sixteen-red-fullsize-1x.png 410w, https://s.w.org/images/core/4.4/twenty-sixteen-red-desktop-2x.png 504w, https://s.w.org/images/core/4.4/twenty-sixteen-red-fullsize-2x.png 820w" sizes="(max-width: 500px) calc((100vw - 40px) * .32), (max-width: 782px) calc((100vw - 70px) * .32), (max-width: 960px) calc((100vw - 116px) * .24), (max-width: 1290px) calc((100vw - 240px) * .24), 252px" /> -->
			</div>
		</div>
	</div>

	<hr />
</div>