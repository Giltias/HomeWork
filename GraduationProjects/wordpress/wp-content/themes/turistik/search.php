<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Turistik
 * @since Loftschool
 */
get_header('head'); ?>

<body>
<div class="wrapper">
<?php get_header(); ?>
    <div class="main-content">
        <div class="content-wrapper">
            <div class="content">
                <h1 class="title-page">Результаты поиска:</h1>
                <div class="posts-list">
		<?php if ( have_posts() ) : ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>

				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
                $fields = get_fields();

                ?>
				<div class="post-wrap">
                            <div class="post-thumbnail">

                                <img src="<?php echo get_post_image($fields); ?>"
                                     alt="Image поста"
                                     class="post-thumbnail__image">
                            </div>
                            <div class="post-content">
                                <div class="post-content__post-info">
                                    <div class="post-date"><?php the_date(); ?></div>
                                </div>
                                <div class="post-content__post-text">
                                    <div class="post-title">
                                        <?php the_title(); ?>
                                    </div>
                                    <div class="post-content__post-text">
                                        <?php if (!empty($fields['short_name'])) {
                                            echo $fields['short_name'];
                                        } else {
                                            the_excerpt();
                                        }?>
                                    </div>
                                </div>
                                <div class="post-content__post-control">
                                    <a href="<?php the_permalink(); ?>" class="btn-read-post">Читать далее >></a>
                                </div>
                            </div>
                        </div>
            <?
			// End the loop.
			endwhile;
			endif;
?>                </div>
                <div class="pagenavi-post-wrap"><a href="#" class="pagenavi-post__prev-postlink"><i
                                class="icon icon-angle-double-left"></i></a><span
                            class="pagenavi-post__current">1</span><a href="#" class="pagenavi-post__page">2</a><a
                            href="#" class="pagenavi-post__page">3</a><a href="#" class="pagenavi-post__page">...</a><a
                            href="#" class="pagenavi-post__page">10</a><a href="#" class="pagenavi-post__next-postlink"><i
                                class="icon icon-angle-double-right"></i></a></div>
            </div>
            <!-- sidebar-->
            <?php get_sidebar(); ?>
        </div>
    </div>
    <?php get_footer(); ?>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
