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
            return View::make("index.hoslist", $this->Hos(1));
        }

        private function Hos($pagenum)
        {
            $result = array();
            $start_num = $pagenum * 25 - 25;
            $isnew = false;

            if (Session::has("addr"))
            {
                $addr = Session::get("addr");
            }
            else
            {
                $addr = "北京市";
                $isnew = true;
            }

            if (Input::has("addr"))
            {
                $addr = Input::get("addr");
                $isnew = true;
            }

            if ($isnew)
            {
                $allhoscount = Hospital::where("address", "=", $addr)
                                       ->count();
                $remain = $allhoscount % $this->hosnum_perpage;
                $pagecount = $allhoscount / $this->hosnum_perpage;
                if ($remain != 0)
                {
                    $pagecount = $pagecount + 1;
                }
                Session::set("addr", $addr);
                Session::set("pagecount", $pagecount);
            }
            else
            {
                $pagecount = Session::get("pagecount");
            }

            $hoslist = Hospital::where("address", "=", $addr)
                               ->skip($start_num)
                               ->take(25)
                               ->get();
            $hosarray = $hoslist->toArray();
            $hoscount = count($hosarray);

            $res = array();
            $res["count"] = $hoscount;
            $res["list"] = $hosarray;
            $res["pagenum"] = $pagenum;
            $result["hosinfo"] = $res;
            $result["pagecount"] = $pagecount;

            return $result;
        }

    }