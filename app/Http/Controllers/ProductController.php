<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\ProductStoreDTO;
use App\DTO\ProductUpdateDTO;
use App\Exceptions\ForbiddenException;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

    public function __construct(private ProductService $productService)
    {
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        $dto = new ProductStoreDTO(
            $request->get('name'), $request->get('description'), $request->get('price'),
            $request->user()->id
        );

        return response()->json($this->productService->store($dto), Response::HTTP_CREATED);
    }

    public function update(Product $product, ProductUpdateRequest $request): JsonResponse
    {
        if (Gate::allows('update-product', $product)) {
            throw new ForbiddenException();
        }

        $dto = new ProductUpdateDTO($request->get('name'), $request->get('description'), $request->get('price'));

        return response()->json($this->productService->update($product, $dto), Response::HTTP_OK);
    }
}
