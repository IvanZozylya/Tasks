<?php require_once ROOT . "/views/layouts/header.php"; ?>
    <div class="container content text-center">

        <?php if (isset($errors) && is_array($errors)): ?>
            <div class="text-center"><?php foreach ($errors as $error): ?>
                <?php echo $error ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <form class="form-signin" method="post" action="">

            <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>

            <input type="text" id="inputName" class="form-control" placeholder="Name" name="inputName" required=""
                   autofocus="">

            <input type="password" id="inputPassword" class="form-control" name="inputPassword" placeholder="Password"
                   required="">

            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
        </form>

    </div>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>