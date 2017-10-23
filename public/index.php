<?php
require '../vendor/autoload.php';

$mysqli = new mysqli('localhost', 'dbuser', 'dbpass', 'start_testing_php');
$taskRepository = new \StartTestingPHP\Repositories\TaskRepository($mysqli);

if (!empty($_POST['task_note'])) {
    $taskRepository->create($_POST['task_note']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Start Testing Your PHP</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .container {
            width: 740px;
            margin: 0 auto;
        }

        body{
            background-color:#EEEEEE;
        }
        .todolist{
            background-color:#FFF;
            padding:20px 20px 10px 20px;
            margin-top:30px;
        }
        .todolist h1{
            margin:0;
            padding-bottom:20px;
            text-align:center;
        }

        li:last-child{
            border-bottom:none;
        }

        li {
            border:none;
            padding:10px 0;
            border-bottom:1px solid #ddd;
        }
    </style>
</head>
<body>

<?php
$tasks = $taskRepository->all();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="todolist not-done">
                <h1>Tasks</h1>
                <form method="post" role="form" class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail3">Task</label>
                        <input type="text" class="form-control" style="width: 400px;" name="task_note" placeholder="enter your next task">
                    </div>
                    <button type="submit" class="btn btn btn-primary">Add</button>
                </form>
                <hr>
<?php
if (empty($tasks)) {
?>
                <p>You have no tasks. Enjoy your day!</p>
<?php
} else {
?>
                <ul id="sortable" class="list-unstyled">
<?php
    foreach ($tasks as $task) {
?>
                    <li><?php echo htmlentities($task->getNote()); ?></li>
<?php
    }
?>
                </ul>
<?php
}
?>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>

