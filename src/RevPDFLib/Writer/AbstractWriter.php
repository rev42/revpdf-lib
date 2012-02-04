<?php
namespace RevPDFLib\Writer;

abstract class AbstractWriter
{
    abstract function open();
    abstract function close();
}