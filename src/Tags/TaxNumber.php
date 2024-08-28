<?php

namespace Picker\ZATCA\Tags;

use Picker\ZATCA\Tag;

class TaxNumber extends Tag
{
    public function __construct($value)
    {
        parent::__construct(2, $value);
    }
}
