<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/fontawesome/css/all.min.css">
</head>
<style>
    * {
        text-decoration: none;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 0.9rem;
        padding: 0;
        margin: 0;

    }

    body {
        position: relative;

    }

    .notif {
        position: absolute;
        right: 20px;
        top: 20px;
    }
</style>

<body>
    <p style="display:none;max-width:400px" class="alert alert-danger notif"><?= $this->error ?></p>
    <p style="display:none;max-width:400px" class="alert alert-success notif success"><?= isset($_SESSION['success']) ? $_SESSION['success'] : '' ?></p>

    <?= $this->content ?>
</body>
<?php unset($_SESSION['success']) ?>

<script>
    var p = document.querySelector('p');
    var success = document.querySelector('.success');
    var form = document.querySelector('form');
    if (p.innerHTML) {
        setTimeout(() => {
            p.style.display = 'block';
        }, 300);
        setTimeout(() => {
            p.style.display = 'none';
        }, 4000);

    }
    if (success.innerHTML) {
        setTimeout(() => {
            success.style.display = 'block';
        }, 300);
        setTimeout(() => {
            success.style.display = 'none';
        }, 4000);

    }
</script>

</html>