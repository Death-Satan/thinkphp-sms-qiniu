<?php
/**
 * @author    : Death-Satan
 * @date      : 2021/8/20
 * @createTime: 17:30
 * @company   : Death撒旦
 * @link      https://www.cnblogs.com/death-satan
 */


class Qiniu extends \SaTan\Think\Sms\Driver
{

    protected function createSms (): \Satan\Think\Sms\interfaces\SmsInterface
    {
        return new QiniuInterface($this->config);
    }
}