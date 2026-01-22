<?php
namespace App\Entities;

class Work
{
    private ?int $id;
    private string $title;
    private string $description;
    private ?string $filePath;
    private int $classId;
    private int $teacherId;

    public function __construct(
        string $title,
        string $description,
        int $classId,
        int $teacherId,
        ?string $filePath = null,
        ?int $id = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->classId = $classId;
        $this->teacherId = $teacherId;
        $this->filePath = $filePath;
        $this->id = $id;
    }

    public function getId(): ?int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getDescription(): string { return $this->description; }
    public function getFilePath(): ?string { return $this->filePath; }
    public function getClassId(): int { return $this->classId; }
    public function getTeacherId(): int { return $this->teacherId; }

    public function setFilePath(string $path): void { $this->filePath = $path; }
}
?>
