<div class="col-md-12 article pf-video">
	<?php
		// get embedded YT videos
		function quickly_get_embed(){
			$content = get_the_content();
			preg_match('/\bhttps?:\/\/[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|\/))/', $content, $matches);
			$videoLink = str_replace('[/embed', '', $matches[0]);
			return $videoLink;
		}
	?>
	<iframe width="100%" height="400" src="<?php echo quickly_get_embed(); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	<span class="article-credits">By <?php echo get_the_author_link(); ?> on <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php the_date(); ?></a></span>
</div>