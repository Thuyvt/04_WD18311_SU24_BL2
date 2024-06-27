<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{
    //
    public function index() {
        // echo 'Trang danh sách sản phẩm';
        // $listsp = DB::table('sanpham')->get();
        $listsp = DB::table('sanpham')->join('danhmuc', 'sanpham.iddm', '=', 'danhmuc.id')
        ->select('sanpham.*', 'danhmuc.name as name_dm')->get();

        echo '<pre>';
        print_r($listsp);
        $top3 = DB::table('sanpham')->orderBy('luotxem', 'DESC')->limit(3)->get();

        return view('sanpham.list', compact('listsp', 'top3'));
    }

    public function detail($id) {
        echo 'Chi tiết sản phẩm '.$id;
        $data = DB::table('sanpham')->where('id', '=', $id)->first();
        return view('sanpham.detail', compact('data'));
    }

    public function delete($idsp) {
        $data = DB::table('sanpham')->where('id', '=', $idsp)->delete();
        return redirect()->route('san-pham.index');
    }
}
