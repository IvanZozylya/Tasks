<?php require_once ROOT . "/views/layouts/header.php"; ?>

    <div class="container content">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="col-md-2">Image</th>
                <th class="col-md-2" id="userName">User Name</th>
                <th class="col-md-2" id="userEmail">Email</th>
                <th class="col-md-1" id="userStatus">Status</th>
                <th class="col-md-4">Task</th>
                <th class="col-md-1">Actions</th>
            </tr>
            </thead>
            <tbody class="newlist">
            <?php foreach ($tasks as $task) : ?>
                <tr>
                    <td style="">
                        <img src="<?php echo $task['img']; ?>" class="img-rounded" width="100px" height="75px">
                    </td>
                    <td><?php echo $task['name'] ?></td>
                    <td><?php echo $task['email'] ?></td>
                    <td><?php echo $task['status'] ?></td>
                    <td><?php echo $task['text'] ?></td>
                    <td>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <a href="/task/edit/<?php echo $task['id']; ?>"><span
                                        class="glyphicon glyphicon-pencil"></span></a>
                        <?php endif; ?>
                        <a href="/task/details/<?php echo $task['id']; ?>" class="hOffset"><span
                                    class="glyphicon glyphicon-search"></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="col-md-4 col-md-offset-5 pag">
            <?php echo $pagination->get(); ?>
        </div>
        <script src="/template/js/ajax.js"></script>
    </div>


<?php require_once ROOT . "/views/layouts/footer.php"; ?>