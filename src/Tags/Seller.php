<?php

namespace Picker\ZATCA\Tags;

use Picker\ZATCA\Tag;

class Seller extends Tag
{
    public function __construct($value)
    {
        parent::__construct(1, $value);
    }
}
