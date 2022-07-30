<style>
    .breadcrumbs-inner-part .breadcrumbs-inner-bread {
        padding: 65px 0 120px;
    }
</style>
<div class="breadcrumbs-inner-part img3">
    <div class="container">
        <div class="breadcrumbs-inner-bread text-center">
            <h1 class="title-part"><?= $category->name ?></h1>
        </div>
    </div>
</div>
<div class="rs-inner-blog-part pt-130 pb-100 md-pt-80 md-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <?php foreach ($posts as $post) : ?>
                    <div class="rs-latest-part part8 mb-70 md-mb-30">
                        <div class="item">
                            <div class="blog-item">
                                <!-- <div class="img-part">
                                    <a href="<?= site_url('detail/' . $post->slug) ?>">
                                        <img height="50" src="<?= img_ori($post->img) ?>" alt="">
                                    </a>
                                </div> -->
                                <div class="blog-full">
                                    <div class="blog-meta">
                                        <h3 class="title"><a style="color:black;" href="<?= site_url('detail/' . $post->slug) ?>"><?= $post->title ?></a></h3>
                                    </div>
                                    <div class="blog-slider-meta">
                                        <div class="blog-content mb-15">
                                            <span class="post-date">
                                                <i class="flaticon-clock"></i>
                                                <a style="color: black;" href="#"><strong><?= date('d', strtotime($post->created_on)) ?></strong><i><?= date('M', strtotime($post->created_on)) ?></i></a>
                                            </span>
                                            <span class="post-author">
                                                <i class="flaticon-user-1"></i>
                                                <?= $post->author ?>
                                            </span>
                                            <span class="tag-line">
                                                <i class="flaticon-price-tag"></i>
                                                <a href="#"><?= $post->category ?></a>
                                            </span>
                                        </div>
                                        <div class="blog-desc mb-20">
                                            <p>
                                                <?= render_post_excerpt($post->content) ?>...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="widget-area">
                    <div class="title-widget mb-45">
                        <h3 class="title-part">Search</h3>
                    </div>
                    <div class="search-wrap mb-45">
                        <input type="search" placeholder="Search..." name="s" class="search-input" value="">
                        <button type="submit" value="Search"><i class=" flaticon-search"></i></button>
                    </div>
                    <div class="title-widget mb-30">
                        <h3 class="title-part">Kategori Berita</h3>
                    </div>
                    <div class="wap-column-part mb-30">
                        <ul class="chevron-right-icon">
                            <?php foreach (get_categories() as $category) : ?>
                                <li><a href="<?= site_url('category/' . $category->slug) ?>"><?= $category->name ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="blog-recent-post mb-30">
                        <div class="title-widget">
                            <h3 class="title-part mb-50">Berita Terbaru</h3>
                        </div>
                        <?php foreach (latest_news(null) as $post) : ?>
                            <div class="recent-post-widget">
                                <div class="post-img">
                                    <a href="<?= site_url('detail/' . $post->slug) ?>">
                                        <img height="50" width="50" src="<?= img_thumb($post->img) ?>" alt="">
                                    </a>
                                </div>
                                <div class="post-desc">
                                    <a href="?= site_url('detail/' . $post->slug) ?>"><?= substr(strip_tags($post->title), 0, 20) ?></a>
                                    <span class="date">
                                        <i class="fa fa-calendar"></i>
                                        <?= date('d', strtotime($post->created_on)) ?> <?= date('M', strtotime($post->created_on)) ?> <?= date('Y', strtotime($post->created_on)) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?= $links ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>