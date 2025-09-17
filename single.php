<?php
/* Template Name: Blog (Fundraiser by Norts) */

get_header();


$image = get_template_directory_uri() . '/images/hero_2.jpg';
if (get_the_post_thumbnail_url()) {
  $image = get_the_post_thumbnail_url();
}

$author_id = $post->post_author;
$author_display = get_the_author_meta('display_name', $author_id);
$excerpt = get_the_excerpt();
?>
<div class="ftco-blocks-cover-1">
  <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo $image; ?>')">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-9 text-center">
          <span class="d-block mb-3 text-white" data-aos="fade-up">
            <?php echo get_the_date('d M Y'); ?>
            <span class="mx-2 text-primary">&bullet;</span>
            par <?php echo $author_display; ?>
          </span>
            <h1 class="mb-4 text-cursive h1" data-aos="fade-up" data-aos-delay="100"><?php echo get_the_title();; ?></h1>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$categories = array_filter(get_the_category(), function ($cat, $k) {
  return $cat->slug !== 'non-classe';
}, ARRAY_FILTER_USE_BOTH);

$tags = get_the_tags();
?>
<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7 mr-auto blog-content">
        <div><?php echo the_content(); ?></div>


        <?php
        $to_display = array_map(function ($cat) {
          return  [
            'name'    => $cat->cat_name,
            'link' => $cat->taxonomy . '/' . $cat->slug,
          ];
        }, $categories);
        ?>
        <div class="pt-5">
          <p>
            <?php if (!empty($categories)) : ?>
              Categories:
              <?php
              foreach ($to_display as $key => $cat) {
                // echo '<a href="' . $cat['link'] . '">' . $cat['name'] . '</a>';
                echo '<a href="#">' . $cat['name'] . '</a>';

                if ($cat !== end($to_display)) {
                  echo ", ";
                }
              }
              ?>

            <?php endif; ?>

            <?php if (!empty($tags)) { ?>
              Etiquettes:
              <?php
              foreach ($tags as $key => $tag) {
                // echo '<a href="' . $cat['link'] . '">' . $cat['name'] . '</a>';
                echo '<a href="#">' . $tag->name . '</a>';

                if ($tag !== end($tags)) {
                  echo ", ";
                }
              }
              ?>
          </p>
        <?php } ?>
        </div>
      </div>

      <div class="col-md-4 sidebar">
        <!-- <div class="sidebar-box">
          <form action="#" class="search-form">
            <div class="form-group">
              <span class="icon fa fa-search"></span>
              <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
            </div>
          </form>
        </div> -->

        <?php if (!empty($categories)) : ?>
          <div class="sidebar-box">
            <div class="categories">
              <h3>Categories</h3>
              <?php foreach ($categories as $key => $cat) : ?>
                <li><a href="<?php echo $cat->taxonomy . '/' . $cat->slug ?>"><?php echo $cat->cat_name ?> <span>(<?php echo $cat->count; ?>)</span></a></li>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
        <?php
        $author_id = $post->post_author;
        // $author_display = get_the_author_meta('display_name', $author_id);
        $avatar_url = get_avatar_url($author_id);
        $author_description = get_the_author_meta('description');

        ?>
        <?php if (true) : ?>
          <div class="sidebar-box">
            <img src="<?php echo $avatar_url; ?>" alt="" class="img-fluid mb-4 w-50 rounded-circle">
            <?php if ($author_description) : ?>
              <h3 class="text-black">A Propos De l'Auteur</h3>
              <p><?php echo $author_description; ?></p>
              <!-- <p><a href="#" class="btn btn-primary btn-md text-white">Read More</a></p> -->
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <!-- <div class="sidebar-box">
          <h3 class="text-black">Paragraph</h3>
          <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
        </div> -->
      </div>
    </div>

    <?php
    require_once "template-parts/gallery-fbn.php";
 
 
    require_once "template-parts/comments-part.php";
    ?>
  </div>
</div>

<?php
get_footer();
