<?php

namespace Fiuza0\YoutubeClone\Domain\Repository;

use Fiuza0\YoutubeClone\Domain\Model\Genero;
use Fiuza0\YoutubeClone\Domain\Model\Video;
use PDOStatement;

interface VideoRepository
{
    public function save(Video $video): bool;
    public function getAllVideos(): array;
    public function getVideoById(int $id): ?array;

    public function deleteVideo(int $id): bool;
    public function hydradeVideoList(PDOStatement $statement): array;
    public function getVideoByGenero(Genero $genero): array;
}