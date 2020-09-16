<?php

namespace Modules\Discount\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Discount\Entities\Discount;
use App\Product;
use App\User;
use App\Category;
use Illuminate\Validation\Rule;




class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $discounts = Discount::latest()->paginate(30);
        return view('discount::admin.all', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('discount::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|unique:discounts,code',
            'percent' => 'required|integer|between:1,99',
            'users' => 'nullable|array|exists:users,id',
            'products' => 'nullable|array|exists:products,id',
            'categories' => 'nullable|array|exists:categories,id',
            'expired_at' => 'required',
        ]);
        $discount = Discount::create($data);
        $discount->products()->attach($data['products']);
        $discount->categories()->attach($data['categories']);
        $discount->users()->attach($data['users']);
        alert()->success('تخفیف مورد نظر با موفقیت ایجاد شد.');
        return redirect(route('admin.discount.index'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Discount $discount)
    {
        return view('discount::admin.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Discount $discount)
    {
        $data = $request->validate([
            'code' => ['required', Rule::unique('discounts', 'code')->ignore($discount->id)],
            'percent' => 'required|integer|between:1,99',
            'users' => 'nullable|array|exists:users,id',
            'products' => 'nullable|array|exists:products,id',
            'categories' => 'nullable|array|exists:categories,id',
            'expired_at' => 'required',
        ]);
        $discount->update($data);


        if (isset($data['products'])) {
            $discount->products()->detach();
            $discount->products()->attach($data['products']);
        };
        if (isset($data['categories'])) {
            $discount->categories()->detach();
            $discount->categories()->attach($data['categories']);
        };
        if (isset($data['users'])) {
            $discount->users()->detach();
            $discount->users()->attach($data['users']);
        };


        return redirect(route('admin.discount.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
