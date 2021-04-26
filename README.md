# 日志中间件

## 安装
```shell
composer require wss0823/module-push-middleware
```
> 中间件依赖 `uniondrug/middleware` 中间件基础组件。

修改 `app.php` 配置文件，加上Middleware服务，服务名称`LogMiddleware`

```php
return [
    'default' => [
        ......
        'providers'           => [
            ......
            \Uniondrug\TokenAuthMiddleware\MbsPushMiddleware::class,
        ],
    ],
];
```
修改 `server.php` 配置文件，加入 tables 内存表。
```php
return [
    'default' => [
        "tables" => [
            Uniondrug\MbsPushMiddleware\MbsPushTable::class => 64
        ],
        "class" => \App\Servers\Http::class,
    ]
   ]
```

在对应需要加入mbs发送的地方写入数据
```php
$table= $this->getTable(MbsPushTable::TABLE_NAME);
$table->set($this->>getTrace()->getRequestId(),["topicName"=>"merchant","topicTag"=>"edit","message"=>$value]);

```