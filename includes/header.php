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

<div class="container">
 

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
    
    <main>
        
