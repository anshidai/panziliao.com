<?php 

namespace common\components\helper;

/**
* 数组处理类
*/
class ArrayHelper
{
	
	/**
	* 从数组中删除空白的元素（包括只有空白字符的元素）
	* 用法：
    * $arr = array('', 'test', '   ');
    * ArrayHelper::removeEmpty($arr);
    * var_dump($hashmap);
    *   // 输出结果为
    *   array(
    *      'test'
    *    )
	 
	* @param array $arr 要处理的数组
	* @param boolean $trim 是否对数组元素调用 trim 函数
	*/
	public static function removeEmpty(&$arr, $trim = true)
	{
		foreach($arr as $key => $val) {
            if(is_array($val)) {
                self::removeEmpty($arr[$key]);
            }else {
                if($val == '') {
                    unset($arr[$key]);
                }elseif($trim) {
                    if(trim($val)==''){
                        unset($arr[$key]);
                    }
                }
            }
        }
        return $arr;
	}
	
	/**
	* 从一个二维数组中返回指定键的所有值
	* @param array $arr 数据源
	* @param string $col 要查询的键
	* @return array 包含指定键所有值的数组
	*/
	public static function getCols($arr, $col)
	{
		$ret = array();
        foreach($arr as $val) {
            if(isset($val[$col])) {
                $ret[] = $val[$col];
            }
        }
        return $ret;
	}
	
	/**
     * 将一个二维数组转换为 HashMap，并返回结果
     *
     * 用法1：
     * $rows = array(
     *     array('id' => 1, 'value' => '1-1'),
     *     array('id' => 2, 'value' => '2-1'),
     * );
     * $hashmap = ArrayHelper::toHashmap($rows, 'id', 'value');
     *
     * var_dump($hashmap);
     *   // 输出结果为
     *    array(
     *      1 => '1-1',
     *      2 => '2-1',
     *    )
     *
     * 如果省略 $valueField 参数，则转换结果每一项为包含该项所有数据的数组。
     *
     * 用法2：
     * @code php
     * $rows = array(
     *     array('id' => 1, 'value' => '1-1'),
     *     array('id' => 2, 'value' => '2-1'),
     * );
     * $hashmap = ArrayHelper::toHashmap($rows, 'id');
     *
     * var_dump($hashmap);
     *   // 输出结果为
     *    array(
     *      1 => array('id' => 1, 'value' => '1-1'),
     *      2 => array('id' => 2, 'value' => '2-1'),
     *    )
     *
     * @param array $arr 数据源
     * @param string $keyField 按照什么键的值进行转换
     * @param string $valueField 对应的键值
     * @return array 转换后的 HashMap 样式数组
     */
    static function toHashmap($arr, $keyField, $valueField = null)
    {
        $ret = array();
        if($valueField) {
            foreach($arr as $val) {
                $ret[$val[$keyField]] = $val[$valueField];
            }
        } else {
            foreach($arr as $val) {
                $ret[$val[$keyField]] = $val;
            }
        }
        return $ret;
    }
     
    /**
     * 将一个二维数组按照指定字段的值分组
     *
     * @param array $arr 数据源
     * @param string $keyField 作为分组依据的键名
     * @return array 分组后的结果
     */
    public static function groupBy($arr, $keyField)
    {
        $ret = array();
        foreach ($arr as $val) {
            $key = $val[$keyField];
            $ret[$key][] = $val;
        }
        return $ret;
    }
     
    /**
     * 将一个平面的二维数组按照指定的字段转换为树状结构
     *
     * 如果要获得任意节点为根的子树，可以使用 $refs 参数：
     * 用法：
     * $refs = null;
     * $tree = ArrayHelper::tree($rows, 'id', 'parent', 'nodes', $refs);
     *
     * // 输出 id 为 3 的节点及其所有子节点
     * $id = 3;
     * var_dump($refs[$id]);
     *
     * @param array $arr 数据源
     * @param string $keyNodeId 节点ID字段名
     * @param string $keyParentId 节点父ID字段名
     * @param string $keyChildrens 保存子节点的字段名
     * @param boolean $refs 是否在返回结果中包含节点引用
     * return array 树形结构的数组
     */
    public static function toTree($arr, $keyNodeId, $keyParentId = 'parent_id', $keyChildrens = 'childrens', &$refs = null)
    {
        $refs = array();
        foreach($arr as $offset => $val) {
            $arr[$offset][$keyChildrens] = array();
            $refs[$val[$keyNodeId]] = &$arr[$offset];
        }
     
        $tree = array();
        foreach($arr as $offset => $val) {
            $parentId = $val[$keyParentId];
            if($parentId) {
                if(!isset($refs[$parentId])) {
                    $tree[] = &$arr[$offset];
                    continue;
                }
                $parent = &$refs[$parentId];
                $parent[$keyChildrens][] =& $arr[$offset];
            }
            else {
                $tree[] = &$arr[$offset];
            }
        }
        return $tree;
    }

    /**
     * 将树形数组展开为平面的数组
     * @param $tree 原来的树
     * @param string $child 孩子节点的键
     * @param array $list 过渡用的中间数组，
     * @return array 返回列表数组
     */
    public static function treeToArray($tree,$child = '_child', &$list = array())
    {
        if(is_array($tree)) {
            $refer = array();
            foreach ($tree as $key => $value) {
                $reffer = $value;
                if(isset($reffer[$child])){
                    unset($reffer[$child]);
                    self::treeToArray($value[$child], $child, $list);
                }
                $list[] = $reffer;
            }
        }
        return $list;
    }
     
    /**
     * 根据指定的键对数组排序
     *
     * @param array $array 要排序的数组
     * @param string $keyname 排序的键
     * @param int $dir 排序方向
     * @return array 排序后的数组
     */
    public static function sortByCol($array, $keyname, $dir = SORT_ASC)
    {
        return self::sortByMultiCols($array, array($keyname => $dir));
    }
     
    /**
     * 将一个二维数组按照多个列进行排序，类似 SQL 语句中的 ORDER BY
     * 用法：
     * $rows = ArrayHelper::sortByMultiCols($rows, array(
     *     'parent' => SORT_ASC,
     *     'name' => SORT_DESC,
     * ));
     * @param array $rowset 要排序的数组
     * @param array $args 排序的键
     * @return array 排序后的数组
     */
    public static function sortByMultiCols($rowset, $args)
    {
        $sortArray = array();
        $sortRule = '';
        foreach($args as $sortField => $sortDir) {
            foreach ($rowset as $offset => $row) {
                $sortArray[$sortField][$offset] = $row[$sortField];
            }
            $sortRule .= '$sortArray[\'' . $sortField . '\'], ' . $sortDir . ', ';
        }
        if(empty($sortArray) || empty($sortRule)) {
            return $rowset;
        }
        eval('array_multisort(' . $sortRule . '$rowset);');
        return $rowset;
    }
	
	/**
     * 合并两个数组
     * @param array $arr1
     * @param array $arr2
     * @return array 合并后数组
     */
    public static function arrayMerge($arr1, $arr2)
    {
        if(!is_array($arr1) || !is_array($arr2)) {
            return array();
        }
        $ret = $arr1;
        foreach($arr2 as $key => $val) {
            $ret[$key] = $val;
        }
        return $ret;
    }
	
	/**
     * 检查个数组中所有元素是否在字符串中出现
     * @param array|string $search 查找内容
     * @param string $text 在该内容中进行查找
	 * @return boole true:存在 false：不存在
     */
    public static function searchInText($search, $text)
    {
        if(is_array($search)) {
            $res = preg_match("/" . implode('|',$search) . "/", $text);
        } else {
            $res = strpos($text, $search);
            if($res !== false) {
                $res = true;
            }
        }
        if($res) {
            $res = true;
        } else {
            $res = false;
        }
        return $res;
    }
	
	/**
     * 不区分大小写的in_array实现
     * @param array|string $value 查找内容
     * @param array $array 在该内容中进行查找
	 * @return boole true:存在 false：不存在
     */
	public static function inArrayCase($value, $array)
	{
		return in_array(strtolower($value),array_map('strtolower',$array));
	}
	
	/**
     * 将array转成xml字符串
     * 地推的调用
     * @param type $arr
     */
    public static function arrayToXml($arr, $dom=0,$item=0, $trimXmlTag = true)
    {
        if(!$dom) {
            $dom = new DOMDocument("1.0");
        }
        if(is_string($item)) {
            $item = $dom->createElement($item); 
            $dom->appendChild($item);
        }elseif(!$item) {
            $item = $dom->createElement("root"); 
            $dom->appendChild($item);
        }
        foreach($arr as $key=>$val) {
            $itemx = $dom->createElement(is_string($key)? $key: "item");
            $item->appendChild($itemx);
            if(!is_array($val)) {
                $text = $dom->createTextNode($val);
                $itemx->appendChild($text);

            }else {
                self::arrayToXml($val,$dom,$itemx);
            }
        }
        if($trimXmlTag) {
            $ret = str_replace(array('<?xml version="1.0"?>',), array('',), $dom->saveXML());
        }else {
            $ret = $dom->saveXML();
        }
        return $ret;
    }
    
    /**
     * 将xml字符串转成数组
     * @param type $xmlStr
     * @return type
     */
    public static function xmlToArray($xmlStr)
    {
        $sxi = new SimpleXmlIterator($xmlStr, LIBXML_NOCDATA);
        return self::sxiToArray($sxi);
    }

    private static function sxiToArray($sxi)
    {
        $ret = array();
        for($sxi->rewind(); $sxi->valid(); $sxi->next()) {
            if($sxi->hasChildren()) {
                if(!array_key_exists($sxi->key(), $ret)) {
                    $ret[$sxi->key()] = array();
                }
                $ret[$sxi->key()][] = self::sxiToArray($sxi->current());
            } else {
                $ret[$sxi->key()] = (string) $sxi->current();
            }
        }
        return $ret;
    }

	
	
	
	
}