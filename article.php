<?php

require 'includes/init.php';
$conn = require 'includes/db.php';

if (isset($_GET['id'])) {

    $article = Article::getWithCategories($conn, $_GET['id'], true);

} else {
    $article = null;
}

?>
<?php require 'includes/header.php'; ?>

<form class="right padding-top" method="post" action="/search.php">
    <label>Search</label>
    <input type="text" name="search" class="search-width">
    <input type="submit" name="submit" class="btn btn-primary">
</form>

<?php

if (isset($_POST['search'])) {
    $str = $_POST['search'];
    $url = '/search.php?key=' . $str;
    header("Location: {$url}");
}

?>

        <?php if ($article) : ?>

<div>
  <!-- <div class="row"> -->
    
            <article>
                <!-- <div class="col-md-4"> -->

                <h2><?= htmlspecialchars($article[0]['title']); ?></h2>
          

             
                <time datetime="<?= $article[0]['published_at'] ?>"><?php
                    $datetime = new DateTime($article[0]['published_at']);
                    echo $datetime->format("j F, Y");
            ?></time>
      

            <?php if ($article[0]['category_name']) : ?>
                <p class="category_list">Categories:
                    <?php foreach ($article as $a) : ?>
                        <?= htmlspecialchars($a['category_name']); ?>
                    <?php endforeach; ?>
                </p>
                
            <?php endif; ?>

            
                <div class="resizing">
               

                
               <?php if ($article[0]['image_file']) { ?>
                                   <img class="individual-page-img" src="uploads/<?= $article[0]['image_file']; ?>">
                               <?php } else { ?>
                                   <img class="individual-page-img" src="/uploads/artgallery-1png">
                               <?php } ?>
               </div>
   
   
                   <h2 class="content-body whited-paragraphs"><?= htmlspecialchars($article[0]['content']); ?></h2>
               </article> 
           </div>
           
           <nav>
				<ul class="nav">
        			<li class="nav-item"><a class="nav-link" href="/">Back</a></li>
				</ul>
			</nav>
                 
           <?php else: ?>
               <p>Article not found.</p>
           <?php endif; ?>
   
<?php 
     
/**
 * How to post the individual image for each blog post without a default image
<?php if ($article[0]['image_file']) : ?>
    <img class="individual-page-img"src="uploads/<?= $article[0]['image_file']; ?>">
<?php endif; ?>
*/
     
     
require 'includes/footer.php'; ?>
   
     