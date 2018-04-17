<?php get_header(); ?>
<?php get_template_part( 'template_parts/header/cover', 'index' ); ?>

<section class="container">
	<div class="row">
		<div class="col-12 col-md-8 offset-md-2">
			<!-- articles -->
			<?php if ( have_posts() ): ?>
				<?php
					the_archive_title( '<h3 class="page-title text-center">', '</h3><hr>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
				<?php while( have_posts() ): the_post(); ?>
					<?php get_template_part( 'template_parts/content', get_post_format() ); ?>
				<?php endwhile; ?>
			<?php endif ?>

			<!-- posts navigation -->
			<div class="col-md-8 posts-navigation clearfix">
				<a href="#" class="pagination-link older"><?php echo get_previous_posts_link( 'Next' ) ?></a>
				<a href="#" class="pagination-link newer"><?php echo get_next_posts_link( 'Previous' ) ?></a>
			</div>
		</div>
			
		<!-- sidebar -->
		<?php // get_sidebar(); ?>
		
	</div>
</section>
<?php get_footer(); ?>