<?php

/**
 * Created by PhpStorm.
 * User: Y
 * Date: 4/30/2016
 * Time: 1:15 AM
 */

require_once 'Scanner.php';

define('SORT_BY_NAME', '0');
define('SORT_BY_CDATE', '1');
define('SORT_BY_SIZE', '2');

class Image
{
    public $size;
    public $type;
    public $path;

    public function __construct($size, $type, $path)
    {
        $this->size = $size;
        $this->type = $type;
        $this->path = $path;
    }

    public function isValid(){
        if ($this->size < 100000 && $this->type === 'image/jpeg')
            return true;

        //echo 'Image no valid. Size: ' . $this->size . ', type: ' . $this->type;
        return false;
    }

    public function copyToGallery($destination){
        //echo 'move_uploaded_file' . $this->path . ' to ' . $destination;
        move_uploaded_file($this->path, $destination);
    }
}

function getImageListSorted($destination, $sortOrder){
    switch ($sortOrder)
    {
        case SORT_BY_NAME:
            return new ListSortedByName($destination);

        case SORT_BY_SIZE:
            return new ListSortedBySize($destination);

        case SORT_BY_CDATE:
            return new ListSortedByCDate($destination);

        default:
            echo 'error. Undefined sort order';
    }
}