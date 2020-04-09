<?php

namespace Models;

class Team extends Model
{
    public function all(): array
    {
        $teamsRequest = 'SELECT * FROM teams ORDER BY name';
        $pdoSt = $this->pdo->query($teamsRequest);

        return $pdoSt->fetchAll();
    }

    public function find(string $id): \stdClass
    {
        $teamRequest = 'SELECT * FROM teams WHERE id = :id';
        $pdoSt = $this->pdo->prepare($teamRequest);
        $pdoSt->execute([':id' => $id]);

        return $pdoSt->fetch();
    }

    public function findByName(string $name): \stdClass
    {
        $teamRequest = 'SELECT * FROM teams WHERE name = :name';
        $pdoSt = $this->pdo->prepare($teamRequest);
        $pdoSt->execute([':name' => $name]);

        return $pdoSt->fetch();
    }

    public function save(array $team)
    {
        try {
            $insertTeamRequest = 'INSERT INTO teams(`name`, `slug`) VALUES (:name, :slug)';
            $pdoSt = $this->pdo->prepare($insertTeamRequest);
            $pdoSt->execute([':name' => $team['name'], ':slug' => $team['slug']]);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}

