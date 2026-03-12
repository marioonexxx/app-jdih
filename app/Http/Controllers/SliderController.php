<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('user-admin.slider.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Maks 5MB
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = 'slider_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/sliders', $fileName);
                $data['image'] = $fileName;
            }

            Slider::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Slider berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($slider->image) {
                Storage::delete('public/sliders/' . $slider->image);
            }
            $file = $request->file('image');
            $fileName = 'slider_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/sliders', $fileName);
            $slider->image = $fileName;
        }

        $slider->update($request->except('image'));
        return redirect()->back()->with('success', 'Slider diperbarui!');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if ($slider->image) {
            Storage::delete('public/sliders/' . $slider->image);
        }
        $slider->delete();
        return redirect()->back()->with('success', 'Slider dihapus!');
    }
}
