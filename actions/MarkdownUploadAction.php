<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/31/17
 * Time: 2:16 PM
 */

namespace componentsforyii2\extension\actions;
use componentsforyii2\extension\FileHelper;

/**
 * Class MarkdownUploadAction
 * @package componentsforyii2\extension\actions
 */
class MarkdownUploadAction extends BaseAction
{
    const FIELD_NAME = "editormd-image-file";
    public $module = "markdown";

    public function init()
    {
        $this->controller->enableCsrfValidation = false;
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        FileHelper::$module = $this->module;
        FileHelper::$filePath = "/upload/{:module}/{:Y}-{:M}-{:D}/{:name}.{:ext}";
        $result = FileHelper::upload(static::FIELD_NAME);
        $return = [
            "success"=>1,
            "message"=>"上传成功",
        ];
        if($result) {
            $return["url"] = $result["fileurl"];
        }else{
            $return["success"] = 0;
            $return["message"] = "上传失败";
        }

        return $this->controller->asJson($return);
    }
}