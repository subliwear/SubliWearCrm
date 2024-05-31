<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Patronage;
use App\Models\Discount;
use Image;

class ProductsController extends Controller
{
    public function index(){
        return view('products')->with([
            'categories'=>Category::orderBy('title', 'asc')->get(),
            'products'=>Product::paginate(5, ['*'], 'product_page'),
            'patronages' => Patronage::orderBy('title')->paginate(10, ['*'], 'patronage_page')
        ]);
    }

    public function addCategory(){
        return view('products-add-category');
    }

    public function createCategory(Request $request){
        $this->validate($request, [
            'title'=>'required'
        ]);
        $c = new Category;
        $c->title = $request->title;
        $c->images = $request->blocks;
        $c->save();
        return redirect()->route('products');
    }

    public function editCategory(Category $category){
        return view('products-edit-category')->with(['category'=>$category]);
    }

    public function saveCategory(Category $category, Request $request){
        $this->validate($request, [
            'title'=>'required'
        ]);
        $category->title = $request->title;
        $category->images = $request->blocks;
        $category->save();
        return redirect()->route('products');
    }

    public function deleteCategory(Category $category){
        $category->delete();
        return redirect()->back();
    }


    public function add(){
        return view('products-add')->with(['categories'=>Category::all()]);
    }

    public function edit(Product $product){
        return view('products-edit')->with(['categories'=>Category::all(), 'product'=>$product]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'title'=>'required',
            'category_id'=>'required',
        ]);
        if($request->has('preview')){
            $preview = url(str_replace('public', 'storage', $request->file('preview')->store('public/products')));
        }else{
            $preview = 'https://placehold.co/400x400';
        }
        $p = new Product;
        $p->title = $request->title;
        $p->description = $request->description;
        $p->category_id = $request->category_id;
        $p->preview = $preview;
        $p->save();
        return redirect()->route('products');
    }

    public function save(Product $product, Request $request){
        $this->validate($request, [
            'title'=>'required',
            'category_id'=>'required',
        ]);
        if($request->has('preview')){
            $preview = url(str_replace('public', 'storage', $request->file('preview')->store('public/products')));
        }else{
            $preview = $product->preview;
        }
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->preview = $preview;
        $product->save();
        return redirect()->route('products');
    }

    public function delete(Product $product){
        $product->delete();
        return redirect()->back();
    }

    public function addPatronage(){
        return view('products-patronage-add')->with(['categories'=>Category::all()->map(function($item){
            $item->images = [];
            return $item;
        })]);
    }

    public function editPatronage(Patronage $patronage){
        $patronage->categories = json_decode($patronage->categories, true);
        $patronage->products = json_decode($patronage->products, true);
        return view('products-patronage-edit')->with(['patronage'=>$patronage, 'categories'=>Category::all()]);
    }

    public function createThumbnail($path, $width=300, $height=300)
    {

        $img = Image::make(str_replace('public', 'app/public', storage_path($path)))->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        if(!is_dir(storage_path('app/public/patronages_previews')))
            mkdir(storage_path('app/public/patronages_previews'));
        $img->save(str_replace('public', 'app/public', str_replace('patronages', 'patronages_previews', storage_path($path))));
    }

    public function createPatronage(Request $request){

        $this->validate($request, [
            'title'=>'required',
            'description'=>'required',
            // 'preview'=>'required',
            // 'download'=>'required',
            'price'=>'required',
            // 'categories'=>'required',
            // 'products'=>'required'
        ]);

        $p = new Patronage;
        $p->title = $request->title;
        $p->description = $request->description;
        $p->price = $request->price;
        if($request->has('preview')){
            $file =  $request->file('preview')->store('public/patronages');
            $this->createThumbnail($file);
            $p->preview = url(str_replace('public', 'storage', str_replace('patronages', 'patronages_previews', $file)));
        }else
            $p->preview = 'https://placehold.co/400x400?text=Comming+soon';
        if($request->has('download'))
            $p->download = url(str_replace('public', 'storage', $request->file('download')->store('public/patronages')));
        $p->images = $request->blocks;
        $p->customer_ids = json_encode($request->customer_ids);
        // $p->products = json_encode($request->products);
        $p->categories = json_encode($request->categories);
        $p->save();
        return redirect()->route('products');

    }

    public function savePatronage(Patronage $patronage, Request $request){
        $this->validate($request, [
            'title'=>'required',
            'description'=>'required',
            // 'preview'=>'required',
            // 'download'=>'required',
            'price'=>'required',
            // 'categories'=>'required',
            // 'products'=>'required'
        ]);

        $patronage->title = $request->title;
        $patronage->description = $request->description;
        $patronage->price = $request->price;
        $patronage->images = $request->blocks;
        if($request->has('preview'))
            $patronage->preview = url(str_replace('public', 'storage', $request->file('preview')->store('public/patronages')));
        if($request->has('download'))
            $patronage->download = url(str_replace('public', 'storage', $request->file('download')->store('public/patronages')));
        // $patronage->products = $request->products;
        $patronage->customer_ids = $request->customer_ids;
        $patronage->categories = $request->categories;
        $patronage->save();
        return redirect()->route('products');
    }

    public function deletePatronage(Patronage $patronage){
        $patronage->delete();
        return redirect()->back();
    }

    public function jsonPatronages(Request $request){
        if($request->has('page')){
            $p = $request->page;
        }else{
            $p = 0;
        }

        /////// à Revoir c'est la partie responsable au recherche de patronage
        if(!empty($request->keyword)){
            // $categories = Category::where('title', 'like', '%'.$request->keyword.'%')->pluck('id');
            // $str_cat = [];
            // foreach($categories as $cat){
            //     $str_cat[] = (string)$cat;
            // }
            // d($str_cat);
            // $patronages = Patronage::wherejsoncontains('categories', $str_cat)->get();
            $patronages = Patronage::where('title', 'like', '%'.$request->keyword.'%')->get();

            $total = count($patronages);
            // $patronages = Patronage::where('categories', 'like', '%'.$request->keyword.'%')->skip($p*10)->take(10)->get();
        }else{
            $total = Patronage::all()->count();
            $patronages = Patronage::orderBy('title', 'asc') // Tri par ordre alphabétique de la colonne 'title'
              ->skip($p * 10)
              ->take(10)
              ->get();
        }
        $patronages = $patronages->map(function($item){
            unset($item->images);
            // $item->categories = json_decode($item->categories);
            // $item->categories = Category::whereIn('id', $item->categories)->get();
            if(Discount::where('is_overall', true)->exists()){
                $global_discount = Discount::where('is_overall', true)->orderBy('discount', 'desc')->first();
                $discount = $global_discount->discount / 100;
                if($discount!==1){
                    $item->price*=(1-$discount);
                    $item->price = number_format($item->price, 2);
                }
            }else{
                if(auth()->user()->is_customer()){
                    $discount = auth()->user()->customer->discount();
                    if($discount!=1){
                        $item->price*=(1-$discount);
                        $item->price = number_format($item->price, 2);
                    }else{
                        if($item->discount()!=1){
                            $item->price*=(1-$item->discount());
                            $item->price = number_format($item->price, 2);
                        }
                    }
                }
            }
            return $item;
        });

        if(auth()->user()->is_customer()){
            $patronages = $patronages->filter(function($patronage){

                if(!empty($patronage->customer_ids)){
                    $patronage->customer_ids = json_decode($patronage->customer_ids, true);
                }else{
                    $patronage->customer_ids = [];
                }
                if(!is_array($patronage->customer_ids))
                    $patronage->customer_ids = json_decode($patronage->customer_ids, true);
                if(!is_array($patronage->customer_ids))
                    $patronage->customer_ids = [];
                if(count($patronage->customer_ids)>0){
                    if(in_array(auth()->user()->customer->id, $patronage->customer_ids)){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return true;
                }
            });
        }

        return response()->json([
            'total'=>$total,
            'patronages'=>$patronages
        ]);
    }
    public function jsonCategories(Request $request){
        $cats = explode(',', $request->ids);
        return response()->json(Category::whereIn('id', $cats)->get()->map(function($item){
            unset($item->images);
            return $item;
        }));
    }

    public function jsonPatronage(Request $request){
        $p = Patronage::findOrFail($request->id);
        return response()->json($p);
    }
    

}
