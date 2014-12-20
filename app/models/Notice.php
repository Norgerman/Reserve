<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/20/14
     * Time: 3:33 PM
     */
    class Notice
        extends Eloquent
    {
        public $timestamps = false;

        protected $table = 'notice';

        protected $primaryKey = "n_id";
    }