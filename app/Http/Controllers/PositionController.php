<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['positionlist'] = Position::select('id','name','status','created_at')->get();
        $this->data['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Position"], ['name' => "Position List"]
        ];
        //Pageheader set true for breadcrumbs
        $this->data['pageConfigs'] = ['pageHeader' => true, 'isFabButton' => true];
        $this->data['pagetitle'] = 'Position List';


        return view('pages.position-list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Position"], ['name' => "Position Create"]
        ];
        //Pageheader set true for breadcrumbs
        $this->data['pageConfigs'] = ['pageHeader' => true, 'isFabButton' => true];
        $this->data['pagetitle'] = "Position Create";
        return view('pages.position', $this->data); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($request->all()); exit();
        if (!empty($request->all())) {
  
            $validator = Validator::make(
                $request->all(),
                [              
                     'name' => 'required',
                ],
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }

            $postdata = $request->all();
            unset($postdata['_token']);
            unset($postdata['submit']);

            $red = Position::create($postdata);

            if ($red) {
                return redirect()->intended(route('position.index'))->withFlashSuccess('Position Type Created Successfully!');

            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id != '') {

            $position = Position::where(['id' => $id]);

            if ($position->count() > 0) {
                $this->data['response'] = $position->first();

            }
         
            $this->data['breadcrumbs'] = [
                ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Position"], ['name' => "Position Edit"]
            ];
            //Pageheader set true for breadcrumbs
            $this->data['pageConfigs'] = ['pageHeader' => true, 'isFabButton' => true];
            $this->data['pagetitle'] = "Position Edit";
        }
        return view('pages.position', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // echo"<pre>"; print_r($request->all()); die;
        if (!empty($request->all())) {

            // $updatedata = $request->all();
            

            $res = Position::where(['id' => $request->input('id')])->update(['name'=>$request->name]);

            if ($res) {

                return redirect()->intended(route('position.index'))->withFlashSuccess('Position Updated Successfully!');
            } else {

                return redirect()->intended(route('position.index'))->with('error', 'Position Not Updated');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_status($id = 0, $status = 1)
    {

        if ($id != 0 && $status != '') {
            $update = Position::where(['id' => $id])->update(['status' => $status]);
            // echo"<pre>"; print_r($update); die;
            if ($update) {
                return redirect()->back()->with(['success' => 'Status Change Successfully']);
            } else {
                return redirect()->back()->with(['error' => "Something Went Wrong"]);
            }
        }
    }
}
