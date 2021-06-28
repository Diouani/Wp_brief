<div class="blog-content">
	<ul class="blog_post">
		<li class="blog-child">
			<?php if(has_post_thumbnail()): ?>
			<?php $blogImages = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>
			<div class="blog-img">
				<a href="<?php esc_url(the_permalink()); ?>"><img alt="" src="<?php echo esc_url($blogImages); ?>"></a>
			</div>
			<?php endif; ?>
			<div class="blog_post_info">
				<div class="blog-date">
					<?php echo get_the_time('d'); ?> <span><?php echo get_the_time('M'); ?></span>
				</div>
			</div>
			<div class="blog_post_content">
				<h3 class="title-blogpost">
					<a href="<?php esc_url(the_permalink()); ?>"><?php the_title();?></a>
				</h3>
				<div class="blog_post_data">
					<p>
						<span class="post-status"><?php echo esc_html__('News','riven'); ?></span>
					</p>
					<p>
						<span class="post-comments"><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></span>
					</p>
				</div>
				<div class="blog_post_desc">
					<p>
			            <?php the_excerpt(); ?>
						<a href="<?php esc_url(the_permalink()); ?>" class="blog-readmore"><?php echo esc_html__('Read More &gt;','riven'); ?></a>
					</p>
				</div>
			</div>
		</li>
	</ul>
</div>