<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{
            Public function AllBrand(){

                $brands = Brand::latest()->paginate(5);
                return view('admin.brand.index' , compact('brands'));


            }


        public function StoreBrand(Request $request){
            //validate
            $validatedData = $request->validate([
                'brand_name'=> 'required|unique:brands|min:4',
                'brand_image'=> 'required|mimes:jpg,jpeg,png',
                ],
        
                [
                'brand_name.required'=> 'Please Input Brand Name',
                'brand_name.min'=> 'Brand Name must be greater than 4 char',    
                ]
    
            );

            $brand_image = $request->file('brand_image');
            /* $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location, $img_name); */ 

            $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen );
            $last_img = 'image/brand/'.$name_gen;


            Brand::insert([
                'brand_name'=>$request->brand_name,
                'brand_image'=>$last_img,
                'created_at' =>Carbon::now()
                
            ]);

            return Redirect()->back()->with('success','Brand Inserted Successfully');

        
        }   
         //edit brand
        public function Edit($id){
            $brands = Brand::find($id);
            return view('admin.brand.edit',compact('brands'));


        }


              //Update Brand
        public function Update(Request $request, $id){
            $validatedData = $request->validate([
                'brand_name'=> 'required|min:4',
                
                ],
        
                [
                'brand_name.required'=> 'Please Input Brand Name',
                'brand_name.min'=> 'Brand Name must be greater than 4 char',    
                ]
    
            );
            
            $old_image = $request->old_image;

            $brand_image = $request->file('brand_image');
            if($brand_image){
                $name_gen = hexdec(uniqid());
                $img_ext = strtolower($brand_image->getClientOriginalExtension());
                $img_name = $name_gen.'.'.$img_ext;
                $up_location = 'image/brand/';
                $last_img = $up_location.$img_name;
                $brand_image->move($up_location, $img_name);
    
                unlink($old_image);
                Brand::find($id)->update([
                    'brand_name'=>$request->brand_name,
                    'brand_image'=>$last_img,
                    'created_at' =>Carbon::now()
                    
                ]);
    
                return Redirect()->route('all.brand')->with('success','Image Updated Successfully');

            }else{
                
                Brand::find($id)->update([
                    'brand_name'=>$request->brand_name,
                    'created_at' =>Carbon::now()
                    
                ]);
    
                return Redirect()->route('all.brand')->with('success','Updated Brand Name Successfully');

            }
            
         }


         public function Delete($id){

                $image = Brand::find($id);
                $old_image = $image->brand_image;
                unlink($old_image);

                Brand::find($id)->delete();

                return Redirect()->back()->with('success','Updated Brand Delete Successfully');

         }

            //multi image methods
         public function Multipic(){
                $images = Multipic::all();
                return view('admin.multipic.index', compact('images'));
         }

         public function StoreImg(Request $request){

         /*    $validatedData = $request->validate([
                'brand_name'=> 'required|unique:brands|min:4',
                'brand_image'=> 'required|mimes:jpg,jpeg,png',
                ],
        
                [
                'brand_name.required'=> 'Please Input Brand Name',
                'brand_name.min'=> 'Brand Name must be greater than 4 char',    
                ]
    
            ); */

            $image = $request->file('image');

            foreach($image as $multi_img){


                $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
                Image::make($multi_img)->resize(300,300)->save('image/multi/'.$name_gen );
                $last_img = 'image/multi/'.$name_gen;


                Multipic::insert([
                    
                    'image'=>$last_img,
                    'created_at' =>Carbon::now()
                    
                ]);
            }//end of foreach

            return Redirect()->back()->with('success','Brand Inserted Successfully');


         }



}
