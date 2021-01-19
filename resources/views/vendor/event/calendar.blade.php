@extends('event::layouts')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading text-right">
            <button id="create_event"  type="button" class="btn btn-success btn-md"><i class="fa fa-plus"></i> Dodaj egzamin</button>
        </div>
        <div class="panel-body">

            <div id="alert_tmeassage_area"></div>

            <div id='calendar'>
            </div>
        </div>
    </div>
    <!--     Create Event  -->
    <div class="modal fade" id="create_event_modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> Dodaj egzamin</h4>
                </div>
                <div class="modal-body">
                    <div id="create_event_alert"></div>
                    <form id="create_event_frm"  action="{{route('event')}}"  method="post" enctype="multipart/form-data"  >

                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="event_title" id="event_title" required=""  class="form-control" placeholder="Tytuł egzaminu">
                                    <input  type="hidden" id="set_start_time_data" value="No" />
                                    <input  type="hidden" id="set_end_time_data" value="No" />
                                    <input  type="hidden" name="set_end_date_data" id="set_end_date_data" value="No" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="pull-left" style="width: 75%;">
                                <div class="col-lg-5 col-xs-12">
                                    <div class="form-group">
                                        <input type="text"   name="event_start_date" required="" id="event_start_date" value="" class="form-control date_pick" placeholder="Data rozpoczęcia">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xs-2">
                                    <div id="start_time_toggle">
                                        <button type="button"  class="btn btn-md"  title="Dodaj datę rozpoczęcia" onclick="add_start_time()">
                                            <i class="text-success fa fa-plus"></i>
                                            <i class="text-success fa fa-clock"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-xs-12" id="event_start_time_area" style="display: none">
                                    <!--                                 none-->
                                    <div class="form-group">
                                        <input type="text"   name="event_start_time" id="event_start_time" value="" class="form-control time_pick" placeholder="Data rozpoczęcia">
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right" >
                                <div class="col-lg-2 col-xs-2">
                                    <div id="end_date_toggle">
                                        <button type="button" class="btn btn-md"  onclick="add_end_date()" style="width: 117px" >
                                            <i class="text-success fa fa-plus"></i> Data końca</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section row" id="end_date_area" style="display: none">
                            <!--                            none-->
                            <div class="pull-left" style="width: 75%;">
                                <div class="col-lg-5 col-xs-12">
                                    <div class="form-group">
                                        <input type="text"   name="event_end_date" id="event_end_date" value="" class="form-control date_pick" placeholder="Data końca">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xs-2">
                                    <div id="end_time_toggle">
                                        <button type="button"  class="btn btn-md"  title="Dodaj datę zakończenia"  onclick="add_end_time()">
                                            <i class="text-success fa fa-plus"></i>
                                            <i class="text-success fa fa-clock"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-xs-12" id="event_end_time_area" style="display: none">
                                    <!--                    //none-->
                                    <input type="text"   name="event_end_time" id="event_end_time" value="" class="form-control time_pick" placeholder="Data końca">
                                </div>
                            </div>
                            <div class="pull-right">
                                <div class="col-lg-2 col-xs-2">
                                    <button type="button" class="btn btn-md" onclick="remove_end_date()" style="width: 117px" > <i class="text-danger fa fa-times"></i> Usuń</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="">Wydział</label>
                            <select id="faculty" name="faculty" class="form-control">
                                <option value="WEiI">Wydział Elektrotechniki i Informatyki</option>
                                <option value="WM">Wydział Mechaniczny</option>
                                <option value="WBiA">Wydział Budownictwa i Architektury</option>
                                <option value="WIŚ">Wydział Inżynierii Środowiska</option>
                                <option value="WZ">Wydział Zarządzania</option>
                                <option value="WPT">Wydział Podstaw Techniki</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="">Sala</label>
                            <select id="classroom" name="classroom" class="form-control">
                                <option value="1">I</option>
                                <option value="2">I</option>
                                <option value="3">III</option>
                                <option value="4">IV</option>
                                <option value="5">V</option>
                                <option value="6">VI</option>
                                <option value="7">VII</option>
                                <option value="8">VIII</option>
                                <option value="9">IX</option>
                                <option value="10">X</option>
                            </select>
                        </div>

                        <div class="section row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="event_description" name="event_description" placeholder="Opis"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="section" style="margin-top: 10px">
                            <div  class="text-right" id="event_image_error_msg"></div>
                            <p class="text-right">
                                <button type="button" id="create_event_btn"  class="btn btn-primary">Zapisz</button>
                            </p>
                        </div>
                        <!-- end section row -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                </div>
            </div>
        </div>
    </div>



    <!--     Edit Event  -->
    <div class="modal fade" id="edit_event_modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content admin-form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edytuj</h4>
                </div>
                <div class="modal-body">
                    <div id="edit_event_alert"></div>
                    <form id="edit_event_frm" action=""  method="post" enctype="multipart/form-data"  >
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <label class="">Tytuł rezerwacji</label>
                                    <input type="text" name="event_title" id="edit_event_title" required=""  class="form-control" placeholder="Tytuł rezerwacji">
                                </div>
                                <input type="hidden" id="edit_event_id" value="" name="id" />
                                <input type="hidden" id="edit_set_start_time_data" value="Yes" />
                                <input type="hidden" id="edit_set_end_time_data" value="Yes" />
                                <input type="hidden" name="set_end_date_data" id="edit_set_end_date_data" value="Yes" />
                            </div>
                        </div>
                        <div class=" row">
                            <div class="pull-left" style="width: 75%;">
                                <div class="col-lg-5 col-xs-12">
                                    <div class="form-group">
                                        <label class="">Data rozpoczęcia</label>
                                        <input type="text"   name="event_start_date" required="" id="edit_event_start_date" value="" class="form-control date_pick" placeholder="Data rozpoczęcia">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xs-2">
                                    <div id="edit_start_time_toggle" class="mt30">
                                        <button type="button"  class="btn btn-md" title="Usuń czas rozpoczęcia"   onclick="edit_remove_start_time()">
                                            <i class="text-danger fa fa-times"></i>
                                            <i class="text-danger fa fa-clock"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-xs-12" id="edit_event_start_time_area" style="display: block">
                                    <div class="form-group">
                                        <label class="">Data rozpoczęcia</label>
                                        <input type="text"   name="event_start_time" id="edit_event_start_time" value="" class="form-control time_pick" placeholder="Data rozpoczęcia">
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right" >
                                <div class="col-lg-2 col-xs-2">
                                    <div id="edit_end_date_toggle" class="mt30" style="display: none" >
                                        <button type="button" class="btn btn-md"  onclick="edit_add_end_date()" style="width: 117px" >
                                            <i class="text-success fa fa-plus"></i> Data końca</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="edit_end_date_area" style="display: block">
                            <div class="pull-left" style="width: 75%;">
                                <div class="col-lg-5 col-xs-12">
                                    <div class="form-group">
                                        <label class="">Data końca</label>
                                        <input type="text"   name="event_end_date" id="edit_event_end_date" value="" class="form-control date_pick" placeholder="Data końca">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xs-2">
                                    <div id="edit_end_time_toggle" class="mt30">
                                        <button type="button"  class="btn btn-md" title="Usuń datę końca"   onclick="edit_remove_end_time()">
                                            <i class="text-danger fa fa-times"></i>
                                            <i class="text-danger fa fa-clock"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-xs-12" id="edit_event_end_time_area" style="display: block">
                                    <div class="form-group">
                                        <label class="">Data końca</label>
                                        <input type="text"   name="event_end_time" id="edit_event_end_time" value="" class="form-control time_pick" placeholder="Data końca">
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <div class="col-lg-2 col-xs-2 mt30" >
                                    <button type="button" class="btn btn-md" onclick="edit_remove_end_date()" style="width: 117px" > <i class="text-danger fa fa-times"></i>Usuń</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="">Wydział</label>
                            <select id="edit_faculty" name="faculty" class="form-control">
                                <option value="WEiI">Wydział Elektrotechniki i Informatyki</option>
                                <option value="WM">Wydział Mechaniczny</option>
                                <option value="WBiA">Wydział Budownictwa i Architektury</option>
                                <option value="WIŚ">Wydział Inżynierii Środowiska</option>
                                <option value="WZ">Wydział Zarządzania</option>
                                <option value="WPT">Wydział Podstaw Techniki</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="">Sala</label>
                            <select id="edit_classroom" name="classroom" class="form-control">
                                <option value="1">I</option>
                                <option value="2">I</option>
                                <option value="3">III</option>
                                <option value="4">IV</option>
                                <option value="5">V</option>
                                <option value="6">VI</option>
                                <option value="7">VII</option>
                                <option value="8">VIII</option>
                                <option value="9">IX</option>
                                <option value="10">X</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="">Opis rezerwacji</label>
                                    <textarea class="form-control" id="edit_event_description" name="event_description" placeholder="Opis" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="section" style="margin-top: 10px">
                            <p class="text-right">
                                <button type="button" id="edit_event_btn"  class="btn btn-primary">Aktualizuj</button>
                            </p>
                        </div>
                        <!-- end section row -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('content_script')

    <script>
        var loader='<img class="loader" src="<?php echo asset('vendor/event/image/ajax-loader.gif')?>"/>';
        var calender_data_url = "{{route('all-event')}}";

        $( document ).ready(function() {

            $(function() {
                $('#calendar').fullCalendar({
                    height: 800,
                    header: {
                        left: 'month,agendaWeek,agendaDay custom1',
                        center: 'title',
                        right: 'custom2 prevYear,prev,next,nextYear'
                    },
                    footer: {
                        left: 'custom1,custom2',
                        center: '',
                        right: 'prev,next'
                    },
                    events: window.calender_data_url,

                    axisFormat: 'H(:mm)',
                    timeFormat: 'H(:mm)',
                    editable: false,
                    droppable: false,
                    eventTextColor:"#FFF",
                    eventColor:"#337AB7",
                    selectable: true,
                    selectHelper: true,
                    eventLimit: 10,
                    eventDurationEditable: false,

                    eventClick: function (event, jsEvent, view) {
                        edit_event(event.events_id);
                    }


                })

            });
        });


        function reloadCalender(mode)
        {
            $('#calendar').fullCalendar( 'removeEvents');
            $('#calendar').fullCalendar( 'addEventSource', calender_data_url);
            $('#calendar').fullCalendar( 'rerenderEvents' );
        }


        $("#create_event").click(function(){

            $('#create_event_alert').html('');
            $('#create_event_frm').parsley().reset();
            $("#create_event_frm")[0].reset();


            $('#create_event_modal').modal({
                show: 'true'
            });

        });



        $('.date_pick').datetimepicker({
            format: 'DD/MM/YYYY',
            pickTime: false

        });

        $('.time_pick').datetimepicker({
            pickDate: false
        });



        function add_start_time(){
            $('#set_start_time_data').val('Yes');
            $('#event_start_time').val('');

            var button='<button type="button" title="Usuń datę rozpoczęcia"   class="btn btn-md"  onclick="remove_start_time()"><i class="text-danger fa fa-times"></i>   <i class="text-danger fa fa-clock"></i> </button>';
            $('#start_time_toggle').html(button);
            $('#event_start_time_area').show();


        }


        function remove_start_time(){
            $('#set_start_time_data').val('No');

            $('#event_start_time').val('12:00');
            var button='<button type="button" title="Dodaj datę rozpoczęcia"  class="btn btn-md"  onclick="add_start_time()"><i class="text-success fa fa-plus"></i>   <i class="text-success fa fa-clock"></i> </button>';
            $('#start_time_toggle').html(button);
            $('#event_start_time_area').hide();

        }


        function add_end_time(){
            $('#set_end_time_data').val('Yes');
            $('#event_end_time').val('');

            var button='<button type="button"  title="Usuń datę rozpoczęcia"  class="btn btn-md"  onclick="remove_end_time()"><i class="text-danger fa fa-times"></i>   <i class="text-danger fa fa-clock"></i> </button>';
            $('#end_time_toggle').html(button);
            $('#event_end_time_area').show();


        }


        function remove_end_time(){
            $('#set_end_time_data').val('No');

            $('#event_end_time').val('23:59');
            var button='<button type="button" title="Dodaj koniec rezerwacji"  class="btn btn-md"  onclick="add_end_time()"><i class="text-success fa fa-plus"></i>   <i class="text-success fa fa-clock"></i> </button>';
            $('#end_time_toggle').html(button);
            $('#event_end_time_area').hide();

        }




        function add_end_date(){
            $('#set_end_date_data').val('Yes');
            $('#event_end_time').val('23:59');
            $('#end_date_toggle').hide();
            $('#end_date_area').show();


        }



        function remove_end_date(){

            $('#set_end_date_data').val('No');
            $('#event_end_date').val('');
            $('#event_end_time').val('23:59');

            $('#end_date_toggle').show();
            $('#end_date_area').hide();


        }
        function date_compare(){
            var event_start_date = $('#event_start_date').val().split("/");
            var event_start_time=$('#event_start_time').val();
            var start_data=event_start_date[2]+' '+event_start_date[1]+' '+event_start_date[0]+' '+event_start_time ;
            var start_time = new Date(start_data).getTime();


            var event_end_date = $('#event_end_date').val().split("/");
            var event_end_time=$('#event_end_time').val();
            var end_data=event_end_date[2]+' '+event_end_date[1]+' '+event_end_date[0]+' '+event_end_time ;
            var end_time = new Date(end_data).getTime();
            $("#create_event_alert").html('');


            if($('#set_end_date_data').val()=="Yes"){

                if(start_time>end_time){

                    $('#create_event_alert').show().html('<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>Data zakończenia musi być większa niż rozpoczęcia!</div>');
                    return false;
                    //   return false;

                }

                else{
                    return true;
                }

            }else{
                return true;
            }


        }


        $("#create_event_btn").click(function(){
            var set_start_time=$('#set_start_time_data').val();
            if(set_start_time=='Yes'){
                $('#event_start_time').attr('required', 'required');
            }else{
                $('#event_start_time').removeAttr('required');
            }




            var set_end_date=$('#set_end_date_data').val();
            if(set_end_date=='Yes'){
                $('#event_end_date').attr('required', 'required');
            }else{
                $('#event_end_date').removeAttr('required');
            }



            var set_end_time=$('#set_end_time_data').val();
            if(set_end_time=='Yes'){
                $('#event_end_time').attr('required', 'required');
            }else{
                $('#event_end_time').removeAttr('required');
            }



            if($('#create_event_frm').parsley().validate()==true  && date_compare()==true){

                //$('#create_event_frm').submit();
                $('#create_event_alert').show().html(loader);

                var action="{{route('event')}}";
                var formData = new FormData($('#create_event_frm')[0]);
                $.ajax({
                    type: "POST",
                    url: action,
                    data: formData,
                    contentType: false,
                    processData: false,
                    async: false,
                    success: function(feedback) {

                        var jd = $.parseJSON(feedback);

                        if(jd.type=='alert-success'){
                            $("#create_event_frm")[0].reset();
                            $('#create_event_modal').modal('hide');
                            $('#create_event_alert').show().html('');


                            $('#alert_tmeassage_area').show().html('<div class="alert '+jd.type+'"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+jd.message+'</div>');
                            reloadCalender();
                        }else{


                            var msg ='';

                            $.each(jd.error, function( key, value ){
                                msg +=value+'</br>';
                            });

                            $('#create_event_alert').show().html('<div class="alert '+jd.type+'"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+msg+'</div>');





                        }

                    }


                });


            }
        });

        function edit_event(event_id){


            $('#edit_event_modal').modal({
                show: 'true'
            });
            $('#edit_event_frm').parsley().reset();
            $("#edit_event_frm")[0].reset();

            $('#edit_event_alert').html(loader);
            var view_html='';

            var single_event_url = "{{url('single-event')}}/"+event_id;


            $.get(single_event_url, function (r) {
                var edata = $.parseJSON(r);



                if(edata.id>0){


                    $('#edit_event_alert').html('');
                    $('#edit_event_id').val(edata.id);
                    $('#edit_event_title').val(edata.event_title);
                    $('#edit_event_start_date').val(edata.event_start_date);
                    $('#edit_event_start_time').val(edata.event_start_time);
                    $('#edit_event_end_date').val(edata.event_end_date);
                    $('#edit_event_end_time').val(edata.event_end_time);
                    $('#edit_faculty').val(edata.faculty);
                    $('#edit_classroom').val(edata.classroom);
                    $('#edit_event_description').val(edata.event_description);


                }



            });

        }




        function edit_add_start_time(){
            $('#edit_set_start_time_data').val('Yes');
            $('#edit_event_start_time').val('');

            var button='<button type="button" title="Usuń datę rozpoczęcia"   class="btn btn-md"  onclick="edit_remove_start_time()"><i class="text-danger fa fa-times"></i>   <i class="text-danger fa fa-clock"></i> </button>';
            $('#edit_start_time_toggle').html(button);
            $('#edit_event_start_time_area').show();


        }


        function edit_remove_start_time(){
            $('#edit_set_start_time_data').val('No');

            $('#edit_event_start_time').val('12:00');
            var button='<button type="button"  title="Dodaj datę rozpoczęcia"  class="btn btn-md"  onclick="edit_add_start_time()"><i class="text-success fa fa-plus"></i>   <i class="text-success fa fa-clock"></i> </button>';
            $('#edit_start_time_toggle').html(button);
            $('#edit_event_start_time_area').hide();

        }


        function edit_add_end_time(){
            $('#edit_set_end_time_data').val('Yes');
            $('#edit_event_end_time').val('');

            var button='<button type="button" title="Usuń datę zakoćzenia"   class="btn btn-md"  onclick="edit_remove_end_time()"><i class="text-danger fa fa-times"></i>   <i class="text-danger fa fa-clock"></i> </button>';
            $('#edit_end_time_toggle').html(button);
            $('#edit_event_end_time_area').show();


        }


        function edit_remove_end_time(){
            $('#edit_set_end_time_data').val('No');

            $('#edit_event_end_time').val('23:59');
            var button='<button type="button" title="Dodaj datę zakończenia"   class="btn btn-md"  onclick="edit_add_end_time()"><i class="text-success fa fa-plus"></i>   <i class="text-success fa fa-clock"></i> </button>';
            $('#edit_end_time_toggle').html(button);
            $('#edit_event_end_time_area').hide();

        }




        function edit_add_end_date(){
            $('#edit_set_end_date_data').val('Yes');
            $('#edit_event_end_time').val('23:59');

            $('#edit_end_date_toggle').hide();
            $('#edit_end_date_area').show();


        }



        function edit_remove_end_date(){

            $('#edit_set_end_date_data').val('No');
            $('#edit_event_end_date').val('');
            $('#edit_event_end_time').val('23:59');

            $('#edit_end_date_toggle').show();
            $('#edit_end_date_area').hide();


        }



        $("#edit_event_btn").click(function(){
            var set_start_time=$('#edit_set_start_time_data').val();
            if(set_start_time=='Yes'){
                $('#edit_event_start_time').attr('required', 'required');
            }else{
                $('#edit_event_start_time').removeAttr('required');
            }




            var set_end_date=$('#edit_set_end_date_data').val();
            if(set_end_date=='Yes'){
                $('#edit_event_end_date').attr('required', 'required');
            }else{
                $('#edit_event_end_date').removeAttr('required');
            }



            var set_end_time=$('#edit_set_end_time_data').val();
            if(set_end_time=='Yes'){
                $('#edit_event_end_time').attr('required', 'required');
            }else{
                $('#edit_event_end_time').removeAttr('required');
            }






            if($('#edit_event_frm').parsley().validate()==true  && edit_date_compare()==true ){

                // $('#edit_event_frm').submit();
                $('#edit_event_alert').show().html(loader);
                var action="{{url('update-event')}}";
                var formData = new FormData($('#edit_event_frm')[0]);
                $.ajax({
                    type: "POST",
                    url: action,
                    data: formData,
                    contentType: false,
                    processData: false,
                    async: false,
                    success: function(feedback) {
                        var jd = $.parseJSON(feedback);


                        if(jd.type=='alert-success'){
                            $("#edit_event_frm")[0].reset();
                            $('#edit_event_modal').modal('hide');
                            $('#edit_event_alert').show().html('');


                            $('#alert_tmeassage_area').show().html('<div class="alert '+jd.type+'"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+jd.message+'</div>');
                            reloadCalender();
                        }else{


                            var msg ='';

                            $.each(jd.error, function( key, value ){
                                msg +=value+'</br>';
                            });

                            $('#edit_event_alert').show().html('<div class="alert '+jd.type+'"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+msg+'</div>');



                        }
                    }


                });


            }
        });


        function edit_date_compare(){
            var event_start_date = $('#edit_event_start_date').val().split("/");
            var event_start_time=$('#edit_event_start_time').val();
            var start_data=event_start_date[2]+' '+event_start_date[1]+' '+event_start_date[0]+' '+event_start_time ;
            var start_time = new Date(start_data).getTime();


            var event_end_date = $('#edit_event_end_date').val().split("/");
            var event_end_time=$('#edit_event_end_time').val();
            var end_data=event_end_date[2]+' '+event_end_date[1]+' '+event_end_date[0]+' '+event_end_time ;
            var end_time = new Date(end_data).getTime();
            $("#edit_event_alert").html('');

            if($('#edit_set_end_date_data').val()=="Yes"){

                if(start_time>end_time){


                    $('#edit_event_alert').show().html('<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>Data zakończenia musi być większa niż data rozpoczęcia!</div>');

                    return false;
                    //   return false;

                }else{
                    return true;
                }

            }else{
                return true;
            }


        }

    </script>

@endsection
