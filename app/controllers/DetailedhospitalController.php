<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/12/15
 * Time: 14:51
 */
//用医院id查询医院的详细的信息：
//发送："h_id"医院的id,
//返回：1."json医院的详细的信息" 2."unexpected h_id":不知道医院id
class DetailedhospitalController
    extends BaseController{
       function getIndex(){
           return "医院详细信息";
       }

       function getDetailedhospital()
       {
           //获得医院的id
           //$h_id = trim(Input::get("h_id"));

           //test
           $h_id=1;

           //查询医院的信息
           $information = hospital::find($h_id);

           //try
           //TODO
           {
               //如果存在医院
               if ($information != null) {
                   //返回存在的医院
                   return Response::json($information);
               }
               else {
                   //不存在医院
                   return "unexpected h_id";
               }

           }


       }



}

