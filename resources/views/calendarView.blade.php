<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-UA-Compatible" content="ie-edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> calendar view </title>

{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
--}}
 <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
</head>
<body>
    {{-- Arwa --}}
    <div class="continer">
        <div class="jumbotron">
         {{--{{form::open(array('url'=>'','files'=>true))}}--}}
            <div class="row">
                   
               <div class="col-md-8 col-md-offset-2">
                   <a href="/calendarView@getFacilityCalendar" class="btn btn-success"> ADD Events</a>
                   <a href="/editeventurl" class="btn btn-primary"> Edit Events</a>
                   <a href="/deleteeventurl" class="btn btn-danger"> Delete Events</a>
               </div>
               <div class="col-md-8 col-md-offset-2">
                    <script type="text/javascript">
                        jQuery(document).ready(function() {
                          $("#facility_id").on("change", function(e) {
                                $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                            event.preventDefault();
                            console.log(e);
                            var facility_id= e.target.value;
                                //ajax
                               /* $.get('/ajax-CalendarView?facility_id=' + facility_id,function(data){
                                    //success data
                                    alert("here");
                                    console.log(data);
                                });*/
                                $.post( "/ajax", { id: facility_id },
                                    function( data ) {
                                        alert("here");
                                        console.log( "ajax working"); 
                                        console.log( data.calendar );
                                        $('.test').html(data.calendar);
                                        $('#calendar').fullCalendar( 'refetchEvents' );
                                    }, "json");
                            });

                           /*     var item = $("#facility_id option:selected").text();
                                $.post("facilityBookingController/getFacilityCalendar",
                                {
                                    data:item
                                });
                                $.ajax({
                                url: '/personal',//.$(this).val(),
                                type: 'get',
                                data: {},
                                success: function(data) {
                                    if (data.success == true) {
                                   // $("#facility_id").value = data.info;
                                   alert('sucess');
                                    } else {
                                    alert('Cannot find info');
                                    }
                            
                                },
                                error: function(jqXHR, textStatus, errorThrown) {}
                                });*/
                            });
                    </script>
                   <p> select a facility to show its bookings </p>
                    <div class="form-group">
                        <label> facility_id</label>
                        <select class="form-control" name="facility_id" id="facility_id">
                            <option value ='1'>over all calendar</option>
                            <option value ='2'>squash courts =2 in DB</option>
                            <option value ='3'>Aerobics room =3 in DB</option>
                            <option value ='4'>Tennis =4 in DB</option>
                            <option value ='5'>Athletics track =5 in DB</option>
                        </select>
                     </div>
                </div>
               <br>
               <div class="row">
                    @if(count($errors)>0)
                       <div class="alert alert-danger">
                           <ul>
                               @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                               @endforeach
                           </ul>
                       </div>
                   @endif
                   @if(\Session::has('success'))
                       <div class="alert alert-sucess">
                          <p>{{ \Session::get('success')}} </p>
                       </div>
                   @endif
                  {{-- @if(session()->has('success'))
                       <div class="alert alert-success">
                           {{ session()->get('success') }}
                       </div>
                   @endif--}}
               </div>
           </div>
           <div class= "row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-defult">
                       <div class="panel-heading" style="background:#2e6da4; color: white;">
                              booking Calendar 
                       </div>
                       <div class="panel-body" >
                            {!! $calendar->calendar()!!}
                             {!! $calendar->script()!!}
                       </div>
                   </div>
                </div>
            </div>
        </div>
   </div>       	
</body>
</html>