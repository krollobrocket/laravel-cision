<?php

namespace Cyclonecode\Cision\Feed;

use Cyclonecode\Cision\Traits\Serialize;

class ExternalLink
{
    use Serialize;

    private string $Title;
    private string $Url;

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
    public function getUrl(): string
    {
        return $this->Url;
    }

    /**
     * @param string $Url
     */
    public function setUrl(string $Url): void
    {
        $this->Url = $Url;
    }
}
