<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$queried_object = get_queried_object();
$category_title = single_cat_title( '', false );
$category_description = term_description();
// Use the site's Posts page when configured; fall back to the homepage.
$posts_page_id = (int) get_option( 'page_for_posts' );
$blog_url = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/' );
$current_page = max( 1, absint( get_query_var( 'paged' ) ), absint( get_query_var( 'page' ) ) );
?>

<main id="primary" class="site-main tx-category-archive">
	<header class="tx-archive-header">
		<div class="tx-archive-header__inner">
			<nav class="tx-breadcrumbs" aria-label="<?php echo esc_attr__( 'Breadcrumb', 'hello-elementor-category-archive' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Home', 'hello-elementor-category-archive' ); ?></a>
				<span class="tx-breadcrumbs__separator" aria-hidden="true">/</span>
				<a href="<?php echo esc_url( $blog_url ); ?>"><?php echo esc_html__( 'Blogs', 'hello-elementor-category-archive' ); ?></a>
				<span class="tx-breadcrumbs__separator" aria-hidden="true">/</span>
				<span aria-current="page"><?php echo esc_html( $category_title ); ?></span>
			</nav>

			<p class="tx-archive-eyebrow"><?php echo esc_html__( 'USEFULL INSIGHTS', 'hello-elementor-category-archive' ); ?></p>
			<h1 class="tx-archive-title"><?php echo esc_html( $category_title ); ?></h1>

			<?php if ( ! empty( $category_description ) ) : ?>
				<div class="tx-archive-description">
					<?php echo wp_kses_post( $category_description ); ?>
				</div>
			<?php else : ?>
				<p class="tx-archive-description">
					<?php
					echo esc_html(
						sprintf(
							/* translators: %s: category name. */
							__( 'Explore the latest insights, analysis and practical guidance in %s.', 'hello-elementor-category-archive' ),
							$category_title
						)
					);
					?>
				</p>
			<?php endif; ?>

			<nav class="tx-archive-filters" aria-label="<?php echo esc_attr__( 'Blog categories', 'hello-elementor-category-archive' ); ?>">
				<a class="tx-archive-filter" href="<?php echo esc_url( $blog_url ); ?>"><?php echo esc_html__( 'All Blogs', 'hello-elementor-category-archive' ); ?></a>
				<span class="tx-archive-filter tx-archive-filter--active" aria-current="page"><?php echo esc_html( $category_title ); ?></span>
			</nav>
		</div>
	</header>

	<div class="tx-archive-layout">
		<section class="tx-archive-main" aria-label="<?php echo esc_attr( sprintf( __( '%s articles', 'hello-elementor-category-archive' ), $category_title ) ); ?>">
			<?php if ( have_posts() ) : ?>
				<div class="tx-post-grid">
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'tx-post-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<a class="tx-post-card__image-link" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read %s', 'hello-elementor-category-archive' ), get_the_title() ) ); ?>">
									<?php the_post_thumbnail( 'large', array( 'class' => 'tx-post-card__image', 'loading' => 'lazy' ) ); ?>
								</a>
							<?php endif; ?>

							<div class="tx-post-card__body">
								<p class="tx-post-card__date"><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
								<h2 class="tx-post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<div class="tx-post-card__excerpt">
									<?php
									$excerpt = get_the_excerpt();
									if ( '' !== trim( $excerpt ) ) {
										echo wp_kses_post( wpautop( wp_trim_words( $excerpt,  22, '…' ) ) );
									} else {
										echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_content() ),  22, '…' ) );
									}
									?>
								</div>
								<a class="tx-post-card__read-more" href="<?php the_permalink(); ?>">
									<?php echo esc_html__( 'Read More', 'hello-elementor-category-archive' ); ?>
								</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<?php
				$pagination = paginate_links(
					array(
						'total'      => (int) $GLOBALS['wp_query']->max_num_pages,
						'current'    => $current_page,
						'type'       => 'list',
						'prev_text'  => esc_html__( '← Previous', 'hello-elementor-category-archive' ),
						'next_text'  => esc_html__( 'Next →', 'hello-elementor-category-archive' ),
						'aria_label' => esc_attr__( 'Articles pagination', 'hello-elementor-category-archive' ),
					)
				);
				if ( $pagination ) :
					?>
					<nav class="tx-pagination" aria-label="<?php echo esc_attr__( 'Articles pagination', 'hello-elementor-category-archive' ); ?>">
						<?php echo wp_kses_post( $pagination ); ?>
					</nav>
				<?php endif; ?>

			<?php else : ?>
				<div class="tx-archive-empty">
					<h2><?php echo esc_html__( 'No articles found', 'hello-elementor-category-archive' ); ?></h2>
					<p><?php echo esc_html__( 'There are no published articles in this category yet. Please check back soon.', 'hello-elementor-category-archive' ); ?></p>
					<a href="<?php echo esc_url( $blog_url ); ?>"><?php echo esc_html__( 'Browse all blogs', 'hello-elementor-category-archive' ); ?></a>
				</div>
			<?php endif; ?>
		</section>

		<aside class="tx-archive-sidebar" aria-label="<?php echo esc_attr__( 'More articles', 'hello-elementor-category-archive' ); ?>">
			<section class="tx-sidebar-section tx-recent-posts">
				<h2 class="tx-sidebar-title"><?php echo esc_html__( 'Recent Post', 'hello-elementor-category-archive' ); ?></h2>
				<ul class="tx-sidebar-post-list">
					<?php
					$recent_posts = new WP_Query(
						array(
							'post_type'           => 'post',
							'post_status'         => 'publish',
							'posts_per_page'      => 5,
							'ignore_sticky_posts' => true,
							'no_found_rows'       => true,
							'post__not_in'        => is_singular( 'post' ) ? array( get_queried_object_id() ) : array(),
						)
					);
					if ( $recent_posts->have_posts() ) :
						while ( $recent_posts->have_posts() ) :
							$recent_posts->the_post();
							?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							<?php
						endwhile;
					else :
						?>
						<li><?php echo esc_html__( 'No recent posts available.', 'hello-elementor-category-archive' ); ?></li>
					<?php
					endif;
					wp_reset_postdata();
					?>
				</ul>
			</section>

			<section class="tx-sidebar-section tx-popular-posts">
				<h2 class="tx-sidebar-title"><?php echo esc_html__( 'Popular Post', 'hello-elementor-category-archive' ); ?></h2>
				<ul class="tx-sidebar-post-list">
					<?php
					$popular_posts = new WP_Query(
						array(
							'post_type'           => 'post',
							'post_status'         => 'publish',
							'posts_per_page'      => 5,
							'orderby'             => 'comment_count',
							'order'               => 'DESC',
							'ignore_sticky_posts' => true,
							'no_found_rows'       => true,
						)
					);
					if ( $popular_posts->have_posts() ) :
						while ( $popular_posts->have_posts() ) :
							$popular_posts->the_post();
							?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							<?php
						endwhile;
					else :
						?>
						<li><?php echo esc_html__( 'No popular posts available.', 'hello-elementor-category-archive' ); ?></li>
					<?php
					endif;
					wp_reset_postdata();
					?>
				</ul>
				<p class="tx-popular-posts__note"><?php echo esc_html__( 'Popular posts are currently ordered by comment activity.', 'hello-elementor-category-archive' ); ?></p>
			</section>
		</aside>
	</div>

</main>

<?php
get_footer();
