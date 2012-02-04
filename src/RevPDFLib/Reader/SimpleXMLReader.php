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
        
        foreach ($data->source->attributes() as $key => $value) {
            $formattedData['source'][$key] = (string) $value;
        }
        foreach ($data->source->children() as $key => $elements) {
            $formattedData['source'][$key] = (string) $elements[0];
        }
        
        // Page Header attributes
        foreach ($data->pageHeader->attributes() as $key => $value) {
            $formattedData['pageHeader'][$key] = (string) $value;
        }
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
        
        // Report Header attributes
        foreach ($data->reportHeader->attributes() as $key => $value) {
            $formattedData['reportHeader'][$key] = (string) $value;
        }
        $formattedData['reportHeader']['elements'] = array();
        foreach ($data->reportHeader->children() as $key => $elements) {
                $element['value'] = (string) $elements[0];
                $element['type'] = $elements->getName();
                // Page Header elements attributes
                foreach ($elements->attributes() as $j => $value) {
                    $element[$j] = (string) $value;
                }
                $formattedData['reportHeader']['elements'][] = $element;
        }
       /*
        echo '<pre>';
        print_r($formattedData);
        echo '</pre>';exit;
         */
        return $formattedData;
    }
}
