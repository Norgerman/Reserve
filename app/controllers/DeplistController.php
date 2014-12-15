<?php
/**
 * Created by PhpStorm.
 * User: CloudeTown
 * Date: 2014/12/15
 * Time: 15:43
 */

class DeplistController extends BaseController{
    var $depnum_perpage = 25;
    private  function  getDeplist($pagenum)
    {
        return Response::json($this->Dep($pagenum));
    }

    public  function  getIndex()
    {
        $alldepcount = Department::count();
        $remain = $alldepcount%$this->depnum_perpage;
        $pagecount =  $alldepcount/$this->depnum_perpage;
        if ($remain != 0)
        {
            $pagecount = $pagecount+1;
        }
        return View::make("index.deplist",array("pagecount"=>$pagecount,"pagenum"=>1,"depinfo"=>$this->getDeplist(1)));

    }

    private function Dep($pagenum)
    {
        $start_num = $pagenum*25-25;
        $deplist = Department::skip($start_num)->take(25);
        $deparray = array();
        foreach ($deplist as $index => $dep)
        {
            $dp=array();
            $dp["class"] = $dep->depclass->name;
            $dp["hosptial"] = $dep->hospital->name;
            $dp["dp"]=$dep->toArray();
            $deparray[$index]=$dp;
        }

        $depcount = $deparray->count();

        $res = array();
        $res["count"] = $depcount;
        $res["list"] = $deparray;
        return $res;
    }

} 