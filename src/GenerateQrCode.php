<?php

namespace Picker\ZATCA;

use chillerlan\QRCode\QRCode;
use InvalidArgumentException;
use chillerlan\QRCode\QROptions;
use Picker\ZATCA\Tags\InvoiceDate;
use Picker\ZATCA\Tags\InvoiceTaxAmount;
use Picker\ZATCA\Tags\InvoiceTotalAmount;
use Picker\ZATCA\Tags\Seller;
use Picker\ZATCA\Tags\TaxNumber;

class GenerateQrCode
{
    /**
     * @var Tag|Tag[] $data The data or list of tags
     */
    protected $data = [];

    /**
     * @param  Tag|Tag[]  $data  The data or list of tags
     *
     * @throws InvalidArgumentException If the TLV data structure
     *         contains other data than arrays and Tag instances.
     */
    private function __construct($data)
    {
        $this->data = array_filter($data, function ($tag) {
            return $tag instanceof Tag;
        });

        if (\count($this->data) === 0) {
            throw new InvalidArgumentException('malformed data structure');
        }
    }

    /**
     * Initial the generator from list of tags.
     *
     * @param  Tag[]  $data  The list of tags
     *
     * @return GenerateQrCode
     */
    public static function fromData($seller , $vat_register_number , $invoice_date , $total_with_tax , $tax_amount): GenerateQrCode
    {
        $data = [new Seller($seller ), // seller name
            new TaxNumber($vat_register_number), // seller tax number
            new InvoiceDate($invoice_date), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount($total_with_tax), // invoice total amount
            new InvoiceTaxAmount($tax_amount) // invoice tax amount
        ];

        return new self($data);
    }

    public static function fromArray(array $data): GenerateQrCode
    {
        return new self($data);
    }

    /**
     * Encodes an TLV data structure.
     *
     * @return string Returns a string representing the encoded TLV data structure.
     */
    public function toTLV(): string
    {
        return implode('', array_map(function ($tag) {
            return (string) $tag;
        }, $this->data));
    }

    /**
     * Encodes an TLV as base64
     *
     * @return string Returns the TLV as base64 encode.
     */
    public function toBase64(): string
    {
        return base64_encode($this->toTLV());
    }

    /**
     * Render the QR code as base64 data image.
     *
     * @param  array  $options  The list of options for QROption (https://github.com/chillerlan/php-qrcode)
     * @param  string|null  $file  File string represent file path,name and extension
     *
     * @return string
     */
    public function render(array $options = [], string $file = null): string
    {
        $options = new QROptions($options);
        return (new QRCode($options))->render($this->toBase64(), $file);
    }
}
