<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = QueryBuilder::for(Student::class)
            ->allowedFilters('name', 'courses')
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at'])
            ->paginate();

        return new StudentCollection($students);
    }

    /**
     * Store a newly created resource in storage.
     * @param StudentStoreRequest $request
     * @param StudentResource
     */
    public function store(StudentStoreRequest $request)
    {
        $students = Student::create($request->validated());
        return new StudentResource($students);
    }

    /**
     * Display the specified resource.
     * @param Student $student
     * @return StudentResource
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     * @param Student $student
     * @param StudentUpdateRequest $request
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        $student->update($request->validated());
        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     * @param Student $student
     * @return Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->noContent();
    }
}
