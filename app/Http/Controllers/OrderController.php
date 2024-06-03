<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\OrderDTO;
use App\Events\OrderDispatchedEvent;
use App\Http\Requests\OrderStoreRequest;
use App\Jobs\ProcessOrderJob;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    public const ORDER_QUEUED = 'The order has been sent to the queue.';

    public function store(OrderStoreRequest $request): JsonResponse
    {
        $dto = new OrderDTO($request->validated('products'), $request->user()->id);

        ProcessOrderJob::dispatch($dto)->onQueue(config('queue.orders'));
        OrderDispatchedEvent::dispatch($dto, $request->user());

        return response()->json(['message' => self::ORDER_QUEUED], Response::HTTP_OK);
    }

    public function show(Order $order): JsonResponse
    {
        if ( ! $order) {
            throw new NotFoundHttpException();
        }

        return response()->json($order, Response::HTTP_OK);
    }
}
