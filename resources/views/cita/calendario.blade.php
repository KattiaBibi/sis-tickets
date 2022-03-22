@extends('adminlte::page')

<!-- @section('title', 'Dashboard') -->

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')


<div class="card">
  <div class="card-header">
  <h1 class="card-title">Calendario</h1>
  </div>
  <div class="card-body">
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>


<div class="container">


    <div class="response"></div>


    <div id='calendar'></div>


    </div>


  </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

@stop

@section('js')
    <script> console.log('Hi!'); </script>



    <script>


        $(document).ready(function () {





              var SITEURL = "{{url('/')}}";


              $.ajaxSetup({


                headers: {


                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')


                }


              });




              var calendar = $('#calendar').fullCalendar({


                  editable: true,


                  events: SITEURL + "booking",


                  displayEventTime: true,


                  editable: true,


                  eventRender: function (event, element, view) {


                      if (event.allDay === 'true') {


                          event.allDay = true;


                      } else {


                          event.allDay = false;


                      }


                  },


                  selectable: true,


                  selectHelper: true,


                  select: function (start, end, allDay) {


                      var title = prompt('Event Title:');




                      if (title) {


                          var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");


                          var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");




                          $.ajax({


                              url: SITEURL + "booking/create",


                              data: 'title=' + title + '&amp;start=' + start + '&amp;end=' + end,


                              type: "POST",


                              success: function (data) {


                                  displayMessage("Added Successfully");


                              }


                          });


                          calendar.fullCalendar('renderEvent',


                                  {


                                      title: title,


                                      start: start,


                                      end: end,


                                      allDay: allDay


                                  },


                          true


                                  );


                      }


                      calendar.fullCalendar('unselect');


                  },





                  eventDrop: function (event, delta) {


                              var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");


                              var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");


                              $.ajax({


                                  url: SITEURL + 'booking/update',


                                  data: 'title=' + event.title + '&amp;start=' + start + '&amp;end=' + end + '&amp;id=' + event.id,


                                  type: "POST",


                                  success: function (response) {


                                      displayMessage("Updated Successfully");


                                  }


                              });


                          },


                  eventClick: function (event) {


                      var deleteMsg = confirm("Do you really want to delete?");


                      if (deleteMsg) {


                          $.ajax({


                              type: "POST",


                              url: SITEURL + 'booking/delete',


                              data: "&amp;id=" + event.id,


                              success: function (response) {


                                  if(parseInt(response) > 0) {


                                      $('#calendar').fullCalendar('removeEvents', event.id);


                                      displayMessage("Deleted Successfully");


                                  }


                              }


                          });


                      }


                  }




              });


        });




        function displayMessage(message) {


          $(".response").html("<div class='success'>"+message+"</div>");


          setInterval(function() { $(".success").fadeOut(); }, 1000);


        }


      </script>
@stop























