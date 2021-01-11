<?php
/**
 * Created by PhpStorm.
 * User: Andrija
 * Date: 11/16/2020
 * Time: 1:32 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class IndexModels
{

    public function category()
    {
        //return DB::table('')

        return DB::table('category')
            ->select('id_category','name_category')
            ->orderBy('id_category','asc')
            ->get();
    }
    public function subcategory()
    {
        //return DB::table('')

        return DB::table('subcategory')
            ->select('id_subcategory','subcategory_name','category_id')
            ->orderBy('category_id','asc')
            ->get();
    }
    public function ppk()
    {
        //return DB::table('')

        return DB::table('ppk')
            ->select('id_ppk','name_ppk','subcategory_id')
            ->orderBy('subcategory_id','asc')
            ->get();
    }
    public function trending($cat)
    {
        $promotion=1;
        $end=time()+150;
        return DB::table('oglas')
            ->select('id_oglas','name','price','src','title','alt','currency')
            ->distinct()
            ->join('sponsored','oglas.id_oglas','=','sponsored.oglas_id')
            ->join('picture','oglas.id_oglas','=','picture.oglas_id')
            ->join('ppk','ppk_id','=','ppk.id_ppk')
            ->join('subcategory','subcategory_id','=','subcategory.id_subcategory')
            ->join('category','category_id','=','category.id_category')
            ->where([
                [
                    'name_category',$cat
                ],
                [
                    'promotion',$promotion
                ],
                [
                    'end_one','>',$end
                ]

            ])
            ->get();

    }

    public function hot()
    {
        return DB::table('oglas')
            ->select('id_oglas','name','price','alt','title','src','currency')
            ->distinct()
            ->join('picture','id_oglas','=','oglas_id')
            ->orderBy('id_oglas','desc')
            ->limit(8)
            ->get();

    }

    public function blog()
    {
        return DB::table('blog')
            ->select('id_blog','name','datetime')
            ->orderBy('id_blog','asc')
            ->limit(3)
            ->get();


    }

    public function subscribe($email)
    {
        $code=201;
        try {

            DB::table('subscribe')
                ->insert([
                    'email' => $email
                ]);
        }
        catch (\PDOException $e)
        {
            $code=404;
        }

return $code;
    }

public function adverts($start,$take)
{
    $time=time()+100;
    return DB::table('advertising')
        ->select('src1','link')
        ->where('kraj','>',$time)
        ->offset($start)
        ->limit($take)
        ->get();



}

}