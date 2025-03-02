<?php

namespace App\Http\Controllers;

use App\Models\StatusLogs;
use App\Models\WorkOrders;
use Illuminate\Http\Request;

class WorkOrderOperatorController extends Controller
{
    public function index(Request $request)
    {
        $data = WorkOrders::when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->tanggal, fn($q) => $q->whereDate('tenggat_waktu', $request->tanggal))
            ->where('operator_id', auth()->user()->id)
            ->paginate(5);
        return view('work-order-operator.index', compact('data'));
    }

    public function edit(WorkOrders $work_order)
    {
        $workOrder = WorkOrders::findOrFail($work_order->id);
        return view('work-order-operator.edit', compact('workOrder'));
    }
    public function update(Request $request, WorkOrders $work_order)
    {
        $request->validate([
            'status' => 'required|string',
            'quantity_selesai' => 'nullable|integer',
            'keterangan' => 'nullable|string',
        ]);

        $logs = StatusLogs::create([
            'work_order_id' => $work_order->id,
            'status_lama' => $work_order->status,
            'status_baru' => $request->status,
            'quantity_selesai' => $request->quantity_selesai,
            'keterangan' => $request->keterangan,
        ]);

        $work_order->update([
            'status' => $request->status,
        ]);

        return redirect()->to("work-operator/$work_order->id/edit")->with('success', 'Work Order berhasil diperbarui.');
    }

    public function report()
    {
        $data = WorkOrders::where('operator_id', auth()->user()->id)->get();
        return view('work-order-operator.report', compact('data'));
    }
}
