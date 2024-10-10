


<?php
include 'connection.php';
// Conectar ao banco de dados
$host = 'localhost'; // ou seu host
$db = 'escola'; // seu nome de banco de dados
$user = 'rafael'; // seu usuário
$pass = '123456'; // sua senha
$port = 3307;
try {
    // Criar uma instância da classe Database e conectar
    $database = new Database($host, $db, $user, $pass, $port);
    $database->connect();
    $pdo = $database->getConnection();
    // Consulta para obter todos os alunos cadastrados
    $sql = "SELECT * FROM alunos";
    $stmt = $pdo->prepare($sql); // Use $pdo, que é a conexão ao banco
    $stmt->execute();
    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Metadados e link para o arquivo CSS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Lista de Alunos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <!-- Formulário para cadastro de alunos -->
    <div class="container">
        <h1>Cadastro de Alunos</h1>
        <form action="index.php" method="post">
            <!-- Campos de entrada de dados para nome, idade, email e curso -->
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="curso">Curso:</label>
                <input type="text" id="curso" name="curso" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
        <?php
        // Processa os dados do formulário após submissão
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Captura e insere os dados no banco
            $nome = $_POST['nome'];
            $idade = $_POST['idade'];
            $email = $_POST['email'];
            $curso = $_POST['curso'];
            // Inserção no banco
            $sql = "INSERT INTO alunos (nome, idade, email, curso) VALUES (:nome, :idade, :email, :curso)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':idade', $idade);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':curso', $curso);
            if ($stmt->execute()) {
                // Exibe mensagem de sucesso
                echo "<h2>Cadastro realizado com sucesso!</h2>";
            } else {
                echo "Erro ao cadastrar.";
            }
        }
        ?>
    </div>
    <!-- Tabela para exibição de alunos cadastrados -->
    <div class="container">
        <h2>Lista de Alunos</h2>
        <table>
            <thead>
                <tr>
                    <!-- Cabeçalho da tabela -->
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Email</th>
                    <th>Curso</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exibe os alunos retornados da consulta -->
                <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= htmlspecialchars($aluno['id']); ?></td>
                    <td><?= htmlspecialchars($aluno['nome']); ?></td>
                    <td><?= htmlspecialchars($aluno['idade']); ?></td>
                    <td><?= htmlspecialchars($aluno['email']); ?></td>
                    <td><?= htmlspecialchars($aluno['curso']); ?></td>
                    <!-- Link para excluir aluno -->
                    <td><a href="deletar.php?id=<?= $aluno['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este aluno?');" style="color: purple
                ;">Excluir</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>