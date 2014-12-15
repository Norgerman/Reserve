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
        public function getIndex($login = "false", $user = null, $type="")
        {
            return View::make("index.index", array("login" => $login, "register_user" => $user));
        }

        public function postLogin()
        {
            $username = Input::get("username");
            $password = Input::get("password");
            if ($password == "" || $username == "")
            {
                $result = "MESSAGE NOT COMPLETE";
            }
            else
            {
                $user = Registeruser::where("username", "=", $username)
                                    ->first();

                if ($user == null)
                {
                    $result = "username";
                }
                else
                {
                    $pwd = hash("sha256", $password);
                    if ($pwd === $user->password)
                    {
                        Session::put("id", $username);
                        $result = "succeed";
                    }
                    else
                    {
                        $result = "password";
                    }
                }
            }


            return Response::make($result);
        }
    }