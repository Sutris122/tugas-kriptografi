<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contacts</title>
</head>

<body>
    <h1>Contacts</h1>
    <p><a href="<?= site_url('/contacts/create') ?>">Tambah Contact</a></p>
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $c): ?>
                <tr>
                    <td><?= esc($c['id']) ?></td>
                    <td><?= esc($c['name']) ?></td>
                    <td><?= esc($c['email']) ?></td>
                    <td>
                        <a href="<?= site_url('/contacts/edit/' . $c['id']) ?>">Edit</a>
                        <form action="<?= site_url('/contacts/delete/' . $c['id']) ?>" method="post" style="display:inline">
                            <?= csrf_field() ?>
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>