<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/16/14
     * Time: 9:30 PM
     */
    class Answer
        extends Eloquent
    {
        public $timestamps = false;

        protected $table = 'answer';

        protected $primaryKey = "a_id";
    }