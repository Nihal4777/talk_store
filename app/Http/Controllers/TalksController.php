<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Talk;
use App\Models\TalkMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TalksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all()->sortBy('name');
        $talks=Talk::all();
        return view('admin.talks.index',compact('categories','talks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $talk=new Talk();
        $categories=Category::all()->sortBy('name');
        return view('admin.talks.create',compact('categories','talk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $request->validate([
            'title'=>'required',
            'person1_name'=>'required',
            'person2_name'=>'required',
            'description'=>'',
            'script'=>'required',
            'price'=>'required',
            'image'=>'nullable|image',
            ]);
            
            DB::transaction(function() use ($request){
            $talk=new Talk;
            $talk->title=$request->title;
            $talk->person1_name=$request->person1_name;
            $talk->person2_name=$request->person2_name;
            $talk->description=$request->description;
            $talk->category_id=$request->category_id;
            $talk->price=$request->price;
            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName=time().'_'.$file->getClientOriginalName();
                $talk->image='assets/uploaded_images/'.$fileName;
                $file->move(public_path('assets/uploaded_images/'),$fileName);
            }
            $talk->save();
            $messages=explode(PHP_EOL,$request->script);
            foreach($messages as $id=>$message)
            {
                $tm=new TalkMessage();
                $tm->talk_id=$talk->id;
                $tm->seq=$id+1;
                $tm->message=$message;
                $tm->save();
            }
            });
            return redirect(route('talks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Talk  $talk
     * @return \Illuminate\Http\Response
     */
    public function show(Talk $talk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Talk  $talk
     * @return \Illuminate\Http\Response
     */
    public function edit(Talk $talk)
    {
        $categories=Category::all()->sortBy('name');
        return view('admin.talks.edit',compact('talk','categories'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Talk  $talk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Talk $talk)
    {
        $request->validate([
            'title'=>'required',
            'person1_name'=>'required',
            'person2_name'=>'required',
            'description'=>'',
            'script'=>'required',
            'price'=>'required',
            'image'=>'nullable|image',
            ]);
            
            DB::transaction(function() use ($request,$talk){
            $talk->title=$request->title;
            $talk->person1_name=$request->person1_name;
            $talk->person2_name=$request->person2_name;
            $talk->description=$request->description;
            $talk->category_id=$request->category_id;
            $talk->price=$request->price;
            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName=time().'_'.$file->getClientOriginalName();
                $talk->image='assets/uploaded_images/'.$fileName;
                $file->move(public_path('assets/uploaded_images/'),$fileName);
            }
            $talk->save();
            $talk->script()->delete();
            $messages=explode(PHP_EOL,$request->script);
            foreach($messages as $id=>$message)
            {
                $tm=new TalkMessage();
                $tm->talk_id=$talk->id;
                $tm->seq=$id+1;
                $tm->message=$message;
                $tm->save();
            }
            });
            return redirect(route('talks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Talk  $talk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talk $talk)
    {
        $talk->script()->delete();
        $talk->delete();
        return redirect(route('talks.index'))->withSuccess("Talk Deleted");
    }


/* ---------------------------- Admin Only Route ---------------------------- */
    public function admin_talksPurchases(Request $request){
        $orders=Order::where(['is_authorized'=>1])->orderByDesc('created_at')->get();
        return view("admin.talksPurchases",compact('orders'));
    }


}
