<?php require 'includes/init.php';

$conn = require 'includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 6, Article::getTotal($conn, true));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset, true);
   
?>

<?php require 'includes/header.php'; ?>


<form class="right padding-top" method="post">
    <label>Search</label>
    <input type="text" name="search" class="search-width">
    <input type="submit" name="submit" class="btn btn-primary">
</form>

<?php

if (isset($_POST["submit"])) {
	$str = $_POST["search"];
	$stmt = $conn->prepare("SELECT * FROM `article` WHERE title LIKE '%$str%'");

	$stmt->setFetchMode(PDO:: FETCH_OBJ);
	$stmt -> execute();

	if($row = $stmt->fetch())
	{
		?>
		 <br><br><br>
			<article>
				<h2><?php echo $row->title; ?></h2>
				<time><?php echo $row->published_at; ?></time>

				<?php $img = $row->image_file; 
				echo "<img class='individual-page-img' src='uploads/{$img}'/>"?>               
				<h2 class="content-body whited-paragraphs"><?php echo $row->content;?></h2>
			</article> 
			<nav>
				<ul class="nav">
        			<li class="nav-item"><a class="nav-link" href="/">Back</a></li>
				</ul>
			</nav>
	<?php 
	}
		else{
			echo "<p class='center'>Article not found</p>";
		}
	}

?>




