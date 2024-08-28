<?php

namespace Picker\ZATCA\Tags;

use Picker\ZATCA\Tag;

class InvoiceTotalAmount extends Tag
{
    public function __construct($value)
    {
        parent::__construct(4, $value);
    }
}
