<h1 class="text-center">Вход</h1>
<div class="row">
    <div class="col-6 offset-3">
        <form action="" method="post">
            <div class="form-group">
                <label>Логин</label>
                <input name="login" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input name="password" type="password" class="form-control">
                <?php if($error): ?>
                <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Войти">
            </div>
        </form>
    </div>
</div>
