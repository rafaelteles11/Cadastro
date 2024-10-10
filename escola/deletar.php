<?php
include 'connection.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Conectar ao banco de dados
    $host = 'localhost';
    $db = 'escola';
    $user = 'rafael';
    $pass = '123456';
    $port = 3307;
    try {
        // Criar uma instância da classe Database e conectar
        $database = new Database($host, $db, $user, $pass, $port);
        $database->connect();
        $pdo = $database->getConnection();
        // Deletar o aluno com base no ID
        $sql = "DELETE FROM alunos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            // Redirecionar de volta para a listagem após a exclusão
            header("Location: index.php");
            exit();
        } else {
            echo "Erro ao excluir o aluno.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "ID inválido.";
}
?>