<?php
namespace Fiuza0\YoutubeClone\Infra;
use PDO;
use PDOException;
class conexao
{
    private $pdo;
    public function __construct()
    {
        $this->conectar();
    }

public static function conectar(): PDO
    {
        $databasePath = __DIR__ . '/Persistence/banco.sqlite';

        $connection = new PDO(dsn: 'sqlite:' . $databasePath);
        $connection->setAttribute
        (attribute:PDO::ATTR_ERRMODE, value:PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}