<?php
namespace RevPDFLib\Writer;

require_once BASE_DIR . 'vendors/tcpdf/tcpdf.php';

use \TCPDF;

class TcpdfWriter extends \TCPDF
{
    public function header()
    {
        $data = $this->report->getPart('pageHeader')->getElements();
        if (count($data) <= 0 || $data['isVisible'] != 1) {
            return ;
        }
        $this->setCurrentPartNumber($data->number);
        // If we have an header, the startPosition is the TopMargin + header height
        $this->report->getPart('pageHeader')->setStartPosition($this->tMargin);
        // The current position has to be reset at the Top Margin value
        $this->setCurrentPosition($this->report->getTopMargin());
        $this->writePDF($this->report->getPart('pageHeader') , $data['elements']);
    }
}