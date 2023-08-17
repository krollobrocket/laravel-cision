<?php

namespace Cyclonecode\Cision\Feed;

class Settings
{
    private string $pagination = '';
    private int $itemsPerPage;
    private int $numItems;
    private string $dateFormat;
    private string $baseSlug;
    private ?string $imageStyle;

    public function __construct()
    {
        $config = config('cision');
        $this->itemsPerPage = $config['feed_items_per_page'] ?? 0;
        $this->numItems = $config['feed_num_items'] ?? 50;
        $this->dateFormat = $config['feed_date_format'] ?? 'Y-m-d';
        $this->baseSlug = $config['feed_base_slug'] ?? 'cision';
        $this->imageStyle = $config['feed_image_style'] ?? null;
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function getNumItems(): int
    {
        return $this->numItems;
    }

    public function getDateFormat(): string
    {
        return $this->dateFormat;
    }

    public function getBaseSlug(): string
    {
        return $this->baseSlug;
    }

    public function getImageStyle(): ?string
    {
        return $this->imageStyle;
    }

    public function hasPagination(): bool
    {
        return (bool) $this->pagination;
    }

    public function getPagination(): string
    {
        return $this->pagination ?? '';
    }
}
