<?php

namespace Cyclonecode\Cision;

class FeedSettings
{
    private $pagination = null;

    public function hasPagination(): bool
    {
        return (bool) $this->pagination;
    }

    public function getPagination(): string
    {
        return $this->pagination ?? '';
    }
}
