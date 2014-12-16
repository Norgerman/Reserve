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
        public function getIndex()
        {
            $hosptial = Hospital::all();
            print_r($hosptial->toArray());
        }
    }