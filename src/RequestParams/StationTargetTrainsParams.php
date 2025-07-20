<?php


namespace JoseChan\ChineseTrainsSdk\RequestParams;

use Carbon\Carbon;
use JoseChan\Entity\ValidateEntity;

/**
 * @property string $train_no
 * @property string $train_date
 * @property string $rand_code
 */
class TrainRouteParams extends ValidateEntity
{
    protected function rules()
    {
        return [
            "train_no" => ["required"],
            "train_date" => ["required", function($attribute, $value, $fail){
                $carbon = Carbon::createFromFormat("Y-m-d", $value);
                if(!$carbon || $carbon->format("Y-m-d") != $value){
                    $fail("时间格式不正确");
                    return ;
                }

                if($carbon->lt(Carbon::today())){
                    $fail("时间日期不能早于今天");
                }
            }]
        ];
    }


}
