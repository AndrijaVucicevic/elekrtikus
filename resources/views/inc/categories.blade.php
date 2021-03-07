@if(isset($categoryList)&&$categoryList!=null && $data!=null)

    @for($i=0;$i<count($categoryList);$i++)

        <li class="category_list_shop collapsible" data-target="{{$categoryList[$i]->subcategory_name}}">{{$categoryList[$i]->subcategory_name}}
            <ul class="subcategory_list">
                @for($a=0;$a<count($ppk);$a++)

                    @if($ppk[$a]->subcategory_id==$categoryList[$i]->id_subcategory)

                       @if(Route::current()->getName() == 'user')
                        <li id="list_category_{{$ppk[$a]->name_ppk}}">{{$ppk[$a]->name_ppk}}</li>

                        @else
                           
                        <li id="list_http://localhost/elektrikus/public/shop?{{$categoryList[$i]->subcategory_name}}&category={{$ppk[$a]->name_ppk}}">{{$ppk[$a]->name_ppk}}</li>

                            @endif
                    @endif



                @endfor
            </ul>
        </li>
    @endfor

@endif