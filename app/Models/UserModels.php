<?php
/**
 * Created by PhpStorm.
 * User: Andrija
 * Date: 1/18/2021
 * Time: 6:43 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserModels
{

    public function getMessages($count)
    {
        return 1;
    }
    public function getLikes($count)
    {
        return 1;
    }
    public function getMyAds($id,$start,$limit)
    {
        return DB::table('oglas')
            ->select('id_oglas','name','price','src','title','alt','korisnik_oglas.user_id as user_follow'
                ,DB::raw('case when currency=0 then "rsd" else "€" end as "currency_text"'))
            ->distinct()
            ->join('korisnik_oglas','oglas.id_oglas','=','korisnik_oglas.oglas_id')
            ->join('picture','oglas.id_oglas','=','picture.oglas_id')
            ->join('ppk','ppk_id','=','ppk.id_ppk')
            ->where('korisnik_oglas.user_id',$id)
            ->offset($start)
            ->limit($limit)
            ->get();
    }

    public function getFollowAds($id,$start,$limit)
    {
        return DB::table('oglas')
            ->select('id_oglas','name','price','src','title','alt'
                ,DB::raw('case when currency=0 then "rsd" else "€" end as "currency_text"'))
            ->distinct()
            ->join('follow','oglas.id_oglas','=','follow.oglas_id')
            ->join('picture','oglas.id_oglas','=','picture.oglas_id')
            ->join('ppk','ppk_id','=','ppk.id_ppk')
            ->where('follow.user_id',$id)
            ->offset($start)
            ->limit($limit)
            ->get();


    }
}