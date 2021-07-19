<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           All Brand<b> </b>
            
            <b style="float:right;">
            <span class ="badge badge-danger"></span>
            </b>
 
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="container">
            <div class ="row">

                <div class = "col-md-8">
                    <div class = "card">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @endif
                        <div class ="card-header">All Brand</div> 

                  



                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                    <td>{{$brand->brand_name}}</td>
                                    <td><img src="{{asset($brand->brand_image)}}" style="height:40px; width:70px"> </td>
                                    <td>
                                        @if ($brand->created_at == NULL)
                                            <span  class = "text-danger"> No date set</span>
                                            @else
                                            {{$brand->created_at->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('brand/edit/'.$brand->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{url('brand/delete/'.$brand->id)}}" onclick = "return confirm('Are you sure to delete?') "class="btn btn-danger">Delete</a>
                                     </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{$brands->links()}}
                    </div>
                </div> 


                <div class = "col-md-4">
                    <div class = "card">
                           

                        <div class ="card-header">Add Brand</div> 
                        <div class ="card-body">

                    
                            <form action = "{{ route('store.brand')}}" method = "POST" enctype = "multipart/form-data">
                            @csrf
                            <div class="form-group">
                            <label for="exampleInputEmail1">Brand Name</label>
                            <input type="text" name="brand_name"  class="form-control"
                            id="exampleInputEmail1">

                                @error('brand_name')
                                    <span class=text-danger>{{$message}}</span>
                                @enderror    
                            </div>    
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Image</label>
                                <input type="file" name="brand_image"  class="form-control"
                                id="exampleInputEmail1">
    
                                    @error('brand_image')
                                        <span class=text-danger>{{$message}}</span>
                                    @enderror    
                                </div>    
                            <button type="submit" class="btn btn-primary">Add Brand</button>
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
