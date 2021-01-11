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



public function oglasi($start,$take,$cat,$min,$max,$search)
{
    $data='';
    if($max!=null && $min!=null && $search!=null)
    {
        //definisi search
    }
    if($max!=null && $min!=null && $search==null)
    {
        $data= DB::table('oglas')
            ->select('id_oglas','name','price','src','title','alt','currency')
            ->distinct()
            ->join('sponsored','oglas.id_oglas','=','sponsored.oglas_id')
            ->join('picture','oglas.id_oglas','=','picture.oglas_id')
            ->join('ppk','ppk_id','=','ppk.id_ppk')
            //  ->join('subcategory','subcategory_id','=','subcategory.id_subcategory')
            // ->join('category','category_id','=','category.id_category')
            ->where([
                [
                    'name_ppk',$cat
                ],
                [
                    'price','<=',$max
                ],
                [
                    'price','>=',$min
                ]

            ])
            ->offset($start)
            ->limit($take)
            ->get();
    }
    if ($max==null || $min==null && $search!=null)
    {
       //definis search

    }
    if ($max==null || $min==null && $search==null)
    {
       $data= DB::table('oglas')
            ->select('id_oglas','name','price','src','title','alt','currency')
            ->distinct()
            ->join('sponsored','oglas.id_oglas','=','sponsored.oglas_id')
            ->join('picture','oglas.id_oglas','=','picture.oglas_id')
            ->join('ppk','ppk_id','=','ppk.id_ppk')
            //  ->join('subcategory','subcategory_id','=','subcategory.id_subcategory')
            // ->join('category','category_id','=','category.id_category')
            ->where([
                [
                    'name_ppk',$cat
                ]

            ])
            ->offset($start)
            ->limit($take)
            ->get();
    }

    return $data;




}
public function pages($start,$take,$cat,$min,$max,$search)
{
    $pages='';
    if($max!=null && $min!=null && $search!=null)
    {
        //definisi search
        $pages='sve';

    }
    if($max==null || $min==null && $search!=null)
    {
        $pages='search';
    }


    if($min!=null && $max!=null && $search==null)
    {
        $pages= DB::table('oglas')
            ->select('id_oglas')
            ->distinct()
            ->join('sponsored','oglas.id_oglas','=','sponsored.oglas_id')
            ->join('picture','oglas.id_oglas','=','picture.oglas_id')
            ->join('ppk','ppk_id','=','ppk.id_ppk')
            //  ->join('subcategory','subcategory_id','=','subcategory.id_subcategory')
            // ->join('category','category_id','=','category.id_category')
            ->where([
                [
                    'name_ppk',$cat
                ],
                [
                    'price','<=',$max
                ],
                [
                    'price','>=',$min
                ]

            ])
            ->offset($start)
            ->limit($take)
            ->count();



    }
    if ($min==null || $max==null && $search==null)
        {
            $pages= DB::table('oglas')
                ->select('id_oglas')
                ->distinct()
                ->join('sponsored','oglas.id_oglas','=','sponsored.oglas_id')
                ->join('picture','oglas.id_oglas','=','picture.oglas_id')
                ->join('ppk','ppk_id','=','ppk.id_ppk')
                //  ->join('subcategory','subcategory_id','=','subcategory.id_subcategory')
                // ->join('category','category_id','=','category.id_category')
                ->where([
                    [
                        'name_ppk',$cat
                    ]

                ])
                ->offset($start)
                ->limit($take)
                ->count();


    }
    //dd($pages);
return $pages;




}





public function countAds($min,$max,$cat,$search)
{
    return DB::table('oglas')
    ->select('id_oglas')
    ->join('picture','oglas.id_oglas','=','picture.oglas_id')
        ->join('ppk','ppk_id','=','ppk.id_ppk')
        ->where([
            ['name_ppk',$cat],
            ['price','>=',$min],
            ['price','<=',$max]
        ])
    ->count();
}


}