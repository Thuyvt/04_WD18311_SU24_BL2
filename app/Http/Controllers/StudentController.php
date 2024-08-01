<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $students = Student::all();
            // C1
            //return StudentResource::collection($students);

            $arr = [
                'status' => true,
                'message' => 'Lấy danh sách thành công',
                'data' => StudentResource::collection($students)
            ];
            return response()->json($arr, 200);

        } catch (\Exception $exception) {
            $arr = [
                'status' => false,
                'message' => 'Có lỗi xảy ra',
                'description' => $exception->getMessage(),
                'data' => []
            ];
            return response()->json($arr, $exception->getCode());
        }

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
//        dd($request);
        try {
            // Validate dữ liệu truyền vào
            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|max:50',
                'email' => ['required', 'email']
            ]);
            if ($validator->fails()) {
                $res = [
                    'status' => false,
                    'message' => 'Lỗi kiểm tra liệu',
                    'data' => $validator ->errors()
                ];
                return response()->json($res, 200);
            }
            $student = Student::query()->create($request->all());
            $res = [
                'status' => true,
                'message' => 'Tạo mới thành công',
                'data' => $student
            ];
            return response()->json($res, 201);

        } catch (\Exception $exception) {

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $student = Student::query()->where('id', $id)->first();
//            dd($student);
            if (!$student) {
                $res = [
                    'status' => false,
                    'message' => 'Không tìm thấy sinh viên'
                ];
                return response()->json($res, 404);
            }

            // nếu tìm thấy $student
            $res = [
                'status' => true,
                'message' => 'Chi tiết sinh viên',
                'data' => $student
//                'data' => new StudentResource($student)
            ];
            return response()->json($res, 200);
        } catch (\Exception $exception) {

        }
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
//        dd($request->all());
        try {
            $student = Student::query()->where('id', $id)->first();
            if(!$student) {
                $res = [
                    'status' => false,
                    'message' => 'Không tồn tại sinh vieen này'
                ];
                return response()->json($res, 404);
            }

            // validate dữ liệu đầu vào
            // Validate dữ liệu truyền vào
            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|max:50',
                'email' => ['required', 'email']
            ]);
            if ($validator->fails()) {
                $res = [
                    'status' => false,
                    'message' => 'Lỗi kiểm tra liệu',
                    'data' => $validator ->errors()
                ];
                return response()->json($res, 200);
            }
            // cập nhật thông tin
            $student->update($request->all());

            $res = [
                'status' => true,
                'message' => 'Cập nhật thành công',
                'data' => $student
            ];
            return response()->json($res, 200);

        } catch (\Exception $exception) {

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $student = Student::query()->where('id', $id)->first();

            if (!$student) {
                $res = [
                    'status' => false,
                    'message' => 'Không tồn tại sinh viên này'
                ];
                return response()->json($res, 404);
            }
            // thực hiện xóa
            $student->delete();

            $res = [
                'status' => true,
                'message' => 'Xóa thành công',
            ];
            return response()->json($res, 200);

        } catch (\Exception $exception) {

        }
    }
}
