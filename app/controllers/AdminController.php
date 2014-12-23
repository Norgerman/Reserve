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
                        $values["name"] = Hospital::find($admin->hospital_id)->name;
                        $view = "admin.manager";
                    }
                    else if ($admin->auth == 2)
                    {
                        Session::set("type", "admin");
                        $view = "admin.admin";
                    }
                    Session::set("auth", $admin->auth);
                    Session::set("username", $username);
                    Session::set("view", $view);
                    Session::set("values", $values);

                    return Redirect::action("AdminController@getManage");
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

        public function postLogout()
        {
            Session::remove("type");
            Session::remove("auth");
            Session::remove("username");
            Session::remove("view");
            Session::remove("values");
            if (Session::has("hos_id"))
            {
                Session::remove("hos_id");
            }

            return Redirect::action("AdminController@getIndex", array("result" => "none"));
        }

        public function getManage()
        {
            if (Session::has("view"))
            {
                $view = Session::get("view");
                $values = Session::get("values");

                return View::make($view, $values);
            }
            else
            {
                App::abort(403, "Unauthorized");
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
                $count = Session::get("hoscount");
            }
            else
            {
                $count = Hospital::count();
                $total = (int)($count / $limit) + (($count % $limit) > 0 ? 1 : 0);
                Session::set("hospagenum", $total);
                Session::set("hoscount", $count);
            }
            $hospital = Hospital::skip($startrow)
                                ->take($limit)
                                ->get()
                                ->toArray();
            $result = array();
            $result["total"] = $total;
            $result["page"] = $page;
            $result["records"] = $count;
            $result["rows"] = $hospital;

            return Response::json($result);
        }

        public function postHospitalmanage()
        {
            $oper = Input::get("oper");
            if ($oper == "edit")
            {

            }
            else if($oper == "del")
            {

            }
        }

        public function getShowdepartment()
        {
            $limit = (int)Input::get("rows");
            $page = (int)Input::get("page");
            $hospital_id = Session::get("hos_id");
            $startrow = $limit * $page - $limit;
            if (Session::has("hospagenum"))
            {
                $total = Session::get("deppagenum");
                $count = Session::get("depcount");
            }
            else
            {
                $count = Department::where("hospital_id", "=", $hospital_id)
                                   ->count();
                $total = (int)($count / $limit) + (($count % $limit) > 0 ? 1 : 0);
                Session::set("deppagenum", $total);
                Session::set("depcount", $count);
            }
            $department = Department::where("hospital_id", "=", $hospital_id)
                                    ->skip($startrow)
                                    ->take($limit)
                                    ->get()
                                    ->toArray();
            $result = array();
            $result["total"] = $total;
            $result["page"] = $page;
            $result["records"] = $count;
            $result["rows"] = $department;

            return Response::json($result);
        }

        public function postDepartmentmanager()
        {

        }

        public function getShowdoctor()
        {
            $limit = (int)Input::get("rows");
            $page = (int)Input::get("page");
            $department_id = Input::get("department_id");
            $startrow = $limit * $page - $limit;

            $count = Doctor::where("department_id", "=", $department_id)
                           ->count();
            $total = (int)($count / $limit) + (($count % $limit) > 0 ? 1 : 0);

            $doctor = Doctor::where("department_id", "=", $department_id)
                            ->skip($startrow)
                            ->take($limit)
                            ->get()
                            ->toArray();
            $result = array();
            $result["total"] = $total;
            $result["page"] = $page;
            $result["records"] = $count;
            $result["rows"] = $doctor;
        }

        public function postDoctormanager()
        {

        }

        public function getShowvisit()
        {
            $limit = (int)Input::get("rows");
            $page = (int)Input::get("page");
            $doctor_id = Input::get("doctor_id");
            $startrow = $limit * $page - $limit;

            $count = Visit::where("doctor_id", "=", $doctor_id)
                          ->count();
            $total = (int)($count / $limit) + (($count % $limit) > 0 ? 1 : 0);

            $visit = Visit::where("doctor_id", "=", $doctor_id)
                          ->skip($startrow)
                          ->take($limit)
                          ->get()
                          ->toArray();
            $result = array();
            $result["total"] = $total;
            $result["page"] = $page;
            $result["records"] = $count;
            $result["rows"] = $visit;
        }

        public function postVisitmanager()
        {

        }

        public function getShoworder()
        {
            $limit = (int)Input::get("rows");
            $page = (int)Input::get("page");
            $visit_id = Input::get("visit_id");
            $startrow = $limit * $page - $limit;

            $count = Order::where("visit_id", "=", $visit_id)
                          ->count();
            $total = (int)($count / $limit) + (($count % $limit) > 0 ? 1 : 0);

            $order = Order::where("visit_id", "=", $visit_id)
                          ->skip($startrow)
                          ->take($limit)
                          ->get()
                          ->toArray();
            $result = array();
            $result["total"] = $total;
            $result["page"] = $page;
            $result["records"] = $count;
            $result["rows"] = $order;
        }

        public function postOrdermanager()
        {

        }

    }