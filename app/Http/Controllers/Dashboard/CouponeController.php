<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Coupone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponeController extends Controller
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
        $data = Coupone::latest()->paginate(15);
        return view('Dashboard.coupones.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.coupones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'code' => "required|unique:coupones,code",
                'type' => "required|in:fixed,percent",
                'value' => 'required|numeric',
                'cart_value' => 'required|numeric',
                'expiry_date' => "required|date",
            ]);
            $data = $validator->validated();
            $data['expiry_date'] = date('Y-m-d', strtotime($request->expiry_date));
            Coupone::create($data);
            return redirect()->route('admin.coupones.index')->with('success', 'Coupone Add Successfuly');
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupone::findOrFail($id);
        return view('Dashboard.coupones.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $coupone = Coupone::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'code' => "required|unique:coupones,code," . $id,
                'type' => "required|in:fixed,percent",
                'value' => 'required|numeric',
                'cart_value' => 'required|numeric',
                'expiry_date' => "required|date",
            ]);
            $data = $validator->validated();
            $data['expiry_date'] = date('Y-m-d', strtotime($request->expiry_date));
            $coupone->update($data);
            return redirect()->route('admin.coupones.index')->with('success', 'Coupone Update Successfuly');
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupone::findOrFail($id);
        $coupon->delete();
        return redirect()->route('admin.coupones.index')->with('success', 'Coupone Deleted Successfuly');
    }
}
