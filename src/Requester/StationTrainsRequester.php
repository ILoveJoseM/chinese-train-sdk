<?php


namespace JoseChan\ChineseTrainsSdk\Requester;


use GuzzleHttp\Psr7\Utils;
use JoseChan\ChineseTrainsSdk\RequestParams\StationTrainParams;

class StationTrainRequester extends MainBaseRequester
{
    const URI = "/index/otn/zwdch/queryCC";

    protected function getParamsClass()
    {
        return StationTrainParams::class;
    }

    /**
     * @param StationTrainParams $params
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function request($params)
    {
        $uri = Utils::uriFor(self::URI);

        $response = $this->client->post($uri, [
            "form_params" => $params->toArray()
        ]);

        $body = $response->getBody();
        $array = json_decode($body, true);
        if (!is_array($array) || !is_array($array['data'] ?? [])) {
            throw new \Exception("请求接口失败：" . $array['error_description'] ?? "");
        }

        return collect($array['data'] ?? []);
    }
}
