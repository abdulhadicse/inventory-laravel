<?php

namespace App\Http\Controllers\Pos;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Services\Invoice\InvoiceService;
use App\Services\Category\CategoryService;
use App\Services\Customer\CustomerService;

class InvoiceController extends Controller
{
    /**
     * The PurchaseService instance.
     */
    private InvoiceService $invoiceService;

    /**
     * Constructor for PurchaseController.
     *
     * @param  PurchaseService  $purchaseService  The PurchaseService instance.
     */
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * Display a listing of purchases.
     *
     * @return View View containing a list of purchases.
     */
    public function index()
    {
        $invoices = $this->invoiceService->list();
        return view('admin.modules.invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new purchase.
     *
     * @return View View containing the purchase creation form.
     */
    public function create()
    {
        $categories = (new CategoryService())->list();
        $customers  = (new CustomerService())->list();

        return view('admin.modules.invoice.create', compact('categories', 'customers'));
    }

    /**
     * Store a newly created purchase in storage.
     *
     * @return RedirectResponse Redirect to the purchase list page.
     */
    public function store(Request $request)
    {
        $this->invoiceService->store($request);

        toastr('Invoice added successfully.', 'success');

        return redirect()->route('invoice.list');
    }

    /**
     * Display a listing of pending purchases.
     *
     * @return View View containing the purchase creation form.
     */
    public function approvalInvoices()
    {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
        return view('admin.modules.invoice.approval', compact('allData'));
    }

    /**
     * Display a listing of pending purchases.
     *
     * @return View View containing the purchase creation form.
     */
    public function pendingInvoices()
    {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('admin.modules.invoice.pending', compact('allData'));
    }

    public function show(string $id)
    {
        $invoice = Invoice::with('invoiceDetails')->findOrFail($id);
        $payment = Payment::where('invoice_id', $invoice->id)->first();
        return view('admin.modules.invoice.edit', compact('invoice', 'payment'));
    }

    public function approvalStore(Request $request, $id)
    {
        foreach ($request->selling_qty as $key => $val) {
            $invoice_details = InvoiceDetail::where('id', $key)->first();
            $product = Product::where('id', $invoice_details->product_id)->first();
            if ($product->quantity < $request->selling_qty[$key]) {
                toastr('Sorry you approve Maximum Value', 'warning');
                return redirect()->back();
            }
        } // End foreach

        $invoice = Invoice::findOrFail($id);
        $invoice->status = '1';

        DB::transaction(function () use ($request, $invoice, $id) {
            foreach ($request->selling_qty as $key => $val) {
                $invoice_details = InvoiceDetail::where('id', $key)->first();

                $invoice_details->status = '1';
                $invoice_details->save();

                $product = Product::where('id', $invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
                $product->save();
            } // end foreach

            $invoice->save();
        });

        toastr('Invoice Approve Successfully', 'success');

        return redirect()->route('invoice.list');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetail::where('invoice_id', $invoice->id)->delete();

        toastr('Invoice deleted Successfully', 'success');
         return redirect()->back();
    }

    public function printInvoice(string $id)
    {
        $invoice = Invoice::with('invoiceDetails')->findOrFail($id);
        $payment = Payment::where('invoice_id', $invoice->id)->first();
        return view('admin.modules.invoice.print', compact('invoice', 'payment'));
    }
}
