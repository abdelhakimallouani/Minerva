<?php
namespace App\Services;

use App\Entities\Work;
use App\Repositories\WorkRepository;

class WorkService
{
    private WorkRepository $repository;

    public function __construct(WorkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createWork(array $data, int $teacherId): void
    {
        $work = new Work(
            $data['title'],
            $data['description'],
            $data['class_id'],
            $teacherId
        );

        $this->repository->save($work);
    }

    public function getWorksByTeacher(int $teacherId): array
    {
        return $this->repository->findByTeacher($teacherId);
    }
}
?>