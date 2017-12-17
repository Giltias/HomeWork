<?php get_header('head'); ?>
<body>
<div class="wrapper">
    <?php get_header(); ?>
    <div class="main-content">
        <div class="content-wrapper">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <div class="content">
                <h1 class="title-page"><?php the_title(); ?></h1>
                <p>
                    <img src="<?php echo get_post_image(); ?>" alt="Image" class="alignleft">
                </p>
                <p>
                    <?php the_content(); ?>
                </p>
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