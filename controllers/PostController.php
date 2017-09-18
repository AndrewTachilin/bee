<?php
include_once('../view/index.php');

class PostController
{
    public function actionIndex()
    {
        include_once('../model/PostModel.php');
        $PostModel = new PostModel();
        if (isset($_POST['updateSubmit']) && !empty($_POST['updateText'])) {

            $PostModel->UpdateTaskByAdmin($_POST['updateText'], $_POST['id'],$_POST['option']);
        }

        if (isset($_POST['submit']) && isset($_POST['text'])) {


            $fileExt = explode('.', $_FILES['image']['name']);
            $fileExt = strtolower((end($fileExt)));
            $allowed = ['jpg'];
            if (in_array($fileExt, $allowed)) {
                if ($_FILES['image']['error'] === 0) {
                    $fileNewName = uniqid('', false) . '.' . $fileExt;
                    $filePath = '../images/' . $fileNewName;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
                    }
                }
            }
            $PostModel->inputTask($_POST['name'], $_POST['email'], $_POST['text'], $filePath);
        }

    }

    public function selectTasks()
    {
        include_once('../model/PostModel.php');
        $PostModel = new PostModel();
        $allTasks = $PostModel->select();
        return $allTasks;
    }

    public function pagination()
    {

        include_once('../model/PostModel.php');
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page > 1) ? ($page * 3) - 3 : 0;
        $PostModel = new PostModel();
        if (isset($_GET['field']) && isset($_GET['sort'])) {
            $res = $PostModel->pagination($start, $_GET['field'], $_GET['sort']);
        } else {
            $_GET['field'] = 'name';
            $_GET['sort'] = 'asc';
            $res = $PostModel->pagination($start, $_GET['field'], $_GET['sort']);


            return $res;
        }

    }
}

$postController = new PostController();
$allTasks = $postController->selectTasks();
$pagination = $postController->pagination();
