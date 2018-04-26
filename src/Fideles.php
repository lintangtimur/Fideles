<?php

namespace Fideles;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet;
use Fideles\Constant\Meta;

/**
 * @see http://github.com/lintangtimur
 */
class Fideles
{
    private $file;
    /**
     * Worksheet
     *
     * @var Worksheet
     */
    private $worksheet;
    /**
     * header from excel
     *
     * @var array
     */
    private $header = [];

    public $overwrite = true;

    /**
     * Filename
     *
     * @param string $fileName
     */
    public function __construct($fileName)
    {
        $this->file = $fileName;
        $this->initWorksheet();
    }

    /**
     * Get Fideles Version
     *
     * @return string
     */
    public static function VERSION()
    {
        return Meta::VERSION;
    }

    private function initWorksheet()
    {
        $fileType = IOFactory::identify($this->file);
        $reader = IOFactory::createReader($fileType);
        $spreadsheet = $reader->load($this->file);
        $this->worksheet = $spreadsheet->getSheet(0);
        $this->coverHeader();
    }

    private function coverHeader()
    {
        $lastCol = charToIndex($this->worksheet->getHighestDataColumn());
        $lastRow = $this->worksheet->getHighestDataRow();

        $header = [];

        for ($i = 1; $i <= $lastCol; $i++) {
            $coor = $this->worksheet->getCellByColumnAndRow($i, 1)->getCoordinate();
            $result = $this->worksheet->getCell($coor)->getValue();
            $header[$result] = [
                'varchar' => 20
            ];
        }
        $this->header = $header;
    }

    /**
     * return the result converted from excel
     *
     * @return array
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * make json object
     *
     * @param  array $header
     * @return void
     */
    private function makeJson($header)
    {
        $json = json_encode($header, JSON_PRETTY_PRINT);

        return $json;
    }

    /**
     * save to json file
     *
     * @param  object $json
     * @param  string $fileName
     * @return void
     */
    public function saveToJson($fileName)
    {
        $json = $this->makeJson($this->header);
        file_put_contents($fileName . '.json', $json);
    }

    /**
     * create sql file
     *
     * @param  string $tableName
     * @param  array  $header
     * @param  string $fileName
     * @return void
     */
    public function createSql($tableName, $fileName)
    {
        $headerAuthor = "
        /* Created By StelGenerator 
        \tCreated At: %s
        */\n";
        $sqlString = "CREATE TABLE %s (
        \t id int(5) NOT NULL AUTO_INCREMENT,
        ";

        $fo = fopen($fileName . '.sql', 'w');
        fwrite($fo, sprintf($headerAuthor, date('Y-m-d H:i:s')));
        fwrite($fo, sprintf($sqlString, $tableName));
        foreach ($this->header as $key => $value) {
            $kunci = key($this->header[$key]);
            $length = $this->header[$key][$kunci];
            $dataToAppend = "\t %s %s(%d) NOT NULL,
        ";
            $gantiSpace = str_replace(' ', '_', $key);
            fwrite($fo, sprintf($dataToAppend, $gantiSpace, $kunci, $length));
        }
        fwrite($fo, "\t PRIMARY KEY(id)");
        fwrite($fo, "\n);");
        fclose($fo);
    }
}
