<?php

    class BaseController
        extends Controller
    {

        /**
         * Setup the layout used by the controller.
         *
         * @return void
         */
        protected function setupLayout()
        {
            if (!is_null($this->layout))
            {
                $this->layout = View::make($this->layout);
            }
        }

        protected function getLogininfo()
        {
            $result = array();
            $type = Session::get("type");
            $result["login"] = "false";
            if ($type === "user")
            {
                $result["username"] = Session::get("username");
                $result["login"] = "true";
            }

            return $result;
        }

    }
