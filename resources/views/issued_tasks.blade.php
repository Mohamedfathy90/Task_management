<x-app-layout>
  
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card mb-3">
                    <div class="card-body">
                                      
                        <div class="form-group" style="float:left;">
                            <label><strong>Filter By Status</strong></label>
                            <select id='status' class="form-control" style="width: 200px">
                                <option value="">--Select Status--</option>
                                <option value="in progress">In Progress</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        
                        <div class="form-group" style="margin-left:20%;">
                            <label><strong>Filter By Site</strong></label>
                            <select id='site' class="form-control" style="width: 200px">
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
                        
                        
                        <div class="form-group ">
                            <label ><strong>Filter By date</strong></label><br>
                            <label for="startdate">Start</label>
                            <input id="startdate" class="form-control" type="date" style="width: 200px; display:inline-block;" />
                            <label for="enddate" style="margin-left:50px; display:inline-block;" >end</label>
                            <input id="enddate" class="form-control" type="date" style="width: 200px ;display:inline-block;" />
                        </div>
                    </div>

                    <div class="form-group">
                    <a href="/task/add" class="btn btn-primary ml-3" >New Job Order</a>
                    </div>
                </div>
                           
                <table class="table table-bordered" id="issued-tasks">
                    <thead>
                    <tr>
                    <th>No.</th>
                    <th>Site</th>
                    <th>Equipment_tag</th>
                    <th>Equipment_desc</th>
                    <th>Execution_department</th>
                    <th>Task_desc</th>
                    <th>Due_Date</th>
                    <th>Job_type</th>
                    <th>Status</th>
                    </tr>
                    </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

