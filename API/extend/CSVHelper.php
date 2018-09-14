<?php

class CSVHelper
{
    private static $_instance = null;

    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new CSVHelper();
        }
        return self::$_instance;
    }

    public static function saveFile($titles, $data_array, $filePath = "", $extension = "csv", $separator = ",") {
        $extension = empty($extension) ? "csv" : $extension;
        $filename = "data_".date('YmdHis').".".$extension;//文件名

        $fullPath = $filePath . DS . $filename; // 路径 + 文件名

        $csv_value = self::a_2_str($titles, $data_array, $separator);

        file_put_contents($fullPath, $csv_value);

        return $filename;

    }

    // convert array to csv data
    /*
     * $titles: 数据列名称
     * $data_array: 数组数据
     * $separator: 数据项分隔符，默认为tab符
     */
    public static function a_2_csv($titles, $data_array, $extension = "csv", $separator = "\t") {
        $extension = empty($extension) ? "csv" : $extension;
        $filename = "data_".date('YmdHis').".".$extension;//文件名

        $csv_value = self::a_2_str($titles, $data_array, $separator);

        // CSVHelper::getInstance()->log($csv_value);

        self::addHeaders($filename);
        echo $csv_value;

        return $csv_value;
    }

    private static function addHeaders($filename) {
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=".$filename);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
    }

    private static function a_2_str($titles, $data_array, $separator){
        // output columns title
        $rows = array();
        // header
        if(empty($titles)) {
            $value = self::str_2_gbk("没有指定数据列名称！^_^");
            array_push($rows, $value);
        } else {
            $value = implode($separator, $titles);
            $value = self::str_2_gbk($value);
            array_push($rows, $value);
        }

        if(empty($data_array)) {
            $value = self::str_2_gbk("没有符合您要求的数据！^_^");
            array_push($rows, $value);
        } else {
            foreach ($data_array as $data) {
                $value = implode($separator, $data);
                $value = self::str_2_gbk($value);
                array_push($rows, $value);
            }
        }
        $value = implode("\r\n", $rows);
        return $value;
    }

    private static function str_2_utf8($strInput) {
        // 页面编码为utf-8时使用，否则导出的中文为乱码
        $input_encoding = 'gb2312';
        $output_enconding = 'utf-8';
        //$value = iconv($input_encoding, $output_enconding, $strInput);
        $value = mb_convert_encoding($strInput, $output_enconding, $input_enconding);
        return $value;
    }

    private static function str_2_gbk($strInput) {
        // 页面编码为utf-8,导出文件使用gb2312时使用，否则导出的中文为乱码
        $input_encoding = 'utf-8';
        $output_enconding = 'gb2312';
        //$value = iconv($input_encoding, $output_enconding, $strInput);
        //$value = mb_convert_encoding($strInput, $output_enconding, $input_enconding);
        $value = mb_convert_encoding($strInput, $output_enconding);
        return $value;
    }

}