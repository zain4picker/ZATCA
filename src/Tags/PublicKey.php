<?php

namespace Picker\ZATCA\Tags;

use Picker\ZATCA\Tag;

class PublicKey extends Tag
{
    public function __construct($value)
    {
        parent::__construct(8, $value);
    }
}
