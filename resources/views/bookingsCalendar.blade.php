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
            <div class="row">
                   
               <div class="col-md-8 col-md-offset-2">
                   <a href="/squashCourts" class="btn btn-success"> ADD booking</a>
                   {{-- these btns - for admin--}}
                   <a href="/url" class="btn btn-primary"> Edit booking</a>
                   <a href="/url" class="btn btn-danger"> Delete booking</a>
               </div>
               <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <h3> select a calendar </h3>
                        <ul> 
                            {{-- 1st element - for admin--}}
                            <li><a href="/bookingsCalendar/1" >overall Calendar</a></li>
                            <li><a href="/bookingsCalendar/2" >squash courts =2 in DB</a></li>
                            <li><a href="/bookingsCalendar/3" >Aerobics room =3 in DB</a></li>
                            <li><a href="/bookingsCalendar/4" >Tennis =4 in DB</a></li>
                            <li><a href="/bookingsCalendar/5" >Athletics track =5 in DB</a></li>
                        </ul>
                    
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
