<?php
namespace App\HttpController\Api;

use App\HttpController\Api\Base;
use App\Lib\Upload\Video;

/**
 * 文件上传逻辑 - 视频 图片
 * Class Upload
 * @package App\HttpController\Api
 */
class Upload extends Base
{
    public function index()
    {

    }

    public function file()
    {
        $request = $this->request();
        print_r($request);
//        $obj = new Video($request);
//
//        $obj->upload();
//        $request = $this->request();
//        $videos = $request->getUploadedFile('file');
//        $flag = $videos->moveTo("/www/wwwroot/imooc_esapi/webroot/1.jpg");
//
//        $data = [
//            'url' => "1.jpg",
//            'flag' => $flag,
//        ];
//        if ($flag) {
//            return $this->writeJson(200, 'OK', $data);
//        } else {
//            return $this->writeJson(400, 'OK', $data);
//        }
    }
}