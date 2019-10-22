<?php
/**
 * @package slt
 */
?>



<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="secondline-themes-default-blog-index <?php if( (!has_post_thumbnail())): ?>secondline-content-no-img<?php endif;?>">

		<?php if(has_post_thumbnail()): ?>
			<div class="secondline-themes-feaured-image">
				<?php secondline_themes_blog_link(); ?>
					<?php 
						if(get_theme_mod('secondline_themes_image_cropping', 'secondline-themes-crop') == 'secondline-themes-uncrop') {
							the_post_thumbnail('secondline-themes-show-index-uncropped', array('data-no-lazy' => '1') ); 
						} else {
							the_post_thumbnail('secondline-themes-show-index', array('data-no-lazy' => '1') ); 
						}
					;?>	
				</a>
			</div><!-- close .secondline-themes-feaured-image -->
		<?php endif; ?><!-- close gallery -->
			
		<?php if ( ! empty( $settings['secondline_elements_show_carousel_content'] ) ) : ?>
			<div class="secondline-show-content">

				<?php if ( ! empty( $settings['secondline_elements_show_carousel_title'] ) ) : ?><h2 class="secondline-show-title"><?php secondline_themes_blog_post_title(); ?><?php the_title(); ?></a></h2><?php endif;?>

				<?php if ( 'secondline_shows' == get_post_type() ) : ?>
					<div class="secondline-show-meta">
						
						<div class="show-host-container">					
							<?php if ( ( ! empty( $settings['secondline_elements_show_carousel_show_host_img'] ) ) && ( get_post_meta($post->ID, 'secondline_themes_show_hosts_img', true) ) ) : ?><span class="show-meta-host"><img src="<?php echo esc_url(get_post_meta($post->ID, 'secondline_themes_show_hosts_img', true)) ?>" /></span><?php endif; ?>	
							
							<?php if ( ( ! empty( $settings['secondline_elements_show_carousel_show_host'] ) ) && ( get_post_meta($post->ID, 'secondline_themes_show_hosts', true) ) ) : ?><span class="show-host-meta"><?php echo esc_html_e('Hosted By', 'tusant-secondline' );?></span><span class="show-meta-names"><?php echo esc_attr(get_post_meta($post->ID, 'secondline_themes_show_hosts', true)); ?></span><?php endif; ?>			
						</div>
						
						<?php if ( ! empty( $settings['secondline_elements_show_carousel_cat'] ) ) : ?>
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
				
				
				<?php if ( ! empty( $settings['secondline_elements_show_carousel_excerpt'] ) ) : ?>
					<div class="secondline-themes-blog-excerpt">
						<div class="slt-addon-excerpt">
							<?php if((get_post_meta($post->ID, 'secondline_themes_show_short_desc', true)) != '' ) : ?>
								<?php echo wpautop(get_post_meta($post->ID, 'secondline_themes_show_short_desc', true));?>
							<?php else: ?>
								<p><?php echo secondline_addons_excerpt($settings['slt_excerpt_length'] ); ?></p>
							<?php endif; ?> 
						</div>					
						<?php if ( ! empty( $settings['secondline_elements_show_carousel_read_more'] ) ) : ?><a class="more-link" href="<?php the_permalink();?>"><?php if($settings['slt_read_more_icon'] != ''):?><i class="fa <?php echo esc_attr($settings['slt_read_more_icon']);?>" aria-hidden="true"></i><?php endif;?> <?php echo esc_attr($settings['slt_read_more_txt']);?></a><?php endif;?>						
					</div>
				<?php endif; ?>
				
				
				
			</div><!-- close .secondline-blog-content -->
		<?php endif; ?>		
	
	<div class="clearfix-slt"></div>
	</div><!-- close .secondline-themes-default-blog-index -->
</div><!-- #post-## -->