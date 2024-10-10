<?php
class Database {
    private $pdo;
    private $host;
    private $db;
    private $user;
    private $pass;
    private $port;
    // Construtor para definir as configurações do banco de dados
    public function __construct($host, $db, $user, $pass, $port = 3307) {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port; // Porta padrão é 3307, mas você pode especificar outra.
    }
    // Método para conectar ao banco de dados
    public function connect() {
        try {
            // Cria uma nova instância de PDO para MySQL
            $this->pdo = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db};charset=utf8", $this->user, $this->pass);
            
            // Define o modo de erro do PDO para exceções
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            echo "Conexão com o banco de dados MySQL realizada com sucesso!<br>";
        } catch (PDOException $e) {
            // Exibe a mensagem de erro caso a conexão falhe
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage() . "<br>";
        }
    }
    public function getConnection(){
        return $this->pdo;
    }
}
?>