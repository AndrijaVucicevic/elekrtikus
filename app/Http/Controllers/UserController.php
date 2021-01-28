<?php

namespace App\Http\Controllers;

use App\Models\BaseUserModels;
use App\Models\IndexModels;
use App\Models\ShopModels;
use App\Models\UserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    private $model;
    private $modelBase;
    private $modelUser;
    private $modelIndex;
    private $start=0;
    private $limit=1;

    public function __construct()
    {
        $this->model= new ShopModels();
        $this->modelBase=new BaseUserModels();
        $this->modelUser=new UserModels();
        $this->modelIndex=new IndexModels();

        // parent::__call($method, $parameters); // TODO: Change the autogenerated stub
    }



  public function index(Request $request)
  {
      //
      $user=auth()->user()->id;
      $code=$request->get('category');
      $categoryList=null;
      $ppk=null;
 if($code==null) $code=$request->code;

      switch ($code)
      {

          case 'messages' :
              $count=4;
              $data=$this->modelUser->getMessages($count);
              break;
          case 'likes':
              $count=6;
              $data=$this->modelUser->getLikes($count);
              break;
          case 'obavestenja':
              $count='sve';
              $data=$this->modelUser->getLikes($count);
              $code='obavestenja';
              break;
          case 'poruke':
              $count='sve';
              $data=$this->modelUser->getMessages($count);
              $code='obavestenja';
              break;
          case 'moji_oglasi':
              $data=$this->modelUser->getMyAds(auth()->user()->id,$this->start,$this->limit,$category=null);
              $code='oglasi';
              $categoryList = $this->modelIndex->subcategory();
              $ppk = $this->modelIndex->ppk();
              break;
          case 'pratim':
              $data=$this->modelUser->getFollowAds(auth()->user()->id,$this->start,$this->limit,$category=null);
              $code='oglasi';
              $categoryList = $this->modelIndex->subcategory();
              $ppk = $this->modelIndex->ppk();
              break;
          case 'noviUnos':
              $code='novUnos';
              $data=null;
              $categoryList=$this->modelIndex->category();
              break;

      }
     // dd($code);

      if ($request->code!=null) {
          return count($data) > 0 ? view('ajax.shop_ajax', ["userLi" => $data]) : ($data = 404);
      }
      else{

          return view('user',[
             'data'=>$data,
              'code'=>$code,
              'categoryList'=>$categoryList,
              'ppk'=>$ppk
          ]);


      }
      //dd($code);

  }

  public function more_products(Request $request)
  {


      $this->start=(int)$request->start*(int)$this->limit;
      $code=$request->code;
      $category=$request->category;

      if(strpos($code,'#'))
      {
          $string=explode('#',$code);
          $code=$string[0];

      }

      //dd($category);
      if($code=='moji_oglasi')
      {
          $data=$this->modelUser->getMyAds(auth()->user()->id,$this->start,$this->limit,$category);

      }
      else{
          $data=$this->modelUser->getFollowAds(auth()->user()->id,$this->start,$this->limit,$category);
      }



      return  count($data)>0 ?  view('ajax.shop_ajax', ["products" => $data]) : ($data=404) ;



  }

public function changeUserCategory(Request $request)
{
    $category=$request->category;
    $code=$request->code;

    if(strpos($code,'#'))
    {
        $string=explode('#',$code);
        $code=$string[0];

    }


    if ($code=='moji_oglasi')
    {
        $data=$this->modelUser->getMyAds(auth()->user()->id,$this->start,$this->limit,$category);
    }
    if($code=='pratim')
    {
        $data=$this->modelUser->getFollowAds(auth()->user()->id,$this->start,$this->limit,$category);

    }

    return  count($data)>0 ?  view('ajax.shop_ajax', ["products" => $data]) : ($data=404) ;

}
public function delete_product(Request $request)
{
    $password=$request->pass;
    $product_id=$request->id;


        $string=explode('#',$product_id);
        $product_id=$string[1];

       $user=$this->modelBase->userPassword(auth()->user()->id);


        $check=Hash::check($password, $user->password);

     if($check==false)
     {
         $data=419;
     }
     if($check==true)
     {
         //brisanje

         $data=$this->modelUser->deleteProduct($product_id);

        if($data!=201)
        {
            $data=404;
        }

     }

         return ($data);

}

}
