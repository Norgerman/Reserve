<?php

    /**
     * Created by PhpStorm.
     * User: Norgerman
     * Date: 12/18/14
     * Time: 7:37 PM
     */
    class DeplistController
        extends BaseController
    {
        private $depnum_perpage = 5;

        public function getIndex()
        {

        }

        public function getDeplist()
        {
            $pagenum = Input::get("pagenum", 1);
            print_r($this->Dep($pagenum));
        }

        private function Dep($pagenum)
        {
            $result = array();
            $res = array();
            $deparray = array();
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
                $isnew = true;
            }

            if ($isnew)
            {
                $alldepcount = Hospital::whereHas("departments", function ($d) use ($class_id)
                {
                    $d->where("class_id", "=", $class_id);
                })
                                       ->distinct()
                                       ->count();
                $remain = $alldepcount % $this->depnum_perpage;
                $pagecount = $alldepcount / $this->depnum_perpage;
                if ($remain != 0)
                {
                    $pagecount = $pagecount + 1;
                }
                Session::set("deppagecount", (int)$pagecount);
            }
            else
            {
                $pagecount = Session::get("deppagecount");
            }

            $hoslist = $alldepcount = Hospital::whereHas("departments", function ($d) use ($class_id)
            {
                $d->where("class_id", "=", $class_id);
            })
                                              ->distinct()
                                              ->skip($start_num)
                                              ->take($this->depnum_perpage)
                                              ->get();

            foreach ($hoslist as $index => $hos)
            {
                $dep = array();
                $dep["hosname"] = $hos->name;
                $dep["deplist"] = array();
                $dep["deplist"] =
                    array_merge($dep["deplist"], $hos->departments->filter(function ($department) use ($class_id)
                    {
                        return $department->class_id == $class_id;
                    })
                                                                  ->toArray());

                $deparray[$index] = $dep;
            }

            $res["count"] = count($deparray);
            $res["list"] = $deparray;
            $res["pagenum"] = $pagenum;
            $result["docinfo"] = $res;
            $result["pagecount"] = (int)$pagecount;

            return $result;
        }
    }