<?php
/**
 * @package slt
 */

?>




<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="show-grid-index secondline-themes-default-blog-index <?php if( (!has_post_thumbnail()) && (!get_post_meta($post->ID, 'secondline_themes_gallery', true)) ): ?>secondline-content-no-img<?php endif;?>">

		<?php if(has_post_thumbnail()): ?>
			<div class="secondline-themes-feaured-image">
				<?php secondline_themes_blog_link(); ?>
					<?php 
						if(get_theme_mod('secondline_themes_image_cropping', 'secondline-themes-crop') == 'secondline-themes-uncrop') {
							the_post_thumbnail('secondline-themes-show-index-uncropped'); 
						} else {
							the_post_thumbnail('secondline-themes-show-index'); 
						}
					;?>	
				</a>
			</div><!-- close .secondline-themes-feaured-image -->
		<?php endif; ?>
			
		
		<div class="secondline-blog-content">

			<h2 class="secondline-blog-title"><?php secondline_themes_blog_post_title(); ?><?php the_title(); ?></a></h2>

				<?php if ( 'secondline_shows' == get_post_type() ) : ?>
					<div class="secondline-show-meta">
						
						<div class="show-host-container">					
							<?php if ( ( ! empty( $settings['secondline_elements_show_carousel_show_host_img'] ) ) && ( get_post_meta($post->ID, 'secondline_themes_show_hosts_img', true) ) ) : ?><span class="show-meta-host"><img src="<?php echo esc_url(get_post_meta($post->ID, 'secondline_themes_show_hosts_img', true)) ?>" /></span><?php endif; ?>	
							
							<?php if ( ( ! empty( $settings['secondline_elements_show_carousel_show_host'] ) ) && ( get_post_meta($post->ID, 'secondline_themes_show_hosts', true) ) ) : ?><span class="show-host-meta"><?php echo esc_html_e('Hosted By', 'tusant-secondline' );?></span><span class="show-meta-names"><?php echo esc_attr(get_post_meta($post->ID, 'secondline_themes_show_hosts', true)) ?></span><?php endif; ?>			
						</div>
						
						<?php if ( ! empty( $settings['secondline_elements_show_list_cat'] ) ) : ?>
							<div class="show-category-list">
								
								<?php $terms = get_the_terms( $post->ID , 'show_category' );
								if($terms) {
									echo '<i class="fa fa-folder"></i>';
									foreach ( $terms as $term ) {
									$term_link = get_term_link( $term, 'show_category' );
									if( is_wp_error( $term_link ) )
									continue;
									echo '<div>' . $term->name .'<span>, </span> </div>';
									}
								}?>		
							</div>	
							<div class="clearfix-slt"></div>
						<?php endif;?>		

					</div>
				<?php endif; ?>
			
			
			<div class="secondline-themes-blog-excerpt">
				<?php if ( ! empty( $settings['secondline_elements_show_list_excerpt'] ) ) : ?>
					<div class="slt-addon-excerpt">
						<?php if((get_post_meta($post->ID, 'secondline_themes_show_short_desc', true)) != '' ) : ?>
							<?php $short_desc_text = wpautop(get_post_meta($post->ID, 'secondline_themes_show_short_desc', true));?>
							<p><?php echo wp_trim_words( $short_desc_text, $settings['slt_excerpt_length'], $more = null );?></p>
						<?php else: ?>
							<p><?php echo secondline_addons_excerpt($settings['slt_excerpt_length'] ); ?></p>
						<?php endif; ?> 
					</div>
				<?php endif; ?>
				<a class="more-link" href="<?php the_permalink();?>"><?php if($settings['slt_read_more_icon'] != ''):?><i class="fa <?php echo esc_attr($settings['slt_read_more_icon']);?>" aria-hidden="true"></i><?php endif;?> <?php echo esc_attr($settings['slt_read_more_txt']);?></a>						
			</div>
			
			
			
		</div><!-- close .secondline-blog-content -->
	
		<?php if ( is_sticky() && is_home() && ! is_paged() ) { printf( '<div class="secondline-themes-sticky-post">%s</div>', esc_html__( 'FEATURED', 'tusant-secondline' ) ); } ?>
	
	<div class="clearfix-slt"></div>
	</div><!-- close .secondline-themes-default-blog-index -->
</div><!-- #post-## -->