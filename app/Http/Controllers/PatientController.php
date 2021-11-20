<?php

namespace App\Http\Controllers;

use App\Models\Patien;
use Illuminate\Http\Request;


class PatientController extends Controller
{
    public function index() {
        $patients = Patien::all();

        $data = [
            'message' => 'Get All Patient',
            'data' => $patients
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request) {
        $patients = Patien::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'in_date_at' => $request->in_date_at,
            'out_date_at' => $request->out_date_at
        ]);

        $data = [
            'message' => 'Student is created succesfully',
            'data' => $patients,
        ];

        // mengembalikan data (json) dan kode 201
        return response()->json($data, 201);
    
    }

    public function update(Request $request, $id) {

        $patients = Patien::find($id);

        if ($patients) {
            $patients->update([
                'name' => $request->name ?? $patients->name, 
                'phone' => $request->phone ?? $patients->phone, 
                'address' => $request->address ?? $patients->address, 
                'status' => $request->status ?? $patients->status, 
                'in_date_at' => $request->in_date_at ?? $patients->in_date_at, 
                'out_date_at' => $request->out_date_at ?? $patients->out_date_at, 
            ]);

            $data = [
                'message' => 'berhasil',
                'data' => $patients,
            ];

            return response()->json($data, 201);

        }

        else {
            $data = [
                'message' => 'gagal'
            ];

            return response()->json($data, 404);

        }
        
    }

    public function destroy($id) {
        $patients = Patien::find($id);

        if ($patients) {
            $patients->delete();

            $data = [
                'message' => 'berhasil menghapus',
                'data' => $patients
            ];

            return response()->json($data, 200);
        }

        else {
            $data = [
                'massage' => 'gagal menghapus'
            ];

            return response()->json($data, 404);
        }
    }
    
    public function search($name) {
        $patients = Patien::where('name',$name)->get();

        if ($patients) {

            $data = [
                'message' => 'data ditemukan',
                'data' => $patients
            ];

            return response()->json($data, 200);
        }

        else {
            $data = [
                'massage' => 'nama tidak ditemukan'
            ];

            return response()->json($data, 404);
        }

    }

    public function positive() {
        $patients = Patien::where('status','positive')->get();
        
        $data = [
            'data' => $patients
        ];


        if ($patients) {


            $data = [
                'message' => 'data ditemukan',
                'data' => $patients
            ];

            return response()->json($data, 200);
        }

        else {
            $data = [
                'massage' => 'data tidak ditemukan'
            ];

            return response()->json($data, 404);
        }


    }

    public function recovered() {
        $patients = Patien::where('status','sembuh')->get();
        
        $data = [
            'data' => $patients
        ];


        if ($patients) {


            $data = [
                'message' => 'data ditemukan',
                'data' => $patients
            ];

            return response()->json($data, 200);
        }

        else {
            $data = [
                'massage' => 'data tidak ditemukan'
            ];

            return response()->json($data, 404);
        }
    }

    public function dead() {
        $patients = Patien::where('status','meninggal')->get();
        
        $data = [
            'data' => $patients
        ];


        if ($patients) {


            $data = [
                'message' => 'data ditemukan',
                'data' => $patients
            ];

            return response()->json($data, 200);
        }

        else {
            $data = [
                'massage' => 'data tidak ditemukan'
            ];

            return response()->json($data, 404);
        }
    }
}
