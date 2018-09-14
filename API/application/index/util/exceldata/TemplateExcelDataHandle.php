<?php

namespace app\index\util\exceldata;

use think\exception\HttpException;

/**
 * Excel 数据处理
 * Class TemplateExcelDataHandle
 * @package app\index\util\factory
 */
class TemplateExcelDataHandle implements ExcelDataHandle
{

    /**
     * 处理导入的模板数据
     * @param array $array
     * @return array|mixed
     *
     *
     * // Excel 模板格式：
     * //---------
     * | | | ...
     * --- | --- | --- | ...
     * 品类 | 品牌 | 机型 | ...
     * 手机 | 苹果 | iPhons 6S | ...
     * | | | ...
     * 检测选项 | | | ...
     * | | | ...
     * 一级类目 | 二级类目 | #（用#号表示默认选项）选项1 | 选项2 | <<（用<< 表示属于前一选项的子选项）选项2子选项1 | <<选项2子选项2 | 选项3 | 选项4 ｜ <<选项4子选项1 ｜ ...      //此行说明
     * 外观类 | 机身外观 | #外观完好 | 外观有划痕 | <<轻微划痕 | <<严重划痕 | 外观有磕碰或掉漆 | ...     // 此行示例
     * (此列同上可留空) | 机身 | #机身完好 | 机身变形或断裂 | ...     // 此行示例...
     * 屏幕类 | 屏幕显示 | #显示正常 | 亮点/色差/轻微发黄 | 严重老化/色斑 | 漏液/断线/显示不正常/高仿屏 | ...     // 此行示例
     * | | | ...
     *
     */
    public function handle(Array $array)
    {
        if (!$array) return [];
        $array = \ArrayHelper::removeArrayEmptyElement($array);// 移除空行；二维数组中子数组元素均为空值的子数组
        \ArrayHelper::arrayTrim($array);// Trim数组元素空格;
        $templateRes = $this->getExcelInfo($array);
        $templateData = $this->arrayAutoFillFirst($templateRes['data']);// 自动填充缺失数据
        $templateData =\ArrayHelper::removeNull($templateData);// 移除数组中的null值
        $templateData = $this->getFormatData($templateData);
        $templateRes['data'] = $templateData;
        return $templateRes;
    }

    /**
     * 获取 Excel 数据信息
     * @param $array 获取从 excel 导入的数组
     * @return array ['templateInfo' => [导入模板信息], 'data' => [导入模板数据]]
     */
    protected function getExcelInfo(Array $array) {

        if (3 > count($array)) {
            //throw new HttpException(200, '数据错误！');
            \ResponseHelper::apiFail('1010', '上传文件内容格式有误', '');
        }

        $data = [];
        $templateInfo = [];
        if (3 == count(array_filter($array[1]))) {
            list($templateInfo['category'],$templateInfo['brand'],$templateInfo['model']) = $array[1];
        } else {
            \ResponseHelper::apiFail('1010', '上传文件内容格式有误,（品类，品牌，机型）', '');
        }

        if (1 == count(array_filter($array[2]))) {
            $templateInfo['type'] = array_filter($array[2])[0];
        } else {
            throw new HttpException(200, '数据格式错误！');
        }

        foreach ($array as $key => $item)
        {
            if ($key < 3) continue;
            $data[] = $item;
        }

        return ['templateInfo' => $templateInfo, 'data' => $data];
    }

    // 根据上下文自动填充首位元素为空的数组
    protected function arrayAutoFillFirst(Array $array) {
        static $type = '';
        foreach ($array as $key => &$item)
        {
            foreach ($item as $k => &$v)
            {
                if ($k == 0) {
                    $v ? $type = $v : $item[$k] = $type ;
                }
            }
        }
        return $array;
    }

    /**
     * 获取格式化Excel数据
     * @param array $array 获取的 Excel 数据组成数组
     * @return array [
     *      'main' => [新数组],
     *      'properties' => [一级选项],
     *      'category' => [所有类别],
     *      'categoryLayer' => [按一级选项分层的二级分类],
     *      'section' => [三级选项]
     *  ];
     */
    protected function getFormatData(Array $array) {
        if (!$array) {
            return [];
        }
        $newArr = [];
        $properties = [];//属性, 一级选项
        $category = [];//类别, 所有二级选项
        $categoryLayer = [];//类别，根据属性分层
        $section = [];//三级选项, 以 << 分隔
        $parent = '';//定义变量临时存储存在三级选项的二级分类名称
        foreach ($array as $key => $item)
        {
            // 不符合要求的数据过滤掉
            if(count($item) < 3) {
                continue;
            }

            $newArr[$key] = $array[$key];
            foreach ($item as $k => $v)
            {
                // 获取一级选项和二级选项
                switch ($k)
                {
                    case '0':
                        in_array($v, $properties) ? : array_push($properties, $v) ;
                        break;
                    case '1':
                        in_array($v, $category) ? : array_push($category, $v) ;
                        $categoryLayer[$item[0]][] = $v;
                        break;
                    default:
                        break;
                }
                // 获取三级选项, 以 << 分隔
                if ( '<<' == mb_substr($v, 0,2) ) {
                    $newArr[$key][$parent][] = trim($v, '<<');// 或使用 mb_substr($v, 2);
                    $section[$parent][] = trim($v, '<<');//三级选项, 以 << 分隔
                    unset($newArr[$key][$k]);//移除二级选项中的三级选项
                } else {
                    $parent = $v;
                }
            }
        }

        return ['main' => $newArr, 'properties' => $properties, 'category' => $category, 'categoryLayer' => $categoryLayer, 'section' => $section];
        //return $newArr;
    }

}