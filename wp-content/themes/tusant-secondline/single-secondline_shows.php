<?php
/**
 * The template for displaying all single shows.
 *
 * @package slt
 */

get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
	
	<?php get_template_part( 'template-parts/post-title/title', 'show' ); ?>
	
	<div id="content-slt" class="site-content-blog-post">

		<div class="width-container-slt <?php if ( get_theme_mod( 'secondline_themes_show_post_sidebar') == 'left') : ?> left-sidebar-slt<?php endif; ?>">
				
				<?php if ( get_theme_mod( 'secondline_themes_show_post_sidebar', 'none') == 'right' || get_theme_mod( 'secondline_themes_show_post_sidebar', 'none') == 'left') : ?><div id="main-container-slt"><?php endif; ?>
				
					<?php get_template_part( 'template-parts/content', 'single-show' ); ?>
											
				<?php if ( get_theme_mod( 'secondline_themes_show_post_sidebar', 'none') =='right' || get_theme_mod( 'secondline_themes_show_post_sidebar', 'none') =='left') : ?></div><!-- close #main-container-slt --><?php if ( is_active_sidebar( 'secondline-themes-show-sidebar' ) ) : ?><div class="sidebar"><?php dynamic_sidebar( 'secondline-themes-show-sidebar' ); ?></div><?php endif;?><?php endif; ?>

				
		<div class="clearfix-slt"></div>
		</div><!-- close .width-container-slt -->
		
	</div><!-- #content-slt -->
	
	
	<?php endwhile; // end of the loop. ?>	

<?php get_footer(); ?>