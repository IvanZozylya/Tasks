<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="content container">
    <?php if (isset($errors) && is_array($errors) && count($errors) > 0) : ?>
        <div class="alert alert-danger col-md-12">
            <ul>
                <?php for ($i = 0; $i < count($errors); $i++) : ?>

                    <li><?php echo $errors[$i];?></li>

                <?php endfor; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form name="createTask" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <img id="output_image" class="center-block"/>
                    <input type="file" accept="image/jpeg,image/png,image/gif" name="userfile"
                           onchange="preview_image(event)" required>
                    <div class="alert alert-info vOffset">
                        <strong>Info! </strong>Only jpg/gif/png formats are supported. Image can have dimensions up to
                        320х240.
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="form-group">
                    <label for="userName">User Name</label>
                    <input type="text" class="form-control" id="userName" name="userName" placeholder="User Name"
                           required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="task">Task</label>
                    <textarea class="form-control" id="task" name="task" rows="5" placeholder="Task description"
                              required></textarea>
                </div>
            </div>
        </div>

        <div class="pull-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" id="preview_create">
                Preview
            </button>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
                            <label>User Name: </label>
                            <br><input type="text" name="" id="create_name_US" disabled>
                        </div>
                        <div class="form-group">
                            <label>Email: </label>
                            <br><input type="email" name="" id="create_email_US" disabled>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="InputTask">Task</label>
                            <textarea class="form-control" name="task" id="create_task_US" rows="5" disabled></textarea>
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
<script>
    $(document).ready(function () {
        $("#preview_create").click(function () {
            $("#create_name_US").val($("#userName").val());
            $("#create_email_US").val($("#email").val());
            $("#create_task_US").val($("#task").val());

        });
    });
</script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="/template/js/createView.js"></script>

</body>
</html>
