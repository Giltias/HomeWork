<div class="sidebar" id="sidebar">
    <div class="sidebar__sidebar-item">
        <div class="sidebar-item__title">Теги</div>
        <div class="sidebar-item__content">
            <div class="tags-list">
                <?php wp_tag_cloud('largest=12&smallest=12'); ?>
                <!--<li class="tags-list__item"><a href="#" class="tags-list__item__link">путешествия по
                        россии</a></li>
                <li class="tags-list__item"><a href="#" class="tags-list__item__link">турция</a></li>
                <li class="tags-list__item"><a href="#" class="tags-list__item__link">гоа</a></li>
                <li class="tags-list__item"><a href="#" class="tags-list__item__link">авиабилеты</a></li>
                <li class="tags-list__item"><a href="#" class="tags-list__item__link">отели</a></li>
                <li class="tags-list__item"><a href="#" class="tags-list__item__link">европа</a></li>
                <li class="tags-list__item"><a href="#" class="tags-list__item__link">азия</a></li>
                <li class="tags-list__item"><a href="#" class="tags-list__item__link">тайланд</a></li>
                <li class="tags-list__item"><a href="#" class="tags-list__item__link">хостелы</a></li>
                <li class="tags-list__item"><a href="#" class="tags-list__item__link">шоппинг</a></li>-->
            </div>
        </div>
    </div>
    <div class="sidebar__sidebar-item">
        <div class="sidebar-item__title">Категории</div>
        <div class="sidebar-item__content">
            <?php $cats = get_categories(['parent' => 0]); ?>
            <ul class="category-list">
                <?php foreach ($cats as $cat) : ?>
                    <li class="category-list__item">
                        <a href="<?php echo get_category_link($cat->term_id) ?>" class="category-list__item__link">
                            <?php echo $cat->name ?>
                        </a>
                    </li>
                    <?php $subcats = get_categories(['parent' => $cat->term_id]);
                        foreach ($subcats as $key => $subcat) :
                            if ($key === 0) : ?>
                                <ul class="category-list__inner">
                            <?php endif; ?>
                                    <li class="category-list__item">
                                        <a href="<?php echo get_category_link($subcat->term_id) ?>" class="category-list__item__link">
                                            <?php echo $subcat->name ?>
                                        </a>
                                    </li>
                            <?php if ($key === count($subcats) - 1) : ?>
                                </ul>
                            <?php endif; ?>
                    <?php endforeach; ?>

                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php if (!dynamic_sidebar("sidebar")) : ?><?php endif; ?>
</div>
