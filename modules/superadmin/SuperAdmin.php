<?php

namespace app\modules\superadmin;

class SuperAdmin extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\superadmin\controllers';
    public $layout = '@app/themes/main/layouts/main';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
