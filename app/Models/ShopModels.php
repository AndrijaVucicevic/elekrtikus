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

private $zero=0;
private $one=1;
private $two=2;
private $three=3;


public function oglasi($start,$take,$cat,$min,$max,$search,$sort,$condition,$price_status,$currency)
{
    //dd($sort[0]);


     $data= DB::table('oglas')
        ->select('id_oglas','name','price','src','title','alt','name_ppk'
            ,DB::raw('case when currency=0 then "rsd" else "€" end as "currency_text"'))
        ->distinct()
        ->join('sponsored','oglas.id_oglas','=','sponsored.oglas_id')
        ->join('picture','oglas.id_oglas','=','picture.oglas_id')
        ->join('ppk','ppk_id','=','ppk.id_ppk')
         ->where( 'picture_cat',$this->one);

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
    switch($condition)
    {
        case 1:
            $data=$data->where('condition_status',$this->one);
        break;
        case 2:
            $data=$data->where('condition_status',$this->two);
            break;
        case 3:
            $data=$data->where('condition_status',$this->one)
                ->orWhere('condition_status',$this->two);
            break;
            case 4:
            $data=$data->where('condition_status',$this->three);
            break;
        case 5:
            $data=$data->where('condition_status',$this->one)
                ->orWhere('condition_status',$this->three);
            break;
        case 6:
            $data=$data->where('condition_status',$this->two)
                ->orWhere('condition_status',$this->three);
            break;
    }
    switch($price_status)
    {
        case 1:
            $data=$data->where('price_status',$this->one);
            break;
        case 2:
            $data=$data->where('price_status',$this->two);
            break;
        case 3:
            $data=$data->where('price_status',$this->one)
                ->orWhere('price_status',$this->two);
            break;
        case 4:
            $data=$data->where('price_status',$this->three);
            break;
        case 5:
            $data=$data->where('price_status',$this->one)
                ->orWhere('price_status',$this->three);
            break;
        case 6:
            $data=$data->where('price_status',$this->two)
                ->orWhere('price_status',$this->three);
            break;
    }
    switch ($currency)
    {
        case 1:
            $data=$data->where('currency',$this->zero);
            break;
        case 2:
            $data=$data->where('currency',$this->one);
            break;

    }



    return $data->offset($start)
        ->limit($take)
        ->orderBy($sort[0],$sort[1])
        ->get();




}




public function pages($cat,$min,$max,$search,$condition,$price_status,$currency)
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

    switch($condition)
    {
        case 1:
            $pages=$pages->where('condition_status',$this->one);
            break;
        case 2:
            $pages=$pages->where('condition_status',$this->two);
            break;
        case 3:
            $pages=$pages->where('condition_status',$this->one)
                ->orWhere('condition_status',$this->two);
            break;
        case 4:
            $pages=$pages->where('condition_status',$this->three);
            break;
        case 5:
            $pages=$pages->where('condition_status',$this->one)
                ->orWhere('condition_status',$this->three);
            break;
        case 6:
            $pages=$pages->where('condition_status',$this->two)
                ->orWhere('condition_status',$this->three);
            break;
    }
    switch($price_status)
    {
        case 1:
            $pages=$pages->where('price_status',$this->one);
            break;
        case 2:
            $pages=$pages->where('price_status',$this->two);
            break;
        case 3:
            $pages=$pages->where('price_status',$this->one)
                ->orWhere('price_status',$this->two);
            break;
        case 4:
            $pages=$pages->where('price_status',$this->three);
            break;
        case 5:
            $pages=$pages->where('price_status',$this->one)
                ->orWhere('price_status',$this->three);
            break;
        case 6:
            $pages=$pages->where('price_status',$this->two)
                ->orWhere('price_status',$this->three);
            break;
    }
    switch ($currency)
    {
        case 1:
            $pages=$pages->where('currency',$this->zero);
            break;
        case 2:
            $pages=$pages->where('currency',$this->one);
            break;

    }


    //dd($pages);
return $pages->count();




}





public function countAds($min,$max,$cat,$search)
{
    $data= DB::table('oglas')
    ->select('id_oglas')
        ->distinct()
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