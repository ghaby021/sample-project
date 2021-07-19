<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multi Picture <b> </b>
            
            <b style="float:right;">
            <span class ="badge badge-danger"></span>
            </b>
 
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="container">
            <div class ="row">

                <div class = "col-md-8">
                    <div class = "card-group">

                        @foreach ($images as $multi)
                        <div class = "col-md-4 mt-5">
                            <div class = "card">
                                <img src ="{{asset($multi->image)}}">
                            </div>


                        </div>
                            

                        @endforeach

                    </div>

                </div> 

                <div class = "col-md-4">
                    <div class = "card">
                           

                        <div class ="card-header">Multi Image</div> 
                        <div class ="card-body">

                    
                            <form action = "{{ route('store.image')}}" method = "POST" enctype = "multipart/form-data">
                            @csrf
                                <div class="form-group">
                                <label for="exampleInputEmail1">Multi Image</label>
                                <input type="file" name="image[]"  class="form-control"
                                id="exampleInputEmail1" multiple="">
    
                                    @error('image')
                                        <span class=text-danger>{{$message}}</span>
                                    @enderror    
                                </div>    
                            <button type="submit" class="btn btn-primary">Add image</button>
                            </form> 


                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- trash part --}}
       {{--  <div class="container">
            <div class ="row">

                <div class = "col-md-8">
                    <div class = "card">
                     
                        <div class ="card-header">Trash List</div> 

                  



                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trashCat as $category)
                                <tr>
                                    <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->user->name}}</td>
                                    <td>
                                        @if ($category->created_at == NULL)
                                            <span class = "text-danger"> No date set</span>
                                            @else
                                            {{$category->created_at->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('category/restore/'.$category->id)}}" class="btn btn-info">Restore</a>
                                        <a href="{{url('pdelete/category/'.$category->id)}}" class="btn btn-danger">Delete</a>
                                     </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{$trashCat->links()}}
                    </div>
                </div> 


                
            </div>
            
        </div> --}}


    </div>    
    
</x-app-layout>
