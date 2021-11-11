<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$request->session()->flush();
        $products = [];
        $arrayIds = [];
        
        if($request->session()->exists('products')) {
            $products = $request->session()->get('products');
        }
        
        if($request->session()->exists('arrayIds')) {
            $arrayIds = $request->session()->get('arrayIds');
        }
        
        $appName = 'Product App';
        $data = [];
        
        if($request->session()->exists('message')) {
            $message = $request->session()->get('message');
            $data['message'] = $message;
            $type = 'success';
            if($request->session()->exists('type')) {
                 $type = $request->session()->get('type');
            }
            $data['type'] = $type;
        }
        $data['products'] = $products;
        if(!empty($arrayIds)) {
            $data['arrayIds'] = $arrayIds;
        }
        $data['appname'] = $appName;
        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $appName = 'Product App';
        $data = [];
        $data['appname'] = $appName;
        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request->session()->exists('arrayIds')) {
            $arrayIds = $request->session()->get('arrayIds');
        } else {
            $arrayIds = [];
        }
        
        if(count($arrayIds) == 0) {
            $arrayIds = [1];
        } else {
            $lastId = end($arrayIds);
            array_push($arrayIds, $lastId + 1);
        }
        $id = end($arrayIds);
        
        $name = $request->input('name');
        $price = $request->input('price');
        
        if($request->session()->exists('products')) {
            $products = $request->session()->get('products');
        } else {
            $products = [];
        }
        $product = ['id' => $id, 'name' => $name, 'price' => $price];
        if(isset($products[$id])) {
            return back()->withInput();
        } else {
            $products[$id] = $product;   
        }
        $request->session()->put('products', $products);
        $request->session()->put('arrayIds', $arrayIds);
        return redirect('producto')->with('message', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if($request->session()->exists('products') && isset($request->session()->get('products')[$id])) {
            $product = $request->session()->get('products')[$id];
            $data = [];
            $data['product'] = $product;
            $data['appname'] = 'Product App';
            return view('products.show', $data);
        }
        return redirect('resource');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($request->session()->exists('products') && isset($request->session()->get('products')[$id])) {
            $product = $request->session()->get('products')[$id];
            $data = [];
            $data['product'] = $product;
            $data['appname'] = 'Product App';
            return view('products.edit', $data);
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->session()->exists('products')) {
            $products = $request->session()->get('products');
            if(isset($products[$id])) {
                $product = $products[$id];
                $idInput = $request->input('id');
                $nameInput = $request->input('name');
                $priceInput = $request->input('price');
                $product['id'] = $idInput;
                $product['name'] = $nameInput;
                $product['price'] = $priceInput;
                if(isset($products[$idInput]) && $id != $idInput) {
                    return back()->withInput();
                }
                unset($products[$id]);
                $products[$idInput] = $product;
                $request->session()->put('products', $products);
                return redirect('producto')->with('message', 'Product edited successfully!');
           } 
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $message = "We couldn't delete the product...";
        $type = 'danger';
        if($request->session()->exists('products')) {
            $products = $request->session()->get('products');
            if(isset($products[$id])) {
                unset($products[$id]);
                $request->session()->put('products', $products);
                $message = 'Product deleted successfully!';
                $type = 'success';
            }
        }
        $data = [];
        $data['message'] = $message;
        $data['type'] = $type;
        return redirect('producto')->with($data);
    }
    
    function flush(Request $request) {
        $request->session()->flush();
        return redirect('producto')->with('message', 'All products removed!');
    }
    
}
