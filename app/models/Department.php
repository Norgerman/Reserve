<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/8/14
     * Time: 8:55 PM
     */
    class Department
        extends Eloquent
    {

        public $timestamps = false;

        protected $table = 'department';

        protected $primaryKey = "d_id";

        public function depclass()
        {
            return $this->belongsTo('Depclass', "class_id", "c_id");
        }

        public function hospital()
        {
            return $this->belongsTo('Hospital', "hospital_id", "h_id");
        }
    }