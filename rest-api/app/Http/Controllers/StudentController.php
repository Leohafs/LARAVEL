<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    # method index - get all resource
    public function index()
    {
        #menggunakan model Student untuk select data
        $students = Student::all();

        $data = [
            'message' => 'Get all students',
            'data' => $students,
        ];

        #menggunaka response json laravel
        #otomatis set header content type json
        #otomatis mengubah data array ke JSON
        #mengatur status code
        return response()->json($data, 200);
    }

    # menambahkan resource student
    # membuat mothode store
    public function store(Request $request)
    {
        # menangkap request
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];

        #menggunakan student untuk insert data
        $student = Student::create($input);

        $data = [
            'message' => 'student is created succesfully',
            'data' => $student,
        ];

        #mengembalikan data (json) status code 201
        return response()->json($data, 201);
    }

    # mengupdate resource student
    # membuat mothode update
    public function update(Request $request, $id)
    {
        # cari data student yang ingin diupdate
        $student = Student::find($id);

        # contoh 1
        //$student->nama = $request->input('nama');
        //$student->nim = $request->input('nim');
        //$student->email = $request->input('email');
        //$student->jurusan = $request->input('jurusan');
        //$student->save();

        #contoh 2
        # mendapatkan data request
        if ($student) {
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->Jurusan,
            ];

            # mengupdate data
            $student->update($input);

            $data = [
                'message' => 'Student Update Successfully',
                'data' => $student,
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found'
            ];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

    # menghapus resource student
    # membuat mothode destory
    public function destroy($id)
    {   # cari id student yang ingin dihapus
        $student = Student::find($id);

        if ($student) {
            # hapus student tersebut
            $student->delete();

            $data = [
                'message' => 'Student Deleted Successfully' //,
                //'data' => $student,
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found'
            ];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

    # mendapatkan detail resource student
    # membuat method show
    public function show($id)
    {
        # cari data student
        $student = Student::find($id);

        if ($student) {
            $data = [
                'message' => 'get detail student',
                'data' => $student,
            ];

            # mengembalikan data (json) status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found'
            ];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }
}
