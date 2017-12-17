<?php get_header('head'); ?>
<body>
<div class="wrapper">
    <?php get_header(); ?>
    <div class="main-content">
        <div class="content-wrapper">
            <div class="content">
                <h1 class="title-page">Последние новости и акции из мира туризма</h1>
                <div class="posts-list">
                    <?php
                        $qo = get_queried_object();
                        $tag = ($qo->taxonomy === 'post_tag') ? $qo->slug : null;
                        $cat = $qo->cat_ID;
                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                        $query = new \WP_Query(
                            [
                                'post_type' => ['post', 'akcia'],
                                'tag' => $tag,
                                'cat' => $cat,
                                'year' => get_query_var('year'),
                                'monthnum' => get_query_var('monthnum'),
                                'day' => get_query_var('day'),
                                'posts_per_page' => 3,
                                'paged' => $paged
                            ]
                        );
                        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
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
                    <?php endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?>
                </div>
                <div class="pagenavi-post-wrap">
                    <?php
                    $GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;

                    get_pagination(); ?>
                </div>
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
