<?php
/**
 * @package slt
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="secondline-single-container">

		<div class="secondline-blog-single-content">
			<?php if( has_post_format( 'gallery' ) && get_post_meta($post->ID, 'secondline_themes_gallery', true)  ): ?>
				<div class="secondline-featured-image">
					<div class="flexslider secondline-gallery">
					  <ul class="slides">
							<?php $files = get_post_meta( get_the_ID(),'secondline_themes_gallery', 1 ); ?>
							<?php foreach ( (array) $files as $attachment_id => $attachment_url ) : ?>
							<?php $lightbox_secondline = wp_get_attachment_image_src($attachment_id, 'large'); ?>
							<li>
								<a href="<?php echo esc_url($lightbox_secondline[0]);?>" data-rel="prettyPhoto[gallery]" <?php $get_description = get_post($attachment_id)->post_excerpt; if(!empty($get_description)){ echo 'title="' . esc_attr($get_description) . '"'; } ?>>
								<?php echo wp_get_attachment_image( $attachment_id, 'secondline-blog-index' ); ?>
							</a></li>
							<?php endforeach;  ?>
						</ul>
					</div><!-- close .flexslider -->

				</div><!-- close .secondline-featured-image -->

			<?php elseif ( (get_theme_mod('secondline_themes_blog_single_featured_img_display', 'true') == 'true') && ( is_singular('post') || is_singular('podcast') || is_singular('episode') || is_singular('product') || is_singular('download') ) && has_post_thumbnail() && (!get_post_meta($post->ID, 'secondline_themes_disable_img'))) : ?>
		        <div class="secondline-featured-img-single">
		            <?php the_post_thumbnail('full');?>
		        </div>
		    <?php endif;?>      

           
            <?php /* START ALTERNATIVE HEADER LAYOUT (SHOW HEADER ON POSTS) */; ?>
            <?php $secondline_post_id = get_post_meta($post->ID, 'secondline_themes_parent_show_post', true);?>
            <?php if(($secondline_post_id !== '') && ($secondline_post_id !== 'None')) : ?>
                <h1 class="blog-post-title"><?php the_title();?></h1>
                <div class="alt-secondline-post-meta">

                    <?php if (get_theme_mod( 'secondline_themes_blog_single_meta_date_display', 'true') == 'true') : ?><span class="blog-meta-date-display"><?php the_time(get_option('date_format')); ?></span><?php endif; ?>

                    <?php if (get_theme_mod( 'secondline_themes_blog_single_meta_author_display', 'true') == 'true') : ?><span class="blog-meta-author-display"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span><?php endif; ?>
					
                    <?php if (get_theme_mod( 'secondline_themes_blog_single_meta_category_display', 'true') == 'true') : ?>
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
					<?php endif;?>		

                    <?php if (get_theme_mod( 'secondline_themes_blog_single_duration_display', 'true') == 'true') : ?>
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
                            $filesize = get_post_meta( $post->ID, 'filesize', true );
                            if ( !empty($filesize) ) {
								$filesize = apply_filters( 'ssp_file_filesize', $filesize, $post->ID );
								echo '<span class="blog-meta-time-slt">'. esc_attr($filesize).'</span>';						
							}								
                        }                    
                        ;?>
                    <?php endif;?>	

                    <?php if (get_theme_mod( 'secondline_themes_blog_single_meta_comments_display', 'true') == 'true') : ?><span class="blog-meta-comments"><?php comments_popup_link( '' . wp_kses( __( '0 Comments', 'tusant-secondline' ), true ) . '', wp_kses( __( '1 Comment', 'tusant-secondline' ), true), wp_kses( __( '% Comments', 'tusant-secondline' ), true ) ); ?></span><?php endif; ?>								
                </div>        
                
                <?php if( function_exists('the_powerpress_content') && (!has_post_format( 'video' )) && (get_the_powerpress_content() != '') && (!get_post_meta($post->ID, 'secondline_themes_external_embed', true) )) : ?>
                    <?php 
                        $slt_options_pl = get_option('powerpress_general');
                        $slt_player_settings = $slt_options_pl['display_player'];							
                    ?>                    

                    <?php if((($slt_player_settings == '0') || ($slt_player_settings == '2')) && get_the_powerpress_content() != '') :?>								
                    <div id="alt-single-post-player">
                        <div id="player-float-secondline">
                            <div class="alt-player-container-secondline">				
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
                        </div>
                    </div>
                    <?php endif;?>

                <?php elseif((get_post_meta($post->ID, '_audiourl', true)) && (function_exists('spp_sl_sppress_plugin_updater')) && (!get_post_meta($post->ID, 'secondline_themes_external_embed', true) )) : ?> 		
                    <div id="alt-single-post-player">
                        <div id="player-float-secondline">
                            <div class="alt-player-container-secondline">
                                <?php echo do_shortcode('[spp-player]'); ?>
                            </div>	
                        </div>
                    </div>

                <?php elseif((function_exists('ssp_episodes')) && (!has_post_format( 'video' )) && (!get_post_meta($post->ID, 'secondline_themes_external_embed', true) ) ) : ?>
                    <div id="alt-single-post-player">
                        <div id="player-float-secondline">
                            <div class="alt-player-container-secondline">				
                                <?php echo do_shortcode('[podcast_episode]'); ?>				
                            </div>	
                        </div>
                    </div>

                <?php elseif(get_post_meta($post->ID, 'secondline_themes_external_embed', true)) : ?>
                    <div class="alt-player-container-secondline embed-player-single-slt">
                       <div id="player-float-secondline" <?php if(has_post_format( 'video' ) || (strpos(get_post_meta($post->ID, 'secondline_themes_external_embed', true), 'youtube.com') !== false) || (strpos(get_post_meta($post->ID, 'secondline_themes_external_embed', true), 'vimeo.com') !== false)): ?>class="single-video-secondline"<?php endif;?>>
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
                    </div>	

                <?php endif;?>	                        
            <?php endif;?>     
            <?php /* END ALTERNATIVE SHOW LAYOUT (SHOW HEADER ON POSTS) */; ?>   
			
			<div class="secondline-themes-blog-single-excerpt">
				<?php the_content(); ?>              
			
				<?php if( function_exists('the_powerpress_content')): ?>
					<?php
						$slt_options_pl = get_option('powerpress_general');
						$slt_player_settings = $slt_options_pl['display_player'];	
					?>
					<?php if(($slt_player_settings == '1') && (function_exists('spp_sl_sppress_plugin_updater'))) : ?>
						<?php $MetaData = get_post_meta($post->ID, 'enclosure', true);?>
						<?php 
						
						$MetaParts = explode("\n", $MetaData, 4);
						if (isset($MetaParts[0])) {
							$meta_url = $MetaParts[0];
						};
						
						if ($meta_url != '') {
							echo do_shortcode('[spp-player url="'. esc_url($meta_url) . '"]');
						}
						
						?>							
					<?php elseif(($slt_player_settings == '1')) : ?>
						<?php the_powerpress_content(); ?>
					<?php endif;?>	
				<?php endif;?>				
			
				<?php wp_link_pages( array(
					'before' => '<div class="secondline-page-nav">' . esc_html__( 'Pages:', 'tusant-secondline' ),
					'after'  => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					) );
				?>
			</div>
			<div class="clearfix-slt"></div>
			
			<?php the_tags(  '<div class="tags-secondline"><i class="fa fa-tags"></i>', ' ', '</div><div class="clearfix-slt"></div>' ); ?> 
			
			<?php if(get_the_author_meta('description')) : ?>
				<?php get_template_part( 'template-parts/author', 'info' ); ?>
			<?php endif; ?>
						
			<div class="clearfix-slt"></div>
			
			<?php if (get_theme_mod( 'secondline_themes_blog_single_comment_area_display', 'true') == 'true') : ?>
				<?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
			<?php endif;?>	
			
		</div><!-- close .secondline-blog-content -->

	<div class="clearfix-slt"></div>
	
	
	</div><!-- close .secondline-single-container -->
</div><!-- #post-## -->