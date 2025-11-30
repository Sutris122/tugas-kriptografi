<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Edit Contact</title>
</head>

<body>
    <h1>Edit Contact</h1>
    <form action="<?= site_url('/contacts/update/' . $contact['id']) ?>" method="post">
        <?= csrf_field() ?>
        <p>
            <label>Name<br>
                <input type="text" name="name" required value="<?= esc($contact['name']) ?>">
            </label>
        </p>
        <p>
            <label>Email<br>
                <input type="email" name="email" required value="<?= esc($contact['email']) ?>">
            </label>
        </p>
        <p><button type="submit">Update</button></p>
    </form>
    <p><a href="<?= site_url('/contacts') ?>">Back</a></p>
</body>

</html>