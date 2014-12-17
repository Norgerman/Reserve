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

            return View::make("index.deplist", $this->Dep(1));

        }

        private function Dep($pagenum)
        {
            $result = array();
            $start_num = $pagenum * $this->depnum_perpage - $this->depnum_perpage;
            $class_id = 1;
            $isnew = false;

            $alldepcount = Department::where("class_id", "=", $class_id)
                                     ->count();
            $remain = $alldepcount % $this->depnum_perpage;
            $pagecount = $alldepcount / $this->depnum_perpage;
            if ($remain != 0)
            {
                $pagecount = $pagecount + 1;
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
                $dp["dp"] = $dep->toArray();
                $deparray[$index] = $dp;
            }

            $depcount = count($deparray);

            $res = array();
            $res["count"] = $depcount;
            $res["list"] = $deparray;
            $res["pagenum"] = $pagenum;
            $result["hosinfo"] = $res;
            $result["pagecount"] = (int)$pagecount;

            return $result;
        }

    }