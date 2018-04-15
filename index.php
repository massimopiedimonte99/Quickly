<?php get_header(); ?>
<?php get_template_part( 'template_parts/header/cover', 'index' ); ?>

<section class="container">
	<div class="row">
		<?php
			// change the layout according to the user chose to get or not the sidebar 
			// $activate_sidebar = esc_attr( get_option( 'sidebar-status' ) ); 
			// print $activate_sidebar === 'yes' ? '<div class="col-12 col-md-8">' : '<div class="col-12 col-md-8 offset-md-2">'; 
			print '<div class="col-12 col-md-8 offset-md-2">';
		?>
			<!-- articles -->
			<?php if ( have_posts() ): ?>
				<?php while( have_posts() ): the_post(); ?>
					<?php get_template_part( 'template_parts/content', get_post_format() ); ?>
				<?php endwhile; ?>
			<?php endif ?>

			<!-- posts navigation -->
			<div class="col-md-8 posts-navigation clearfix">
				<?= get_previous_posts_link( __( 'Next', 'quicklytheme' ) ) ?>
				<?= get_next_posts_link( __( 'Previous', 'quicklytheme' ) ) ?>
			</div>
		</div>

		<?php 
			// if the user wants a sidebar, give him/her a sidebar
			// if( $activate_sidebar === 'yes' ) get_sidebar();  
		?>
		
	</div>
</section>
<?php get_footer(); ?>