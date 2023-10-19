<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Workorder') }}
        </h2>
    </x-slot>
    <div class="main-content">
        <section class="section">
            
          <div class="section-body">
            <div class="row" style="margin-left:0px; margin-right:0px;">
              <div class="col-9 mx-auto mt-6">
                <div class="card">
                  <div class="card-body">
                  
                  <form id="add_task" action="/task/add" method="post" enctype="multipart/form-data">
                    @csrf 
                    
                          <div class="form-group" style="margin-left: 80px;">
                          <label class='mt-3'>Requested Department:</label>
                          <input  type="text" class='form-control col-9' name="request_dep"  value="AQELECT" readonly>
                          </div>
                          
                          <div class="form-group" style="margin-left: 80px;">
                          <label>Execution Department:</label>
                          <select id='site' class="form-control col-9" name="execution_dep">
                                <option value="">--Select Department--</option>
                                @foreach($departments as $deparment)
                                <option value="{{$deparment->name}}"  {{ old('execution_dep')== $deparment->name ? 'selected' : "" }}>{{$deparment->name}}</option>
                                @endforeach  
                            </select>
                            @error('execution_dep')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror  
                          </div>  
                          
                          <div class="form-group" style="margin-left: 80px;"> 
                              <label>Site:</label>
                                <select id='select' class="form-control col-9" name="site" >
                                <option value="">--Select Site--</option>
                                <option value="MED" {{ old('site')== "MED" ? 'selected' : "" }}>MEADIA</option>
                                <option value="P1" {{ old('site')== "P1" ? 'selected' : "" }}>PI</option>
                                <option value="P2" {{ old('site')== "P2" ? 'selected' : "" }}>PII</option>
                                <option value="WAQ"{{ old('site')== "WAQ" ? 'selected' : "" }}>WAQ</option>
                                <option value="NAQ" {{ old('site')== "NAQ" ? 'selected' : "" }}>NAQ-PI</option>
                                <option value="NAQP2" {{ old('site')== "NAQP2" ? 'selected' : "" }}>NAQ-PII</option>
                                <option value="NAQP3" {{ old('site')== "NAQP3" ? 'selected' : "" }}>NAQ-PIII</option>  
                                </select>
                          </div>
                              
                          <div class="form-group" style="margin-left: 80px;">
                               <div id="search-autocomplete" class="form-outline">
                               <label class="form-label" for="search">Equipment Tag</label> 
                               <input type="text" id="search_tag" name="tag" value="{{old('tag')}}" class="typeahead form-control col-9" style="max-height: 150px;overflow-y: auto;"/>
                               @error('tag')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror  
                              </div>
                          </div>
                          
                          <div class="form-group" style="margin-left: 80px;">
                              <label>Equipment_description:</label>
                              <input id="desc" name="description" type="text" class='form-control col-9'  value="{{old('description')}}" readonly>
                          </div>
                    
                          <div class="form-group" style="margin-left: 80px;">
                              <label>Add Photo</label>
                              <input type="file" class='form-control' name="image">
                              @error('image')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          
                          <div class="form-group" style="margin-left: 80px;">
                              <label>Remarks:</label>
                              <textarea class='form-control col-9' style="height:150px;" name="remarks" value="" ></textarea> 
                              @error('remarks')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror 
                          </div>
                    
                          <div class="form-group " style="margin-left: 80px;">             
                              <button type="submit" class="btn btn-primary" style="background-color: #007bff;">Add</button>
                          </div>
                    </form>
                  </div>
                
                </div>
              </div>
              </div>
            </div>
           
          </div>
    </section>
</div>
    </x-app-layout>

    