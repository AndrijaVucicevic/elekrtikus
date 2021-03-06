<?php
/**
 * Created by PhpStorm.
 * User: Andrija
 * Date: 11/17/2020
 * Time: 4:33 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class ProductModels
{


    public function getInformation($product_id)
    {

        return DB::select('SELECT name_ppk, oglas.name as o_name, price, description, likes, unlike, timestamp
        ,username,created_at,korisnik_oglas.name,price_status,condition_status, address,city,phone_number,
        CASE WHEN currency=0 then "rsd" else "€" END as currency_text, (SELECT COUNT(user_id) FROM korisnik_oglas WHERE user_id IN (SELECT user_id FROM korisnik_oglas WHERE oglas_id=?)) as number_of
        FROM oglas INNER JOIN korisnik_oglas ON oglas.id_oglas=korisnik_oglas.oglas_id 
        INNER JOIN users ON users.id=korisnik_oglas.user_id 
        INNER JOIN ppk ON ppk.id_ppk=oglas.ppk_id
        WHERE id_oglas=?',array_fill(0,3,$product_id));

    /*  return DB::table('oglas')
            ->select('name_ppk','oglas.name as o_name','price','description','likes','unlike','timestamp','username','created_at','korisnik_oglas.name',
                DB::raw('case when currency=0 then "rsd" else "€" end as "currency_text"'),
           'price_status','condition_status','address','phone_number','city',
                DB::raw('SELECT COUNT(user_id) FROM korisnik_oglas WHERE user_id IN (SELECT user_id FROM korisnik_oglas WHERE oglas_id=22) as number_of)',array_fill(0,3,$product_id))
            )
            ->join('korisnik_oglas','oglas_id','=','oglas.id_oglas')
            ->join('users','users.id','=','korisnik_oglas.user_id')
            ->join('ppk','ppk.id_ppk','=','oglas.ppk_id')
            ->where(
               'id_oglas',$product_id
            )
            ->first();

*/


    }

}