<?php
/**
 * @package tgs_wp
 */
?>

<div class="post-meta">
	<ul class="pull-right social-list">
		<li><a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" class="facebook">Share on Facebook</a></li>
		<li><a href="http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php the_permalink(); ?>" target="_blank" class="twitter">Share on Twitter</a></li>
		<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=<?php echo get_site_url(); ?>" target="_blank" class="linkedin">Share on LinkedIn</a></li>
	</ul>			
	<p>Date: <strong><?php the_time('m.d.Y'); ?></strong> <span class="post-meta-divider">|</span> Posted by: <strong><?php the_author(); ?></strong></p>
</div>
