<?php
/**
 * @package slt
 */
?>

<div class="secondline-elements-slider-background" <?php global $post; if((get_post_meta($post->ID, 'secondline_themes_header_image', true)) != '') : ?>style="background-image:url('<?php echo esc_url( get_post_meta($post->ID, 'secondline_themes_header_image', true));?>')"<?php elseif(has_post_thumbnail()): ?><?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'secondline-themes-blog-post'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"<?php endif; ?>>
	<?php global $post; ?>
	<div class="slider-elements-display-table">
	
		<div class="slider-text-floating-container">
			<div class="slider-content-max-width">
				<div class="slider-content-margins">
					<div class="slider-content-alignment-slt">
												
						<a href="<?php the_permalink();?>"><h2 class="secondline-blog-slider-title"><?php the_title(); ?></h2></a>					
						
						<div class="secondline-themes-blog-excerpt">
							<?php if ( ! empty( $settings['secondline_elements_slider_excerpt'] ) ) : ?>
								<div class="slt-addon-excerpt">
									<?php if((get_post_meta($post->ID, 'secondline_themes_show_short_desc', true)) != '' ) : ?>
										<?php echo wpautop(get_post_meta($post->ID, 'secondline_themes_show_short_desc', true));?>
									<?php else: ?>
										<p><?php echo secondline_addons_excerpt($settings['slt_slider_excerpt_length'] ); ?></p>
									<?php endif; ?> 
								</div>
							<?php endif; ?>
						</div>
						<?php if ( ! empty( $settings['secondline_elements_slider_button'] ) ) : ?>
							<a class="single-show-link-slt button" href="<?php the_permalink();?>"><?php echo esc_html($settings['secondline_elements_slider_button_txt']);?></a>
						<?php endif; ?>						
					</div>										
				</div>
			</div><!-- close .slider-content-max-width -->
		</div><!-- close .slider-text-floating-container -->
	
	</div><!-- close .slider-elements-display-table -->
			
	<div class="slider-background-overlay-color"></div>
	<div class="clearfix-slt"></div>
	
</div><!-- close .secondline-elements-slider-background -->