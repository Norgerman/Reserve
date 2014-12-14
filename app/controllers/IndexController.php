<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/14/14
     * Time: 1:13 PM
     */
    class IndexController
        extends BaseController
    {
        public function getIndex()
        {
            return View::make("index.index", array("login" => "false"));
        }

        public function postLogin()
        {
            $username = Input::get("username");
            $password = Input::get("password");
            if($password==""||$username=="")
                $result = "MESSAGE NOT COMPLETE";
            else
            {
                $user = Registeruser::where("username", "=", $username)
                    ->first();

                if ($user == null)
                {
                    $result = "USER NOT FOUND";
                }
                else
                {
                    $pwd = hash("sha256",$password);
                    if ($password === $user->password)
                    {
                        Session::put("$username","$username");
                        $result = "SIGN IN SUCCESS";
                    }
                    else
                    {
                        $result = "WRONG PASSWORD";
                    }
                }
            }


            return Response::make($result);
        }
    }