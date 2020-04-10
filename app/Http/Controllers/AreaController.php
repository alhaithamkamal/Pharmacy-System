<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables; 
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Area;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $areas =Area::all();
        if ($request->ajax()) {
            $areas =Area::all();
            return Datatables::of($areas)
                    ->addIndexColumn()
                    ->addColumn('action', function($areas){
                        $btn = '<a href="'.route("areas.show",["area" => $areas->id]).'" '.
                        'class="edit btn btn-success btn-sm" style="margin-right:10px;">show</a>';
                        $btn .= '<a href="'.route("areas.edit",["area" => $areas->id]).
                        '" class="edit btn btn-primary btn-sm" style="margin-right:10px;" >Edit</a>';
                        $btn .= '<button type="button" data-id="'.$areas->id.
                        '" data-toggle="modal" data-target="#DeleteAreaModal" class="btn btn-danger btn-sm" '.
                        'id="getDeleteId">Delete</button>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('areas.index');
    }

    public function create(){
        return view('areas.create');
    }

    public function store(StoreAreaRequest $request){
        //get the request data
        //store the request data in the database
        //redirect to show page
       
        $validate = $request->validated();
        if($validate){  
            
            Area::create([
                'name' => $request->name,
            ]);
           
        }
       
        return redirect()->route('areas.index')->with('message', 'Area added successfully');
    }

    public function show(Request $request){

        $area = $request->area;
        $area = Area::find($area);

        if(!$area){
            return redirect()->route('areas.index')->with('error', 'area is not found');
        }

    	return view('areas.show',[
    		'area' => $area
    	]);
    }

    public function edit(Request $request){
        
        $areaID = $request->area;
        $area = Area::find($areaID);
        if(!$area){
            return redirect()->route('areas.index')->with('error', 'area is not found');
        }
        return view('areas.edit',[
            'area' => $area
        ]);

    }

    public function update(UpdateAreaRequest $request){

        $area= Area::find($request->area);
        $validate = $request->validated();
 
        if($validate){
           
            $area -> update([
                'name' => $request->name
            ]); 
              
        }

        return redirect()->route('areas.index')->with('message', 'Area edited successfully');;
    }
 

    public function destroy(Request $request)
    {

        $area = Area::find($request->area);
        if ($area->addresses()->count()) {
            return response()->json(['check'=> 'false','message'=>'Cannot delete: this area has addresses']);
        }
        $area->delete();      
        return response()->json(['check'=> 'true','message'=>'Area deleted succussfully']);
    }

}
