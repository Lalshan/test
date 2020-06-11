@extends('admin.master')

@section('title','Add Time Schedule')

@push('css')
    

@endpush

@section('content')
   <section id="main-content">

        <section class="wrapper">
            <!-- row -->
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <section class="content">
                        <button class="btn btn-theme add" type="submit" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"> Add Time Schedule</i></button>
                            
                        <table class="table table-striped table-advance table-hover">
                        <thead class="bg-success">
                          <tr>
                            <th>S.I</th>
                       
                            <th>Operator Name</th>
                        
                            <th>Bus Code</th>
                       
                            <th>Operator Phone</th>
                        
                            <th>Time Schedule</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        {{-- @forelse( $all_operator as $operator ) --}}
                        <tbody>
                         {{--  <tr>
                          <td>{{$loop->index + 1}}</td>
                          <td>{{$operator->operator_name}}</td>
                          <td>{{$operator->operator_email}}</td>
                          <td>{{$operator->operator_phone}}</td>
                          <td>{{$operator->operator_address}}</td>
                          <td>{{$operator->operator_logo}}</td>
                          <td>{{$operator->status}}</td>


                         <td>

                          <div class="btn-group" role="group">
                            <button onclick="deletePost({{ $operator->id }})" class="btn btn-danger">Delete</button>
                            <a href="#"class="btn btn-info">Edit</a>
                            <a href="#"class="btn btn-info">View</a>
                          </div>

                           <form id="delete-form-{{ $operator->id }}" class="form-horizontal" action="{{ route('admin.operator.destroy',$operator->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>


                         </td>

                        </tr> --}}
                        </tbody>
                      {{-- @empty
                       <tr>
                           <td class="text-center" colspan="12"><h3 class="text-danger">No Operator Are available</h3></td>
                              </tr>
                      @endforelse --}}
                    </table>
                       </section>

                       <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title centered">Add Time Schedule</h4>
        </div>
        <div class="modal-body">
         <form method="post" action="{{ route('admin.schedule.store') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <fieldset>
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                                <!-- <label for="exampleInputEmail1">Bus Name</label> -->
                                <select  name="operator_id" class="form-control">
                                    <option value="0">--Select Operator--</option>
                                      @foreach ($all_operator['data'] as $select_operator)
                                        <option value="{{$select_operator->id}}">{{$select_operator->operator_name}}
                                        </option>
                                      @endforeach
                                </select>
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                                <!-- <label for="exampleInputEmail1">Bus Name</label> -->
                                <select name="bus_id"  class="form-control">
                                    {{-- <option value="0">--Select Bus--</option>
                                    @foreach ($bus_list['data'] as $bus)
                                    <option value="{{$bus->id}}">{{$bus->bus_code}}</option>
                                    @endforeach --}}
                                </select>
                          </div>
                          </div>
                          
                         
                             <div class="col-md-6">
                              <div class="form-group">
                                <input type="time" name="time_schedule" class="form-control" aria-describedby="emailHelp" value="00:00">
                              </div>
                            </div>
                          
                            

                          </div>
                         <div class="row">
                          
                           <div class="col-md-12 ">
                          <button type="submit" class="btn btn-theme btn-block">Add Operator</button>
                        </div>
                          </div>
                          
                           


                          
                       
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  


    </section>   

@endsection

@push('js')
{{-- Modal Script --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>





<script type="text/javascript">
  function deletePost(id) {
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger mr-2',
      buttonsStyling: true,
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
      event.preventDefault();
      document.getElementById('delete-form-'+id).submit();
    } else if (
            // Read more about handling dismissals
    result.dismiss === swal.DismissReason.cancel
    ) {
      swal(
              'Cancelled',
              'Your data is safe :)',
              'error'
      )
    }
  })
  }
</script>

<script type="text/javascript">
  $(function () {
    var operator = $('select[name="operator_id"]'),
        bus = $('select[name="bus_id"]');
    bus.attr('disabled','disabled')
    operator.change(function(){
      var id= $(this).val();
      console.log(id)
    })
  })
  
</script>


{{-- <script type='text/javascript'>

    $(document).ready(function(){

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token()}}"
            }
        });

      // Department Change
      $('#operator_id').change(function(){

         // Department id
         var id = $(this).val();

         // Empty the dropdown
         $('#bus_id').find('option').not(':first').remove();

         // AJAX request 
         $.ajax({
           url: 'admin/getBus/'+id,
           type: 'get',
           dataType: 'json',
           success: function(response){

             var len = 0;
             if(response['data'] != null){
               len = response['data'].length;
             }

             if(len > 0){
               // Read data and create <option >
               for(var i=0; i<len; i++){

                 var id = response['data'][i].id;
                 var name = response['data'][i].bus_code;

                 var option = "<option value='"+id+"'>"+bus_code+"</option>"; 

                 $("#bus_id").append(option); 
               }
             }

           }
        });
      });

    });

    </script> --}}





@endpush
  
  
  						

















							