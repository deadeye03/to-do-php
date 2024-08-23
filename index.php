<?php
$conn = mysqli_connect("localhost", "root", "", "todo");
if ($conn->connect_error) {
    die("Connection failled: " . $conn->connect_error);
}
date_default_timezone_set('Asia/Kolkata');
$cuYear = date("Y");
$cuMonth = date("m");
$cuDay = date("d");
$cuDate = "$cuYear-$cuMonth-$cuDay";
$monthNum = $cuMonth;
$monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
$sql = "SELECT * FROM tasks WHERE createdAt='$cuDate' ";
$allTasks = $conn->query($sql);

if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    echo $task;
    $sql = "INSERT INTO tasks(task) VALUES('$task') ";
    if ($conn->query($sql) === TRUE) {
        header("Location: http://localhost/to-do");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/inputForm.css">
    <link rel="stylesheet" href="css/showBtn.css">
    <link rel="icon" href="img/list.png">
</head>
<style>
    .input__checkbox {
        margin-left: 1rem;
        cursor: pointer;
    }

    .input__checkbox:checked+.input__label {
        color: #666;
        text-decoration: line-through;
        text-decoration-color: rgb(182, 88, 88);
    }
    .hidden{
        visibility: "hidden";
        opacity: 0;
    }
</style>

<body>
    <div class="main-container">

    </div>
    <div class="todo__layout">
        <section class="todo">
            <div class="todo__header">
                <h1 class="todo__date">
                    <!-- Replace with actual list title -->
                    My To-Do List
                </h1>
            </div>
            <div class="todo__task">
                <!-- Repeat this block for each task -->
                <?php while ($work = $allTasks->fetch_assoc()): ?>
                    <div class="todo__task__content" id="task-<?php echo $work['taskid'] ?>">
                        <div class="todo__task__inputBox" style="display:flex;align-items:center;">
                            <?php if ($work['isComplete']): ?>
                                <form id="task-form-<?php echo $work['taskid'] ?>"
                                    action="/to-do/PHP/isComplete.php?id=<?php echo $work['taskid'] ?>" method="post">

                                    <input type="checkbox" id="checkbox-<?php echo $work['taskid'] ?>" name="checkbox" value=0  data-id="<?php echo $work['taskid'] ?>"   checked class="input__checkbox" id="<?php echo $work['taskid'] ?>"
                                        onchange="submitForm('<?php echo $work['taskid'] ?>')">

                                </form>
                            <?php else: ?>
                                <form id="task-form-<?php echo $work['taskid'] ?>"
                                    action="/to-do/PHP/isComplete.php?id=<?php echo $work['taskid'] ?>" method="post">

                                    <input type="checkbox" id="checkbox-<?php echo $work['taskid'] ?>" name="checkbox" value=1 data-id="<?php echo $work['taskid'] ?>"
                                        class="input__checkbox" id="<?php echo $work['taskid'] ?>"
                                        onchange="submitForm('<?php echo $work['taskid'] ?>')">

                                </form>

                            <?php endif; ?>

                            <label for="checkbox-<?php echo $work['taskid'] ?>" class="input__label"
                                id="label-<?php echo $work['taskid'] ?>">
                                <?php echo $work['task'] ?>
                            </label>
                        </div>
                        <div class="todo__task__button">
                            <button class="todo__btn edit__btn" data-id="<?php echo $work['taskid'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="icon icon__edit">
                                    <path
                                        d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V299.6l-94.7 94.7c-8.2 8.2-14 18.5-16.8 29.7l-15 60.1c-2.3 9.4-1.8 19 1.4 27.8H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z" />
                                </svg>
                            </button>
                            <form action="/to-do/PHP/delete.php?id=<?php echo $work['taskid'] ?>" method="post">
                                <button class="todo__btn delete__btn" data-id="1" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon icon__delete">
                                        <path
                                            d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="input__edit" id="input-edit-<?php echo $work['taskid'] ?>">
                            <form action="/to-do/PHP/update.php?id=<?php echo $work['taskid'] ?>" method="post"
                                class="input__form">
                                <input type="text" class="input__edit__text input__label" id="edit-text1" name="newTask">
                                <button class="todo__btn input__edit__btn" id="save-btn-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon icon__save">
                                        <path
                                            d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 288a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Repeat block ends -->
                <?php endwhile; ?>
            </div>
            <!-- INSET TASK -->
            <form action="" method="post" class="todo__footer">
                <input type="text" class="todo__input" name="task" placeholder="Add task.....">
                <button type="submit" name="submit" class="todo__btn todo__btn-add" name="button" value="My To-Do List">
                    <svg class="icon icon__add">
                        <use xlink:href="img/sprite.svg#icon-add-outline"></use>
                    </svg>
                </button>
            </form>
        </section>
        <div class="previousTask">
            <button class="previousTask__btn">See Previous Day Task</button>
            <div class="previousTask__date">
                <button class="prev" onclick="showDate(-1)">
                    <span class="arrow">
                        <</span>
                </button>
                <span id="month"><?php echo $monthName ?></span>
                <span id="date"><?php echo $cuDay ?></span>
                <button class="next show" onclick="showDate(1)">
                    <span class="arrow">></span>
                </button>
            </div>
        </div>
    </div>

    <script src="js/edit.js"></script>
    <script src="js/getPrevious.js"></script>
    <script src="js/iscomplete.js"></script>
</body>

</html>