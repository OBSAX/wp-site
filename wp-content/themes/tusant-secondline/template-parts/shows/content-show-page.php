<?php
/**
 * @package slt
 */

?>




<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="secondline-themes-default-blog-index <?php if( (!has_post_thumbnail()) && (!get_post_meta($post->ID, 'secondline_themes_gallery', true)) ): ?>secondline-content-no-img<?php endif;?> show-page-contents">

		<?php if(has_post_thumbnail()): ?>
			<div class="secondline-themes-feaured-image">
				<?php secondline_themes_blog_link(); ?>
					<?php 
						if(get_theme_mod('secondline_themes_image_cropping', 'secondline-themes-crop') == 'secondline-themes-uncrop') {
							the_post_thumbnail('secondline-themes-index-single-column-uncropped'); 
						} else {
							the_post_thumbnail('secondline-themes-index-single-column'); 
						}
					;?>	
				</a>
			</div><!-- close .secondline-themes-feaured-image -->
        <?php endif; ?><!-- close gallery -->
			
		
		<div class="secondline-blog-content">

			<h2 class="secondline-blog-title"><?php secondline_themes_blog_post_title(); ?><?php the_title(); ?></a></h2>

			<?php if ( (('post' == get_post_type()) || ('podcast' == get_post_type())) && (get_theme_mod('secondline_themes_show_post_list_meta','display') == 'display') ) : ?>
				<div class="secondline-post-meta">
				
					<?php if (get_theme_mod( 'secondline_themes_blog_meta_date_display', 'true') == 'true') : ?><span class="blog-meta-date-display"><?php the_time(get_option('date_format')); ?></span><?php endif; ?>
					
					<?php if (get_theme_mod( 'secondline_themes_blog_meta_author_display', 'true') == 'true') : ?><span class="blog-meta-author-display"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span><?php endif; ?>
					
                    <?php if (get_theme_mod( 'secondline_themes_blog_meta_category_display', 'true') == 'true') : ?>
						<?php if(get_post_type() == 'podcast') :?>
							<span class="single-blog-meta-category-list">
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
					
					<?php if (get_theme_mod( 'secondline_themes_blog_meta_duration_display', 'true') == 'true') : ?>
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
					<?php endif;?>	
					
					<?php if (get_theme_mod( 'secondline_themes_blog_meta_comment_display', 'true') == 'true') : ?><span class="blog-meta-comments"><?php comments_popup_link( '' . wp_kses( __( '0 Comments', 'tusant-secondline' ), true ) . '', wp_kses( __( '1 Comment', 'tusant-secondline' ), true), wp_kses( __( '% Comments', 'tusant-secondline' ), true ) ); ?></span><?php endif; ?>
					
				</div>
			<?php endif; ?>
			
			
			<div class="secondline-themes-blog-excerpt">
				<?php if(get_theme_mod('secondline_themes_show_post_list_excerpt', 'display') == 'display'): ?>	
                <div class="slt-addon-excerpt">
                    <?php if(get_theme_mod('secondline_themes_show_post_list_excerpt_word', '12', true)): ?><?php $excerpt_count = esc_attr(get_theme_mod('secondline_themes_show_post_list_excerpt_word', '12'));?><?php if(has_excerpt() ): ?><?php the_excerpt(); ?><?php else: ?><p><?php echo secondline_addons_excerpt($excerpt_count); ?></p><?php endif; ?><?php endif; ?>
                </div>
                <?php endif;?>
				<?php if(get_theme_mod('secondline_themes_show_post_list_more', 'hide') == 'display'):?><a class="more-link" href="<?php the_permalink();?>"><?php esc_attr_e('Read More', 'tusant-secondline' );?></a><?php endif;?>
			
			
				<?php if( function_exists('the_powerpress_content') && (!has_post_format( 'video' )) && (get_the_powerpress_content() != '') && (!get_post_meta($post->ID, 'secondline_themes_external_embed', true) )) : ?>            

					<?php if(get_the_powerpress_content() != '') :?>								
						<div class="post-list-player-container-secondline">			
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
					<div class="post-list-player-container-secondline">
						<?php echo do_shortcode('[spp-player]'); ?>
					</div>
					
				<?php elseif((function_exists('ssp_episodes')) && (!has_post_format( 'video' )) && (!get_post_meta($post->ID, 'secondline_themes_external_embed', true) ) ) : ?>
					<div class="post-list-player-container-secondline">				
						<?php echo do_shortcode('[podcast_episode]'); ?>											
					</div>

				<?php elseif(get_post_meta($post->ID, 'secondline_themes_external_embed', true)) : ?>
					<div class="post-list-player-container-secondline embed-player-single-slt">
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
			
		</div><!-- close .secondline-blog-content -->
		
	<div class="clearfix-slt"></div>
	</div><!-- close .secondline-themes-default-blog-index -->
</div><!-- #post-## -->