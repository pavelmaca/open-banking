<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard;

class StandardPaging implements PagingInterface
{
    /** @var int|null */
    protected $pageNumber;

    /** @var int|null */
    protected $pageCount;

    /** @var int|null */
    protected $nextPage;

    /** @var int|null */
    protected $pageSize;

    /** @var int|null */
    protected $totalCount;

    public function __construct(?int $pageNumber = null, ?int $pageCount = null, ?int $nextPage = null, ?int $pageSize = null, ?int $totalCount = null)
    {
        $this->pageNumber = $pageNumber;
        $this->pageCount = $pageCount;
        $this->nextPage = $nextPage;
        $this->pageSize = $pageSize;
        $this->totalCount = $totalCount;
    }

    public function hasPaging(): bool
    {
        return $this->pageNumber !== null && $this->pageCount !== null;
    }

    public function getPageNumber(): ?int
    {
        return $this->pageNumber;
    }

    public function getPageCount(): ?int
    {
        return $this->pageCount;
    }

    public function getNextPage(): ?int
    {
        return $this->nextPage;
    }

    public function getPageSize(): ?int
    {
        return $this->pageSize;
    }

    public function getTotalCount(): ?int
    {
        return $this->totalCount;
    }
}
