<?php

    class User
        extends Eloquent
    {

        /**
         * The database table used by the model.
         *
         * @var string
         */

        public $timestamps = false;

        protected $table = 'user';

        protected $primaryKey = "id";

        public function question()
        {
            return $this->hasMany("Question", "owner_id", "id");
        }

        public function answer()
        {
            return $this->hasMany("Answer", "owner_id", "id");
        }

    }
