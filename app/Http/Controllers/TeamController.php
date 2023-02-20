<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;



class TeamController extends Controller
{
    protected $model;
    public function __construct(Team $team)
    {
        $this->model = $team;
    }

    public function index(): Response
    {
        return response($this->model->all());
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:30',
                'titles' => 'nullable|integer|impossible_titles|non_negative',
                'top_scorer' => 'required|max:50',
                'fifa_code' => 'required|max:3|unique:teams,fifa_code',
                'first_cup' => 'nullable|invalid_year|impossible_titles|date',
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first(),
                ], 400);
            }
    
            $team = $this->model->create($request->all()); 
    
            return response()->json($team, 201);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
      
    }

    public function show(string $id): JsonResponse
    {
        $team = $this->model->find($id);
        if(!$team){
            return response()->json(['message' => 'Team not found'], 404);
        }
        return response()->json($team, 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        
        $team = $this->model->find($id);
        
        if(!$team){
            return response()->json(['message' => 'Team not found'], 404);
        }

        $data =json_decode($request->getContent());

        if(!$request->has('first_cup')){
            $formattedDate = DateTime::createFromFormat('Y-m-d H:i:s', $team->first_cup)->format('Y-m-d');
            $data->first_cup = $formattedDate;
        }
       
        if(!$request->has('titles')){
            $data->titles = $team->titles;
        }
        
        $request = new Request((array) $data);
        
        try {
            
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|max:30',
                'titles' => 'nullable|sometimes|integer|impossible_titles|non_negative',
                'top_scorer' => 'sometimes|max:50',
                'fifa_code' => 'sometimes|max:3|unique:teams,fifa_code,'.$team->id,
                'first_cup' => 'nullable|sometimes|invalid_year|impossible_titles|date',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first(),
                ], 400);
            }
            
            $dados = $request->all();
            $team->fill($dados)->save();
            return response()->json($team, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        $team = $this->model->find($id);
        if(!$team){
            return response()->json(['message' => 'Team not found'], 404);
        }
        $team->delete();
    }
}
