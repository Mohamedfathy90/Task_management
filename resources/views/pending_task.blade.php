<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Task') }}
        </h2>
    </x-slot>
    <div class="main-content">
        <section class="section">
            
          <div class="section-body">
            <div class="row">
              <div class="col-9 mx-auto mt-6">
                <div class="card">
                  <div class="card-body">
                  
                  <form action="/task/pending/{{$task->id}}" method="post">
                    @csrf 
                    <div class="form-group" style="margin-left: 80px;">
                        <label>Site:</label>
                        <input type="text" class='form-control col-9' name="name" value="{{$task->site}}" readonly>
                    </div>
                    <div class="form-group" style="margin-left: 80px;">
                        <label>Task Description:</label>
                        <input type="text" class='form-control col-9' name="name" value="{{$task->task_desc}}" readonly>
                    </div>
                    <div class="form-group" style="margin-left: 80px;">
                        <label>Equipment_tag:</label>
                        <input type="text" class='form-control col-9' name="name" value="{{$task->equipment_tag}}" readonly>
                    </div>
                    <div class="form-group" style="margin-left: 80px;">
                        <label>Equipment_description:</label>
                        <input type="text" class='form-control col-9' name="name" value="{{$task->equipment_desc}}" readonly>
                    </div>
                    
                    <div class="form-group" style="margin-left: 80px;">
                      <label>Pending Cause</label>
                      <input type="text" class='form-control col-9' name="cause">
                    </div>
                          
                    <div class="form-group " style="margin-left: 80px;">             
                    <button type="submit" class="btn btn-primary" style="background-color: #007bff;">Pend Task</button>
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

    