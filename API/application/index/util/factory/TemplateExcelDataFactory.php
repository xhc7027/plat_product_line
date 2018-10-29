<?php

namespace app\index\util\factory;

use app\index\util\exceldata\TemplateExcelDataHandle;

/**
 * Excel 模板数据处理工厂
 * Class TemplateExcelDataFactory
 * @package app\index\util\factory
 */
class TemplateExcelDataFactory implements ExcelDataFactory
{
    /**
     * @inheritdoc
     */
    public static function create()
    {
        return new TemplateExcelDataHandle();
    }
}