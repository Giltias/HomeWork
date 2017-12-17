<?php get_header('head'); ?>
<body>
<div class="wrapper">
    <?php get_header(); ?>
    <!-- header_end-->
    <div class="main-content">
        <div class="content-wrapper">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                $fields = get_fields();
            ?>
            <div class="content">
                <div class="article-title title-page">
                    <?php the_title(); ?>
                </div>
                <div class="article-image">
                    <img src="<?php echo get_post_image($fields); ?>" alt="Image поста">
                </div>
                <div class="article-info">
                    <div class="post-date"><?php the_date(); ?></div>
                </div>
                <div class="article-text">

                    <?php echo get_price_akcia($fields); ?>
                    <?php the_content(); ?>
                </div>
                <div class="article-pagination">
                    <div class="article-pagination__block pagination-prev-left">
                        <a href="<?php $post = get_adjacent_post(false, '', true); echo get_permalink($post->id); ?>" class="article-pagination__link">
                            <i class="icon icon-angle-double-left"></i>Предыдущая статья
                        </a>
                        <div class="wrap-pagination-preview pagination-prev-left">
                            <div class="preview-article__img"><img src="<?php echo get_post_image($fields, $post->ID); ?>" class="preview-article__image"></div>
                            <div class="preview-article__content">
                                <div class="preview-article__info"><a href="#" class="post-date"><?php echo date('d.m.Y',strtotime($post->post_date)); ?></a></div>
                                <div class="preview-article__text"><?php echo $post->post_title; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="article-pagination__block pagination-prev-right">
                        <a href="<?php $post = get_adjacent_post(false, '', false); $next_post = get_adjacent_post(false, '', false); echo get_permalink($next_post->ID); ?>" class="article-pagination__link">
                            Сдедующая статья<i class="icon icon-angle-double-right"></i>
                        </a>
                        <div class="wrap-pagination-preview pagination-prev-right">
                            <div class="preview-article__img"><img src="<?php echo get_post_image($fields, $next_post->ID); ?>" class="preview-article__image"></div>
                            <div class="preview-article__content">
                                <div class="preview-article__info"><a href="#" class="post-date"><?php echo date('d.m.Y',strtotime($next_post->post_date)); ?></a></div>
                                <div class="preview-article__text"><?php echo $next_post->post_title; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; else: ?>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>
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