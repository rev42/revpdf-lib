<?php 
namespace RevPDFLib\Reader;

class SimpleXMLReader implements ReaderInterface
{
    public function parseData($data)
    {
        $formattedData = array();
        foreach ($data->attributes() as $key => $value) {
            $formattedData['report'][$key] = (string) $value;
        }
        $formattedData['source'] = $data->source;
        
        // Page Header attributes
        foreach ($data->pageHeader->attributes() as $key => $value) {
            $formattedData['pageHeader'][$key] = (string) $value;
        }
        
        // Page Header elements
        $formattedData['pageHeader']['elements'] = array();
        foreach ($data->pageHeader->children() as $key => $elements) {
                $element['value'] = (string) $elements[0];
                $element['type'] = $elements->getName();
                // Page Header elements attributes
                foreach ($elements->attributes() as $j => $value) {
                    $element[$j] = (string) $value;
                }
                $formattedData['pageHeader']['elements'][] = $element;
        }

        return $formattedData;
    }
}
