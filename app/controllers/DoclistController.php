<?php

    /**
     * Created by PhpStorm.
     * User: CloudeTown
     * Date: 2014/12/15
     * Time: 15:43
     */
    class DoclistController
        extends BaseController
    {
        private $docnum_perpage = 2;

        public function  getDoclist()
        {
            $pagenum = Input::get("pagenum", 1);

            return Response::json($this->Doc($pagenum));
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

            print_r($this->Doc(1));

            //return View::make("", array("depgroup" => $departmentgroup));
        }

        public function getDoctortime()
        {
            $dep_id = Input::get("department_id");

            $dep = Department::find($dep_id);
            $hos = $dep->hospital;

            Session::set("hos_id", $hos->h_id);
            $hosinfo = array("h_id" => $hos->h_id, "name" => $hos->name);
            $depinfo = array("d_id" => $dep->d_id, "name" => $dep->name);

            return View::make("hoslist.doctortime", array("hosinfo" => $hosinfo,
                                                          "depinfo" => $depinfo,
                                                          "doclist" => json_encode($this->Doc(1))));
        }

        public function postZan()
        {
            if (Input::has("doctor_id"))
            {
                $doc_id = Input::get("doctor_id");
                DB::begintransaction();

                $doc = Doctor::find($doc_id);
                if ($doc !== null)
                {
                    $zan = $doc->zan;
                    $doc->zan++;
                    if (!$doc->save())
                    {
                        DB::rollback();

                        return Response::json(array("zan" => $zan));
                    }
                    else
                    {
                        DB::commit();

                        return Response::josn(array("zan" => $zan + 1));
                    }
                }
                else
                {
                    DB::rollback();

                    return Response::json(array("zan" => -1));
                }
            }
            else
            {
                return Response::json(array("zan" => -1));
            }
        }

        private function Doc($pagenum)
        {
            $department_id = Session::get("department_id");
            $start_num = $pagenum * $this->docnum_perpage - $this->docnum_perpage;
            $isnew = false;
            $startdate = date("Y-m-d", strtotime("+1 day"));
            $enddate = date("Y-m-d", strtotime("+8 days"));
            $res = array();
            $result = array();
            $doclist = array();
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
                Session::set("docpagecount", (int)$pagecount);
            }
            else
            {
                $pagecount = Session::get("docpagecount");
            }

            $docs = Doctor::where("department_id", "=", $department_id)
                          ->skip($start_num)
                          ->take($this->docnum_perpage)
                          ->get();

            foreach ($docs as $index => $doc)
            {
                $doctor = array();
                $doctor["id"] = $doc->id;
                $doctor["name"] = $doc->name;
                $doctor["description"] = $doc->description;
                $doctor["tel"] = $doc->tel;
                $doctor["zan"] = $doc->zan;

                $doctor["visit"] = array();
                $doctor["visit"] =
                    array_merge($doctor["visit"], $doc->visits->filter(function ($visit) use ($startdate, $enddate)
                    {
                        $work_date = $visit->work_date;

                        return $work_date >= $startdate && $work_date <= $enddate;
                    })
                                                              ->toArray());
                $doclist[$index] = $doctor;
            }

            $res["count"] = count($doclist);
            $res["list"] = $doclist;
            $res["pagenum"] = $pagenum;
            $result["docinfo"] = $res;
            $pages = array();
            for ($i = 1; $i <= (int)$pagecount; $i++)
            {
                $pages[$i - 1] = $i;
            }
            $result["pagecount"] = $pages;

            return $result;
        }

    }