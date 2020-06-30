<?php

namespace app\user\model;

use think\Model;

/*
3个字段，分别为
token           text，是否开启限制标志位,1开0关
time           int， token过期时间
*/

class Token extends Model
{
}
