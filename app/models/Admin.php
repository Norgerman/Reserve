<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/8/14
     * Time: 8:45 PM
     */
    class Admin
        extends Eloquent
    {
        public $timestamps = false;

        public $incrementing = false;

        protected $table = 'admin';

        protected $primaryKey = "id";
    }