<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/12/14
 * Time: 20:04
 */

//getIndex:首页，（信息中包括h_id医院的h_id，name医院的名字）：没写
//postDoctordep:响应ajax，字段Idnum是医院h_Id,返回所有科室的d_Id和名字
//postDoctorreg:响应注册的信息，并且跳转到index页面，返回的array中inf代表时是否注册成功："ok":成功，"username existed"：重名,"unknown error"：未知的错误



class DoctorregController
extends BaseController
{
    public function getIndex()
    {
        //返回的医院信息
        $hospital = Hospital::all(array("h_id","name"));
        //返回的array中inf代表时是否注册成功："ok":成功，"username existed"：重名,"unknown error"：未知的错误
        return $hospital;

    }


    //获取某一个医院的所有科室
    public function postDoctordep(){
        if (Request::ajax())
        {
            //获取数据库中的数据
            $idnum=input::get("Idnum");
            //获取医院的科室
            $res = Department::where("h_id", "=", $idnum)->all(array("d_id","name"));
            //返回
            return $res;

        }

        return "error";
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