<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/8/14
     * Time: 10:07 PM
     */
    class Message
        extends Eloquent
    {
        public $timestamps = false;

        protected $table = 'message';

        protected $primaryKey = "m_id";
    }