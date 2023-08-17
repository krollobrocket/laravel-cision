<?php

namespace Cyclonecode\Cision\Feed;

use Cyclonecode\Cision\Traits\Serialize;

class File
{
    use Serialize;

    private bool $IsMain;

    private string $MediaType;

    private string $Url;

    private string $FileName;

    private string $Title;

    private string $Description;

    private \DateTime $CreateDate;

    private array $Keywords;

    /**
     * @return bool
     */
    public function isIsMain(): bool
    {
        return $this->IsMain;
    }

    /**
     * @param bool $IsMain
     */
    public function setIsMain(bool $IsMain)
    {
        $this->IsMain = $IsMain;
    }

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
    public function setMediaType(string $MediaType)
    {
        $this->MediaType = $MediaType;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->Url;
    }

    /**
     * @param string $Url
     */
    public function setUrl(string $Url)
    {
        $this->Url = $Url;
    }

    /**
     * @return string
     */
    public function getFileName(): sstring
    {
        return $this->FileName;
    }

    /**
     * @param string $FileName
     */
    public function setFileName(string $FileName)
    {
        $this->FileName = $FileName;
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
    public function setTitle(string $Title)
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
    public function setDescription(string $Description)
    {
        $this->Description = $Description;
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
    public function setCreateDate(\DateTime $CreateDate)
    {
        $this->CreateDate = $CreateDate;
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
    public function setKeywords(array $Keywords)
    {
        $this->Keywords = $Keywords;
    }
}
