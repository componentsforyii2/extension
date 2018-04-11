<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/30/17
 * Time: 3:59 PM
 */

namespace componentsforyii2\extension\actions;
use trntv\filekit\File;
use yii\web\Response;
use componentsforyii2\extension\FileHelper;

/**
 * Class CropperAction
 * @package componentsforyii2\extension\actions
 */
class CropperAction extends BaseAction
{
    protected $fileType = "cropper";
    public function run()
    {
        FileHelper::$module = $this->fileType;
        FileHelper::$filePath = "/upload/{:module}/{:Y}-{:M}-{:D}/{:name}.{:ext}";
        $params = $this->request->post();
        $result = FileHelper::cropper($params);
        if (!$result) {
            return $this->controller->error("裁剪失败",Response::FORMAT_JSON);
        }
        return $this->controller->ajax($result);
    }
}