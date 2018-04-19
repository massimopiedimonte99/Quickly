<div class="col-md-12 article" <?php post_class(); ?>>
	<h3 class="article-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
	<?php the_excerpt(); ?>
	<?php
		// date link informations
		$archive_year  = get_the_time('Y'); 
		$archive_month = get_the_time('m'); 
		$archive_day   = get_the_time('d'); 
	?>
	<span class="article-credits">By <?php echo get_the_author_link(); ?> on <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php the_date(); ?></a></span>
</div>