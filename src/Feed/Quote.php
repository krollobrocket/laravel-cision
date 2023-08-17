<?php

namespace Cyclonecode\Cision\Feed;

use Cyclonecode\Cision\Traits\Serialize;

class Quote
{
    use Serialize;

    private string $Author;
    private string $Text;

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->Author;
    }

    /**
     * @param string $Author
     */
    public function setAuthor(string $Author): void
    {
        $this->Author = $Author;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->Text;
    }

    /**
     * @param string $Text
     */
    public function setText(string $Text): void
    {
        $this->Text = $Text;
    }
}
