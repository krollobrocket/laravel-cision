<?php

namespace Cyclonecode\Cision\Feed;

use Cyclonecode\Cision\Traits\Serialize;

class Image
{
    use Serialize;

    protected string $MediaType;
    protected string $FileName;
    protected string $DownloadUrl;
    protected string $Photographer;
    protected string $UrlTo100x100Thumbnail;
    protected string $UrlTo200x200Thumbnail;
    protected string $UrlTo100x100ArResized;
    protected string $UrlTo200x200ArResized;
    protected string $UrlTo400x400ArResized;
    protected string $UrlTo800x800ArResized;
    protected \DateTime $CreateDate;
    protected string $Title;
    protected string $Description;
    protected array $Keywords;

    /**
     * @return string
     */
    public function getMediaType(): string
    {
        return $this->MediaType;
    }

    /**
     * @param string $MediaType
     */
    public function setMediaType(string $MediaType): void
    {
        $this->MediaType = $MediaType;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->FileName;
    }

    /**
     * @param string $FileName
     */
    public function setFileName(string $FileName): void
    {
        $this->FileName = $FileName;
    }

    /**
     * @return string
     */
    public function getDownloadUrl(): string
    {
        return $this->DownloadUrl;
    }

    /**
     * @param string $DownloadUrl
     */
    public function setDownloadUrl(string $DownloadUrl): void
    {
        $this->DownloadUrl = $DownloadUrl;
    }

    /**
     * @return string
     */
    public function getPhotographer(): string
    {
        return $this->Photographer;
    }

    /**
     * @param string $Photographer
     */
    public function setPhotographer(string $Photographer): void
    {
        $this->Photographer = $Photographer;
    }

    /**
     * @return string
     */
    public function getUrlTo100x100Thumbnail(): string
    {
        return $this->UrlTo100x100Thumbnail;
    }

    /**
     * @param string $UrlTo100x100Thumbnail
     */
    public function setUrlTo100x100Thumbnail(string $UrlTo100x100Thumbnail): void
    {
        $this->UrlTo100x100Thumbnail = $UrlTo100x100Thumbnail;
    }

    /**
     * @return string
     */
    public function getUrlTo200x200Thumbnail(): string
    {
        return $this->UrlTo200x200Thumbnail;
    }

    /**
     * @param string $UrlTo200x200Thumbnail
     */
    public function setUrlTo200x200Thumbnail(string $UrlTo200x200Thumbnail): void
    {
        $this->UrlTo200x200Thumbnail = $UrlTo200x200Thumbnail;
    }

    /**
     * @return string
     */
    public function getUrlTo100x100ArResized(): string
    {
        return $this->UrlTo100x100ArResized;
    }

    /**
     * @param string $UrlTo100x100ArResized
     */
    public function setUrlTo100x100ArResized(string $UrlTo100x100ArResized): void
    {
        $this->UrlTo100x100ArResized = $UrlTo100x100ArResized;
    }

    /**
     * @return string
     */
    public function getUrlTo200x200ArResized(): string
    {
        return $this->UrlTo200x200ArResized;
    }

    /**
     * @param string $UrlTo200x200ArResized
     */
    public function setUrlTo200x200ArResized(string $UrlTo200x200ArResized): void
    {
        $this->UrlTo200x200ArResized = $UrlTo200x200ArResized;
    }

    /**
     * @return string
     */
    public function getUrlTo400x400ArResized(): string
    {
        return $this->UrlTo400x400ArResized;
    }

    /**
     * @param string $UrlTo400x400ArResized
     */
    public function setUrlTo400x400ArResized(string $UrlTo400x400ArResized): void
    {
        $this->UrlTo400x400ArResized = $UrlTo400x400ArResized;
    }

    /**
     * @return string
     */
    public function getUrlTo800x800ArResized(): string
    {
        return $this->UrlTo800x800ArResized;
    }

    /**
     * @param string $UrlTo800x800ArResized
     */
    public function setUrlTo800x800ArResized(string $UrlTo800x800ArResized): void
    {
        $this->UrlTo800x800ArResized = $UrlTo800x800ArResized;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate(): \DateTime
    {
        return $this->CreateDate;
    }

    /**
     * @param \DateTime $CreateDate
     */
    public function setCreateDate(\DateTime $CreateDate): void
    {
        $this->CreateDate = $CreateDate;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->Title;
    }

    /**
     * @param string $Title
     */
    public function setTitle(string $Title): void
    {
        $this->Title = $Title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     */
    public function setDescription(string $Description): void
    {
        $this->Description = $Description;
    }

    /**
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->Keywords;
    }

    /**
     * @param array $Keywords
     */
    public function setKeywords(array $Keywords): void
    {
        $this->Keywords = $Keywords;
    }
}
