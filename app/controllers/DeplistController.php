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
        private $docnum_perpage = 5;

        public function  getDoclist()
        {
            $pagenum = Input::get("pagenum", 1);

            return Response::json();
        }

        public function  getIndex()
        {
            $hos_id = Input::get("hos_id", 1);
            Session::set("hos_id", $hos_id);
            $departmentgroup = Department::where("hospital_id", "=", $hos_id)
                                         ->get()
                                         ->groupBy("class_id");

            $firstgroup = $departmentgroup->first();
            Session::set("department_id", $firstgroup[0]->d_id);

            $departmentgroup = $departmentgroup->toArray();

            foreach ($departmentgroup as $ind => $group)
            {
                foreach ($group as $index => $dep)
                {
                    $group[$index] = $dep->toArray();
                }
                $departmentgroup[$ind] = $group;
            }
            print_r($departmentgroup);
        }

        private function Doc($pagenum)
        {
            $department_id = Session::get("department_id");
            $start_num = $pagenum * $this->docnum_perpage - $this->docnum_perpage;
            $isnew = false;

            if (Input::has("department_id"))
            {
                $department_id = Input::get("department_id");
                $isnew = true;
                Session::set("department_id", $department_id);
            }

            if ($isnew || !Session::has("docpagecount"))
            {
                $alldoccount = Doctor::where("department_id", "=", $department_id)
                                     ->count();
                $remain = $alldoccount % $this->docnum_perpage;
                $pagecount = $alldoccount / $this->docnum_perpage;
                if ($remain != 0)
                {
                    $pagecount = $pagecount + 1;
                }
                Session::set("docpagecount", $pagecount);
            }
            else
            {
                $pagecount = Session::get("docpagecount");
            }


        }

    }