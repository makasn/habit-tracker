@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Habit</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="/store">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="Enter title" value="{{ $habit['title'] }}">
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" name="start_date" value="{{ $habit['start_date'] }}">
                            </div>
                            <div class="col">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" name="end_date" value="{{ $habit['end_date'] }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="timeframe">Time</label>
                            <select class="form-control" name="timeframe" id="timeframe">
                                <!-- TODO: Enumちゃんと使う -->
                                <option value="anytime" @if($habit['timeframe']=="anytime") selected @endif>いつでも</option>
                                <option value="morning" @if($habit['timeframe']=="morning") selected @endif>午前</option>
                                <option value="afternoon" @if($habit['timeframe']=="afternoon") selected @endif>午後</option>
                                <option value="evening" @if($habit['timeframe']=="evening") selected @endif>夜</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="repeat">Repeat</label>
                            <ul class="nav nav-tabs">
                                <!-- TODO: Enumちゃんと使う -->
                                <li class="nav-item">
                                    <a href="#tab1"
                                       @if($habit['repeat_type'] == "day") class="nav-link active" @else class="nav-link" @endif
                                       data-toggle="tab">曜日</a>
                                    <input type="hidden" name="repeat_type" value="day" @if($habit['repeat_type'] != "day") disabled=true @endif>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab2"
                                       @if($habit['repeat_type'] == "interval") class="nav-link active" @else class="nav-link" @endif
                                       data-toggle="tab">インターバル</a>
                                    <input type="hidden" name="repeat_type" value="interval" @if($habit['repeat_type'] != "interval") disabled=true @endif>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab3"
                                       @if($habit['repeat_type'] == "count") class="nav-link active" @else class="nav-link" @endif
                                       data-toggle="tab">回数</a>
                                    <input type="hidden" name="repeat_type" value="count" @if($habit['repeat_type'] != "count") disabled=true @endif>
                                </li>
                            </ul>
                            <div class="tab-content p-3 border border-top-0">
                                <div id="tab1" 
                                     @if($habit['repeat_type'] == "day") class="tab-pane active" @else class="tab-pane" @endif>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[mo]"
                                               id="mo" value="MO" @if(in_array('MO', $habit['day'])) checked @endif> 
                                        <label class="form-check-label" for="mo">月曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[tu]"
                                               id="tu" value="TU" @if(in_array('TU', $habit['day'])) checked @endif>
                                        <label class="form-check-label" for="tu">火曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[we]"
                                               id="we" value="WE" @if(in_array('WE', $habit['day'])) checked @endif>
                                        <label class="form-check-label" for="we">水曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[th]"
                                               id="th" value="TH" @if(in_array('TH', $habit['day'])) checked @endif>
                                        <label class="form-check-label" for="th">木曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[fr]"
                                               id="fr" value="FR" @if(in_array('FR', $habit['day'])) checked @endif>
                                        <label class="form-check-label" for="fr">金曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[sa]"
                                               id="sa" value="SA" @if(in_array('SA', $habit['day'])) checked @endif>
                                        <label class="form-check-label" for="sa">土曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[su]"
                                               id="su" value="SU" @if(in_array('SU', $habit['day'])) checked @endif>
                                        <label class="form-check-label" for="su">日曜日</label>
                                    </div>
                                </div>
                                <div id="tab2"
                                     @if($habit['repeat_type'] == "interval") class="tab-pane active" @else class="tab-pane" @endif>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval0" value=1 @if($habit['interval']===1) checked @endif>
                                        <label class="form-check-label" for="interval0">毎日</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval1" value=2 @if($habit['interval']===2) checked @endif>
                                        <label class="form-check-label" for="interval1">2日に1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval2" value=3 @if($habit['interval']==3) checked @endif>
                                        <label class="form-check-label" for="interval2">3日に1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval3" value=4 @if($habit['interval']==4) checked @endif>
                                        <label class="form-check-label" for="interval3">4日に1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval4" value=5 @if($habit['interval']==5) checked @endif>
                                        <label class="form-check-label" for="interval4">5日に1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval5" value=6 @if($habit['interval']==6) checked @endif>
                                        <label class="form-check-label" for="interval5">6日に1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval6" value=7 @if($habit['interval']==7) checked @endif>
                                        <label class="form-check-label" for="interval6">7日に1回</label>
                                    </div>
                                    <div class="form-check">
                                    </div>
                                </div>
                                <div id="tab3"
                                     @if($habit['repeat_type'] == "count") class="tab-pane active" @else class="tab-pane" @endif>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count1" value=1 @if($habit['count']===1) checked @endif>
                                        <label class="form-check-label" for="count1">毎週1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count2" value=2 @if($habit['count']==2) checked @endif>
                                        <label class="form-check-label" for="count2">毎週2回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count3" value=3 @if($habit['count']==3) checked @endif>
                                        <label class="form-check-label" for="count3">毎週3回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count4" value=4 @if($habit['count']==4) checked @endif>
                                        <label class="form-check-label" for="count4">毎週4回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count5" value=5 @if($habit['count']==5) checked @endif>
                                        <label class="form-check-label" for="count5">毎週5回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count6" value=6 @if($habit['count']==6) checked @endif>
                                        <label class="form-check-label" for="count1">毎週6回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count7" value=7 @if($habit['count']==7) checked @endif>
                                        <label class="form-check-label" for="count7">毎日</label>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coping">Coping</label>
                            <input type="text" class="form-control" id="coping"
                                   placeholder="Enter coping" value="{{ $habit['coping'] }}">
                        </div>
                        <div class="form-group">
                            <label for="memo">Memo</label>
                            <input type="text" class="form-control" id="memo"
                                   placeholder="Enter memo" value="{{ $habit['memo'] }}">
                        </div>
                        <input type="hidden" name="habit_id" value="{{ $habit['id'] }}">
                        <button type="submit" class="btn btn-primary mb-2">Register</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@include('_habit_script')
@endsection
