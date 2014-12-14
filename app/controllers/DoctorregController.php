<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/12/14
 * Time: 20:04
 */




class DoctorregController
extends BaseController
{
    public function getIndex()
    {
        //返回的array中inf代表时是否注册成功："ok":成功，"username existed"：重名,"unknown error"：未知的错误
        return "医生注册";

    }


    public function getDoctorreg()
    {
        return "医生注册";
    }

    public function postDoctorreg(){
        //获取数据库中的数据
        $idnum = Input::get("Idnum");
        $pwd = Input::get("pwd");
        $department_id = Input::get("department_id");
        $username = Input::get("username");
        $name = Input::get("name");
        $description = Input::get("description");
        $auth = Input::get("auth");
        $tel = Input::get("tel");

        //判断用户名是否有重名
        $userreg = Doctor::where("username", "=", $username)
            ->first();

        if ($userreg==null){
            //加入信息到数据库
            $user = new Doctor();
            $user->idnum = $idnum;
            $user->pwd = $pwd;
            $user->department_id = $department_id;
            $user->username = $username;
            $user->name = $name;
            $user->description = $description;
            $user->auth = $auth;
            $user->tel = $tel;
            if ($user->save())
            {
                return Redirect::action("IndexController@getIndex",array("inf" => "ok"));
            }
        }
        else{
            //重名
            return Redirect::action("getIndex",array("inf" => "username existed"));
        }
        //未知的错误
        return Redirect::action("getIndex",array("inf" => "unknown error"));



    }



} 