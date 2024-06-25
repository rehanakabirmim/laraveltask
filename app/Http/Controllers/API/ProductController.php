<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    
    public function index()
    {
        
        return response()->json(Product::all(), 200);
    }

    public function show($id)
    {
        $product = Product::with('brand', 'category', 'unit', 'tax', 'quantities')->find($id);
        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'sku' => 'required|string',
            'symbology' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
            'alert_qty' => 'required|integer',
            'tax_id' => 'required|exists:taxes,id',
            'is_active' => 'required|in:0,1',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create($request->all());

        if ($request->has('quantities')) {
            foreach ($request->quantities as $quantity) {
                $product->quantities()->create(['quantity' => $quantity]);
            }
        }

        if ($request->has('attachments')) {
            foreach ($request->attachments as $attachment) {
                $product->attachments()->create(['file_path' => $attachment]);
            }
        }

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string',
            'sku' => 'sometimes|required|string',
            'symbology' => 'sometimes|required|string',
            'brand_id' => 'sometimes|required|exists:brands,id',
            'category_id' => 'sometimes|required|exists:categories,id',
            'unit_id' => 'sometimes|required|exists:units,id',
            'price' => 'sometimes|required|numeric',
            'qty' => 'sometimes|required|integer',
            'alert_qty' => 'sometimes|required|integer',
            'tax_id' => 'sometimes|required|exists:taxes,id',
            'is_active' => 'sometimes|required|in:0,1',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product->update($request->all());

        if ($request->has('quantities')) {
            $product->quantities()->delete();
            foreach ($request->quantities as $quantity) {
                $product->quantities()->create(['quantity' => $quantity]);
            }
        }

        if ($request->has('attachments')) {
            $product->attachments()->delete();
            foreach ($request->attachments as $attachment) {
                $product->attachments()->create(['file_path' => $attachment]);
            }
        }

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
    
}
