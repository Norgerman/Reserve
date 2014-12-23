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
                $orders = $user->orders;
                foreach ($orders as $index => $ord)
                {
                    $visit = $ord->visit;
                    $docname = $visit->doctor->name;
                    $hospital = Hospital::find($ord->hospital_id);
                    $hosname = $hospital->name;
                    $price = $hospital->price;
                    $depname = Department::find($ord->department_id)->name;
                    $order[$index] = array("o_id" => $ord->o_id,
                                           "price" => $price,
                                           "doctorname" => $docname,
                                           "hospitalname" => $hosname,
                                           "departmentname" => $depname,
                                           "date" => $visit->work_date,
                                           "time" => $ord->time,
                                           "status" => $ord->status);
                }

                $result = array();

                foreach ($order as $index => $ord)
                {
                    $result[$index] = strtotime($ord["date"]);
                }

                arsort($result);

                foreach (array_keys($result) as $key)
                {
                    $result[$key] = $order[$key];
                }

                $order = array();

                $order = array_merge($order, $result);
            }

            return View::make('personinfo.index', array("logininfo" => parent::getLogininfo(),
                                                        "userinfo" => $userinfo,
                                                        "orders" => $order));
        }
    }