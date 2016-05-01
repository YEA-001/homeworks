<?php

/**
 * Created by PhpStorm.
 * User: Y
 * Date: 4/30/2016
 * Time: 4:30 PM
 */
class Scanner
{
    protected $destination;
    private $fileList;
    public function __construct($destination)
    {
        $this->destination = $destination;
        $this->fileList = scandir($destination);
        //echo 'scandir' . $destination;
        //var_dump($this->fileList);
        if ($this->fileList === false)
            $this->fileList = Array();

        if (($key = array_search('.', $this->fileList)) !== false)
            unset($this->fileList[$key]);

        if (($key = array_search('..', $this->fileList)) !== false)
            unset($this->fileList[$key]);
    }

    public function getFileList()
    {
        return $this->fileList;
    }
}

class ListSortedByName extends Scanner
{
    public function __construct($destination)
    {
        parent::__construct($destination);
    }

    public function getFileList()
    {
        return parent::getFileList();
    }
}

class ListSortedBySize extends Scanner
{
    public function __construct($destination)
    {
        parent::__construct($destination);
    }
    public function getFileList()
    {
        $arrayUnsorted = parent::getFileList();
        $arraySorted = Array();


        foreach ($arrayUnsorted as $key => $value){
            $arraySorted[filesize($this->destination . $value)] = $value;
        }

        ksort($arraySorted);

        return $arraySorted;
    }
}

class ListSortedByCDate extends Scanner
{
    public function __construct($destination)
    {
        parent::__construct($destination);
    }

    public function getFileList()
    {
        $arrayUnsorted = parent::getFileList();
        $arraySorted = Array();

        foreach ($arrayUnsorted as $key => $value){
            $arraySorted[filectime($this->destination . $value)] = $value;
        }

        ksort($arraySorted);
        
        return $arraySorted;
    }
}