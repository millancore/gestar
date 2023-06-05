<?php vx_start('layout'); ?>
<form action="/" method="post">
    <label>
        <input type="text" name="description" placeholder="Description">
    </label>
    <button type="submit">Create</button>
</form>

<!-- List of task-->
<ul>
    <?php foreach ($tasks as $task): ?>
        <li>
            <a href="/task/<?= $task['id'] ?>">
                <?= $task['description'] ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php vx_end(); ?>

