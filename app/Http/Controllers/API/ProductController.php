<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateProductRequest;
use App\Models\Product;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        if (!$request->api_token)
            return $this->sendError('required must have api_token', 403);
        $user = User::where('api_token', $request->api_token)->first();
        if (!$user)
            return $this->sendError('No user have this token', 403);
        try {
            $product = Product::create([
                'name' => [
                    'ar' => $request->name_ar,
                    'en' => $request->name_en,
                ],
            ]);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
        return $this->sendResponse(['product_id' => $product->id], 'data saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if (!$request->api_token)
            return $this->sendError('required must have api_token', 401);
        $user = User::where('api_token', $request->api_token)->first();
        if (!$user)
            return $this->sendError('No user have this token', 401);
        try {
            $product = Product::findOrFail($id);
            $name = $product->name;
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(['name' => $name], 'data retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
