<!-- Button trigger modal -->
<style>
    .modal-dialog .modal-content .modal-body {

        height: 250px!important;
       margin-top: 20px!important;
        padding: 50px!important;
    }
    .modal-dialog .modal-content .modal-body-change {

        padding: 20px!important;
        margin-top: 20px!important;

    }

    .modal-dialog  {

       width: 60%!important;
    }
    .modal-dialog .modal-content .modal-header button{

        float: right!important;
        right: 10px!important;
    }
    .modal-dialog .modal-content .modal-header {

        right: auto!important;
        border-bottom: 1px solid black;
        width: 100%;

    }
    .modal-dialog .modal-content .modal-header h5{
        margin-left: 20px;
    }

</style>


<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user_change_check">
    Launch demo modal
</button>
-->

<!-- Modal -->
<div class="modal fade" id="user_change_check" tabindex="-1" role="dialog" aria-labelledby="user_change_check" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="user_check">
                <h5 class="modal-title" id="changeModal">Potvrda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="user_check_body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btnUserAction btn btn-primary" data-value="" onclick="oop()">Save changes</button>
            </div>
        </div>
    </div>
</div>
@if(isset($code))
@if($code!='novUnos')


<!-- modal izmenaa --->
<div class="modal fade" id="user_change" tabindex="-1" role="dialog" aria-labelledby="user_change" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="user_change" style="border: none!important;">
              <h5 class="modal-title" id="change_title">Izmena oglasa oglass taj taaaj</h5>
            </div>
                <div class="modal-body-change" id="user_check_body">





                    @if($code=='moji_podaci')
<form>


@include('inc.sign_up')
</form>
<script src="{{asset('js/register.js')}}"></script>

               @else
                        @include('inc.new_product')

                    @endif
                </div>





            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btnUserAction btnUpdateInsert btn btn-primary" data-value="change_insert#2" >Save changes</button>
            </div>
            </div>
        </div>
</div>

@endif
    @endif