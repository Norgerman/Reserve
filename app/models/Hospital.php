<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/8/14
     * Time: 9:55 PM
     */
    class Hospital
        extends Eloquent
    {
        public $timestamps = false;

        protected $table = 'hospital';

        protected $primaryKey = "h_id";

        public function departments()
        {
            return $this->hasMany("Department", "hospital_id", "h_id");
        }
    }