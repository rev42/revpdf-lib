<?php
namespace RevPDFLib\Element;

class FactoryElement {
    
    /**
     * Element factory
     *
     * @param string $type type of Element to generate
     *
     * @return object
     */
    public static function getFactory($type)
    {
        switch ($type) {
            case 'textZone':
                return new Textzone();
                break;
            case 'PageNumber':
                return new Pagenumber();
                break;
            case 'textField':
                return new Textfield();
                break;
            case 'Image':
                return new Image();
                break;
            case 'RoundedBox':
                return new Roundedbox();
                break;
            case 'Rectangle':
                return new Rectangle();
                break;
            case 'Line':
                return new Line();
                break;
            default:
                throw new \Exception('This element type is not supported : ' . $type);
                break;
        }
    }
}

?>
