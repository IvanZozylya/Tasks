<?php require_once ROOT . "/views/layouts/header.php"; ?>

<form name="createTask" class="container content" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-5 col-sm-12">
            <div class="form-group">
                <img id="output_image" class="center-block" src="<?php echo $task['img']; ?>"/>
            </div>
        </div>
        <div class="col-md-7 col-sm-12">
            <div class="form-group">
                <label for="userName">User Name</label>
                <input type="text" class="form-control" id="userName" name="userName"
                       value="<?php echo $task['name']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $task['email']; ?>"
                       disabled>
            </div>
            <div class="form-group">
                <label for="isCompleted">Completed: </label>
                <input type="checkbox" id="isCompleted" disabled <?php if ($task['status'] != 0) echo "checked"; ?>>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="task">Task</label>
                <textarea class="form-control" id="task" name="task" rows="5" placeholder="Task description"
                          disabled><?php echo $task['text']; ?></textarea>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['user'])) : ?>
        <div class="pull-right">
            <a class="btn btn-primary" name="save" href="/task/edit/<?php echo $task['id']; ?>">Edit</a>
        </div>
    <?php endif; ?>
</form>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>
