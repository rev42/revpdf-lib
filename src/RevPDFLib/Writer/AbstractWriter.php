<?php
namespace RevPDFLib\Writer;

abstract class AbstractWriter
{
    abstract function openDocument();
    abstract function closeDocument();
}