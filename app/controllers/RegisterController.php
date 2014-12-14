<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/14/14
     * Time: 6:42 PM
     */
    class RegisterController
        extends BaseController
    {
        public function getIndex()
        {
            return "注册页面";
        }

        public function getUserreg()
        {
            return "用户注册";
        }

        public function getDocreg()
        {
            return "医生注册";
        }

        public function getUsersignin()
        {
            $idnum = Input::get("Idnum");
            $pwd = Input::get("pwd");
            //TODO
            $user = new Registeruser();
            $user->idnum = $idnum;
            //TODO
            if ($user->save())
            {
                return Redirect::action("IndexController@getIndex");
            }
        }
    }