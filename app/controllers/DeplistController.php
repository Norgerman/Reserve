<?php

    /**
     * Created by PhpStorm.
     * User: CloudeTown
     * Date: 2014/12/15
     * Time: 15:43
     */
    class DeplistController
        extends BaseController
    {
        private $depnum_perpage = 25;

        public function  getDeplist()
        {
            $pagenum = Input::get("pagenum", 1);
            
            return Response::json($this->Dep($pagenum));
        }

        public function  getIndex()
        {
            return View::make("index.deplist", array("depinfo" => $this->Dep(1)));
        }

        private function Dep($pagenum)
        {
            $result = array();
            $start_num = $pagenum * $this->depnum_perpage - $this->depnum_perpage;
            $isnew = false;

            if (Session::has("class_id"))
            {
                $class_id = Session::get("class_id");
            }
            else
            {
                $class_id = 1;
                Session::set("class_id", $class_id);
                $isnew = true;
            }

            if (Input::has("class_id"))
            {
                $class_id = Input::get("class_id");
                Session::set("class_id", $class_id);
                $isnew = true;
            }

            if ($isnew)
            {
                $alldepcount = Department::where("class_id", "=", $class_id)
                                         ->count();
                $remain = $alldepcount % $this->depnum_perpage;
                $pagecount = $alldepcount / $this->depnum_perpage;
                if ($remain != 0)
                {
                    $pagecount = $pagecount + 1;
                }
                Session::set("deppagecount", $pagecount);
            }
            else
            {
                $pagecount = Session::get("deppagecount");
            }

            $deplist = Department::where("class_id", "=", $class_id)
                                 ->skip($start_num)
                                 ->take($this->depnum_perpage)
                                 ->get();

            $deparray = array();
            foreach ($deplist as $index => $dep)
            {
                $dp = array();
                $dp["class"] = $dep->depclass->name;
                $dp["hosptial"] = $dep->hospital->name;
                $dp["d_id"] = $dep->d_id;
                $dp["name"] = $dep->name;
                $dp["description"] = $dep->description;
                $dp["tel"] = $dep->tel;
                $deparray[$index] = $dp;
            }

            $depcount = count($deparray);

            $res = array();
            $res["count"] = $depcount;
            $res["list"] = $deparray;
            $res["pagenum"] = $pagenum;
            $result["depinfo"] = $res;
            $result["pagecount"] = (int)$pagecount;

            return $result;
        }

    }