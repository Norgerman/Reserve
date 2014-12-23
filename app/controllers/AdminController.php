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
            return View::make("admin.index", array("result" => $result));
        }

        public function postLogin()
        {
            $username = Input::get("username");
            $password = Input::get("password");
            $admin = Admin::where("username", "=", $username)
                          ->first();
            $values = array();
            if ($admin !== null)
            {
                if ($admin->password == hash("sha256", $password))
                {
                    Session::set("id", $admin->id);
                    if ($admin->auth == 1)
                    {
                        Session::set("type", "manager");
                        Session::set("hos_id", $admin->hospital_id);
                        $view = "admin.manager";
                    }
                    else if ($admin->auth == 2)
                    {
                        Session::set("type", "admin");
                        $view = "admin.admin";
                    }
                    Session::set("auth", $admin->auth);
                    Session::set("username", $username);

                    return View::make($view);
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
            $limit = (int)Input::get("rows");
            $page = (int)Input::get("page");
            $startrow = $limit * $page - $limit;
            if (Session::has("hospagenum"))
            {
                $total = Session::get("hospagenum");
            }
            else
            {
                $count = Hospital::count();
                $total = (int)($count / $limit) + (($count % $limit) > 0 ? 1 : 0);
                Session::set("hospagenum", $total);
            }
            $hospital = Hospital::skip($startrow)
                                ->take($limit)
                                ->get()
                                ->toArray();
            $result = array();
            $result["total"] = $total;
            $result["page"] = $page;
            $result["record"] = count($hospital);
            $result["rows"] = $hospital;

            return Response::json($result);
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