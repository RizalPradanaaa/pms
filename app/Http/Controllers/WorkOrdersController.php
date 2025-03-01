<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkOrdersController extends Controller
{
    public function index(Request $request)
    {
        $data = WorkOrders::when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->tanggal, fn($q) => $q->whereDate('tenggat_waktu', $request->tanggal))
            ->paginate(5);
        return view('work-orders.index', compact('data'));
    }
    public function create()
    {
        $operator = User::where('role', 'operator')->get();
        return view('work-orders.create', compact('operator'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nomor_wo' => 'required|unique:work_orders,nomor_wo',
            'nama_produk' => 'required|string|min:3|max:255',
            'jumlah' => 'required|integer|min:1',
            'tenggat_waktu' => 'required|date',
            'status' => 'required|string',
            'operator_id' => 'required|exists:users,id',
        ]);
        WorkOrders::create([
            'nomor_wo' => $request->nomor_wo,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'tenggat_waktu' => $request->tenggat_waktu,
            'status' => $request->status,
            'operator_id' => $request->operator_id,
        ]);

        return redirect()->route('work-orders.index')->with('success', 'Work Order berhasil ditambahkan.');
    }
    public function edit(WorkOrders $work_order)
    {
        $workOrder = WorkOrders::findOrFail($work_order->id);
        $operator = User::where('role', 'operator')->get();
        return view('work-orders.edit', compact('workOrder', 'operator'));
    }
    public function update(Request $request, WorkOrders $work_order)
    {
        $request->validate([
            'nomor_wo' => 'required|unique:work_orders,nomor_wo,' . $work_order->id,
            'nama_produk' => 'required|string|min:3|max:255',
            'jumlah' => 'required|integer|min:1',
            'tenggat_waktu' => 'required|date',
            'status' => 'required|string',
            'operator_id' => 'required|exists:users,id',
        ]);
        $work_order->update([
            'nomor_wo' => $request->nomor_wo,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'tenggat_waktu' => $request->tenggat_waktu,
            'status' => $request->status,
            'operator_id' => $request->operator_id,
        ]);

        return redirect()->route('work-orders.index')->with('success', 'Work Order berhasil diperbarui.');
    }
    public function destroy(WorkOrders $work_order)
    {
        $work_order->delete();
        return redirect()->route('work-orders.index')->with('success', 'Work Order berhasil dihapus.');
    }

    public function report()
    {
        $data = WorkOrders::select('nama_produk', 'status', DB::raw('SUM(jumlah) as total_quantity'))
            ->groupBy('nama_produk', 'status')
            ->get()
            ->groupBy('nama_produk');

        return view('work-orders.report', compact('data'));
    }
}
