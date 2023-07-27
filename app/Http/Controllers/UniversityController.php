<?php

namespace App\Http\Controllers;

use App\Models\Universities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Collection\Collection;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universities = Universities::all()->take(20)->toArray();


        $this->removeSpecificData($universities);

        return response()->json(["success" => true, "data" => ["universities" => $universities]]);

    }


    /**
     * `Removes specific information from the end result `
     * @param mixed $universities
     * @param array $fieldsToRemove
     * @return mixed
     */
    private function removeSpecificData(&$universities, ...$fieldsToRemove)
    {
        if (empty($universities)) {
            return;
        }

        if (empty($fieldsToRemove)) {
            $fieldsToRemove = ['id', 'created_at', 'updated_at'];
        }
        foreach ($universities as &$university) {
            foreach ($fieldsToRemove as $field) {
                unset($university[$field]);
            }


        }
        return $universities;
    }


    public function getUniversityByName($name)
    {
        $name = trim(strtolower($name));
        $validator = Validator::make(['name' => $name], [
            'name' => 'min:1|regex:/^[a-z ]+$/'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "error" => [
                    "code" => 403,
                    "message" => $validator->errors()->first('name')
                ]
            ]);
        }

        $universities = Universities
            ::where("name", 'like', '%' . $name . '%')
            ->orwhere("abbreviation", 'like', '%' . $name . '%')
            ->get();


        $this->removeSpecificData($universities);


        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }

    public function getUniversitiesInCity($city)
    {
        $validator = Validator::make(['city' => $city], [
            'city' => 'min:1|regex:/^[a-z ]+$/'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "error" => [
                    "code" => 403,
                    "message" => $validator->errors()->first('city')
                ]
            ]);
        }

        $universities = Universities::where("city", 'like', '%' . $city . '%')->get();



        $this->removeSpecificData($universities);

        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }



    public function getUniversitiesInState($state)
    {
        $validator = Validator::make(['state' => $state], [
            'state' => 'min:1|regex:/^[a-z ]+$/'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "error" => [
                    "code" => 403,
                    "message" => $validator->errors()->first('state')
                ]
            ]);
        }


        $universities = Universities::where("state", 'like', '%' . $state . '%')->get();


        $this->removeSpecificData($universities);
        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }




    public function getAllPrivateUniversities()
    {


        $universities = Universities::where("university_type", "private")->get()->take(20);


        $this->removeSpecificData($universities);
        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }


    public function getPrivateUniversitiesInState($state)
    {
        $state = trim(strtolower($state));
        $validator = Validator::make(['state' => $state], [
            'state' => 'min:1|regex:/^[a-z ]+$/'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "error" => [
                    "code" => 403,
                    "message" => $validator->errors()->first('state')
                ]
            ]);
        }


        $universities = Universities
            ::where("university_type", 'like', '%' . "private" . '%')
            ->where("state", 'like', '%' . $state . '%')
            ->get()->take(20);


        $this->removeSpecificData($universities);
        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }

}