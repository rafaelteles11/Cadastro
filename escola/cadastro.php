<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];

    $sql = "INSERT INTO alunos (nome, idade, email, curso) VALUES ('$nome', $idade, '$email', '$curso')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Aluno cadastrado com sucesso!'); window.location.href='index.php';</script>";
    } else {
        echo "Ocorreu um erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
