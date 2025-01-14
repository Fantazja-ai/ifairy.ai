<?php 
$header_min = true;
$loadAI = false;
$use_bootstrap_icons = true;
require_once("inc/includes.php");
define('META_TITLE', @$seoConfig['blog_meta_title']);
define('META_DESCRIPTION', @$seoConfig['blog_meta_description']);
require_once("inc/header.php");
$getCreditsPacks = $credits_packs->getListFront();
$getMenuName = $menus->getBySlug("/blog");
$postsPerPage = $config->blog_pagination == 0 ? 1 : $config->blog_pagination;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$getPost = $posts->getListFront($page, $postsPerPage);
$totalPosts = $posts->getTotalPosts();
$totalPages = ceil($totalPosts / $postsPerPage);
?>

<section id="inner-page">
  <div class="container">
    <div class="row">
      <div class="col"><h1><?php echo $getMenuName->name; ?></h1></div>
    </div>
  </div>  
</section>

<section class="py-4">
  <div class="container">

    <div class="row">
      <div class="col py-2">
        <h2 class="default-title"><?php echo $lang['blog_title']; ?></h2>
        <p><?php echo $lang['blog_sub_title']; ?></p>
      </div>
    </div>    

    <div class="row">
      <?php foreach ($getPost as $showPosts) {?>
      <div class="col-lg-4 col-md-6 col-12">

        <div class="wrapper-card-post d-flex flex-column">
          <div class="card-post-image">
             <a href="<?php echo $base_url; ?>/blog/<?php echo $showPosts->slug;?>">
              <img src="<?php echo $base_url; ?>/public_uploads/<?php echo $showPosts->image;?>" onerror="this.src='https://placehold.co/1200x628'" alt="<?php echo $showPosts->title;?>" title="<?php echo $showPosts->title;?>">
              </a>
            </div>
          <div class="card-post-content d-flex flex-column flex-grow-1">
            <div class="card-post-content-info">
              <div class="card-post-title">
                <h2><a href="<?php echo $base_url; ?>/blog/<?php echo $showPosts->slug;?>"><?php echo $showPosts->title; ?></a></h2>
              </div>
              <div class="card-post-resume">
                <p><?php echo $showPosts->resume; ?></p>
              </div>
              <div class="card-blog-footer mt-auto">
                <div class="card-post-content-date">
                  <span><i class="bi bi-calendar"></i> <?php echo formatDate($showPosts->publication_date, false); ?></span>
                </div>
                <div class="card-post-cta text-end">
                  <a href="<?php echo $base_url; ?>/blog/<?php echo $showPosts->slug;?>"><span class="btn btn-primary"><?php echo $lang['blog_read_more']; ?></span></a>
                </div>              
              </div>
            </div>
          </div>
        </div>

      </div>
      <?php } ?>
    </div>

    <?php if ($totalPosts > $postsPerPage) {?>
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-center">
                <nav>
                    <ul class="pagination blog-pagination">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php if($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>        
        </div>
    </div>
    <?php } ?>

  </div>
</section>


<?php
require_once("inc/footer.php");
?>