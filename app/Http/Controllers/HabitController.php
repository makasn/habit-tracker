<?php

namespace App\Http\Controllers;

use App\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $habits = Habit::where('user_id', Auth::id())->get();
        foreach ($habits as $habit) {
            $habit->setRrules();
        }
        return view('list', ['habits' => $habits]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'  => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'repeat_type' => 'string',
            'count_per_week' => 'integer',
            'interval' => 'integer',
            'day' => 'array',
            'timeframe' => 'string',
        ]);

        if ($validatedData['repeat_type'] == 'interval') {
            $validatedData['reccurence_rules'] = app('App\Http\Controllers\RruleController')
                ->buildIntervalRule($validatedData['interval']);
            $validatedData['count_per_week'] = null;
        }

        if ($validatedData['repeat_type'] == 'day') {
            $validatedData['reccurence_rules'] = app('App\Http\Controllers\RruleController')
                ->buildByDayRule($validatedData['day']);
            $validatedData['count_per_week'] = null;
        }

        $user_id = Auth::id();

        if (isset($request['habit_id'])) {
            $habit = Habit::where([
                ['user_id', $user_id],
                ['id', $request['habit_id']],
            ])->first();
            //エラーハンドリング
        }

        if (!isset($habit)) {
            $habit = new Habit();
            $habit->user_id = $user_id;
        }

        $habit->fill($validatedData)->save();
        return redirect()->route('home');
    }

    public function edit($habit_id)
    {
        $habit = Habit::where([
            ['user_id', Auth::id()],
            ['id', $habit_id],
        ])->first();

        $habit->setRrules();

        return view('edit', ['habit' => $habit]);
    }
}
