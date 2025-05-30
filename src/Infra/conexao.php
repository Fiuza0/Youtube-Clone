<?php
namespace Fiuza0\YoutubeClone\Infra;
use PDO;
require 'vendor/autoload.php';
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

        $connection = new PDO('mysql:host=localhost;dbname=motionless', 'root', 'Okarin=11');
        $connection->setAttribute
        (attribute:PDO::ATTR_ERRMODE, value:PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}