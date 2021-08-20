# thinkphp6 七牛云 sms 驱动
## 短信驱动 基于 七牛云官方sdk轻度封装 [qiniu/php-sdk](https://github.com/qiniu/php-sdk)
# 使用
## 修改配置文件 `config/sms.php`

---
```php
return [
    'default'=>env('sms.default','qiniu'),
    'drives'=>[
        'qiniu'=>[
            'type'=>'Qiniu',
            'accessKey'=>null,//
            'secretKey'=>null,//
        ]
    ]
];
 ```
---
## 查看[sms文档](https://www.cnblogs.com/death-satan/articles/thinkphp_sms.html)