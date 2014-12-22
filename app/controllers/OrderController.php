<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/21/14
     * Time: 1:53 PM
     */
    class OrderController
        extends BaseController
    {
        public function getIndex()
        {

        }

        public function postOrder()
        {
            if (Input::has("visit_id" && Session::has("id")))
            {
                $visit_id = Input::get("visit_id");
                $time = Input::get("time");
                $department_id = Session::get("departmeng_id");
                $hospital_id = Session::get("hos_id");
                $id = Session::get("id");
                //TODO
            }
            else
            {
                return Response::make("failed", 200, array("Content-Type" => "text/plain"));
            }
        }
    }