<?php
namespace RevPDFLib\Wrapper;

abstract class AbstractWrapper
{
    abstract function openDocument();
    abstract function closeDocument();
}