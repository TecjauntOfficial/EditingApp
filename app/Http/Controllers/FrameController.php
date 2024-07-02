<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frame;
use Validator;

class FrameController extends Controller
{

    public function CreateFrames(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'frame_img' => 'required|array|min:1',
            'frame_img.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 200,
                'message' => $validator->errors()
            
            ], 401);
        }

        if ($request->hasFile('frame_img')) {
            foreach ($request->file('frame_img') as $image) {
                $frame = new Frame();
                $frame->category_id = $request->category_id;
        
                $imagePath = $image->storeAs(
                    'frame_img',
                    str_replace(' ', '_', $image->getClientOriginalName()),
                    'public'
                );
        
                $frame->frame_img = $imagePath;
        
                $frame->save();
            }
        }


        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Frames created successfully',
        ], 200);

    }


    public function ViewAllFrames()
    {
        if(Frame::all()->isEmpty())
        {
            return response()->json([
                'status' => 'error',
                'code' => 200,
                'message' => 'No Frames Found.',
            ], 401);
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Frames Fetched Succesfully.',
            'data' => Frame::all()
        ], 200);
    }

    public function ViewFramesByCategory($id)
    {
        if(Frame::where('category_id', $id)->get()->isEmpty())
        {
            return response()->json([
                'status' => 'error',
                'code' => 200,
                'message' => 'No Frames Found for this Category.',
            ], 401);
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Frames Fetched Succesfully.',
            'data' => Frame::where('category_id', $id)->get()
        ], 200);
    }
    
}
