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
						<?php if ( ('post' == get_post_type()) || ('podcast' == get_post_type()) ) : ?>
							<div class="secondline-post-meta">							
								<span class="blog-meta-date-display"><a href="<?php the_permalink();?>"><?php the_time(get_option('date_format')); ?></a></span>								
								<span class="blog-meta-author-display"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span>								
								<?php if (get_theme_mod( 'secondline_themes_blog_meta_category_display', 'true') == 'true') : ?>
									<?php if(get_post_type() == 'podcast') :?>
										<span class="blog-meta-category-list">
											<?php $terms = get_the_terms( $post->ID , 'series' );
												if($terms) {
													foreach ( $terms as $term ) {
													$term_link = get_term_link( $term, 'series' );
													if( is_wp_error( $term_link ) )
													continue;
													echo esc_attr($term->name) .'<span>,</span>';
													}
												}
											;?>
										</span>
									<?php else: ?>
										<span class="single-blog-meta-category-list"><?php the_category(', '); ?></span>
									<?php endif;?>	
								<?php endif; ?>																		
								<?php 					 
									if( function_exists('powerpress_get_enclosure_data') ) {						
										$slt_episode_data = powerpress_get_enclosure_data( $post->ID );
										if( !empty($slt_episode_data['duration']) ) {
										  echo '<span class="blog-meta-time-slt">'.esc_attr($slt_episode_data['duration']).'</span>';
										}
									}
									if(function_exists('ssp_episodes')) {
										$duration = get_post_meta( $post->ID, 'duration', true );
										if ( !empty($duration) ) {
											$duration = apply_filters( 'ssp_file_duration', $duration, $post->ID );
											echo '<span class="blog-meta-time-slt">'. esc_attr($duration).'</span>';						
										}
									}                                 
									;?>
								<span class="blog-meta-comments"><?php comments_popup_link( '' . wp_kses( __( '0 Comments', 'tusant-secondline' ), true ) . '', wp_kses( __( '1 Comment', 'tusant-secondline' ), true), wp_kses( __( '% Comments', 'tusant-secondline' ), true ) ); ?></span>
								
							</div>
						<?php endif; ?>						
						
						<div class="secondline-themes-blog-excerpt">
							<?php if ( ! empty( $settings['secondline_elements_slider_excerpt'] ) ) : ?>
								<div class="slt-addon-excerpt">
									<?php if(has_excerpt() ): ?><?php the_excerpt(); ?><?php else: ?><p><?php echo secondline_addons_excerpt($settings['slt_slider_excerpt_length'] ); ?></p><?php endif; ?> 
								</div>
							<?php endif; ?>
						</div>

						<?php if( function_exists('the_powerpress_content') && (!has_post_format( 'video' )) && (get_the_powerpress_content() != '') && (!get_post_meta($post->ID, 'secondline_themes_external_embed', true) )) : ?>                  

							<?php if(get_the_powerpress_content() != '') :?>								
								<div class="single-player-container-secondline">			
									<?php if(function_exists('spp_sl_sppress_plugin_updater')):?>
										<?php
										
										// If PP & SPP are active - Display SPP
										$MetaData = get_post_meta($post->ID, 'enclosure', true);						 						
										$MetaParts = explode("\n", $MetaData, 4);
										if (isset($MetaParts[0])) {
											$meta_url = $MetaParts[0];
										};						
										if ($meta_url != '') {
											echo do_shortcode('[spp-player url="'. esc_url($meta_url) . '"]');
										}		
										
									?>																
									<?php else : ?>								
										<?php the_powerpress_content(); ?>
									<?php endif;?>	
								</div>
							<?php endif;?>
											
						<?php elseif((get_post_meta($post->ID, '_audiourl', true)) && (function_exists('spp_sl_sppress_plugin_updater')) && (!get_post_meta($post->ID, 'secondline_themes_external_embed', true) )) : ?> 		
							<div class="single-player-container-secondline">
								<?php echo do_shortcode('[spp-player]'); ?>
							</div>
							
						<?php elseif((function_exists('ssp_episodes')) && (!has_post_format( 'video' )) && (!get_post_meta($post->ID, 'secondline_themes_external_embed', true) ) ) : ?>
							<div class="single-player-container-secondline">				
								<?php echo do_shortcode('[podcast_episode]'); ?>											
							</div>
							
						<?php elseif((function_exists('load_podlove_podcast_publisher')) && (!has_post_format( 'video' )) && (!get_post_meta($post->ID, 'secondline_themes_external_embed', true) ) ) : ?>
							<div class="single-player-container-secondline podlove-player">				
								<?php echo do_shortcode('[podlove-episode-web-player]'); ?>											
							</div>	

						<?php elseif(get_post_meta($post->ID, 'secondline_themes_external_embed', true)) : ?>
							<div class="single-player-container-secondline embed-player-single-slt">
							   <?php
									// Check to see if we have any oEmbed supported content, otherwise - echo the shortcode/iframe.
									$secondline_oembed = wp_oembed_get(get_post_meta($post->ID, 'secondline_themes_external_embed', true)); 
									if( !empty($secondline_oembed) && ($secondline_oembed !== '') ) {
										echo wp_oembed_get(get_post_meta($post->ID, 'secondline_themes_external_embed', true)); 
									} else {
										echo do_shortcode(get_post_meta($post->ID, 'secondline_themes_external_embed', true));	
									};																
								?>
							</div>	
						<?php endif;?>								
						
						
					</div>
										
				</div>
			</div><!-- close .slider-content-max-width -->
		</div><!-- close .slider-text-floating-container -->

	
	</div><!-- close .slider-elements-display-table -->
		
	
	<div class="slider-background-overlay-color"></div>
	<div class="clearfix-slt"></div>
	
</div><!-- close .secondline-elements-slider-background -->