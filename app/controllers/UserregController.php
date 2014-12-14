<?php
/**
 * Created by PhpStorm.
 * User: CloudeTown
 * Date: 2014/12/14
 * Time: 19:27
 */

class UserregController {
    public function getIndex($type="user", $error="false")
    {
        return View::make(index.register,array("type"=>$type,"error"=>$error));
    }

    public function postUsersignin()
    {
        $username = Input::get("username");
        $idnum = Input::get("idnum");
        $origin_pwd = Input::get("password");
        $pwd = hash("sha256", $origin_pwd);
        $credit = 5;
        $tel = Input::get("tel");
        $auth = 1;
        $name = Input::get("name");

        $user = new User();
        $user->type = 1;
        if ($user->save())
        {
            $register_user = new Registeruser();
            $register_user->id = $user->id;
            $register_user->username = $username;
            $register_user->name = $name;
            $register_user->idnum = $idnum;
            $register_user->password = $pwd;
            $register_user->credit = $credit;
            $register_user->tel = $tel;
            $register_user->auth = $auth;
            if ($register_user->save())
            {
                return Redirect::Action("IndexController@getIndex",array("login"=>"true","register_user"=>$register_user));
            }
            else
            {
                return Redirect::Action("UserregController@getIndex",array("type"=>"user","error"=>"true"));
            }
        }
        else
        {
            return Redirect::Action("UserregController@getIndex",array("type"=>"user","error"=>"true"));
        }




    }
}

