<?php
/**
 * Created by PhpStorm.
 * User: 俊杰
 * Date: 2014/10/14
 * Time: 13:04
 */

namespace iit\dnspod;


use yii\base\Component;
use yii\base\InvalidParamException;

class Api extends Component
{
    public $email;
    public $password;

    public function init()
    {
        parent::init();
        if ($this->email === null || $this->password === null) {
            throw new InvalidParamException('The Email or Password not set');
        }
        Dnspod::$component = $this;
        $this->registerComponent();
    }

    public function registerComponent()
    {
        $coreComponent = [
            'dnspodAccount' => '\iit\dnspod\Account',
            'dnspodDomain' => '\iit\dnspod\Domain',
            'dnspodRecord' => '\iit\dnspod\Record',
        ];
        foreach ($coreComponent as $name => $class) {
            \Yii::$app->set($name, $class);
        }
    }

    public function getAccount()
    {
        return \Yii::$app->get('dnspodAccount');
    }

    public function getDomain()
    {
        return \Yii::$app->get('dnspodDomain');
    }

    public function getRecord()
    {
        return \Yii::$app->get('dnspodRecord');
    }
} 