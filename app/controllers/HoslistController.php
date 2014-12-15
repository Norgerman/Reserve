<?php

    /**
     * Created by PhpStorm.
     * User: CloudeTown
     * Date: 2014/12/15
     * Time: 14:34
     */
    class HoslistController
        extends BaseController
    {

        var $hosnum_perpage = 25;

        private function  getHoslist()
        {
            $pagenum = Input::get("pagenum");

            return Response::json($this->Hos($pagenum));
        }

        public function  getIndex()
        {
            $allhoscount = Hospital::count();
            $remain = $allhoscount % $this->hosnum_perpage;
            $pagecount = $allhoscount / $this->hosnum_perpage;
            if ($remain != 0)
            {
                $pagecount = $pagecount + 1;
            }

            return View::make("index.hoslist", array("pagecount" => $pagecount,
                                                     "hosinfo" => $this->getHoslist(1)));

        }

        private function Hos($pagenum)
        {
            $start_num = $pagenum * 25 - 25;
            $hoslist = Hospital::skip($start_num)
                               ->take(25)
                               ->get();
            $hosarray = $hoslist->toArray();
            $hoscount = count($hosarray);

            $res = array();
            $res["count"] = $hoscount;
            $res["list"] = $hosarray;
            $res["pagenum"] = $pagenum;

            return $res;
        }

    }