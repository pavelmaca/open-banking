<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard;

interface PagingInterface
{
    public function hasPaging(): bool;

    public function getPageNumber(): ?int;

    public function getPageCount(): ?int;

    public function getNextPage(): ?int;

    public function getPageSize(): ?int;

    public function getTotalCount(): ?int;
}
