<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Attribute;
use App\AttributeValue;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query();

        if ($keyword = request('search')) {
            $products->where('title' , 'LIKE' , "%{$keyword}%")->orWhere('description' , 'LIKE' , "%{$keyword}%");
        }
    
        $products = $products->latest()->paginate(20);
        return view('admin.products.all' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer',],
            'inventory' => ['required', 'integer'],
            'view_count' => ['integer'],
            'categories' => ['required'],
            'image' => ['required','mimes:png,jpg,jpeg','max:1024'],
            'attributes' => ['array']
        ]);

        $file = $request->file('image');
        $destinationPath = '/images/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
        $file->move( public_path($destinationPath), $file->getClientOriginalName());

        $data['image'] = $destinationPath . $file->getClientOriginalName();


        $product = auth()->user()->products()->create($data);
        $product->categories()->sync($data['categories']);
        if (isset($data['attributes'])) {
            $this->attachAttributesToProduct($product , $data);
        };

        alert()->success('مطلب مورد نظر شما با موفقیت ایجاد شد.');
        return redirect(route('admin.products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // return $product->attributes[0]->pivot->value;
        return view('admin.products.edit' , compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer',],
            'inventory' => ['required', 'integer'],
            'view_count' => ['integer'],
            'categories' => ['required'],
            'attributes' => ['required']
        ]);


        if ($request->file('image')) {
            $request->validate([
                'image' => ['required','mimes:png,jpg,jpeg','max:1024']
            ]);

            if(File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $file = $request->file('image');
            $destinationPath = '/images/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
            $file->move( public_path($destinationPath), $file->getClientOriginalName());
            $data['image'] = $destinationPath . $file->getClientOriginalName();
        }

        

        $product->update($data);
        $product->categories()->sync($data['categories']);
        

        $product->attributes()->detach();

        if (isset($data['attributes'])) {
            $this->attachAttributesToProduct($product , $data);
        };
        
        alert()->success('مطلب مورد نظر شما با موفقیت ایجاد شد.');
        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }

    public function attachAttributesToProduct(Product $product , array $data): void {
        $attributes = collect($data['attributes']);
        $attributes->each(function($item) use($product) {
            if (is_null($item['name']) || is_null($item['value'])) {
                return;
            }
            $attr = Attribute::firstOrCreate(
                ['name' => $item['name']]
            );
            $attr_value = $attr->values()->firstOrCreate(
                ['value' => $item['value']]
            );
            $product->attributes()->attach($attr->id , ['value_id' => $attr_value->id]);
 
        });
    }
}
