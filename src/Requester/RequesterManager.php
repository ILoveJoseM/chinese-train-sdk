<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2022-12-03
 * Time: 16:48
 */

namespace JoseChan\ChineseTrainsSdk\Requester;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;
use JoseChan\BaiduBceSdk\Requester\BaseRequester;

class RequesterManager
{
    /** @var Application $app */
    private $app;

    /**
     * RequesterManager constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    /**
     * @param $name
     * @return \Illuminate\Foundation\Application|BaseRequester
     * @throws \Exception
     */
    public function getRequester($name)
    {
        $namespace = "JoseChan\\ChineseTrainsSdk\\Requester\\";
        $class = Str::camel(ucfirst($name)) . "Requester";
        if (!class_exists($namespace . $class)) {
            throw new \Exception("Requester not exists");
        }

        return $this->app->make($namespace . $class);
    }

    /**
     * @param $name
     * @param $arguments
     * @return \JoseChan\Entity\Entity
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        $requester = $this->getRequester($name);
        return $requester->request($requester->resolveParams($arguments));
    }
}
