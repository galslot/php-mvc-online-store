<h1>Главная страница</h1>
<br>
<h2>Main/index</h2>
<br>


<?php if(!empty($names)): ?>
    <?php foreach ($names as $name): ?>

        <p><?= $name->id ?> - <?= $name->name ?></p>

    <?php endforeach; ?>
<?php endif; ?>

