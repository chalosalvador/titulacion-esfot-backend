<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollection;
use App\Imports\StudentImport;
use App\Models\Project;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',

    ];

    public function index()
    {
        return new StudentCollection(Student::paginate());
    }

    public function show()
    {
        $user = Auth::user();
        return response()->json(ProjectResource::collection($user->userable->projects), 200);
    }

    public function store(Request $request)
    {

        $password = Hash::make('123456');

        $student = Student::create([
            'apto' => "0",
            'unique_number' => $request ->unique_number,
            'career_id' => $request->career_id
        ]);
        $student->user()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'role' => User::ROLE_STUDENT
        ]);
        return response()->json(new StudentResource($student), 201);
    }

    public function update(Request $request, Student $student)
    {
        $this->authorize('update', $student);
        $student->update($request->all());
        return response()->json($student, 200);
    }

    public function projects(Student $student)
    {
        $this->authorize('view', $student);
        $projects = $student->projects;
        return response()->json(ProjectResource::collection($projects), 200);

    }

    public function project()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }

    public function delete(Student $student)
    {
        $student->delete();
        return response()->json(null, 204);
    }

    public function uploadImportFile(Request $request)
    {
        $fileName = 'estudiantes.xlsx';
        $request->file('file')->move(public_path('/files'), $fileName);

        try {
            Excel::import(new StudentImport(), 'files/estudiantes.xlsx');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $collectionFailures = collect();

            foreach ($failures as $failure) {
                $collectionFailures = $collectionFailures->push(
                    [
                        'row' => $failure->row(),
                        'attribute' => $failure->attribute(),
                        'errors' => $failure->errors(),
                        'values' => $failure->values()
                    ]);
            }

            $collectionFailures = $collectionFailures->groupBy('row');
            $collectionByRows = collect();

            foreach ($collectionFailures as $dataByRowsKey => $dataByRows) {
                $collectionByRow = collect();
                foreach ($dataByRows as $dataByRow) {
                    foreach ($dataByRow as $key => $data) {
                        (is_null($collectionByRow->get('' . $key))) ? $dataArray = collect() : $dataArray = $collectionByRow->get('' . $key);
                        $dataArray->push($data);
                        $dataArray = $dataArray->unique();
                        $collectionByRow->put('' . $key, $dataArray);
                    }
                }
                $collectionByRows->put('' . $dataByRowsKey, $collectionByRow);
            }
            return response()->json(['error' => 'import_excel_data', 'error_list' => $collectionByRows], 404);
        }
        return response()->json(['ok' => 'all_data_was_successfully_saved'], 200);
    }

}
