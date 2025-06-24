<?php

namespace App\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class MapRequestPayload
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
