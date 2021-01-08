<h1 class="text-center">Список задач</h1>
<?php if($flash): ?>
<div class="alert alert-success"><?php echo $flash ?></div>
<?php endif; ?>
<div class="form-group">
    <a href="/?r=main/create" class="btn btn-success">Добавить задачу</a>
</div>
<table class="table">
    <thead>
    <tr>
        <th><a href="?page=<?php echo $page ?>&order=<?php echo $order_side ?>username">Имя пользователя</a></th>
        <th><a href="?page=<?php echo $page ?>&order=<?php echo $order_side ?>email">E-mail</a></th>
        <th>Текст задачи</th>
        <th><a href="?page=<?php echo $page ?>&order=<?php echo $order_side ?>in_work">Статус</a></th>
        <?php if(\lib\App::$isAdmin): ?>
            <th></th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($models as $model): ?>
    <tr>
        <td><?php echo $model->username ?></td>
        <td><?php echo $model->email ?></td>
        <td><?php echo $model->task ?></td>
        <td><?php echo $model->getStatus() ?></td>
        <?php if(\lib\App::$isAdmin): ?>
            <td><a href="?r=main/edit&id=<?php echo $model->id ?>">Редактировать</a></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php $count = \models\Task::getPageCount() ?>
        <?php for($i = 1; $i <= $count; $i++): ?>
        <?php
            $url = '?page=' . $i;
            if($order){
                $url .= '&order=' . $order;
            }
        ?>
        <li class="page-item"><a class="page-link" href="<?php echo $url ?>"><?php echo $i; ?></a></li>
        <?php endfor; ?>
    </ul>
</nav>
