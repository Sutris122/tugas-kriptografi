<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Create Contact</title>
</head>

<body>
    <h1>Create Contact</h1>
    <form action="<?= site_url('/contacts/store') ?>" method="post">
        <?= csrf_field() ?>
        <p>
            <label>Name<br>
                <input type="text" name="name" required>
            </label>
        </p>
        <p>
            <label>Email<br>
                <input type="email" name="email" required>
            </label>
        </p>
        <p><button type="submit">Simpan</button></p>
    </form>
    <p><a href="<?= site_url('/contacts') ?>">Back</a></p>
</body>

</html>