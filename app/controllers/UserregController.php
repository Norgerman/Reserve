<?php

    /**
     * Created by PhpStorm.
     * User: CloudeTown
     * Date: 2014/12/14
     * Time: 19:27
     */
    class UserregController
        extends BaseController
    {
        public function getIndex($type = "user", $error = "false")
        {
            return View::make("index.register", array("type" => $type, "error" => $error));
        }

        public function postUsersignin()
        {
            $username = trim(Input::get("username"));
            $idnum = trim(Input::get("idnum"));
            $origin_pwd = trim(Input::get("password"));
            $pwd = hash("sha256", $origin_pwd);
            $credit = 5;
            $tel = trim(Input::get("tel"));
            $auth = 1;
            $name = trim(Input::get("name"));
            $user = new User();
            $user->type = 1;

            try
            {
                DB::begintransaction();
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
                        Session::set("id", $register_user->id);
                        Session::set("type", "user");
                        Session::set("auth", $register_user->auth);
                        Session::set("username", $username);
                        DB::commit();

                        return Redirect::Action("IndexController@getIndex");
                    }
                    else
                    {
                        throw new PDOException();
                    }
                }
                else
                {
                    throw new PDOException();
                }
            }
            catch (PDOException $e)
            {
                DB::rollback();

                return Redirect::Action("UserregController@getIndex", array("type" => "user", "error" => "true"));
            }
        }
    }

