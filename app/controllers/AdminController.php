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
                        $hospital = Hospital::find($admin->hospital_id);
                        $values = $hospital->toArray();
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

            $sord = Input::get("sord");
            if ($sord == "" || $sord == null)
            {
                $sord = "asc";
            }

            $sidx = Input::get("sidx");
            if ($sidx == null || $sidx == "")
            {
                $sidx = "h_id";
            }

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
            $hospital = Hospital::select(array("h_id", "name", "price", "address", "province", "rank", "tel"))
                                ->skip($startrow)
                                ->take($limit)
                                ->orderBy($sidx, $sord)
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
            $status = 0;
            if ($oper == "edit")
            {
                $h_id = Input::get("h_id");
                $name = Input::get("name");
                $price = Input::get("price");
                $address = Input::get("address");
                $province = Input::get("province");
                $rank = Input::get("rank");
                $tel = Input::get("tel");
                $hospital = Hospital::find($h_id);
                if ($hospital)
                {
                    $hospital->name = $name;
                    $hospital->price = $price;
                    $hospital->address = $address;
                    $hospital->province = $province;
                    $hospital->rank = $rank;
                    $hospital->tel = $tel;
                    if ($hospital->save())
                    {
                        $status = 1;
                    }
                    else
                    {
                        $status = 2;
                    }
                }
                else
                {
                    $status = 3;
                }
            }

            return Response::json(array("status" => $status));
        }

        public function getShowadmin()
        {

            $limit = (int)Input::get("rows");
            $page = (int)Input::get("page");
            $startrow = $limit * $page - $limit;
            if (Session::has("adminpagenum"))
            {
                $total = Session::get("adminpagenum");
                $count = Session::get("admincount");
            }
            else
            {
                $count = Admin::count();
                $total = (int)($count / $limit) + (($count % $limit) > 0 ? 1 : 0);
                Session::set("adminpagenum", $total);
                Session::set("admincount", $count);
            }

            $sord = Input::get("sord");
            if ($sord == "" || $sord == null)
            {
                $sord = "asc";
            }

            $admin = Admin::skip($startrow)
                          ->take($limit)
                          ->orderBy("id", $sord)
                          ->get()
                          ->toArray();
            $result = array();
            $result["total"] = $total;
            $result["page"] = $page;
            $result["records"] = $count;
            $result["rows"] = $admin;

            return Response::json($result);
        }

        public function postAdminmanage()
        {
            $oper = Input::get("oper");
            $status = 0;
            if ($oper == "edit")
            {
                $id = Input::get("id");
                //$username = Input::get("username");
                $password = hash("sha256", trim((string)Input::get("password")));
                $auth = Input::get("auth");
                $hospital_id = Input::get("hospital_id");
                $admin = Admin::find($id);
                if ($admin)
                {
                    $admin->auth = $auth;
                    $admin->password = $password;
                    $admin->$hospital_id = $hospital_id;
                    if ($admin->save())
                    {
                        $status = 1;
                    }
                    else
                    {
                        $status = 2;
                    }
                }
                else
                {
                    $status = 3;
                }
            }
            else if ($oper == "add")
            {
                DB::begintransaction();
                try
                {
                    $password = hash("sha256", trim((string)Input::get("password")));
                    $auth = Input::get("auth");
                    $username = Input::get("username");
                    $user = new User();
                    $user->type = 3;
                    if ($user->save())
                    {
                        $admin = new Admin();
                        $admin->id = $user->id;
                        $admin->username = $username;
                        $admin->password = $password;
                        $admin->auth = $auth;
                        if (Input::has("hospital_id"))
                        {
                            $hospital_id = Input::get("hospital_id");
                            if ($hospital_id != "")
                            {
                                $admin->hospital_id = (int)$hospital_id;
                            }
                        }
                        if ($admin->save())
                        {
                            $status = 1;
                        }
                        else
                        {
                            throw new PDOException("", 2);
                        }
                        DB::commit();
                    }
                    else
                    {
                        throw new PDOException("", 2);
                    }
                }
                catch (PDOException $e)
                {
                    $status = $e->getCode();
                    DB::rollback();
                }
            }

            return Response::json(array("status" => $status));
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
            if (Input::get("sord"))
            {
                $sord = Input::get("sord");
                if ($sord == "" || $sord == null)
                {
                    $sord = "asc";
                }
            }
            $department = Department::where("hospital_id", "=", $hospital_id)
                                    ->skip($startrow)
                                    ->take($limit)
                                    ->orderBy("d_id", $sord)
                                    ->get()
                                    ->toArray();
            $result = array();
            $result["total"] = $total;
            $result["page"] = $page;
            $result["records"] = $count;
            $result["rows"] = $department;

            return Response::json($result);
        }

        public function postDepartmentmanage()
        {
            $oper = Input::get("oper");
            $status = 0;
            if ($oper == "edit")
            {
                $d_id = Input::get("d_id");
                $class_id = Input::get("class_id");
                $name = Input::get("name");
                $description = Input::get("description");
                $tel = Input::get("tel");
                $department = Department::find($d_id);
                if ($department)
                {
                    $department->class_id = $class_id;
                    $department->name = $name;
                    $department->description = $description;
                    $department->tel = $tel;
                    if ($department->save())
                    {
                        $status = 1;
                    }
                    else
                    {
                        $status = 2;
                    }
                }
                else
                {
                    $status = 3;
                }
            }
            else if ($oper == "add")
            {
                $hospital_id = Session::get("hos_id");
                $department = new Department();
                $class_id = Input::get("class_id");
                $name = Input::get("name");
                $description = Input::get("description");
                $tel = Input::get("tel");
                $department->class_id = $class_id;
                $department->name = $name;
                $department->description = $description;
                $department->tel = $tel;
                $department->hospital_id = $hospital_id;
                if ($department->save())
                {
                    $status = 1;
                }
                else
                {
                    $status = 2;
                }
            }

            return Response::json(array("status" => $status));
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

            $sord = Input::get("sord");
            if ($sord == "" || $sord == null)
            {
                $sord = "asc";
            }
            Session::set("dep_id", $department_id);
            $doctor = Doctor::select(array("id", "username", "password", "name", "description", "auth", "tel"))
                            ->where("department_id", "=", $department_id)
                            ->skip($startrow)
                            ->take($limit)
                            ->orderBy("id", $sord)
                            ->get()
                            ->toArray();
            $result = array();
            $result["total"] = $total;
            $result["page"] = $page;
            $result["records"] = $count;
            $result["rows"] = $doctor;
        }

        public function postDoctormanage()
        {
            $oper = Input::get("oper");
            $status = 0;
            if ($oper == "edit")
            {
                $password = hash("sha256", trim((string)Input::get("password")));
                $auth = Input::get("auth");
                $username = Input::get("username");
                $name = Input::get("name");
                $tel = Input::get("tel");
                $id = Input::get("id");
                $description = Input::get("description");
                $doctor = Doctor::find($id);
                if ($doctor)
                {
                    $doctor->password = $password;
                    $doctor->auth = $auth;
                    $doctor->username = $username;
                    $doctor->name = $name;
                    $doctor->tel = $tel;
                    $doctor->description = $description;
                    if ($doctor->save())
                    {
                        $status = 1;
                    }
                    else
                    {
                        $status = 2;
                    }
                }
                else
                {
                    $status = 3;
                }
            }
            else if ($oper == "add")
            {
                DB::begintransaction();
                try
                {
                    $password = hash("sha256", trim((string)Input::get("password")));
                    $auth = Input::get("auth");
                    $username = Input::get("username");
                    $name = Input::get("name");
                    $tel = Input::get("tel");
                    $description = Input::get("description");
                    $user = new User();
                    $user->type = 2;
                    if ($user->save())
                    {
                        $doctor = new Doctor();
                        $doctor->username = $username;
                        $doctor->password = $password;
                        $doctor->auth = $auth;
                        $doctor->id = $user->id;
                        $doctor->name = $name;
                        $doctor->tel = $tel;
                        $doctor->description = $description;
                        $doctor->department_id = Session::get("dep_id");
                        if ($doctor->save())
                        {
                            $status = 1;
                        }
                        else
                        {
                            throw new PDOException("", 2);
                        }
                        DB::commit();
                    }
                    else
                    {
                        throw new PDOException("", 2);
                    }
                }
                catch (PDOException $e)
                {
                    $status = $e->getCode();
                    DB::rollback();
                }
            }

            return Response::json(array("status" => $status));
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

            Session::set("doc_id", $doctor_id);

            if (Input::get("sord"))
            {
                $sord = Input::get("sord");
                if ($sord == "" || $sord == null)
                {
                    $sord = "asc";
                }
            }

            $visit = Visit::select(array("v_id", "work_date", "am", "pm", "ng"))
                          ->where("doctor_id", "=", $doctor_id)
                          ->skip($startrow)
                          ->take($limit)
                          ->orderBy("v_id", $sord)
                          ->get()
                          ->toArray();
            $result = array();
            $result["total"] = $total;
            $result["page"] = $page;
            $result["records"] = $count;
            $result["rows"] = $visit;
        }

        public function postVisitmanage()
        {
            $oper = Input::get("oper");
            $status = 0;
            if ($oper == "edit")
            {
                $v_id = Input::get("v_id");
                $work_date = Input::get("work_date");
                $am = Input::get("am");
                $pm = Input::get("pm");
                $ng = Input::get("ng");
                $visit = Visit::find($v_id);
                if ($visit)
                {
                    $visit->work_date = $work_date;
                    $visit->am = $am;
                    $visit->pm = $pm;
                    $visit->ng = $ng;
                    if ($visit->save())
                    {
                        $status = 1;
                    }
                    else
                    {
                        $status = 2;
                    }
                }
                else
                {
                    $status = 3;
                }
            }
            else if ($oper == "add")
            {
                $work_date = Input::get("work_date");
                $am = Input::get("am");
                $pm = Input::get("pm");
                $ng = Input::get("ng");
                $visit = new Visit();
                $visit->doctor_id = Session::get("doc_id");
                $visit->work_date = $work_date;
                $visit->am = $am;
                $visit->pm = $pm;
                $visit->ng = $ng;
                if ($visit->save())
                {
                    $status = 1;
                }
                else
                {
                    $status = 3;
                }
            }

            return Response::json(array("status" => $status));
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


            $sord = Input::get("sord");
            if ($sord == "" || $sord == null)
            {
                $sord = "asc";
            }

            $order = Order::where("visit_id", "=", $visit_id)
                          ->skip($startrow)
                          ->take($limit)
                          ->orderBy("o_id", $sord)
                          ->get()
                          ->toArray();
            $result = array();
            $result["total"] = $total;
            $result["page"] = $page;
            $result["records"] = $count;
            $result["rows"] = $order;
        }

        public function postOrdermanage()
        {
            App::abort(405, "Method not allowed");
        }

    }