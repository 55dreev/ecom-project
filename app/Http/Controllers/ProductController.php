<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costume;
use App\Models\Order; // assuming you have an Order model set up
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
{
    $costumes = Costume::all();
    $orders = Order::all(); // Adjust query if needed
    return view('adminproducts', compact('costumes', 'orders'));
}

    // Store a new costume
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'image'       => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        // Handle image upload
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = 'images/' . $imageName;
        $image->move(public_path('images'), $imageName);

        // Save costume to database
        $costume = new Costume();
        $costume->name = $request->name;
        $costume->price = $request->price;
        $costume->image = $imagePath;
        $costume->description = $request->description;
        $costume->save();

        return response()->json(['message' => 'Costume saved successfully!'], 201);
    }

    // Update an existing costume (editing)
    public function update(Request $request, $id)
    {
        $costume = Costume::find($id);
        if (!$costume) {
            return response()->json(['success' => false, 'message' => 'Costume not found!'], 404);
        }

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $costume->name = $request->name;
        $costume->price = $request->price;
        $costume->description = $request->description;

        // Check if a new image has been uploaded
        if ($request->hasFile('image')) {
            // Remove the old image from storage
            $oldImagePath = public_path($costume->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            // Save the new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'images/' . $imageName;
            $image->move(public_path('images'), $imageName);
            $costume->image = $imagePath;
        }

        $costume->save();
        return response()->json(['success' => true, 'message' => 'Costume updated successfully!']);
    }

    // Delete a costume by id
    public function deleteById($id)
    {
        $costume = Costume::find($id);
        if (!$costume) {
            return response()->json(['success' => false, 'message' => 'Costume not found!'], 404);
        }

        // Remove the image file from storage
        $imagePath = public_path($costume->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $costume->delete();
        return response()->json(['success' => true, 'message' => 'Costume deleted successfully!']);
    }

    // --- Order management methods ---

    // List all orders
    public function listOrders()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    // Update an order. For example, you might update the order status.
    public function updateOrder(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found!'], 404);
        }

        // For demonstration, we'll assume that updating an order means changing its status.
        // You can adjust the validation and logic as needed.
        $request->validate([
            'status' => 'required|string|max:100'
        ]);

        $order->status = $request->status;
        $order->save();
        return response('', 204);
    }

    // Delete an order by its ID
    public function deleteOrder($orderId)
{
    $order = Order::find($orderId);

    if (!$order) {
        return response()->json(['success' => false, 'message' => 'Order not found!'], 404);
    }

    $order->delete();

    // Return 204 (No Content) instead of a JSON message
    return response('', 204);
}

}
