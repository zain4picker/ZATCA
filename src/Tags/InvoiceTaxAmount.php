<?php

namespace Picker\ZATCA\Tags;

use Picker\ZATCA\Tag;

class InvoiceTaxAmount extends Tag
{
    public function __construct($value)
    {
        parent::__construct(5, $value);
    }
}
