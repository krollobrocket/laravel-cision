<?php

namespace Cyclonecode\Cision\Traits;

use Cyclonecode\Cision\Feed\Image;
use Cyclonecode\Cision\Feed\Item;

trait Serialize
{
    public static function fromObject(\stdClass $data): self
    {
        return self::fromJson(\json_encode($data));
    }

    /**
     * @param  array $data
     * @return Serialize|Image|Item|Quote
     */
    public static function fromArray(array $data = []): self
    {
        $data = collect($data);

        return self::fromJson($data->toJson());
    }

    /**
     * @param  string $data
     * @return Serialize|Image|Item|Quote
     */
    public static function fromJson(string $data): self
    {
        $class = get_called_class();

        return \App::make('CisionSerializer')->deserialize($data, $class, 'json');
    }

    public static function arrayFromJson(string $data): array
    {
        $class = get_called_class();

        return \App::make('CisionSerializer')->deserialize($data, $class . '[]', 'json');
    }
}
