@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Habit</div>

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
                                   placeholder="Enter title" value="{{ old('title') }}">
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                            </div>
                            <div class="col">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="timeframe">Time</label>
                            <select class="form-control" name="timeframe" id="timeframe">
                                <!-- TODO: Enumちゃんと使う -->
                                <option value="anytime" @if(old('timeframe')=="anytime") selected @endif>いつでも</option>
                                <option value="morning" @if(old('timeframe')=="morning") selected @endif>午前</option>
                                <option value="afternoon" @if(old('timeframe')=="afternoon") selected @endif>午後</option>
                                <option value="evening" @if(old('timeframe')=="evening") selected @endif>夜</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="repeat">Repeat</label>
                            <ul class="nav nav-tabs">
                                <!-- TODO: Enumちゃんと使う -->
                                <li class="nav-item">
                                    <a href="#tab1" class="nav-link active" data-toggle="tab">曜日</a>
                                    <input type="hidden" name="repeat_type" value="day"> 
                                </li>
                                <li class="nav-item">
                                    <a href="#tab2" class="nav-link" data-toggle="tab">インターバル</a>
                                    <input type="hidden" name="repeat_type" value="interval" disabled=true>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab3" class="nav-link" data-toggle="tab">回数</a>
                                    <input type="hidden" name="repeat_type" value="count" disabled=true>
                                </li>
                            </ul>
                            <div class="tab-content p-3 border border-top-0">
                                <div id="tab1" class="tab-pane active">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[mo]"
                                               id="mo" value="MO" @if(old('day.mo')) checked @endif> 
                                        <label class="form-check-label" for="mo">月曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[tu]"
                                               id="tu" value="TU" @if(old('day.tu')) checked @endif>
                                        <label class="form-check-label" for="tu">火曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[we]"
                                               id="we" value="WE" @if(old('day.we')) checked @endif>
                                        <label class="form-check-label" for="we">水曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[th]"
                                               id="th" value="TH" @if(old('day.th')) checked @endif>
                                        <label class="form-check-label" for="th">木曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[fr]"
                                               id="fr" value="FR" @if(old('day.fr')) checked @endif>
                                        <label class="form-check-label" for="fr">金曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[sa]"
                                               id="sa" value="SA" @if(old('day.sa')) checked @endif>
                                        <label class="form-check-label" for="sa">土曜日</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="day[su]"
                                               id="su" value="SU" @if(old('day.su')) checked @endif>
                                        <label class="form-check-label" for="su">日曜日</label>
                                    </div>
                                </div>
                                <div id="tab2" class="tab-pane">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval0" value=0 @if(old('interval')===0) checked @endif>
                                        <label class="form-check-label" for="interval0">毎日</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval1" value=1 @if(old('interval')===1) checked @endif>
                                        <label class="form-check-label" for="interval1">2日に1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval2" value=2 @if(old('interval')==2) checked @endif>
                                        <label class="form-check-label" for="interval2">3日に1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval3" value=3 @if(old('interval')==3) checked @endif>
                                        <label class="form-check-label" for="interval3">4日に1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval4" value=4 @if(old('interval')==4) checked @endif>
                                        <label class="form-check-label" for="interval4">5日に1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval5" value=5 @if(old('interval')==5) checked @endif>
                                        <label class="form-check-label" for="interval5">6日に1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="interval"
                                               id="interval6" value=6 @if(old('interval')==6) checked @endif>
                                        <label class="form-check-label" for="interval6">7日に1回</label>
                                    </div>
                                    <div class="form-check">
                                    </div>
                                </div>
                                <div id="tab3" class="tab-pane">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count1" value=1 @if(old('count')===1) checked @endif>
                                        <label class="form-check-label" for="count1">毎週1回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count2" value=2 @if(old('count')==2) checked @endif>
                                        <label class="form-check-label" for="count2">毎週2回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count3" value=3 @if(old('count')==3) checked @endif>
                                        <label class="form-check-label" for="count3">毎週3回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count4" value=4 @if(old('count')==4) checked @endif>
                                        <label class="form-check-label" for="count4">毎週4回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count5" value=5 @if(old('count')==5) checked @endif>
                                        <label class="form-check-label" for="count5">毎週5回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count6" value=6 @if(old('count')==6) checked @endif>
                                        <label class="form-check-label" for="count1">毎週6回</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="count"
                                               id="count7" value=7 @if(old('count')==7) checked @endif>
                                        <label class="form-check-label" for="count7">毎日</label>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coping">Coping</label>
                            <input type="text" class="form-control" id="coping"
                                   placeholder="Enter coping" value="{{ old('coping') }}">
                        </div>
                        <div class="form-group">
                            <label for="memo">Memo</label>
                            <input type="text" class="form-control" id="memo"
                                   placeholder="Enter memo" value="{{ old('memo') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Register</button>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@include('_habit_script')
@endsection
