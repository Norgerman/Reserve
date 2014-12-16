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

        protected $table = 'question';

        protected $primaryKey = "q_id";

        public function answer()
        {
            return $this->hasOne("Answer", "a_id", "answer_id");
        }
    }