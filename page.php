<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <div class="registration">
        <div class="forms">
            <form action="/" method="POST">
                <h2>New User</h2>
        
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="E-mail">
                <input type="num" name="age" placeholder="Age">
        
                <button>Save</button>
            </form>

            <form action="/" method="POST">
                <h2>Update User</h2>

                <input type="hidden" name="_method" value="patch">
        
                <select name="user_id">
                    <?php foreach ($users as $user) { ?>
                        <option value="<?= $user['id'] ?>"><?= $user['id'] ?></option>
                    <?php } ?>
                </select>

                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="E-mail">
                <input type="num" name="age" placeholder="Age">
        
                <button class="edit">Edit</button>
            </form>
        </div>
    
        <table>
            <thead>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>age</th>
                <th>options</th>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr class="<?= $updated && $user['id'] === $user_id ? $updated : null ?>">
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['age'] ?></td>
                        <td>
                            <form action="/" method="POST">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <button class="danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>