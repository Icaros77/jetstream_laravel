<?php

namespace App\Http\ApiControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiVendorStoreRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VendorController extends Controller
{

    public function show(Request $req, $id)
    {
        try {
            $vendor = Vendor::with("products")->findOrFail($id);
            return  new VendorResource($vendor);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "error" => "Vendor hasn't been found"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "error" => "An error has occurred"
            ]);
        }
    }

    public function store(ApiVendorStoreRequest $req)
    {
        $data = $req->validated();
        Vendor::create($data);
        return response()->json([
            "data" => ["message" => "Vendor added!"]
        ]);
    }

    public function update(Request $req, $id)
    {
        try {
            $has_updated = Vendor::where("id", $id)->update($req->all());

            throw_unless($has_updated, ModelNotFoundException::class);

            return response()->json([
                "data" => [
                    "message" => "Updated with success!"
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "error" => "Vendor hasn't been found"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "error" => "An error has occurred"
            ]);
        }
    }
}
