<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipment Status') }}
        </h2>
    </x-slot>
    <div class="main-content">
        <section class="section">
            
          <div class="section-body">
            <div class="row" style="margin-left:0px; margin-right:0px;">
              <div class="col-9 mx-auto mt-6">
                <div class="card">
                  <div class="card-body">
                  
                  <form  action="/get_equip_status" method="post">
                    @csrf 
                    <div class="form-group" style="margin-left: 80px;">
                                   
                          <label>Site:</label>
                                <select id='select' class="form-control col-9" name="site" >
                                <option value="">--Select Site--</option>
                                <option value="MED">MEADIA</option>
                                <option value="P1">PI</option>
                                <option value="P2">PII</option>
                                <option value="WAQ">WAQ</option>
                                <option value="NAQ">NAQ-PI</option>
                                <option value="NAQP2">NAQ-PII</option>
                                <option value="NAQP3">NAQ-PIII</option>  
                            </select>
                    </div>
                              <div class="form-group" style="margin-left: 80px;">
                               <div id="search-autocomplete" class="form-outline">
                               <label class="form-label" for="search">Equipment Tag</label> 
                               <input type="text" id="search_tag" name="tag" class="typeahead form-control col-9" style="max-height: 150px;overflow-y: auto;"/>
                               @error('tag')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror  
                              </div>
                              </div>
                    <div class="form-group" style="margin-left: 80px;">
                        <label>Equipment_description:</label>
                        <input id="desc" type="text" class='form-control col-9'  value="" readonly>
                    </div>
                    
                    <div class="form-group " style="margin-left: 80px;">             
                    <button type="submit" class="btn btn-primary" style="background-color: #007bff;">Get Status</button>
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

    