<?php


include_once 'db_config.php';

$id = $_POST['id'] ?? null;

foreach ($_POST['id'] as $ids) {
    $statement = $pdo->prepare('DELETE FROM products WHERE id = :id');
    $statement->bindValue(':id', $ids);
    $statement->execute();
} 

echo '<meta http-equiv="refresh" content="0;url=index.php">';
?>