<?php

namespace App\Http\Controllers;

use App\Models\Universities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Collection\Collection;

class UniversityController extends Controller
{
    /**
     * Display a listing of universities.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $universities = Universities::all()->take(20)->toArray();


        $this->removeSpecificData($universities);

        return response()->json(["success" => true, "data" => ["universities" => $universities]]);

    }


    /**
     * `Removes specific information from the university data`
     *
     * @param mixed $universities
     * @param array $fieldsToRemove
     * @return mixed
     */
    public function removeSpecificData(&$universities, ...$fieldsToRemove)
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



    /**
     * Get university details by name or abbreviation.
     *
     * @param string $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUniversityDetailsByName($name)
    {

        if($name == "state"){
            return $this->getStateUniversityDetailsInState("state");
        }
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
            ->orwhere("abbreviation", 'like', '%' . $name )
            ->get()->take(20);


        $this->removeSpecificData($universities);


        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }





      /**
     * Display a listing of  state  universities in a state .
     *
     * @param string $state
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStateUniversityDetailsInState($state)
    {
        $state = trim(strtolower($state));
        $validator = Validator::make(['state' => $state], [
            'state' => 'min:1|regex:/^[a-z ]+$/'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                "error" => [
                    "code" => 403,
                    "message" => $validator->errors()->first('state')
                ]
            ]);
        }
        $universities = Universities
            ::where("university_type", 'like', '%' . "state" )
            ->orwhere("state", 'like', '%' . $state . '%')
            ->orwhere("abbreviation", $state)
          
            ->get()
            ->take(20);


        $this->removeSpecificData($universities);
        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }








    /**
     * Get universities in a city 
     *
     * @param string $city
     * @return \Illuminate\Http\JsonResponse
     */
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

        $universities = Universities
            ::where("city", 'like', '%' . $city . '%')
            ->get()
            ->take(20);
        $this->removeSpecificData($universities);
        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }



    /**
     * Get universities in a state 
     *
     * @param string $state
     * @return \Illuminate\Http\JsonResponse
     */
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

        $universities = Universities
            ::where("state", 'like', '%' . $state . '%')
            ->pluck("name")
            ->take(20);


        // $this->removeSpecificData($universities);
        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }



    /**
     * Display a listing of all private universities.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function getAllPrivateUniversities()
    {
        $universities = Universities
            ::where("university_type", "private")
            ->pluck("name")
            ->take(20);

        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }

    /**
     * Display a list of all private universities in a state
     * @param string $state
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Display a listing of universities.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function getAllFederalUniversities()
    {
        $universities = Universities
            ::where("university_type", "federal")
            ->pluck("name")->take(20);

        return response()->json(["success" => true, "data" => ["universities" => $universities]]);

    }


    /**
     * Display a listing of  federal universities in a state .
     *
     * @param string $state
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFederalUniversitiesInState($state)
    {
        $state = trim(strtolower($state));
        $validator = Validator::make(['state' => $state], [
            'state' => 'min:1|regex:/^[a-z ]+$/'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                "error" => [
                    "code" => 403,
                    "message" => $validator->errors()->first('state')
                ]
            ]);
        }
        $universities = Universities
            ::where("university_type", 'like', '%' . "federal" . '%')
            ->where("state", 'like', '%' . $state . '%')
            ->get()->take(20);


        $this->removeSpecificData($universities);
        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }


    public function getAllStateUniversities()
    {
        $universities = Universities::where("university_type", "state")->pluck('name')->take(20);
        return response()->json(["success" => true, "data" => ["universities" => $universities]]);

    }


      /**
     * Display a listing of  state  universities in a state .
     *
     * @param string $state
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStateUniversitiesInState($state)
    {
        $state = trim(strtolower($state));
        $validator = Validator::make(['state' => $state], [
            'state' => 'min:1|regex:/^[a-z ]+$/'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                "error" => [
                    "code" => 403,
                    "message" => $validator->errors()->first('state')
                ]
            ]);
        }
        $universities = Universities
            ::where("university_type", 'like', '%' . "state" . '%')
            ->where("state", 'like', '%' . $state . '%')
            ->pluck('name')
            ->take(20);


        // $this->removeSpecificData($universities);
        return response()->json(["success" => true, "data" => ["universities" => $universities]]);
    }



}