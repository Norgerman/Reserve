<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/8/14
     * Time: 10:00 PM
     */
    class Visit
        extends Eloquent
    {
        public $timestamps = false;

        protected $table = 'visit';

        protected $primaryKey = "v_id";
    }