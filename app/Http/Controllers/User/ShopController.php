<?php

namespace App\Http\Controllers\User;

 
 use Inertia\Inertia;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dompdf\Dompdf;
 use Barryvdh\DomPDF\Facade\Pdf; // ✅ import


class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        return Inertia::render('Shop/Shop',[
            'shops' => Shop::all()
        ]);

    //      return Inertia::render('Dashboard', [
    //     'shops' => Shop::latest()->get(),
    // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Shop/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:shops,email',
            'address' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('shops', 'public');
        }

        Shop::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'address'=>$data['address'],
            'image'=>$data['image'] ?? null,
    
        ]);

        // return redirect()->route('shops.index') 
        return redirect()->route('shops.index') 
            ->with('success', 'Shop added successfully!');
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
        $shop = Shop::findOrFail($id);
        return Inertia::render('Shop/edit', [
            'shop' => $shop
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shop = Shop::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:shops,email,'.$id,
            'address' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('shops', 'public');
        }

        $shop->update($data);
 
        // return redirect()->route('shops.index') 
        return redirect()->route('shops.index') 
            ->with('success', 'Shop updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return redirect()->route('shops.index')
            ->with('success', 'Shop deleted successfully!');
    }


    //  public function generatePdf(Request $request)
    // {
    //       $data = [
    //         'title' => 'Sample PDF Document',
    //         'date' => date('d-m-Y'),
    //         'items' => [
    //             ['name' => 'Item 1', 'price' => 100],
    //             ['name' => 'Item 2', 'price' => 200],
    //             ['name' => 'Item 3', 'price' => 300],
    //         ]
    //     ];

    //     // Load Blade View
    //     $pdf = Pdf::loadView('pdf.pdf_template', $data);

    //     // Download PDF
    //     return $pdf->download('invoice.pdf');
    
    // }
}