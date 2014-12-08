<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/8/14
     * Time: 9:57 PM
     */
    class Order
        extends Eloquent
    {
        public $timestamps = false;

        protected $table = 'order';

        protected $primaryKey = "o_id";

        public function visit()
        {
            return $this->belongsTo("Visit", "v_id", "visit_id");
        }

        public function registeruser()
        {
            return $this->belongsTo("Registeruser", "owner_id", "id");
        }
    }