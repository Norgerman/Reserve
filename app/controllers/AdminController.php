<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/16/14
     * Time: 7:01 PM
     */
    class AdminController
        extends BaseController
    {
        public function getIndex($result = "none")
        {
            return Response::make($result);
        }

        public function postLogin()
        {
            $username = Input::get("username");
            $password = Input::get("password");
            $admin = Admin::where("username", "=", $username)
                          ->first();
            if ($admin !== null)
            {
                if ($admin->password == hash("sha256", $password))
                {
                    Session::set("id", $admin->id);
                    if ($admin->auth == 1)
                    {
                        Session::set("type", "manager");
                        Session::set("hos_id", $admin->hospital_id);
                        $view = "";
                    }
                    else if ($admin->auth == 2)
                    {
                        Session::set("type", "admin");
                        $view = "";
                    }
                    Session::set("auth", $admin->auth);
                    Session::set("username", $username);

                    return Redirect::action("AdminController@getIndex", array("result" => "succeed"));
                }
                else
                {
                    return Redirect::action("AdminController@getIndex", array("result" => "password"));
                }
            }
            else
            {
                return Redirect::action("AdminController@getIndex", array("result" => "username"));
            }
        }

        public function getShowhospital()
        {

        }

        public function postHospitalmanage()
        {

        }

        public function getShowdepartment()
        {

        }

        public function postDepartmentmanager()
        {

        }

        public function getShowdoctor()
        {

        }

        public function postDoctormanager()
        {

        }

        public function getShowvisit()
        {

        }

        public function postVisitmanager()
        {

        }

        public function getShoworder()
        {
            //$str=date("Y-m-d",strtotime());
        }

        public function postOrdermanager()
        {

        }

    }