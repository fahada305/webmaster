<?php

namespace app\modules\supplier;

class Supplier extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\supplier\controllers';

      public $layout = '@app/themes/main/layouts/main';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
