<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 6, Article::getTotal($conn));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);
  
   
?>
<?php require '../includes/header.php'; ?>

<h2 class="center">Administration</h2>

<p class="center"><a href="new-article.php">New Article</a></p>

        <?php if (empty($articles)): ?>
            <p>No articles found.</p>
        <?php else: ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Published</th>
                    <th>Post Image</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $article): ?>

                <tr>
                    <td>
                        <a href="article.php?id=<?= $article['id']; ?>">
                        <?= htmlspecialchars($article['title']);?></a>
                    </td>
                    <td>
                        <?php if ($article['published_at']) : ?>
                            <time><?= $article['published_at'] ?></time>
                        <?php else : ?>
                            Unpublished
                            <button class="publish" data-id="<?= $article['id'] ?>">Publish</button>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($article['image_file']) { ?>
                            <img class="thumb" src="/uploads/<?= $article['image_file']; ?>">
                        <?php } else { ?>
                            <img class="thumb" src="/uploads/artgallery-1png">
                        <?php } ?>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>

        <?php require '../includes/pagination.php'; ?>

        <?php endif; ?>

<?php require '../includes/footer.php'; ?>