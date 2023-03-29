<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid;

class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function discount()
    {
        $user_id = auth()->user()->id;
        $discount = Discount::where('user_id',$user_id)->first();
        if (!isset($discount)){
            // Скидка отсутствует - генерируем новую
            $discount = $this->createDiscount($user_id);
        } elseif (Carbon::now()->subHours()->gte($discount->updated_at)) {
            // Скидка есть, но её возраст старше часа
            $discount = $this->updateDiscount($discount);
        }
        return view('home', compact('discount'));
    }

    public function checkDiscount(Request $request)
    {
        $user_id = auth()->user()->id;
        $discount = Discount::where('user_id',$user_id)
            ->where('code', $request->input('code'))
            ->first();
        if (!isset($discount)) {
            return view('discount-error');
        } elseif (Carbon::now()->subHours(3)->gte($discount->updated_at)) {
            // Скидка есть, но её возраст старше трёх часов
            return view('discount-error');
        }
        return view('home', compact('discount'));
    }

    private function createDiscount($user_id)
    {
        $discount = new Discount();
        $discount->value = random_int(1,50);
        $discount->code = Uuid\Uuid::getFactory()->uuid1();
        $discount->user_id = $user_id;
        $discount->save();
        return $discount;
    }

    private function updateDiscount(Discount $discount)
    {
        $discount->value = random_int(1,50);
        $discount->code = Uuid\Uuid::getFactory()->uuid1();
        $discount->save();
        return $discount;
    }
}
