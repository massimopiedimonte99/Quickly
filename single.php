<?php get_header(); ?>


<?php if ( have_posts() ): ?>
			<?php while( have_posts() ): the_post(); ?>
					<?php get_template_part( 'template_parts/header/cover', 'single' ); ?>
					<section class="container">
						<div class="row">
							<!-- taxonomies -->
							<div class="col-md-12 taxonomies">
								<?php the_category( ' ' ); ?>
								<?php the_tags( '', ' ', '' ); ?>
							</div>
							<!-- article -->
							<article class="col-md-12 article">
								<?php the_content(); ?>
								<?php
									// date link informations
									$archive_year  = get_the_time('Y'); 
									$archive_month = get_the_time('m'); 
									$archive_day   = get_the_time('d'); 
								?>
								<span class="article-credits">By <?= get_the_author_link(); ?> on <a href="<?= get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php the_date(); ?></a></span>
							</article>
							<!-- posts navigation -->
							<div class="col-md-12 posts-navigation single-pagination clearfix">
								<?php previous_post_link( '%link' ); ?>
								<?php next_post_link( '%link' ); ?>
							<hr></div>
							
							<!-- comments -->
							<?php if ( comments_open() || get_comments_number() ): ?>
	 			 				<div class="col-md-12">
	 			 					<?php comments_template(); ?>
								</div>
							<?php endif; ?>
						</div>
					</section>
			<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>