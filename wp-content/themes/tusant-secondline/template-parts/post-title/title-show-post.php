<?php
/**
 * @package slt
 */
?>  
    <?php

    $secondline_show_post = get_post_meta($post->ID, 'secondline_themes_parent_show_post');
    $secondline_post_id = $secondline_show_post[0];

    $args = array(
      'p'         => $secondline_post_id, 
      'post_type' => 'any',
    );

    $parent_show_post = new WP_Query($args);
    
    while($parent_show_post->have_posts()): $parent_show_post->the_post();
    
    ?>
    
	<div id="page-title-slt-show-page" <?php if(get_post_meta($post->ID, 'secondline_themes_header_image', true) != '') :?> style="background-image:url( '<?php echo esc_url( get_post_meta($post->ID, 'secondline_themes_header_image', true)) ;?>');"<?php endif;?>>			
		<div id="show-post-title-meta-container" class="<?php if(get_post_meta($post->ID, 'secondline_themes_external_embed', true)) : ?>slt-no-embed-player<?php endif;?><?php if(has_post_format( 'video' )): ?> video-format-secondline<?php endif;?>">
			<div class="width-container-slt">				                                                     
			  <div class="show-header-info<?php if ( is_singular() && has_post_thumbnail() && (!get_post_meta($post->ID, 'secondline_themes_disable_img'))) : ?> grid3columnbig-secondline<?php endif;?>">
				  <h1 class="show-page-title"><a class="show-page-link" href="<?php the_permalink();?>"><?php the_title(); ?></a></h1>
					<div class="single-show-meta-secondline">
					   <div class="single-show-host-container">					
							<?php if (get_post_meta($post->ID, 'secondline_themes_show_hosts_img', true)) :?><span class="show-meta-host"><img src="<?php echo esc_url(get_post_meta($post->ID, 'secondline_themes_show_hosts_img', true)) ?>" /></span><?php endif;?>

							<?php if(get_post_meta($post->ID, 'secondline_themes_show_hosts', true)) : ?><span class="show-host-meta"><?php echo esc_html_e('Hosted By', 'tusant-secondline' );?></span><span class="show-meta-names"><?php echo esc_attr(get_post_meta($post->ID, 'secondline_themes_show_hosts', true)) ?></span><?php endif;?>			
						</div>  
						<div class="clearfix-slt"></div>                           
						<div class="single-show-desc-secondline">
							<?php echo wpautop(get_post_meta($post->ID, 'secondline_themes_show_short_desc', true));?>
						</div>
						<div class="single-show-links-secondline">
							<?php if(get_post_meta($post->ID, 'secondline_themes_show_website', true)) :?>
								<a class="button single-show-website-slt" href="<?php echo esc_url(get_post_meta($post->ID, 'secondline_themes_show_website', true));?>"><?php echo esc_html_e('Website','tusant-secondline');?></a>
							<?php endif ;?> 
							<?php if(!get_post_meta($post->ID, 'secondline_themes_show_subscribe_button', true)) :?>
								<a class="button single-show-subscribe-slt" href="#!"><?php echo esc_html_e('Subscribe','tusant-secondline');?></a>   
								<!-- Modal HTML embedded directly into document -->
								<div id="secondline-subs-modal" class="modal">
									<?php                  
										$secondline_subscribe_entries = get_post_meta( get_the_ID(), 'secondline_themes_repeat_subscribe', true );

										if($secondline_subscribe_entries != '') {
											echo '<div class="secondline-subscribe-modal"><ul>';
											foreach ( (array) $secondline_subscribe_entries as $key => $entry ) {

												$secondline_link = $secondline_platform_slt = '';

												if ( isset( $entry['secondline_themes_subscribe_platform'] ) ) {
													$secondline_platform_slt = esc_html( $entry['secondline_themes_subscribe_platform'] );
													$secondline_platform_slt_txt = str_replace("-", " ", $secondline_platform_slt); 
												}											
												if ( isset( $entry['secondline_themes_subscribe_url'] ) ) {
													$secondline_link = esc_html( $entry['secondline_themes_subscribe_url'] );
												}
												if ( isset( $entry['secondline_themes_custom_link_label'] ) ) {
													$custom_label_secondline = esc_html( $entry['secondline_themes_custom_link_label'] );
												} else {
													$custom_label_secondline = $secondline_link;
												}													
												if(($secondline_link != '') && ($secondline_platform_slt != '') && ($secondline_platform_slt != 'custom')) {
													echo '<li class="secondline-subscribe-'.esc_attr($secondline_platform_slt).'"><a href="' . esc_url($secondline_link) . '" target="_blank"><img class="secondline-subscribe-img" src="'. get_template_directory_uri().'/images/icons/' . esc_html($secondline_platform_slt) . '.png' .'" />' . esc_html($secondline_platform_slt_txt) . '</a></li>';
												} elseif(($secondline_link != '') && ($secondline_platform_slt == 'custom')) {
													echo '<li class="secondline-subscribe-'.esc_attr($secondline_platform_slt).'"><a href="' . esc_url($secondline_link) . '" target="_blank"><img class="secondline-subscribe-img" src="'. get_template_directory_uri().'/images/icons/' . esc_html($secondline_platform_slt) . '.png' .'" />' . esc_html($custom_label_secondline) . '</a></li>';
												}
											}
											echo '</ul></div>'; //
										}
									?>                                       
								</div>                                
							<?php endif;?>                                    
						</div>                           
						<div id="secondline-show-icons">
							<?php                  
								$secondline_subscribe_entries = get_post_meta( get_the_ID(), 'secondline_themes_repeat_social', true );

								if($secondline_subscribe_entries != '') {
									echo '<ul>';
									foreach ( (array) $secondline_subscribe_entries as $key => $entry ) {

										$secondline_link = $secondline_platform_slt = '';

										if ( isset( $entry['secondline_themes_social_icon'] ) ) {
											$secondline_themes_social_icon = esc_html( $entry['secondline_themes_social_icon'] );
											$slt_brand_name = substr($secondline_themes_social_icon, 3);
											$slt_brand_name_clean = explode("-", $slt_brand_name);
										}

										if ( isset( $entry['secondline_themes_social_url'] ) ) {
											$secondline_themes_social_url = esc_html( $entry['secondline_themes_social_url'] );
										}
										if(($secondline_themes_social_url != '') && ($secondline_themes_social_icon != '')) {
											echo '<li class="secondline-tusant-icon"><a href="' . esc_url($secondline_themes_social_url) . '" target="_blank"><i class="fab ' . esc_attr($secondline_themes_social_icon) . '" title="' . esc_attr($slt_brand_name_clean[0]) . '"></i></a></li>';
										}
									}
									echo '</ul>'; //
								}
							?>                                       
						</div>                                
					</div>
			  </div>  


                <?php if ( is_singular() && has_post_thumbnail() && (!get_post_meta($post->ID, 'secondline_themes_disable_img'))) : ?>
                    <div class="grid3column-secondline lastcolumn-secondline">										
                            <div class="secondline-featured-img-single-show">
								<?php 
									if(get_theme_mod('secondline_themes_image_cropping', 'secondline-themes-crop') == 'secondline-themes-uncrop') {
										the_post_thumbnail('secondline-themes-show-index-uncropped'); 
									} else {
										the_post_thumbnail('secondline-themes-show-index'); 
									}
								;?>	
                            </div>
                    </div>
                <?php endif;?> 				  
                  
                  
			    <div class="clearfix-slt"></div>
			</div><!-- close .width-container-slt -->
		</div><!-- close #blog-post-title-meta-container -->					
	</div><!-- #page-title-slt -->
	
<?php endwhile; ?>    

<?php wp_reset_postdata(); ?>

