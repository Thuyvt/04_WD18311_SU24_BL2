<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    const PATH_VIEW = 'books.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Book::query()->with(['author'])->latest('id')->get();
//        dd($data->author->name);
        return view(self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::query()->pluck('name','id')->all();
//        dd($authors);
        return view(self::PATH_VIEW.__FUNCTION__, compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->except('image');
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put('books', $request->file('image'));
        }
//        dd($data);
        Book::query()->create($data);
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view(self::PATH_VIEW.__FUNCTION__, compact('book'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::query()->pluck('name','id')->all();
        return view(self::PATH_VIEW.__FUNCTION__,
            compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
//        dd($request->all())
        $data = $request->except('image');
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put('books', $request->file('image'));
            // xóa ảnh cũ trong storage
            if (!empty($book->image) && Storage::exists($book->image)) {
                Storage::delete($book->image);
            }
        } else {
            // nếu ko upload ảnh mới dữ lại ảnh cũ
            $data['image'] = $book->image;
        }
//        dd($data);
        $book->update($data);
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return back();

    }
}
