<?php

require 'includes/init.php';

$conn = require 'includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 6, Article::getTotal($conn, true));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset, true);
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Travel Secrets Blog</title>
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

<div class="container-xl">
 

    <nav>
        <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
            <?php if (Auth::isLoggedIn()) : ?>

                <li class="nav-item"><a class="nav-link" href="/admin/">Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="/logout.php">Log out</a></li>
                
                <?php else : ?>

                    <li class="nav-item"><a class="nav-link" href="/login.php">Log in</a></li>

            <?php endif; ?>

            <li class="nav-item"><a class="nav-link" href="/contact.php">Contact</a></li>
        </ul>
    </nav>
    
    <main class="main-main">



<?php

if (isset($_POST['search'])) {
    $str = $_POST['search'];
    $url = '/search.php?key=' . $str;
    header("Location: {$url}");
}

?>

<?php


$email = '';
$subject = 'Subscription to Newsletter';

$sent = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];
    $subject = $_POST['subject'];


    $errors = [];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = "Please enter a valid email address";
    }


    if (empty($errors)) {

        
        try {
        
        $email = EMAIL;
        $subject = $subject;
        $from=$_POST["email"];

        $headers = "From: $from";
        
        
        $sent = true;
        
        
        
        } catch (Exception $e) {
            echo 'Subscription Failed: ' . $mail->ErrorInfo;
                }
            }
            
        }

?>

<?php if ($sent) : ?>
<?php mail($email,$subject,$headers);?>


<?php header("Refresh:2; url=index.php"); 
echo "Thankyou for Subscribing";
?>
    
<?php else: ?>


<?php if (! empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php  endif; ?>



<div id="top-content">
    
    <header>
        <h1 class="center">Travel Secrets Blog</h1>
    </header>
    


<form class="right padding-top search-form" method="post" action="/search.php">
    <label>Search</label>
    <input type="text" name="search" class="search-width">
    <input type="submit" name="submit" class="btn btn-primary black">
</form>


<img class="individual-page-img main-img" src="uploads/travel1.jpg">

<div class="newsletter-content">
    <P class="main-img-title" id="top-2nd-content">Subscibe to our newsletter</P>
    <!-- <button class="btn btn-primary">Subscribe</button> -->
    <form method="post" id="formContact" class="newsletter">

<div class="form-group newsletter" id="emailForm" name="emailForm">
    <label for="email"></label>
    <input class="form-control" name="email" id="email" type="email" placeholder="Your email"
    value="<?= htmlspecialchars($email) ?>">
</div>

    <button class="btn btn-primary normal-btn black" name="subject" id="subject" 
    value="<?= htmlspecialchars($subject) ?>">Subscribe</button>

</form>

</div>
</img>
</div>
    


 <?php endif; ?>
 
        <?php if (empty($articles)): ?>
            <p>No articles found.</p>
        <?php else: ?>

        <ul id="index">
            <div class="article-container">
                <?php foreach ($articles as $article): ?>
                
                    <div class="post">
                    <li>
                        <article>
    
                            <h2><a href="article.php?id=<?= $article['id']; ?>"><?=
                            htmlspecialchars($article['title']); ?></a></h2>

                            <time datetime="<?= $article['published_at'] ?>"><?php 
                            $datetime = new DateTime($article['published_at']);
                            echo $datetime->format("j F, Y");
                            ?></time>
                            
                            <?php if ($article['category_names']) : ?>
                                <p class="category_list">Categories:
                                    <?php foreach ($article['category_names'] as $name) : ?>
                                        <?= htmlspecialchars($name) . ', '; ?>
                                    <?php endforeach; ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($article['image_file']) { ?>
                                <img class="front-images" src="/uploads/<?= $article['image_file']; ?>">
                            <?php } else { ?>
                                <img class="front-images" src="/uploads/artgallery-1png">
                            <?php } ?>

                            <!-- <p class="whited-paragraphs"><?= htmlspecialchars($article['content']); ?></p>
                        -->
                        
                        </article>            
                    </li>
                    </div>
                        
                <?php endforeach; ?>
            </div>  
        </ul>

       <?php require 'includes/pagination.php'; ?>

        <?php endif; ?>

<?php require 'includes/footer.php'; ?>