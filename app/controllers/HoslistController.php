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

        private $hosnum_perpage = 5;

        public function  getHoslist()
        {
            $pagenum = Input::get("pagenum", 1);

            return Response::json($this->Hos($pagenum));
        }

        public function  getIndex()
        {
            return View::make("hoslist.index", array("logininfo" => parent::getLogininfo(),
                                                     "hosinfo" => json_encode($this->Hos(1))));
        }

        public function postZan()
        {
            if (Input::has("hospital_id"))
            {
                $hos_id = Input::get("hospital_id");
                DB::begintransaction();

                $hos = Hospital::find($hos_id);
                if ($hos !== null)
                {
                    $zan = $hos->zan;
                    $hos->zan++;
                    if (!$hos->save())
                    {
                        DB::rollback();

                        return Response::json(array("zan" => $zan));
                    }
                    else
                    {
                        DB::commit();

                        return Response::json(array("zan" => $zan + 1));
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

        private function Hos($pagenum)
        {
            $result = array();
            $start_num = $pagenum * $this->hosnum_perpage - $this->hosnum_perpage;
            $isnew = false;

            if (Session::has("addr"))
            {
                $addr = Session::get("addr");
            }
            else
            {
                $addr = "北京市";
                $isnew = true;
                Session::set("addr", $addr);
            }

            if (!Input::ajax())
            {
                $addr = "北京市";
                $isnew = true;
                Session::set("addr", $addr);
            }

            if (Input::has("addr"))
            {
                $addr = Input::get("addr");
                $isnew = true;
                Session::set("addr", $addr);
            }

            if ($isnew)
            {
                $allhoscount = Hospital::where("province", "=", $addr)
                                       ->count();
                $remain = $allhoscount % $this->hosnum_perpage;
                $pagecount = $allhoscount / $this->hosnum_perpage;
                if ($remain != 0)
                {
                    $pagecount = $pagecount + 1;
                }
                Session::set("hospagecount", (int)$pagecount);
            }
            else
            {
                $pagecount = Session::get("hospagecount");
            }

            $hoslist = Hospital::where("province", "=", $addr)
                               ->skip($start_num)
                               ->take($this->hosnum_perpage)
                               ->get();
            $hosarray = $hoslist->toArray();
            foreach ($hosarray as $index => $hos)
            {
                $des = $hos["description"];
                $des = mb_substr($des, 0, 70)."...";
                $hos["description"] = $des;
                $hosarray[$index] = $hos;
            }
            $hoscount = count($hosarray);

            $res = array();
            $res["count"] = $hoscount;
            $res["list"] = $hosarray;
            $res["pagenum"] = $pagenum;
            $result["hosinfo"] = $res;
            $pages = array();
            for ($i = 1; $i <= (int)$pagecount; $i++)
            {
                $pages[$i - 1] = $i;
            }
            $result["pagecount"] = $pages;

            return $result;
        }

    }