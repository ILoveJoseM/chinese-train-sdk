<?php


namespace JoseChan\ChineseTrainsSdk\Requester;


use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;

abstract class OpenBaseRequester extends BaseRequester
{
    /** @var Client $client */
    protected $client;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->client = $app->make("trains-open-client");
    }
}
