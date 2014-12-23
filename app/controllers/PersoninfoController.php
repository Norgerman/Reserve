<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/20/14
     * Time: 2:15 PM
     */
    class PersoninfoController
        extends BaseController
    {
        public function getIndex()
        {
            $userinfo = array();
            $order = array();
            if (Session::has("id"))
            {
                $id = Session::get("id");
                $user = Registeruser::find($id);
                $userinfo = $user->toArray();
                foreach ($user->orders as $index => $ord)
                {
                    $visit = $ord->visit;
                    $docname = $visit->doctor->name;
                    $hosname = Hospital::find($ord->hospital_id)->name;
                    $depname = Department::find($ord->department_id)->name;
                    $order[$index] = array("o_id" => $ord->o_id,
                                           "doctorname" => $docname,
                                           "hospitalname" => $hosname,
                                           "departmentname" => $depname,
                                           "date" => $visit->date,
                                           "time" => $ord->time,
                                           "status" => $ord->status);
                }
            }

            return View::make('personinfo.index', array("logininfo" => parent::getLogininfo(),
                                                        "userinfo" => $userinfo,
                                                        "orders" => $order));
        }
    }