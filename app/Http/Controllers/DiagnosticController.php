<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Storage;
use App\Models\DiagnosticTest;
use App\Models\TestHospital;
use Illuminate\Cache\RedisTagSet;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    //
    public function viewDiagnosticTest()
    {
        $diagnosticTests = DiagnosticTest::all();

        return view('diagnostic', compact('diagnosticTests'));
    }

    public function viewDiagnosticDetails($id)
    {
        $diagnosticTest = DiagnosticTest::with('Hospital')->find($id);

        // return response()->json($diagnosticTest);
        return view('diagnostic-details', compact('diagnosticTest'));
    }

    public function addDiagnosticStore(Request $request)
    {
        $diagnosticTest = DiagnosticTest::create(['test_name' => $request->testname]);
        if (is_array($request->hospitals)) {
            foreach ($request->hospitals as $index => $hospital) {
                $imagePath = null;

                // Check if an image is uploaded for this hospital
                if ($request->hasFile("hospitals.$index.image")) {
                    $imagePath = $request->file("hospitals.$index.image")->store('hospital_images', 'public');
                }

                TestHospital::create([
                    'hospital_name' => $hospital['name'],
                    'test_price' => $hospital['price'],
                    'hospital_image' => $imagePath,
                    'test_id' => $diagnosticTest->id,
                ]);
            }
        }

        return redirect()->route('diagnostic.viewtest')->with('success', 'Diagnostic test and hospitals added successfully');
    }

    public function viewUpdate($id)
    {
        $update = DiagnosticTest::with('Hospital')->find($id);

        // return response()->json($update);
        return view('add-diagnostic', compact('update'));
    }

    public function update(Request $request, $id)
    {
        // return $request->input();
        $diagnosticTest = DiagnosticTest::findOrFail($id);
        $diagnosticTest->update(['test_name' => $request->testname]);

        $existingHospitals = TestHospital::where('test_id', $diagnosticTest->id)->pluck('id')->toArray();

        $receivedHospitalIds = [];

        if (is_array($request->hospitals)) {
            foreach ($request->hospitals as $index => $hospitalData) {
                $hospital = TestHospital::where('test_id', $diagnosticTest->id)
                    ->where('id', $hospitalData['id'] ?? null)
                    ->first();

                if ($hospital) {
                    $hospital->update([
                        'hospital_name' => $hospitalData['name'],
                        'test_price' => $hospitalData['price'],
                    ]);
                    $receivedHospitalIds[] = $hospital->id;
                } else {
                    $hospital = TestHospital::create([
                        'test_id' => $diagnosticTest->id,
                        'hospital_name' => $hospitalData['name'],
                        'test_price' => $hospitalData['price'],
                    ]);
                    $receivedHospitalIds[] = $hospital->id;
                }

                if (isset($hospitalData['image']) && $request->hasFile("hospitals.$index.image")) {
                    $imagePath = $request->file("hospitals.$index.image")->store('hospital_images', 'public');
                    $hospital->update(['hospital_image' => $imagePath]);
                }
            }
        }

        $hospitalsToDelete = array_diff($existingHospitals, $receivedHospitalIds);
        TestHospital::whereIn('id', $hospitalsToDelete)->delete();

        return redirect()->route('diagnostic.details', ['id' => $id])->with('success', 'Diagnostic test and hospitals updated successfully');
    }

    public function actions(Request $request)
    {

        $diagnosticTest = DiagnosticTest::findOrFail($request->id);
        $diagnosticTest->status = $request->status;
        $diagnosticTest->save();

        return response()->json(['message' => 'Status updated successfully', 'new_status' => $diagnosticTest->status]);
    }
}
