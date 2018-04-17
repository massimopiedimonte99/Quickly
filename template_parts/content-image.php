<div class="col-md-12 article pf-image">
	<a href="<?php the_permalink(); ?>">
		<div class="pf-img" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
			<img src="<?php echo get_avatar_url( get_the_author_meta('ID'), [ 'size' => 200, 'default' => 'http://www.gravatar.com/avatar/3b3be63a4c2a439b013787725dfce802?d=identicon' ] ); ?>" alt="" class="rounded-circle img-thumbnail avatar">
			<h3 class="article-title"><?php the_title(); ?></h3>
		</div>
	</a>
</div>