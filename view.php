<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sample ToDo App</title>
  <style>
      li {
        margin-bottom: 10px;
      }

      input[type="text"] {
          width: 300px;
          height: 20px;
          font-size: 16px;
          padding: 3px;
      }
  </style>
</head>
<body>
<h1>To-Do List</h1>

<!-- Error message -->
<?php if (isset($error)): ?>
  <p style="color: red"><?= $error ?></p>
<?php endif; ?>

<!-- List of tasks -->
<ul id="taskList">
  <?php foreach ($tasks as $task): ?>
    <li>
      <form method="post">
        <input type="text" maxlength="255" name="text" value="<?= $task->text ?>" required>
        <input type="hidden" name="id" value="<?= $task->id ?>">
        <input type="hidden" name="action" value="update">
        <button type="submit">Update Task</button>
        <a href="/?action=remove&id=<?= $task->id ?>">Delete Task</a>
      </form>
    </li>
  <?php endforeach; ?>
  <li>
    <!-- Form for adding a new task -->
    <form method="post">
      <input type="text" maxlength="255" placeholder="Enter a task" name="text" required>
      <input type="hidden" name="action" value="add">
      <button type="submit">Add Task</button>
    </form>
  </li>
</ul>


</body>
</html>