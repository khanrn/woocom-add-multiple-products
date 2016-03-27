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
$extensions = $this->register_extensions();
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
	<h1>
		<?php echo get_admin_page_title() ?>
		<span class="title-count theme-count"><?php echo count( $extensions ); ?></span>
	</h1>
	<br>
	<div class="theme-browser">
		<div class="themes">
			<?php foreach( $extensions as $slug => $info ) : ?>
				<div class="theme">
					<?php if ( !empty( $info['img_url'] ) ) : ?>
						<div class="theme-screenshot">
							<a target="_blank" href="<?php echo esc_url( $info['url'] ) ?>"><img src="<?php echo esc_url( $info['img_url'] ) ?>"></a>
						</div>
					<?php else : ?>
						<div class="theme-screenshot blank"></div>
					<?php endif; ?>

					<div class="theme-author"></div>

					<h2 class="theme-name" id="<?php echo esc_attr( $slug ) ?>"><span><?php echo esc_attr( $info['name'] ) ?></span></h2>
					<div class="theme-actions">
						<a class="button button-primary" target="_blank" href="<?php echo esc_url( $info['url'] ) ?>"><?php _e( 'Get It Now!', 'dwqa' ); ?></a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>