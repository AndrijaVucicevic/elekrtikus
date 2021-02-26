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
    public $city=1;
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
    public $one=1;










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

        //dd($start);
      $data= DB::table('oglas')

            ->select('id_oglas','oglas.name','price','src','title','alt','korisnik_oglas.user_id as user_follow'
                ,DB::raw('case when currency=0 then "rsd" else "€" end as "currency_text"'))

            ->join('korisnik_oglas','oglas.id_oglas','=','korisnik_oglas.oglas_id')
            ->leftJoin('picture','oglas.id_oglas','=','picture.oglas_id')
            ->join('ppk','ppk_id','=','ppk.id_ppk')
            ->where([
               [ 'korisnik_oglas.user_id',$id
               ],
                ['picture_cat',$this->one
                ]
            ]);

      if($category!=null)
      {
          $data=$data->where('name_ppk',$category);
      }


            return
                $data->offset($start)
                ->limit($limit)
                ->distinct()
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
               ],
               ['picture_cat',$this->one
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

 public function insert_picture($id,$fileName,$fileName1,$cat=0)
 {
     $code=201;
    try{

        DB::table('picture')->insert([
           "src"=>"images/" . $fileName1,
            "alt"=>$fileName,
            "title"=>$fileName1,
            "oglas_id"=>$id,
            "picture_cat"=>$cat

        ]);

    }
    catch(\Throwable $e) {
        //\Log::critical("Failed to insert youur ad.");
        $code=$e->getMessage();
        //  throw new \Exception("Greska pri unosu");

    }
     return $code;

 }
public function pictureUpdateCat($id)
{
    $cat=1;
    DB::table('picture')->where('oglas_id',$id)
        ->limit($cat)
        ->update([
        "picture_cat"=> $cat

    ]);



}

public function insert_product()
{


    try {
        DB::transaction(function () {

            $time=time();
            $id=DB::table('oglas')->insertGetId([
                "ppk_id"=>$this->ppk,
                "name"=>$this->nameProduct,
                "price"=>$this->price,
                "currency"=>$this->currency,
                "description"=>$this->description,
                "timestamp"=>$time,
                "condition_status"=>$this->condition,
                "price_status"=>$this->priceStatus




            ]);



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
               'city'=>$this->city

           ]);

        });

        $code= $this->idInsert;
    }
    catch(\Throwable $e) {
        //\Log::critical("Failed to insert youur ad.");
        $code=$e->getMessage();
        //  throw new \Exception("Greska pri unosu");

    }
//dd($code);
    return $code;




}

// bank account
public function check_bank_account()
{
    return DB::table('bank_account')
        ->select('current_state')
        ->where('user_id',auth()->user()->id)
        ->first();

}
public function insert_promotion_one($id){

    $code=201;
    $time=time();
    $start_one=date('Y-m-d h:i:s', $time);
    try {
        DB::table('sponsored')
            ->insert([
                'oglas_id'=>$id,
                'end_one'=>time(),
                'start_one'=>$start_one
            ]);
    }

        catch(\Throwable $e) {
            //\Log::critical("Failed to insert youur ad.");
            $code=$e->getMessage();
            //  throw new \Exception("Greska pri unosu");

        }

        return $code;
}
public function insert_promotion_two($id){
    $code=201;
    $time=time();
    $start_one=date('Y-m-d h:i:s', $time);
    try {
        DB::table('sponsored')
            ->insert([
               'oglas_id'=>$id,
                'end_two'=>time(),
                'start_two'=>$start_one
            ]);
    }
    catch(\Throwable $e) {
        //\Log::critical("Failed to insert youur ad.");
        $code=$e->getMessage();
        //  throw new \Exception("Greska pri unosu");

    }

    return $code;
}

public function getUserProduct($id)
{


    return DB::table('oglas')
        ->select('oglas.id_oglas','oglas.datetime','id_ppk','name_ppk','oglas.name','price','currency','description','price_status','condition_status'
        ,'JMBG','ID_card','phone_number','address','korisnik_oglas.name as firstName','lastName','src','alt','title'
            ,'subcategory_name','subcategory.id_subcategory','name_category','category.id_category','city'
        )
        ->join('picture','oglas.id_oglas','=','picture.oglas_id')
        ->join('korisnik_oglas','oglas.id_oglas','=','korisnik_oglas.oglas_id')
        ->join('ppk','oglas.ppk_id','=','ppk.id_ppk')
        ->join('subcategory', 'ppk.subcategory_id', '=', 'subcategory.id_subcategory')
        ->join('category', 'subcategory.category_id', '=', 'category.id_category')
       ->where('oglas.id_oglas','=',$id)
        ->get();
}

    public $idUpdate;

public function update_product($idUpdate)
{

    $this->idUpdate=$idUpdate;
    try {
        DB::transaction(function () {

            $time=time();
            DB::table('oglas')
                ->where('id_oglas',$this->idUpdate)
                ->update([
                "ppk_id"=>$this->ppk,
                "name"=>$this->nameProduct,
                "price"=>$this->price,
                "currency"=>$this->currency,
                "description"=>$this->description,
                "update_at"=>$time,
                "condition_status"=>$this->condition,
                "price_status"=>$this->priceStatus

            ]);





            DB::table('korisnik_oglas')
                ->where('oglas_id',$this->idUpdate)
                ->update([
                'ID_card'=>$this->personIDcard,
                'phone_number'=>$this->personPhone,
                'address'=>$this->personStreet,
                'name'=>$this->personName,
                'lastName'=>$this->personLastName,
                'city'=>$this->city

            ]);

        });

        $code= 201;
    }
    catch(\Throwable $e) {
        //\Log::critical("Failed to insert youur ad.");
        $code=$e->getMessage();
        //  throw new \Exception("Greska pri unosu");

    }

    return $code;




}

public function getPicture($idUpdate)
{

    return DB::table('picture')
        ->select('id_picture')
        ->where('oglas_id',$idUpdate)
        ->get();


}

public function deletePicture($id)
{
    $file=DB::table('picture')
        ->select('title')
        ->where('id_picture',$id)
        ->first();

    DB::table('picture')
        ->where('id_picture', '=',$id)
        ->delete();

    return $file;
}



}