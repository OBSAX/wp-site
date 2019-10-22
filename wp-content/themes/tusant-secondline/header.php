<?php
/**
 * The Header for our theme.
 *
 * @package slt
 * @since slt 1.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="//gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if(is_singular('secondline_shows') && (get_post_meta($post->ID, 'secondline_themes_show_rss_feed', true) != '')) :?>	
		<?php 
		remove_action( 'wp_head', 'feed_links_extra', 3 ); 
		remove_action( 'wp_head', 'feed_links', 2 ); 
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		add_filter('ssp_show_global_feed_tag', '__return_null');
		?>
		<link type="application/rss+xml" rel="alternate" title="<?php echo get_the_title();?>" href="<?php echo esc_url(get_post_meta($post->ID, 'secondline_themes_show_rss_feed', true));?>"/>
	<?php endif;?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
	// For WordPress 5.2+
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>
	<?php get_template_part( 'header/page', 'loader' ); ?>
	<div id="main-container-secondline" <?php secondline_themes_page_title(); ?>>
		<?php // Elementor `header` location
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) : ?>		
		<div id="secondline-themes-header-position">		
		<?php if (get_theme_mod( 'secondline_themes_header_fixed', 'none-fixed-slt' ) == 'fixed-slt' && get_theme_mod( 'secondline_themes_logo_position', 'secondline-themes-logo-position-left' ) != 'secondline-themes-logo-position-center'  ) : ?><div id="secondline-fixed-nav"><?php endif; ?>
			<header id="masthead-slt" class="secondline-themes-site-header <?php echo esc_attr( get_theme_mod('secondline_themes_nav_align', 'secondline-themes-nav-right') ); ?>">
				<?php if (get_theme_mod( 'secondline_themes_header_fixed', 'none-fixed-slt' ) == 'fixed-slt') : ?><div id="secondline-themes-sidebar-fixed-nav"><?php endif; ?>
					
					<div id="logo-nav-slt">
						
						<div class="width-container-slt secondline-themes-logo-container">
							<h1 id="logo-slt" class="logo-inside-nav-slt noselect"><?php secondline_themes_logo(); ?></h1>
						</div><!-- close .width-container-slt -->
						
						<?php secondline_themes_navigation(); ?>
						
					</div><!-- close #logo-nav-slt -->
					<?php get_template_part( 'header/mobile', 'navigation' ); ?>
				
				<?php if (get_theme_mod( 'secondline_themes_header_fixed', 'none-fixed-slt' ) == 'fixed-slt' ) : ?></div><!-- close #secondline-themes-sidebar-fixed-nav --><?php endif; ?>
			</header>
		<?php if (get_theme_mod( 'secondline_themes_header_fixed', 'none-fixed-slt' ) == 'fixed-slt' && get_theme_mod( 'secondline_themes_logo_position', 'secondline-themes-logo-position-left' ) != 'secondline-themes-logo-position-center') : ?></div><!-- close #secondline-fixed-nav --><?php endif; ?>
		</div><!-- close #secondline-themes-header-position -->
		<?php endif;?>