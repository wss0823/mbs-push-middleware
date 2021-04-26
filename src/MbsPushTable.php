<?php
/**
 * Created by PhpStorm.
 * User: weng
 * Date: 4/23/21
 * Time: 6:03 PM
 */
namespace Uniondrug\MbsPushMiddleware;

use Uniondrug\Phar\Server\Tables\XTable;

class MbsPushTable extends XTable
{
    /**
     * 内存表名称
     */
    const TABLE_NAME = 'mbsPushTable';
    /**
     * 列信息
     * @var array
     */
    protected $columns = [
        'topicName' => [
            parent::TYPE_STRING,
            64
        ],
        'topicTag' => [
            parent::TYPE_STRING,
            64
        ],
        'message'=>[
            parent::TYPE_STRING,
            2000
        ]
    ];

    /**
     * 内存表名称
     * @var string
     */
    public static $name = self::TABLE_NAME;

}