<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/news" method="post">
    <?= csrf_field() ?>

    <p>
        <label for="title">Title</label>
        <input type="input" name="title" value="<?= set_value('title') ?>">
    </p>

    <p>
        <label for="body">Text</label>
        <textarea name="body" cols="45" rows="4"><?= set_value('body') ?></textarea>
    </p>

    <p>
        <input type="submit" name="submit" value="Create news item">
    </p>
</form>