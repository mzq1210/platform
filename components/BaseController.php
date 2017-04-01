<?php

namespace app\components;

use Yii;
use yii\web\Controller;
use app\components\Setting;

class BaseController extends Controller {

    public $userid;
    public $username;
    public $city_id;
    public $request;

    public function init() {

        parent::init();

    }

}
