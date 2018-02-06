<?php

class SiteController
{
    //Главная страничка
    public function actionIndex($page = 1)
    {
        //Получить все записи
        $tasks = Site::getTasks($page);

        //получаем количество записей в переменную $total
        $total = Site::getCountTasksId();

        //Создаем обьект пагинатора
        $pagination = new Pagination($total, $page, Site::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/site/index.php');

        return true;
    }

    //Добавление новой tasks
    public function actionCreate($params = false)
    {
        //Проверяем правильный ли путь в url
        Site::urlVerify($params, "/task/create");

        //Валидация полей
        if (isset($_POST['submit'])) {

            $name = $_POST['userName'];
            $email = $_POST['email'];
            $text = $_POST['task'];
            $filePath = $_FILES['userfile']['tmp_name'];

            $errors = Site::checkModelValidity($name, $email, $text, $filePath);

            if (count($errors) == 0) {
                self::saveTaskToDB($name, $email, $text, $filePath);
            }
        }

        require_once(ROOT . '/views/site/create.php');
        return true;
    }

    private function saveTaskToDB($name, $email, $text, $filePath)
    {
        //Добавляем новую task в БД и получить ее id
        if (!$last_id = Site::addNewTask($name, $email, $text)) {
            header("Location: /");
            exit();
        };

        $uploadFile = $this->saveImageToFileSystem($filePath, $last_id);

        if ($uploadFile) {
            //Обновить путь image нужной tasks в БД
            Site::editPathImage($last_id, $uploadFile);

            //Переадресация на главную страницу
            header("location: /");
        }

    }

    private function saveImageToFileSystem($filePath, $last_id)
    {
        //Меняем название файла
        $image = getimagesize($filePath);
        $extension = image_type_to_extension($image[2]);
        $newFile = $last_id . "$extension";

        //Перемещаем файл
        $uploadFile = ROOT . '/template/image/' . $newFile;
        $this->resizeImage($filePath, $uploadFile);

        //Новый путь к файлу в БД
        return '/template/image/' . $newFile;


    }

    private function resizeImage($filePath, $uploadFile)
    {
        $image = new Image();
        $image->load($filePath);
        $image->resize(320, 240);
        $image->save($uploadFile);
    }

    //Редактирование tasks
    public function actionEdit($id, $params = false)
    {
        //Проверка на авторизацию
        if (!isset($_SESSION['user'])) {
            header("Location: /signin");
        }

        //Проверка id task
        if (!is_numeric($id)) {
            header("Location: /");
            exit();
        }

        $errors = [];

        //Проверяем правильный ли путь в url
        Site::urlVerify($params, "/");

        $id = intval($id);

        //Получаем нужный task
        $task = Site::getShowItemTask($id);

        if (isset($_POST['save'])) {

            $status = (empty($_POST['status'])) ? $task['status'] : $_POST['status'];
            $text = $_POST['task'];

            if (!Site::checkTextMinSize($text)) {
                $errors[] = ('Incorrect task description: minimum number of letters is 2');
            }

            if (count($errors) == 0) {
                //Редактируем task
                Site::editTask($status, $text, $id);
                header("Location: /");
                exit();
            }


        }

        require_once(ROOT . '/views/site/edit.php');
        return true;
    }

    //Просмотр нужного task
    public function actionDetails($id, $params = false)
    {
        //Проверка id task
        if (!is_numeric($id)) {
            header("Location: /");
            exit();
        }

        //Проверяем правильный ли путь в url
        Site::urlVerify($params, "/");

        $id = intval($id);

        //Получаем нужный task
        $task = Site::getShowItemTask($id);


        require_once(ROOT . '/views/site/details.php');
        return true;

    }
}