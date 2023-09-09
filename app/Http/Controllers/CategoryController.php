<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('backend.categories.index',compact('categories'));
    }


    public function create()
    {
        $parent_categories = Category::where('is_parent',1)->orderBy('title','ASC')->get();
        return view('backend.categories.create',compact('parent_categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'photo'=>'required',
            'is_parent'=>'sometimes|in:1',
            'parent_id'=>'nullable|exists:categories,id',
            'status'=>'nullable|in:active,inactive',
        ]);

        $data = $request->all();

        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug',$slug)->count();
        if ($slug_count>0)
        {
            $slug .= time().'-'.$slug;
        }
        $data['slug']=$slug;
        $data['is_parent']=$request->input('is_parent',0);

        $status = Category::create($data);
        if ($status){
//            return redirect()->route('banner.index');
            return redirect()->route('category.index')->with('success','Category added successfuly');
        }
        return redirect()->back()->with('error','there is error');
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $parent_categories = Category::where('is_parent',1)->orderBy('title','ASC')->get();

        if ($category)
        {
            return view('backend.categories.edit',compact('category','parent_categories'));
        }else{
            return redirect()->back()->with('error','Data Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $category = Category::findOrFail($id);
        if ($category)
        {
            $this->validate($request,[

                'title'=>'string|required',
                'summary'=>'string|nullable',
                'photo'=>'required',
                'is_parent' => 'sometimes|in:1',
                'parent_id'=>'nullable|exists:categories,id',
                'status'=>'nullable|in:active,inactive',
            ]);


            $data=$request->all();

            if($request->is_parent==1)
            {
                $data['parent_id']=null;
            }

            $data['is_parent'] = $request->input('is_parent',0);
            $status = $category->fill($data)->save();
            if ($status){
//            return redirect()->route('banner.index');
                return redirect()->route('category.index')->with('success','Category Updated successfuly');
            }
        }
        return redirect()->back()->with('error','there is error');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $child_category_id= Category::where('parent_id',$id)->pluck('id');
        if ($category)
        {
            $status = $category->delete();
            if ($status)
            {
                if(count($child_category_id)>0)
                {
                    Category::shiftChild($child_category_id);
                }
                return redirect()->route('category.index')->with('success', 'category deleted successfuly');
            }else
            {
                return redirect()->back()->with('error', 'there is error');
            }
        }
        return redirect()->back()->with('error', 'Data Not Found');
    }


    public function categoryStatus(Request $request)
    {
        if ($request->mode=='true')
        {
            DB::table('categories')->where('id',$request->id)->update(['status'=>'active']);
        }
        else
        {
            DB::table('categories')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfuly updated','status'=>true]);
    }
    public function categoryIsParent(Request $request)
    {

        if ($request->mode=='true')
        {

            DB::table('categories')->where('id',$request->id)->update(['is_parent'=>'true']);
        }
        else
        {
            DB::table('categories')->where('id',$request->id)->update(['is_parent'=>false]);
        }
        return response()->json(['msg'=>'Successfuly updated','status'=>true]);

    }

    public function getChildByParentID(Request $request,$id)
    {
        $category = Category::findOrFail($id);
        if ($category){
            $child_id=Category::getChildByParentID($request->id);
            if(count($child_id)<0)
            {
                return response()->json(['data'=>'null','status'=>false,'msg'=>'']);
            }
            return response()->json(['data'=>$child_id,'status'=>true,'msg'=>'Successfuly added']);
        }else{
            return response()->json(['data'=>'null','status'=>false,'msg'=>'Category Not Found']);
        }



    }
}
