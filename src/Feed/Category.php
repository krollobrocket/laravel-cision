<?php

namespace Cyclonecode\Cision\Feed;

use Cyclonecode\Cision\Traits\Serialize;

class Category
{
    use Serialize;

    private string $Code;
    private string $Name;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->Code;
    }

    /**
     * @param string $Code
     */
    public function setCode(string $Code): void
    {
        $this->Code = $Code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName(string $Name): void
    {
        $this->Name = $Name;
    }
}
