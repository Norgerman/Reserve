<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/15/14
     * Time: 2:08 PM
     */
    class DocregController
        extends BaseController
    {
        public function getIndex($type = "doctor", $error = "false")
        {
            return View::make("index.register", array("type" => $type, "error" => $error));
        }

        public function postDocsignin()
        {
            $username = trim(Input::get("username"));
            $name = trim(Input::get("name"));
            $orginpwd = trim(Input::get("password"));
            $pwd = hash("sha256", $orginpwd);
            $tel = trim(Input::get("tel"));
            $user = new User();
            DB::begintransaction();
            try
            {
                $user->type = 2;
                if ($user->save())
                {
                    $doctor = new Doctor();
                    $doctor->username = $username;
                    $doctor->id = $user->id;
                    $doctor->name = $name;
                }
                else
                {
                    throw new PDOException();
                }
            }
            catch (PDOException $e)
            {
                DB::rollback();

                return Redirect::Action("DocregController@getIndex", array("type" => "doctor", "error" => "true"));
            }
        }
    }