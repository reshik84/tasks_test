<h1 class="text-center">Создать задачу</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Имя пользователя</label>
        <input type="text" name="username" class="form-control username_input" value="<?php echo isset($data['username'])?$data['username']:''; ?>">
        <?php if(isset($errors['username'])): ?>
            <span class="error"><?php echo $errors['username'] ?></span>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label>E-mail</label>
        <input type="text" name="email" class="form-control email_input" value="<?php echo isset($data['email'])?$data['email']:''; ?>">
        <?php if(isset($errors['email'])): ?>
            <span class="error"><?php echo $errors['email'] ?></span>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label>Текст задачи</label>
        <textarea type="text" name="task" class="form-control task_input"><?php echo isset($data['task'])?$data['task']:''; ?></textarea>
        <?php if(isset($errors['task'])): ?>
            <span class="error"><?php echo $errors['task'] ?></span>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <input type="submit" value="Сохранить" class="btn btn-success">
    </div>
</form>
