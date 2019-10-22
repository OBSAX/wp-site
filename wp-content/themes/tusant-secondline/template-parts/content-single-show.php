<?php
/**
 * @package slt
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="secondline-single-container">

		<div class="secondline-blog-single-content">
            <?php if ( is_singular('post') && (!get_post_meta($post->ID, 'secondline_themes_header_image' )) && has_post_thumbnail() && (!get_post_meta($post->ID, 'secondline_themes_disable_img'))) : ?>
		        <div class="secondline-featured-img-single">
		            <?php the_post_thumbnail('full');?>
		        </div>
		    <?php endif;?>      

			
			<div class="secondline-themes-blog-single-excerpt">
				<?php the_content(); ?>
			
                
                <?php if((!get_post_meta($post->ID, 'secondline_themes_disable_list', true)) && (get_post_meta($post->ID, 'secondline_themes_show_category_selection', true))) : ?>
                    
                    <hr>
                    <h2 class="show-episode-list-heading"><?php echo esc_attr_e('All Episodes','tusant-secondline');?></h2>

                    
					<?php                    
					global $blogloop;
					global $post;

					if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {   $paged = get_query_var('page'); } else {  $paged = 1; }

					$post_per_page = get_theme_mod('secondline_themes_show_post_list_paged', '9');
					$catarrayIds = ''; //default
					$catpostIds = get_post_meta($post->ID, 'secondline_themes_show_category_selection', true);					
					$series_cat_string = implode(", ",$catpostIds);
					
					$catarrayIds = explode(',', $series_cat_string); // explode value into an array of ids
					 if(count($catarrayIds) <= 1) // if array contains one element or less, there's spaces after comma's, or you only entered one id
					 {
						 if( strpos($catarrayIds[0], ',') !== false )// if the first array value has commas, there were spaces after ids entered
						 {
							 $catarrayIds = array(); // reset array
							 $catarrayIds = explode(', ', $series_cat_string); // explode ids with space after comma's
						 }
					 }					 
					
					if ( function_exists( 'ssp_episodes' ) ) {				
						$args = array(
								  'post_type' => 'podcast',
								  'ignore_sticky_posts' => 1,
								  'posts_per_page'     =>  $post_per_page,
								  'paged' => $paged,
								  'tax_query' => array(
									  'relation' => 'AND',
									array(
										'taxonomy' => 'series',
										'field'    => 'slug',
										'terms'    => $catarrayIds,
										'operator' => 'IN'
									),
								  ),
						);
					} else {
						$args = array(
								  'post_type'         => 'post',
								  'ignore_sticky_posts' => 1,
								  'posts_per_page'     =>  $post_per_page,
								  'paged' => $paged,
								  'tax_query' => array(
									  'relation' => 'AND',
									array(
										'taxonomy' => 'category',
										'field'    => 'ids',
										'terms'    => $catarrayIds,
										'operator' => 'IN'
									),
								  ),
						);						
					}

					$blogloop = new \WP_Query( $args );
					?>                                            
					
					
					<div class="secondline-masonry-margins show-page-episodes-slt">
						<div id="secondline-blog-index-masonry">
							<?php if($blogloop != ''): ?>
								<?php while($blogloop->have_posts()): $blogloop->the_post();?>
								<div class="secondline-masonry-item">
									<div class="secondline-masonry-padding-blog single-column-slt disable-match-height<?php if(get_theme_mod('secondline_themes_show_post_list_more', 'hide') == 'hide'):?> disable-read-more<?php endif;?>">
										<div class="secondline-themes-isotope-animation">
											<?php get_template_part('template-parts/shows/content-show','page'); ?>
										</div>
									</div>    
								</div>
								<?php endwhile; ?>
							<?php endif;?>    
						</div>
					</div>
					
					<?php			
						$page_tot = ceil(($blogloop->found_posts) / $post_per_page);
						
						if ( $page_tot > 1 ) {
							$big        = 999999999;
							if(get_theme_mod('secondline_themes_show_post_list_pagination', 'default') == 'infinite') {
								echo paginate_links( array(
									  'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ), // need an unlikely integer cause the url can contains a number
									  'format'    => '?paged=%#%',
									  'current'   => max( 1, $paged ),
									  'total'     => ceil(($blogloop->found_posts) / $post_per_page),
									  'prev_next' => true,
										'prev_text'    => esc_html__('&lsaquo;', 'tusant-secondline'),
										'next_text'    => esc_html__('Load More', 'tusant-secondline'), // Load More
									  'end_size'  => 1,
									  'mid_size'  => 2,
									  'type'      => 'list'
								  )
								);
							} elseif(get_theme_mod('secondline_themes_show_post_list_pagination', 'default') == 'default') {
								echo paginate_links( array(
									  'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ), // need an unlikely integer cause the url can contains a number
									  'format'    => '?paged=%#%',
									  'current'   => max( 1, $paged ),
									  'total'     => ceil(($blogloop->found_posts) / $post_per_page),
									  'prev_next' => true,
										'prev_text'    => esc_html__('&lsaquo;', 'tusant-secondline'),
										'next_text'    => esc_html__('&rsaquo;', 'tusant-secondline'), // Default Pagination
									  'end_size'  => 1,
									  'mid_size'  => 2,
									  'type'      => 'list'
								  )
								);												
							}
						}
					?>				
				
				<?php endif;?>	
			   			
			</div>
						
			
			<?php the_tags(  '<div class="tags-secondline"><i class="fa fa-tags"></i>', ' ', '</div><div class="clearfix-slt"></div>' ); ?> 
			
						
			<div class="clearfix-slt"></div>
						
		</div><!-- close .secondline-blog-content -->

	<div class="clearfix-slt"></div>
	
	
	</div><!-- close .secondline-single-container -->
</div><!-- #post-## -->