<?php
/**
 * Created by PhpStorm.
 * User: Andrija
 * Date: 11/28/2020
 * Time: 5:26 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class ShopModels
{



public function oglasi($start,$take,$cat,$min,$max,$search,$sort)
{
    //dd($sort[0]);
     $data= DB::table('oglas')
        ->select('id_oglas','name','price','src','title','alt'
            ,DB::raw('case when currency=0 then "rsd" else "€" end as "currency_text"'))
        ->distinct()
        ->join('sponsored','oglas.id_oglas','=','sponsored.oglas_id')
        ->join('picture','oglas.id_oglas','=','picture.oglas_id')
        ->join('ppk','ppk_id','=','ppk.id_ppk');

    if($max!=null && $min!=null && $search!=null)
    {
        //definisi search
    }
    if($max!=null && $min!=null && $search==null)
    {

            //  ->join('subcategory','subcategory_id','=','subcategory.id_subcategory')
            // ->join('category','category_id','=','category.id_category')
            $data=$data->where([
                [
                    'name_ppk',$cat
                ],
                [
                    'price','<=',$max
                ],
                [
                    'price','>=',$min
                ]

            ]);


    }
    if ($max==null || $min==null && $search!=null)
    {
       //definis search

    }
    if ($max==null || $min==null && $search==null)
    {

            //  ->join('subcategory','subcategory_id','=','subcategory.id_subcategory')
            // ->join('category','category_id','=','category.id_category')
          $data=$data->where([
                [
                    'name_ppk',$cat
                ]

            ]);

    }

    return $data->offset($start)
        ->limit($take)
        ->orderBy($sort[0],$sort[1])
        ->get();




}
public function pages($cat,$min,$max,$search)
{
    $pages= DB::table('oglas')
        ->select('id_oglas')
        ->distinct()
        ->join('sponsored','oglas.id_oglas','=','sponsored.oglas_id')
        ->join('picture','oglas.id_oglas','=','picture.oglas_id')
        ->join('ppk','ppk_id','=','ppk.id_ppk');

    if($max!=null && $min!=null && $search!=null)
    {
        //definisi search
       //

    }
    if($max==null || $min==null && $search!=null)
    {
       //
    }


    if($min!=null && $max!=null && $search==null)
    {

            //  ->join('subcategory','subcategory_id','=','subcategory.id_subcategory')
            // ->join('category','category_id','=','category.id_category')
          $pages=$pages->where([
                [
                    'name_ppk',$cat
                ],
                [
                    'price','<=',$max
                ],
                [
                    'price','>=',$min
                ]

            ]);





    }
    if ($min==null || $max==null && $search==null)
        {

                //  ->join('subcategory','subcategory_id','=','subcategory.id_subcategory')
                // ->join('category','category_id','=','category.id_category')
               $pages=$pages->where('name_ppk',$cat);



    }
    //dd($pages);
return $pages->count();




}





public function countAds($min,$max,$cat,$search)
{
    $data= DB::table('oglas')
    ->select('id_oglas')
    ->join('picture','oglas.id_oglas','=','picture.oglas_id')
        ->join('ppk','ppk_id','=','ppk.id_ppk')
        ->where([
            ['name_ppk',$cat],
            ['price','>=',$min],
            ['price','<=',$max]
        ]);

  $data=$data->where(
      'currency','=','1'
  );
  //TOOOOOO
  return $data->count();

  //  $data1=$data->where([]);
}

public function countFiltAds($min,$max,$cat,$search,$condition,$price_status,$currency)
{
//

}


public function condition()
{
    return DB::table('oglas')
        ->select(DB::raw('count(CASE WHEN condition_status=1 then 1 end)as novo'),DB::raw('count(CASE WHEN condition_status=2 then 1 end)as kao'),DB::raw('count(CASE WHEN condition_status=3 then 1 end)as polovno'))
        ->get();

}
public function price()
{
    return DB::table('oglas')
        ->select(DB::raw('count(CASE WHEN price_status=1 then 1 end)as fiksno'),DB::raw('count(CASE WHEN price_status=2 then 1 end)as zamena'),DB::raw('count(CASE WHEN price_status=3 then 1 end)as dogovor'))
        ->get();

}
public function currency()
{
    return DB::table('oglas')
        ->select(DB::raw('count(CASE WHEN currency=0 then 1 end)as rsd'),DB::raw('count(CASE WHEN currency=1 then 1 end)as euro'))
        ->get();

}



}