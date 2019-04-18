<?php

    require_once './getConnection.php';

    $options = [
        'host' => 'localhost',
        'dbname' => 'lection',
        'user' => 'root',
        'pass' => ''
    ];

    $conn = getConnection($options);

    $updated = null;

    if (!empty($_POST)) {
        if (isset($_POST['_method']) && $_POST['_method'] === 'delete') {
            $user_id = $_POST['user_id'];

            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");

            $stmt->bindParam(':id', $user_id);

            $stmt->execute();
        } else if (isset($_POST['_method']) && $_POST['_method'] === 'patch') {
            $user_id = $_POST['user_id'];
            $new_name = $_POST['name'];
            $new_email = $_POST['email'];
            $new_age = $_POST['age'];

            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");

            $stmt->bindParam(':id', $user_id);

            $stmt->execute();
            
            $user = $stmt->fetch();

            $name = $new_name !== '' ? $new_name : $user['name'];
            $email = $new_email !== '' ? $new_email : $user['email'];
            $age = $new_age !== '' ? $new_age : $user['age'];

            $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email, age = :age WHERE id = :id");

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':id', $user_id);
    
            $stmt->execute();

            $updated = 'updated';
        } else {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $age = $_POST['age'];
    
            $stmt = $conn->prepare("INSERT INTO users(name, email, age) VALUES(:name, :email, :age)");
    
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':age', $age);
    
            $stmt->execute();
        }
    }

    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();

    $users = $stmt->fetchAll();

    require_once './page.php';