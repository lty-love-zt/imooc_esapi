<?php
namespace App\Model\Es;

use EasySwoole\Core\AbstractInterface\Singleton;
use Elasticsearch\ClientBuilder;
use EasySwoole\Core\Component\Logger;
class EsClient {
    //单例模式
    use Singleton;

    public $esClinet = null;
    //私有化构造函数
    private function __construct()
    {
        $config = \Yaconf::get("es");
        try {
            //es实例
            $this->esClinet = ClientBuilder::create()->setHosts([$config['host'] .":".$config['port']])->build();
        } catch (\Exception $e) {
            //记录日志
            Logger::getInstance()->log($e->getMessage());
        }

        if (empty($this->esClinet)) {
            throw new \Exception("es连接异常");
        }

    }
}