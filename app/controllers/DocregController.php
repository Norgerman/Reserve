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
            $department_id = trim(Input::get("department_id"));
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
                    $doctor->password = $pwd;
                    $doctor->tel = $tel;
                    $doctor->auth = 1;
                    $doctor->department_id = $department_id;
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