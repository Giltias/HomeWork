<?php
/**
 * Template name: news
 */
 get_header('head'); ?>
<body>
<div class="wrapper">
    <?php get_header(); ?>
    <div class="main-content">
        <div class="content-wrapper">
            <div class="content">
                <h1 class="title-page">Список новостей</h1>
                <div class="posts-list">
                    <?php
                        $query = new \WP_Query(
                            [
                                'post_type' => ['post'],
                            ]
                        );
                        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                            $fields = get_fields();
                        ?>
                        <div class="post">
                            <a href="<?php echo get_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                        </div>
                    <?php endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?>
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