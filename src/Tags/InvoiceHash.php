<?php

namespace Picker\ZATCA\Tags;

use Picker\ZATCA\Tag;

class InvoiceHash extends Tag
{
    public function __construct($value)
    {
        parent::__construct(6, $value);
    }
}
