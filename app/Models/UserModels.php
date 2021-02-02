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

   public $nameProduct;
    public $description;
    public $price;
    public $priceStatus;
    public $ppk;
    public $city;
    public $currency;
    public $condition;
    public $promotion;
    public $personName;
    public $personLastName;
    public $personPhone;
    public $personPlace;
    public $personStreet;
    public $personJMBG;
    public $personIDcard;

    public $fileName;
    public $fileName1;
    public $fileSrc;

    public $idInsert;










    public function getMessages($count)
    {
        return 1;
    }
    public function getLikes($count)
    {
        return 1;
    }
    public function getMyAds($id,$start,$limit,$category)
    {
      $data= DB::table('oglas')
            ->select('id_oglas','name','price','src','title','alt','korisnik_oglas.user_id as user_follow'
                ,DB::raw('case when currency=0 then "rsd" else "€" end as "currency_text"'))
            ->distinct()
            ->join('korisnik_oglas','oglas.id_oglas','=','korisnik_oglas.oglas_id')
            ->join('picture','oglas.id_oglas','=','picture.oglas_id')
            ->join('ppk','ppk_id','=','ppk.id_ppk')
            ->where([
               [ 'korisnik_oglas.user_id',$id
               ]
            ]);

      if($category!=null)
      {
          $data=$data->where('name_ppk',$category);
      }


            return $data->offset($start)
            ->limit($limit)
            ->get();


    }

    public function getFollowAds($id,$start,$limit,$category)
    {
       $data=DB::table('oglas')
            ->select('id_oglas','name','price','src','title','alt'
                ,DB::raw('case when currency=0 then "rsd" else "€" end as "currency_text"'))
            ->distinct()
            ->join('follow','oglas.id_oglas','=','follow.oglas_id')
            ->join('picture','oglas.id_oglas','=','picture.oglas_id')
            ->join('ppk','ppk_id','=','ppk.id_ppk')
           ->where([
               [
                'follow.user_id',$id
               ]
           ]);

        if($category!=null)
        {
            $data=$data->where('name_ppk',$category);
        }


            return $data->offset($start)
                ->limit($limit)
                ->get();


    }

    public $idBrisanje;

    public function deleteProduct($id)
    {
        $this->idBrisanje=$id;

        try {
            DB::transaction(function () {

                DB::table("korisnik_oglas")
                    ->where("oglas_id", "=", $this->idBrisanje)
                    ->delete();
                DB::table('picture')
                    ->where('oglas_id', '=', $this->idBrisanje)
                    ->delete();

                DB::table("oglas")
                    ->where("id_oglas", "=", $this->idBrisanje)
                    ->delete();
                DB::table("sponsored")
                    ->where("oglas_id", "=", $this->idBrisanje)
                    ->delete();
                DB::table("follow")
                    ->where("oglas_id", "=", $this->idBrisanje)
                    ->delete();
                DB::table("likes_unlikes")
                    ->where("oglas_id", "=", $this->idBrisanje)
                    ->delete();
               // $jedan = 1;
              /*  DB::table('users')
                    ->where('id', $this->userBrisanje)
                    ->update(['broj_oglasa' => DB::raw('broj_oglasa +' . $jedan)]);
*/
            });

            $code=201;
        }
        catch(\Throwable $e) {
            //\Log::critical("Failed to insert youur ad.");
            $code=$e->getMessage();
            //  throw new \Exception("Greska pri unosu");

        }
        return $code;

    }

 public function insert_picture($id)
 {
     $code=201;
    try{

        DB::table('picture')->insert([
           "src"=>$this->fileSrc,
            "alt"=>$this->fileName,
            "title"=>$this->fileName1,
            "oglas_id"=>$id

        ]);

    }
    catch(\Throwable $e) {
        //\Log::critical("Failed to insert youur ad.");
        $code=$e->getMessage();
        //  throw new \Exception("Greska pri unosu");

    }
     return $code;

 }


public function insert_product()
{


    try {
        DB::transaction(function () {

            $time=time();
            $id=DB::table('oglas')->insertGetId([
             "city_id"=>$this->city,
                "ppk_id"=>$this->ppk,
                "name"=>$this->nameProduct,
                "price"=>$this->price,
                "currency"=>$this->currency,
                "description"=>$this->description,
                "timestamp"=>$time,
                "condition_status"=>$this->condition,
                "price_status"=>$this->priceStatus




            ]);

            $oh=1;

            $this->idInsert=$id;
           DB::table('korisnik_oglas')->insert([
               'user_id'=>auth()->user()->id,
               'oglas_id'=>$id,
               'JMBG'=>$this->personJMBG,
               'ID_card'=>$this->personIDcard,
               'phone_number'=>$this->personPhone,
               'address'=>$this->personStreet,
               'name'=>$this->personName,
               'lastName'=>$this->personLastName,
               'city_id'=>$oh

           ]);

        });

        $code= $this->idInsert;
    }
    catch(\Throwable $e) {
        //\Log::critical("Failed to insert youur ad.");
        $code=$e->getMessage();
        //  throw new \Exception("Greska pri unosu");

    }

    return $code;




}






}