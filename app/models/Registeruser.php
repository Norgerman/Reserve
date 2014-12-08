<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/8/14
     * Time: 8:53 PM
     */
    class Registeruser
        extends Eloquent
    {
        public $incrementing = false;

        public $timestamps = false;

        protected $table = 'registeruser';

        protected $primaryKey = "id";

        public function orders()
        {
            return $this->hasMany("Order", "id", "owner_id");
        }
    }