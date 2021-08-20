<?php
/**
 * @author    : Death-Satan
 * @date      : 2021/8/20
 * @createTime: 17:30
 * @company   : Death撒旦
 * @link      https://www.cnblogs.com/death-satan
 */


class QiniuInterface implements \SaTan\Think\Sms\interfaces\SmsInterface
{
    protected \Qiniu\Auth  $auth;
    protected \Qiniu\Sms\Sms $sms;
    /**
     *
     * QiniuInterface constructor.
     *
     * @param array $config
     */
    public function __construct (array $config)
    {
        $this->auth = new \Qiniu\Auth($config['accessKey'],$config['secretKey']);
        $this->sms = new \Qiniu\Sms\Sms($this->auth);
    }

    /**
     * @inheritDoc
     */
    public function sendSms (int $phone, string $sign_name, string $template_code, array $TemplateParam = [], array $extras = [])
    {
        return $this->sms->sendMessage($sign_name,[$phone],$TemplateParam);
    }

    /**
     * @inheritDoc
     */
    public function sendBatchSms (array $phones, array $sign_name, string $template_code, array $extras = [])
    {
        $extras['params'] = empty($extras['params'])?[]:$extras['params'];
        return $this->sms->sendMessage($sign_name,$phones,$extras['params']);
    }

    /**
     * @inheritDoc
     */
    public function addSmsSign (string $sign_name, string $sign_source, string $remark, array $extras = [])
    {
        $extras['pics'] = $extras['pics']??'';
        return $this->sms->createSignature($sign_name,$sign_source,$extras['pics']);
    }

    /**
     * @inheritDoc
     */
    public function deleteSmsSign (string $sign_name, array $extras = [])
    {
        return $this->sms->deleteSignature($sign_name);
    }

    /**
     * @inheritDoc
     */
    public function modifySmsSign (string $sign_name, string $sign_source, string $remark, array $extras = [])
    {
        $id = $extras['id']??'';
        $pics = $extras['pics']??'';
        return $this->sms->updateSignature($id,$sign_name,$sign_source,$pics);
    }

    /**
     * @inheritDoc
     */
    public function querySmsSign (string $sign_name = '', array $extras = [])
    {
        return $this->sms->checkSingleSignature($sign_name);
    }

    /**
     * @inheritDoc
     */
    public function addSmsTemplate (string $template_name, int $template_type, string $template_content, string $remark, array $extras = [])
    {
        $signature_id = $extras['signature_id']??'';
        return $this->sms->createTemplate($template_name,$template_content,$template_type,$remark,$signature_id);
    }

    /**
     * @inheritDoc
     */
    public function deleteSmsTemplate (string $template_code, array $extras = [])
    {
        return $this->sms->deleteTemplate($template_code);
    }

    /**
     * @inheritDoc
     */
    public function modifySmsTemplate (string $template_code, int $template_type, string $template_name, string $template_content, string $remark, array $extras = [])
    {
        $id = $extras['id']??'';
        $signature_id = $extras['signature_id']??'';
        return $this->sms->updateTemplate($id,$template_name,$template_content,$remark,$signature_id);
    }

    /**
     * @inheritDoc
     */
    public function querySmsTemplate (string $template, array $extras = [])
    {
        return $this->sms->querySingleTemplate($template);
    }
}