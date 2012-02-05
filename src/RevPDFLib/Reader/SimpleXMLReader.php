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
        
        $formattedData['pageHeader'] = $this->getPartData('pageHeader', $data);
        $formattedData['reportHeader'] = $this->getPartData('reportHeader', $data);
        $formattedData['details'] = $this->getPartData('details', $data);
        
       /*
        echo '<pre>';
        print_r($formattedData);
        echo '</pre>';exit;
        */
        return $formattedData;
    }
    
    protected function getPartData($node, $data)
    {
        $formattedData = array();
        
        foreach ($data->$node->attributes() as $key => $value) {
            $formattedData[$node][$key] = (string) $value;
        }
        $formattedData[$node]['elements'] = array();
        foreach ($data->$node->children() as $key => $elements) {
            $element['value'] = (string) $elements[0];
            $element['type'] = $elements->getName();
            foreach ($elements->attributes() as $j => $value) {
                $element[$j] = (string) $value;
            }
            $formattedData[$node]['elements'][] = $element;
        }
        
        return $formattedData[$node];
    }
}
