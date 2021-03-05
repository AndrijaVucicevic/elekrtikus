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
    public $one=1;

    public function category()
    {
        //return DB::table('')

        return DB::table('category')
        ->select('id_category','name_category')
        ->orderBy('id_category','asc')
        ->get();




    }
    public function subcategory($cat=null)
    {
        //return DB::table('')

        $data= DB::table('subcategory')
            ->select('id_subcategory','subcategory_name','category_id');

        if($cat!=null)
        {
            $data=$data->where(
                'category_id',$cat
            );
        }

        return $data->orderBy('category_id','asc')
            ->get();
    }
    public function ppk($cat=null)
    {
        //dd($cat);
        //return DB::table('')

        $data= DB::table('ppk')
            ->select('id_ppk','name_ppk','subcategory_id');

           if($cat!=null)
           {
               if (strlen($cat)<2)
               {
                   $data = $data->where(
                       'subcategory_id', $cat
                   );
                   //dd($cat);
               }
               else {

                   $data = $data->where(
                       'name_ppk', $cat
                   );

               }
           }

        return $data->orderBy('subcategory_id','asc')
            ->get();
    }
    public function trending($cat,$col)
    {
        $promotion=0;
        $end=time()+150;
        $data= DB::table('oglas')
            ->select('id_oglas', 'name', 'price', 'src', 'title', 'alt','name_ppk'
                ,DB::raw('case when currency=0 then "rsd" else "euro" end as "currency_text"'))
            ->distinct()
            ->join('sponsored', 'oglas.id_oglas', '=', 'sponsored.oglas_id')
            ->join('picture', 'oglas.id_oglas', '=', 'picture.oglas_id')
            ->join('ppk', 'ppk_id', '=', 'ppk.id_ppk')
            ->join('subcategory', 'subcategory_id', '=', 'subcategory.id_subcategory')
            ->join('category', 'category_id', '=', 'category.id_category')
            ->where(
               'picture_cat','=',$this->one
            );
        if($cat=='naziv')
        {

             $data=$data->where([
                    [
                        'end_one','>',$promotion
                    ],
                    [
                        'end_one', '>', $end
                    ]

                ])
                ->get();
        }
        if($cat!='naziv' && $col=='shop') {

            $data=$data->where([
                    [
                    'name_ppk', $cat
                    ],
                    [
                        'end_one','>', $promotion
                    ],
                    [
                        'end_one', '>', $end
                    ]

                ])
                ->get();

        }
        if($cat!='naziv' && $col!='shop')
        {
       $data=$data->where([
                    [
                        'name_category', $cat
                    ],
                    [
                        'end_one','>', $promotion
                    ],
                    [
                        'end_one', '>', $end
                    ]

                ])
                ->get();
        }

        return $data;
    }

    public function hot()
    {
        return DB::table('oglas')
            ->select('id_oglas','name','price','alt','title','src' ,'name_ppk' 
                ,DB::raw('case when currency=0 then "rsd" else "euro" end as "currency_text"'))
            ->distinct()
            ->join('picture','id_oglas','=','oglas_id')
            ->join('ppk','ppk.id_ppk','=','oglas.ppk_id')
            ->where('picture_cat',$this->one)
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

public function sponsored($id)
{

    return DB::table('sponsored')
        ->select('end_one','end_two')
        ->where('oglas_id',$id)
        ->first();


}



}