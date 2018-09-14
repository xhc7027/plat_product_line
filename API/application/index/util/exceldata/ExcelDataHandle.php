<?php

namespace app\index\util\exceldata;

/**
 * Excel 数据处理接口
 * Interface ExcelDataHandle
 * @package app\index\util\factory
 */
interface ExcelDataHandle
{
    /**
     * 处理数据
     * @return mixed
     */
    public function handle(Array $array);
}