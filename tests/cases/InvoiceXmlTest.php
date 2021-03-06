<?php

use ComprobanteElectronico\Data\Xml\Invoice;
use ComprobanteElectronico\Data\Normative;
use ComprobanteElectronico\Enums\SaleType;
use ComprobanteElectronico\Enums\PaymentType;

/**
 * Test invoice to XML.
 *
 * @author Cami M <info@10quality.com>
 * @license MIT
 * @package ComprobanteElectronico
 * @version 1.0.0
 */
class InvoiceXmlTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test invoice validation before XML conversion.
     * @since 1.0.0
     *
     * @expectedException        Exception
     * @expectedExceptionMessage Key is missing.
     */
    public function testPreValidation()
    {
        // Prepare
        $invoice = new Invoice;
        // Assert
        $invoice->toXml();
    }
    /**
     * Simple conversion.
     * @since 1.0.0
     */
    public function testSimpleXml()
    {
        // Prepare
        $invoice = new Invoice;
        $invoice->key = 'KEY';
        $invoice->id = 501;
        $invoice->date = '2018-12-01 22:15';
        $invoice->saleType = SaleType::CASH;
        $invoice->paymentType = PaymentType::CASH;
        $invoice->currency = 'USD';
        $invoice->normative = new Normative(['number' => 123, 'date' => time()]);
        // Exec
        $xml = $invoice->toXml();
        // Assert
        $this->assertInternalType('object', $xml);
        $this->assertInstanceOf('SimpleXMLElement', $xml);
    }
}