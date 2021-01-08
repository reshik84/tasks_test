<h1 class="text-center">Создать задачу</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Имя пользователя:</label>
        <?php echo $model->username ?>
    </div>
    <div class="form-group">
        <label>E-mail:</label>
        <?php echo $model->email ?>
    </div>
    <div class="form-group">
        <label>Текст задачи</label>
        <textarea type="text" name="task" class="form-control task_input"><?php echo $model->task ?></textarea>
    </div>
    <div class="form-group">
        <label>
            <input type="hidden" name="in_work" value="0">
            <input type="checkbox" name="in_work" value="1" <?php echo $model->in_work?'checked':'' ?>> Выполнена
        </label>
    </div>
    <input type="hidden" name="id" value="<?php echo $model->id ?>">
    <div class="form-group">
        <input type="submit" value="Сохранить" class="btn btn-success">
    </div>
</form>

