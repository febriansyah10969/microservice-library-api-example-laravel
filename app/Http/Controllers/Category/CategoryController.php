<?php

namespace App\Http\Controllers\Category;

use App\Http\Resources\ProfileResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories(Request $request)
    {
        $categories = Category::with(['children' => function($query) {
            $query->with('children');
        }])->whereNull('category_id')->get();
        return $this->successResponse(true, 'Berhasil menampilkan Kategori.', $categories, []);
    }
    
    public function getListCategories(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return $this->successResponse(true, 'Berhasil menampilkan Kategori.', $categories, []);
    }
}
