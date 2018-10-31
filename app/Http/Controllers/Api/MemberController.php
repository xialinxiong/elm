<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Mrgoon\AliSms\AliSms;

class MemberController extends Controller
{
    //注册
    public function reg(Request $request)
    {
        $data=$request->post();
//      dd($data);
        //取出用户填写验证码和redis验证码
        $sms=$data['sms'];
        $sm=Redis::get("tel_".$data['tel']);
        //给密码加密
        $data['password']=bcrypt($data['password']);
        if ($sms==$sm){
             Member::create($data);
           $data=[
                "status" =>"true",
                "message" => "注册成功"
            ];
        }else{
            $data=[
                "status" =>"false",
                "message" => "注册失败"
            ];
        }
  return $data;

  }
//验证码
    public function sms(Request $request)
    {
        //接收数据
        $tel=$request->get('tel');
        //产生随机验证码
        $code=mt_rand(100000,999999);
        //用redis存起来
        Redis::setex("tel_".$tel,60*3,$code);
        //验证码发给手机
        $config = [
            'access_key' => env("ALIYUNU_ACCESS_ID"),
            'access_secret' => env("ALIYUNU_ACCESS_KEY"),
            'sign_name' =>  env("ALIYUNU_NAME"),
        ];

//        $aliSms = new Mrgoon\AliSms\AliSms();
        $sms = new AliSms();
//        $response = $sms->sendSms('phone number', 'tempplate code', ['name'=> 'value in your template'], $config);
        $response = $sms->sendSms($tel, 'SMS_149417437', ['code'=> $code], $config);
//         dd($response->Code);
        if ($response->Code=="OK"){
            $data = [
                "status" => true,
                "message" => "获取短信验证码成功" . $code
            ];
        }else{
            $data = [
                "status" => false,
                "message" =>$response->Message
            ];
        }

//        dd($data);
        return $data;
}
//登陆
    public function login(Request $request)
    {
        $name=$request->post('name');
        $password=$request->post('password');

        $member=Member::where("username",$name)->first();

        //判断账号密码是否正确
        if ($member && Hash::check($password,$member->password)){
            $data=[
                "status" =>"true",
                "message" => "登陆成功",
                "user_id"=>$member->id,
                "username" =>$name
            ];

            }else{
            $data=[
                "status" =>"false",
                "message" => "登陆失败"
            ];
        }
              return $data;
 }
//忘记密码
    public function forget(Request $request)
    {
        //接收数据
        $da=$request->post();
        //取出用户填写验证码和redis验证码
        $sms=$da['sms'];
        $sm=Redis::get("tel_".$da['tel']);
        //接收手机号
        $tel=$da['tel'];
        if ($sms==$sm){
            //通过手机号来找数据
            $member=Member::where("tel",$tel)->first();
            //给密码加密
            $da['password']=bcrypt($da['password']);
            //修改
            $member->update($da);
            $data=[
                "status" =>"true",
                "message" => "修改成功"
            ];
            return $data;

        }else{
            $data=[
                "status" =>"false",
                "message" => "修改失败"
            ];
            return $data;
        }

}
 //修改密码
    public function edit(Request $request)
    {
        //接收数据
        $data=$request->post();
//        读取一条
        $member=Member::where("id",$data['id'])->first();
//        dd($member);
        //解析数据库原密码
        if (Hash::check($data['oldPassword'],$member->password)){
//            dd($data);
            $data['password']=bcrypt($data['newPassword']);
            $member->update($data);
            $data=[
                "status" =>"true",
                "message" => "修改成功"
            ];
            return $data;

        }else{
            $data=[
                "status" =>"false",
                "message" => "修改失败"
            ];
            return $data;
        }



    }



}
