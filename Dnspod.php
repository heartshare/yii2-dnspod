<?php
/**
 * Created by PhpStorm.
 * User: 俊杰
 * Date: 2014/10/14
 * Time: 13:04
 */

namespace iit\dnspod;


use yii\base\InvalidParamException;

class Dnspod
{

    public static $component;

    public static function send($url, $params)
    {
        $params['login_email'] = static::$component->email;
        $params['login_password '] = static::$component->password;
        $params['format'] = 'json';
        $url = Url::get($url);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, true);
        if (!is_array($params)) {
            throw new InvalidParamException("Post data must be an array.");
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        if (stripos($url, "https://") !== false) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($curl);
        $status = curl_getinfo($curl);
        curl_close($curl);
        if (isset($status['http_code']) && intval($status['http_code']) == 200) {
            return $content;
        }
        return false;
    }
} 