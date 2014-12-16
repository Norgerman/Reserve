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
            $type = Session::get("type");
            $login = "false";
            $username = null;
            if ($type)
            {
                $username = Session::get("username");
                $login = "true";
            }

            return View::make("index.index", array("login" => $login, "username" => $username));
        }

        public function postLogin()
        {
            $username = Input::get("username");
            $password = Input::get("password");
            $result = array();
            if ($password == "" || $username == "")
            {
                $result["status"] = "empty";
            }
            else
            {
                $user = Registeruser::where("username", "=", $username)
                                    ->first();

                if ($user == null)
                {
                    $result["status"] = "username";
                }
                else
                {
                    $pwd = hash("sha256", $password);
                    if ($pwd === $user->password)
                    {
                        Session::set("id", $user->id);
                        Session::set("type", "user");
                        Session::set("auth", $user->auth);
                        Session::set("username", $username);
                        $result["status"] = "succeed";
                        $result["username"] = $username;
                    }
                    else
                    {
                        $result["status"] = "password";
                    }
                }
            }


            return Response::json($result);
        }
    }