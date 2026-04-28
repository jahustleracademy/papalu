<?php
/**
 * Options Page
 *
 * @package   Speed_Contact_Bar
 * @author    Kybernetik Services <wordpress@kybernetik.com.de>
 * @license   GPL-2.0+
 * @link      https://wordpress.org/plugins/speed-contact-bar/
 * @copyright 2021
 */

?>

<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<div class="th_wrapper">
		<div id="th_main">
			<div class="th_content">

				<form method="post" action="options.php">
<?php 
settings_fields( $this->settings_fields_slug );
do_settings_sections( $this->settings_section_slug );
submit_button();
?>
				</form>

			</div><!-- .th_content -->
		</div><!-- #th_main -->
		<div id="th_footer">
			<div class="th_content">
				<h2><?php esc_html_e( 'Credits and informations', 'speed-contact-bar' ); ?></h2>
				<dl>
					<dt><?php esc_html_e( 'Do you like the plugin?', 'speed-contact-bar' ); ?></dt><dd><a href="https://wordpress.org/support/view/plugin-reviews/speed-contact-bar"><?php esc_html_e( 'Rate it at wordpress.org!', 'speed-contact-bar' ); ?></a></dd>
					<dt><?php esc_html_e( 'Do you need support or have an idea for the plugin?', 'speed-contact-bar' ); ?></dt><dd><a href="https://wordpress.org/support/plugin/speed-contact-bar"><?php esc_html_e( 'Post your questions and ideas in the forum at wordpress.org!', 'speed-contact-bar' ); ?></a></dd>
				</dl>
			</div><!-- .th_content -->
		</div><!-- #th_footer -->
	</div><!-- .th_wrapper -->
</div><!-- .wrap -->
