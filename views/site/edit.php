<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="container content">
    <?php if (isset($errors) && is_array($errors) && count($errors) > 0) : ?>
        <div class="alert alert-danger col-md-12">
            <ul>
                <?php for ($i = 0; $i < count($errors); $i++) : ?>

                    <li><?php echo $errors[$i]; ?></li>

                <?php endfor; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form name="createTask"  enctype="multipart/form-data" method="post">
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
                    <input type="email" class="form-control" id="email" name="email"
                           value="<?php echo $task['email']; ?>"
                           disabled>
                </div>
                <div class="form-group">
                    <label for="isCompleted">Completed: </label>
                    <input type="checkbox" id="isCompleted" <?php if ($task['status'] != 0) echo "checked disabled"; ?>
                           name="status" value="1">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="task">Task</label>
                    <textarea class="form-control" id="task" name="task" rows="5" placeholder="Task description"
                              required><?php echo $task['text']; ?></textarea>
                </div>
            </div>
        </div>

        <div class="pull-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" id="preview">Preview
            </button>
            <button type="submit" class="btn btn-primary" name="save">Submit</button>
        </div>
    </form>

</div>

<footer class="container text-center">
    <p class="text-muted">© 2017-2018</p>
</footer>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Task Preview</h4>
            </div>
            <div class="modal-body">

                <div class="container fullWidth">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <img id="output_image" src="<?php echo $task['img']; ?>" class="center-block"/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>User Name: </label>
                            <br><span><?php echo $task['name']; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Email: </label>
                            <br><span><?php echo $task['email']; ?></span>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="InputTask">Task</label>
                            <textarea class="form-control" name="task" rows="5" id="usContent" disabled>Some big description.</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script src="/template/js/previewEdit.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
