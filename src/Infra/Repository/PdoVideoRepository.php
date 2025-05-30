<?php

namespace Fiuza0\YoutubeClone\Infra\Repository;

require __DIR__ . '/../../vendor/autoload.php';

use \Fiuza0\YoutubeClone\Domain\Repository\VideoRepository;
use \Fiuza0\YoutubeClone\Domain\Model\Video;
use \Fiuza0\YoutubeClone\Domain\Model\Genero;
use \Fiuza0\YoutubeClone\Domain\Model\Score;
use \Fiuza0\YoutubeClone\Infra\Conexao;
use \PDO;
class PdoVideoRepository implements VideoRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Video $video):bool
    {
        if($video->id === null){
            return $this->insert($video);
        }
        return $this->update($video);
    }

    private function insert(Video $video): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO videos 
        (nome, dataPostagem, nota, genero) VALUES (?, ?, ?, ?)');
        $success = $stmt->execute([
            $video->nome,
            $video->dataPostagem,
            $video->nota,
            $video->genero
        ]);
        $video->defineId($this->pdo->lastInsertId());
        return $success;
    }
    public function getAllVideos(): array
    {
        $sqlQuery = 'SELECT * FROM videos';
        $stmt = $this->pdo->query($sqlQuery);
        return $this->hydradeVideoList($stmt);
    }

    public function getVideoById(int $id): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?');
        $stmt->execute([$id]);
        return $this->hydradeVideoList($stmt);
    }
    private function update(Video $video): bool
    {
        $stmt = $this->pdo->prepare('UPDATE videos SET nome = ?, dataPostagem = ?, nota = ?, genero = ? WHERE id = ?');
        $success = $stmt->execute([
            $video->nome,
            $video->dataPostagem,
            $video->nota->getNota(),
            $video->genero->value,
            $video->id
        ]);
        return $success;
    }
    public function deleteVideo(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM videos WHERE id = ?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $success = $stmt->execute([$id]); 
        return $success;
    }
    public function hydradeVideoList(\PDOStatement $statement): array
    {
        $videos = [];
        $listanota = [];
        //Escrever um while para capturar a lista de notas e associar ao video
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $videos[] = new Video(
                $row['id'],
                $row['nome'],
                $row['dataPostagem'],
                new Score($row['nota'],null),
                $row['genero']
            );
        }
        return $videos;
    }
    public function getVideoByGenero(Genero $genero): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM videos WHERE genero = ?');
        $stmt->execute([$genero]);
        return $this->hydradeVideoList($stmt);
    }
}