<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 判断是否为合法的身份证号
 * @param $vStr
 * @return bool
 */
function isCreditNo($idcard){
    $vCity = array(
        '11','12','13','14','15','21','22',
        '23','31','32','33','34','35','36',
        '37','41','42','43','44','45','46',
        '50','51','52','53','54','61','62',
        '63','64','65','71','81','82','91'
    );
    if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $idcard)) return false;
    if (!in_array(substr($idcard, 0, 2), $vCity)) return false;
    $vStr = preg_replace('/[xX]$/i', 'a', $idcard);
    $vLength = strlen($vStr);
    if ($vLength == 18) {
        $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
    } else {
        $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
    }
    if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
    if ($vLength == 18) {
        $vSum = 0;
        for ($i = 17 ; $i >= 0 ; $i--) {
            $vSubStr = substr($vStr, 17 - $i, 1);
            $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr , 11));
        }
        if($vSum % 11 != 1) return false;
    }
    return true;
}

/**
 * 生成密码
 * @param $password
 * @return string
 */
function mkPassword($password)
{
    return md5(md5($password));
}


/**
 * 生成验证码
 * @return \think\Response
 */
function getVerify()
{
    $captcha = new \think\captcha\Captcha();
    $captcha->imageW = 118;
    $captcha->imageH = 35;  //图片高
    $captcha->fontSize = 14;  //字体大小
    $captcha->length   = 4;  //字符数
    $captcha->fontttf = '5.ttf';  //字体
    $captcha->expire = 30;  //有效期
    $captcha->useNoise = false;  //不添加杂点
    return $captcha->entry();
}


/**
 * 校验验证码
 * @param $verify
 * @return bool+
 */
function checkVerify($verify)
{
    $captcha = new \think\captcha\Captcha();
    $result=$captcha->check($verify);
    if($result === false){
        return false;
    }else{
        return true;
    }
}