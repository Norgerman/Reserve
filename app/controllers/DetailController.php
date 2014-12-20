<?php

    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2014/12/15
     * Time: 14:51
     */
    class DetailController
        extends BaseController
    {
        public function getIndex()
        {
            $hos_id = Input::get("hospital_id");

            //            print_r($this->detail($hos_id));
            return View::make('hoslist.hospital', array('hosdetail' => $this->detail($hos_id)));
        }

        private function detail($hos_id)
        {
            $result = array();
            $hos = Hospital::find($hos_id);
            if (!$hos == null)
            {
                $result["status"] = "true";
                $result["hosinfo"] = $hos->toArray();
                $depgs = $hos->departments->groupBy("class_id")
                                          ->toArray();
                $depgps = array();
                $baseidx = 0;
                foreach ($depgs as $idx => $depgroup)
                {
                    $classname = Depclass::find($idx)->name;
                    $depa = array();
                    foreach ($depgroup as $index => $dep)
                    {
                        $depa = $dep->toArray();
                    }
                    $depgps[$baseidx] = array("class_name" => $classname, "deplist" => $depa);
                    $baseidx++;
                }
                $result["depinfo"] = $depgps;

                return $result;
            }
            else
            {
                $result["status"] = "false";

                return $result;
            }
        }


    }

