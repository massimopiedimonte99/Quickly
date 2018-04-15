<?php 
	/* 
		Template Name: Sidebar 
	*/ 
?>

<?php get_header(); ?>
<?php get_template_part( 'template_parts/header/cover', 'index' ); ?>

<section class="container">
	<div class="row">
		<div class="col-12 col-md-8">
			<!-- articles -->
			<?php if ( have_posts() ): ?>
				<?php while( have_posts() ): the_post(); ?>
					<?php get_template_part( 'template_parts/content', 'page' ); ?>
				<?php endwhile; ?>
			<?php endif ?>
	</div>
	<?php get_sidebar(); ?>
</section>
<?php get_footer(); ?>