<!-- cover -->
<div class="row">
	<!-- cover background -->
	<div class="col-md-12 cover-img single-cover-img" style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>)"></div>
	<!-- cover content -->
	<div class="cover-content">
		<img src="<?php echo get_avatar_url( get_the_author_meta('ID'), [ 'size' => 200, 'default' => 'http://www.gravatar.com/avatar/3b3be63a4c2a439b013787725dfce802?d=identicon' ] ); ?>" alt="" class="rounded-circle img-thumbnail avatar">
		<h1 class="heading single-main-heading"><?php echo get_the_title(); ?></h1>
		<?php 
			// get subtitle from custom metabox if there is one
			$meta = get_post_meta( $post->ID, 'quickly_fields', true );
			$subtitle = !empty( $meta['subtitle'] ) ? $meta['subtitle'] : ''; 
		?>
		<h2 class="heading single-sub-heading"><?php echo $subtitle ?></h2>
		<!-- social icons -->
		<!-- <div class="social-icons"> -->
			<?php // $permalink = get_permalink(); ?>
<!-- 			<a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u='. $permalink .'' ?>" target="_blank"><span class="fa fa-facebook"></span></a>
			<a href="<?php echo 'https://plus.google.com/share?url=' . $permalink .'' ?>" target="_blank"><span class="fa fa-google-plus"></span></a>
			<a href="<?php echo 'https://twitter.com/intent/tweet?text=Hey, read this article by '. get_the_author() .': '. get_the_title() .'&amp;url='. $permalink ?>" target="_blank"><span class="fa fa-twitter"></span></a>
		</div> -->
	</div>
</div>