<?php

namespace App\Entity;

use App\Repository\ServiceLogsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceLogsRepository::class)
 */
class ServiceLogs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $service_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $service_url;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status_code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceName(): ?string
    {
        return $this->service_name;
    }

    public function setServiceName(?string $service_name): self
    {
        $this->service_name = $service_name;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(?string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getServiceUrl(): ?string
    {
        return $this->service_url;
    }

    public function setServiceUrl(?string $service_url): self
    {
        $this->service_url = $service_url;

        return $this;
    }

    public function getStatusCode(): ?int
    {
        return $this->status_code;
    }

    public function setStatusCode(?int $status_code): self
    {
        $this->status_code = $status_code;

        return $this;
    }
}
