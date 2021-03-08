
@if(isset($data))

<link href="{{asset('css/comment.css')}}" rel="stylesheet" type="text/css">




            <div class="comment-tabs">

                <h3>Komentari</h3>

                {{--      <ul class="nav nav-tabs" role="tablist" style="display:inline-flex !important;">
                      <li ><a href="#comments-logout" role="tab" data-toggle="tab" class="active"><h4 class="reviews text-capitalize">Comments</h4></a></li>

                        @if(\Illuminate\Support\Facades\Auth::check())
                        <li><a href="#add-comment" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Add comment</h4></a></li>
                        @endif

                </ul>--}}

                <div class="tab-content">
                    <div class="tab-pane active" id="comments-logout">
                        <ul class="media-list">
                            <li class="media">

                                <div class="media-body">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle" src="{{asset('img/slide5.jpg')}}" alt="profile">
                                    </a>

                                    <div class="well well-lg">

                                        <h4 class="media-heading text-uppercase reviews">Marco </h4>
                                        <ul class="media-date text-uppercase reviews list-inline">
                                            <li class="dd">22</li>
                                            <li class="mm">09</li>
                                            <li class="aaaa">2014</li>
                                        </ul>
                                        <p class="media-comment">
                                            Great snippet! Thanks for sharing.
                                        </p>
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                        <button class="btn btn-info btn-circle text-uppercase btn-reply" data-value="username_user"  id="reply"><span class="glyphicon glyphicon-share-alt"></span> Reply</button>
                                    @endif
                                    </div>

                                </div>

                                    <ul class="media-list">
                                        <li class="media media-replied">
                                            <div class="media-body">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" src="{{asset('img/slide5.jpg')}}" alt="profile">
                                                </a>
                                                <div class="well well-lg">
                                                    <h4 class="media-heading text-uppercase reviews"><span class="glyphicon glyphicon-share-alt"></span> The Hipster</h4>
                                                    <ul class="media-date text-uppercase reviews list-inline">
                                                        <li class="dd">22</li>
                                                        <li class="mm">09</li>
                                                        <li class="aaaa">2014</li>
                                                    </ul>
                                                    <p class="media-comment">
                                                        Nice job Maria.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>


                            </li>


                        </ul>
                    </div>
                    @if($messYes==0)

                        <div class="tab-pane active" id="add-comment">

                                <div class="form-group">
                                    <label for="addComment" class="control-label">Komentariši</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="addComment" id="addComment" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button class="btn btn-success btn-circle text-uppercase" type="button" id="submitComment"><span class="glyphicon glyphicon-send"></span>Pošalji komentar</button>
                                    </div>
                                </div>

                        </div>
                    @endif
                </div>
            </div>


<script type="text/javascript" src="{{asset('js/comment.js')}}"></script>
@endif