<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\Coupon;
use App\Repositories\CouponRepository;

class CouponController extends Controller
{
    public function index()
    {
        return view('coupon.index', [
            'coupons' => CouponRepository::query()->latest('id')->get(),
        ]);
    }

    public function create()
    {
        return view('coupon.create');
    }

    public function store(CouponStoreRequest $request)
    {
        CouponRepository::storeByRequest($request);

        return to_route('coupon.index')->with('success', 'Coupon created');
    }

    public function edit(Coupon $coupon)
    {
        return view('coupon.edit', [
            'coupon' => $coupon,
        ]);
    }

    public function update(CouponUpdateRequest $request, Coupon $coupon)
    {
        CouponRepository::updateByRequest($request, $coupon);

        return to_route('coupon.index')->withSuccess('Coupon updated');
    }

    public function delete(int $id)
    {
        CouponRepository::find($id)->delete();

        return redirect()->route('coupon.index')->withSuccess('Coupon deleted');
    }
}
