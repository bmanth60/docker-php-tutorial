<?php
    require_once './template.php';
    require_once './entity.php';

    function isPostBack() {
        return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
                writeTag('h1', 'Example Form');
                if (isPostBack()) {
                    try {
                        $db = parse_url(getenv("DATABASE_URL"));
                        $pdo = new PDO("pgsql:" . sprintf(
                            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                            $db["host"],
                            $db["port"],
                            $db["user"],
                            $db["pass"],
                            ltrim($db["path"], "/")
                        ));
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $password = hash('sha256', $_POST['password']);

                        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? AND LOWER(password) = ?');
                        $stmt->execute([$_POST['username'], $password]);
                        $user = $stmt->fetch();

                        if ($user === false) {
                            throw new Exception('Invalid User');
                        }

                        // Convert PDO to Entity
                        $entity = new Entity();
                        $entity->setUserName($user['username']);
                        $entity->setDisplayName($user['displayname']);
                        var_dump($entity);
                    } catch (Exception $e) {
                        if ($e->getMessage() === 'Invalid User' ) {
                            writeTag('span', 'Incorrect username or password.');
                            return;
                        }

                        writeTag('span', 'Sorry, there was an issue processing your request.');
                    }
                } else {
                    require_once './form.php';
                }
            ?>
        </div>
    </body>
</html>