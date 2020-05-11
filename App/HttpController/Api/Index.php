<?php
namespace App\HttpController\Api;
use App\HttpController\Api\Base;
use \EasySwoole\Core\Component\Di;
use App\Lib\Redis\Redis;
use App\Model\Video as VideoModel;
use EasySwoole\Core\Http\Message\Status;
class Index extends Base
{
    public function index()
    {

    }

    public function lists()
    {
        $params = $this->request()->getRequestParam();
        $page = !empty($params['page']) ? intval($params['page']) : 1;
        $size = !empty($params['size']) ? intval($params['size']) : 5;
        $condition = [];
        if (!empty($params['cat_id'])) {
            $condition['cat_id'] = intval($params['cat_id']);
        }

        try {
            $videoModel = new VideoModel();
            $data = $videoModel->getVideoData($condition, $page, $size);
        } catch (\Exception $e) {
            return $this->writeJson(Status::CODE_BAD_REQUEST, $e->getMessage());
        }

        return $this->writeJson(Status::CODE_OK, 'OK', $data);

    }

    public function onRequest($action): ?bool
    {
        //$this->writeJson(403, '您没有权限', []);
        return true;
    }

    public function video()
    {
        $data = [
            'id' => 1,
            'name' => 'singwa老师荣获国家级计算机大赛一等奖',
            'params' => $this->request()->getRequestParam(),
        ];

        return $this->writeJson(202, 'OK', $data);
    }

    //easyswoole操作数据库mysql
    public function getVideo()
    {
        $db = Di::getInstance()->get('MYSQL');
        $result = $db->where("id", 1)->getOne('video');
        return $this->writeJson(200, 'OK', $result);
    }

    //easyswoole操作redis
    public function getRedis()
    {
//        $redis = new \Redis();
//        $redis->connect("0.0.0.0", 6379, 5);
//        $redis->set('singwa456', 90);

        //$result = Redis::getInstance()->get('singwa');
        $result = Di::getInstance()->get('REDIS')->get('singwa');
        return $this->writeJson(200, 'OK', $result);
    }

    public function yaconf()
    {
        $redis = \Yaconf::get('redis');
        return $this->writeJson(200, 'OK', $redis);
    }

    public function push()
    {
        $param = $this->request()->getRequestParam();
        Di::getInstance()->get('REDIS')->rPush('imooc_list_test', $param['f']);
    }
}