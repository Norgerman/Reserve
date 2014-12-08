<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/8/14
     * Time: 8:49 PM
     */
    class Depclass
        extends Eloquent
    {
        public $timestamps = false;

        protected $table = 'depclass';

        protected $primaryKey = "c_id";

        public function departments()
        {
            return $this->hasMany("Department", "class_id", "c_id");
        }
    }