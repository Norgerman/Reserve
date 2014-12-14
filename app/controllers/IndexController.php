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
            $idnum = Input::get("idnum");
            $pwd = Input::get("pwd");
            $user = Registeruser::where("idnum", "=", $idnum)
                                ->first();

            if ($user == null)
            {
                $result = "NOTFOUND";
            }
            else
            {
                if ($pwd === $user->password)
                {
                    $result = "TRUE";
                }
                else
                {
                    $result = "WRONGPASSWORD";
                }
            }

            return Response::make($result);
        }
    }