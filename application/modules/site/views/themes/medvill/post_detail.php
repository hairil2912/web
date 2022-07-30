<style>
    .breadcrumbs-inner-part .breadcrumbs-inner-bread {
        padding: 65px 0 120px;
    }
</style>

<div class="breadcrumbs-inner-part img3">
    <div class="container">
        <div class="breadcrumbs-inner-bread text-center">
            <h1 class="title-part"><?= $post->title ?></h1>
        </div>
    </div>
</div>

<div class="rs-inner-blog-part pt-130 pb-130 md-pt-80 md-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="rs-latest-part part8 mb-70 md-mb-30">
                    <div class="item">
                        <div class="blog-item">
                            <!-- <?php if (!empty($post->img)) : ?>
                                <div class="img-part">
                                    <img style="height: 310px !important; width: 100% !important;" src="<?= site_url('assets/uploads/' . $post->img) ?>">
                                </div>
                            <?php endif; ?> -->
                            <div class="blog-full">
                                <?php if ($this->uri->segment(1) == 'detail') : ?>
                                    <div class="blog-meta">
                                        <h3 class="title"><a href="#"><?= $post->title ?></a></h3>
                                    </div>
                                    <div class="blog-slider-meta">
                                        <div class="blog-content mb-15">
                                            <span class="post-date">
                                                <i class="flaticon-clock"></i>
                                                <strong><?= date('d', strtotime($post->created_on)) ?></strong><i><?= date('M', strtotime($post->created_on)) ?></i>
                                            </span>
                                            <span class="post-author">
                                                <i class="flaticon-user-1"></i>
                                                <a class="link" href="#"><?= $post->author ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div style="color: black !important;" class="service-part mb-25 md-mb-15">
                                    <p>
                                        <?= $post->content; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 md-mb-20">
                <div class="widget-area part2 no-margin">
                    <div class="title-widget mb-45">
                        <h3 class="title-part">Search</h3>
                    </div>
                    <div class="search-wrap mb-45">
                        <input type="search" placeholder="Search..." name="s" class="search-input" value="">
                        <button type="submit" value="Search"><i class=" flaticon-search"></i></button>
                    </div>
                    <?php if ($this->uri->segment(1) == 'service') : ?>
                        <div class="blog-recent-post mb-30">
                            <div class="title-widget">
                                <h3 class="title-part mb-50">Layanan Lainnya</h3>
                            </div>
                            <?php foreach (another_services($post->post_id) as $post) : ?>
                                <div class="recent-post-widget">
                                    <div class="post-img">
                                        <a class="link" href="<?= site_url('service/' . $post->slug) ?>">
                                            <img src="<?= img_thumb($post->img) ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="post-desc">
                                        <a class="link" href="<?= site_url('service/' . $post->slug) ?>"><?= $post->title ?></a>
                                        <span class="date">
                                            <i class="fa fa-calendar"></i>
                                            <?= date('d', strtotime($post->created_on)) ?> <?= date('M', strtotime($post->created_on)) ?> <?= date('Y', strtotime($post->created_on)) ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php elseif ($this->uri->segment(1) == 'event') : ?>
                        <div class="blog-recent-post mb-30">
                            <div class="title-widget">
                                <h3 class="title-part mb-50">Event Lainnya</h3>
                            </div>
                            <?php foreach (another_events($post->post_id) as $post) : ?>
                                <div class="recent-post-widget">
                                    <div class="post-img">
                                        <a class="link" href="<?= site_url('event/' . $post->slug) ?>">
                                            <img src="<?= img_thumb($post->img) ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="post-desc">
                                        <a href="<?= site_url('event/' . $post->slug) ?>"><?= $post->title ?></a>
                                        <span class="date">
                                            <i class="fa fa-calendar"></i>
                                            <?= date('d', strtotime($post->created_on)) ?> <?= date('M', strtotime($post->created_on)) ?> <?= date('Y', strtotime($post->created_on)) ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php elseif ($this->uri->segment(1) == 'spesialis') : ?>
                        <div class="blog-recent-post mb-30">
                            <div class="title-widget">
                                <h3 class="title-part mb-50">Spesialis</h3>
                            </div>
                            <?php foreach (another_events($post->post_id) as $post) : ?>
                                <div class="recent-post-widget">
                                    <div class="post-img">
                                        <a class="link" href="<?= site_url('spesialis/' . $post->slug) ?>">
                                            <img src="<?= img_thumb($post->img) ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="post-desc">
                                        <a href="<?= site_url('spesialis/' . $post->slug) ?>"><?= $post->title ?></a>
                                        <span class="date">
                                            <i class="fa fa-calendar"></i>
                                            <?= date('d', strtotime($post->created_on)) ?> <?= date('M', strtotime($post->created_on)) ?> <?= date('Y', strtotime($post->created_on)) ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="title-widget mb-30">
                            <h3 class="title-part">Kategori Berita</h3>
                        </div>
                        <div class="wap-column-part mb-30">
                            <ul class="chevron-right-icon">
                                <?php foreach (get_categories() as $category) : ?>
                                    <li><a class="link" href="<?= site_url('category/' . $category->slug) ?>"><?= $category->name ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="blog-recent-post mb-30">
                            <div class="title-widget">
                                <h3 class="title-part mb-50">Berita Terbaru</h3>
                            </div>
                            <?php foreach (latest_news($post->post_id) as $post) : ?>
                                <div class="recent-post-widget">
                                    <div class="post-img">
                                        <a class="link" href="<?= site_url('detail/' . $post->slug) ?>">
                                            <img style="height: 50px !important; width:100px !important;" src=" <?= img_thumb($post->img) ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="post-desc">
                                        <a class="link" href="<?= site_url('detail/' . $post->slug) ?>"><?= substr(strip_tags($post->title), 0, 20) ?></a>
                                        <span class="date">
                                            <i class="fa fa-calendar"></i>
                                            <?= date('d', strtotime($post->created_on)) ?> <?= date('M', strtotime($post->created_on)) ?> <?= date('Y', strtotime($post->created_on)) ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>