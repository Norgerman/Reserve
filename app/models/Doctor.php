<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/8/14
     * Time: 8:54 PM
     */
    class Doctor
        extends Eloquent
    {
        public $incrementing = false;

        public $timestamps = false;

        protected $table = 'doctor';

        protected $primaryKey = "id";

        public function department()
        {
            return $this->belongsTo("Department", "department_id", "d_id");
        }

        public function visits()
        {
            return $this->hasMany("Visit", "id", "doctor_id");
        }
    }