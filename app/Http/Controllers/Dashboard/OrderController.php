<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'auto_check_premission']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::latest()->paginate(10);
        return view('Dashboard.Orders.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        $setting = Setting::first();
        return view('Dashboard.Orders.show', compact('order', 'setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate(['status' => "required|in:0,1,2,3"]);
            Order::findOrFail($id)->update($request->only('status'));
            return redirect()->back()->with('success', 'Success Update Status Of Order');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Order::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Success Delete Order');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}