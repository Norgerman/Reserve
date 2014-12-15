<?php
/**
 * Created by PhpStorm.
 * User: CloudeTown
 * Date: 2014/12/15
 * Time: 14:34
 */

class HoslistController extends BaseController {

    var $hosnum_perpage = 25;
    private  function  getHoslist($pagenum)
    {
        return Response::json($this->Hos($pagenum));
    }

    public  function  getIndex()
    {
        $allhoscount = Hospital::count();
        $remain = $allhoscount%$this->hosnum_perpage;
        $pagecount =  $allhoscount/$this->hosnum_perpage;
        if ($remain != 0)
        {
            $pagecount = $pagecount+1;
        }
        return View::make("index.hoslist",array("pagecount"=>$pagecount,"pagenum"=>1,"hosinfo"=>$this->getHoslist(1)));

    }

    private function Hos($pagenum)
    {
        $start_num = $pagenum*25-25;
        $hoslist = Hospital::skip($start_num)->take(25)->select(array("h_id","name","rank","address","tel"));
        $hosarray = $hoslist->toArray();
        $hoscount = $hosarray->count();

        $res = array();
        $res["count"] = $hoscount;
        $res["list"] = $hosarray;
        return $res;
    }

}