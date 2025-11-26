<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::latest()->paginate(10);
        return response()->json($student, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->all();

    $validator = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email', // FIXED
        'address' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()], 422);
    }

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = Str::random(40).'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('student', $filename, 'public');
        $data['image'] = $path;
    }

    $student = Student::create($data);

    return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        if (!$student) {

            return response()->json(['message'=>'Student not found'], 404);
        }
        return response()->json($student, 200);
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    $student = Student::find($id);

    if (!$student) {
        return response()->json(['message' => 'Student not found'], 404);
    }

    $data = $request->all();

    $validator = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            // Rule::unique('students', 'email')->ignore($student->id),
        ],
        'address' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    if ($request->hasFile('image')) {
        // remove previous
        if ($student->image && Storage::disk('public')->exists($student->image)) {
            Storage::disk('public')->delete($student->image);
        }

        $file = $request->file('image');
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('students', $filename, 'public');
        $data['image'] = $path;
    }

    $student->update($data);

    return response()->json($student);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $student = Student::find($id);

    if (!$student) {
        return response()->json(['message' => 'Student not found'], 404);
    }

    // remove image if exists
    if ($student->image && Storage::disk('public')->exists($student->image)) {
        Storage::disk('public')->delete($student->image);
    }

    $student->delete();

    return response()->json(['message' => 'Deleted'], 200);
    }
}
