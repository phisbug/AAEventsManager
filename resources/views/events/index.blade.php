@extends('aapps.index')

@section('title', 'Dex Ilagan')

@section('content')

<div class="overlay"></div>

<div class="container">
    <div class="row">
        <div class="col">
            <header style="margin-bottom:4rem;">
                <h1>Calendar</h1>
            </header>
            <article>
                
            </article>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div>

                <div class="errors" style="color:red;margin=bottom:15px;"></div>


                <form id="formevent" action="{{ route( 'events.add' ) }}" method="post" class="form-horizontal" role="form">
                    @csrf
                        
                         <div class="row">

                          <div class="form-group col-md-12">
                            <label class="control-label">Event</label>
                            <div class="inner-addon left-addon">
                              
                              <input type="text" name="event_name" class="form-control" placeholder="" />
                            </div>

                          </div>

                          
                        </div><!-- ./ end row -->



                        <div class="row">

                          <div class="form-group col-md-6">
                            <label class="control-label">From</label>
                            <div class="inner-addon left-addon">
                              
                              <input autocomplete="off" type="text" name="start_date" class="form-control dateme" placeholder="yyyy-mm-dd" />
                            </div>
                          </div>

                          <div class="form-group col-md-6">
                            <label class="control-label">
                              To
                            </label>
                            <div class="inner-addon right-addon">
                              
                              <input autocomplete="off" type="text" name="end_date"  class="form-control dateme" placeholder="yyyy-mm-dd" />
                            </div>
                          </div>
                        </div><!-- ./ end row -->

                        <div class="row">

                          <div class="form-group col-md-12">
                            
                            <div class="inner-addon left-addon">
                                
                                <label class="radio-inline">
                                <input type="checkbox" name="days[]" value="Monday"  style="margin-bottom: 10px">Mon
                                </label>


                                <label class="radio-inline">
                                <input type="checkbox" name="days[]" value="Tuesday"  style="margin-bottom: 10px">Tue
                                </label>


                                <label class="radio-inline">
                                <input type="checkbox" name="days[]" value="Wednesday"  style="margin-bottom: 10px">Wed
                                </label>

                                <label class="radio-inline">
                                <input type="checkbox" name="days[]" value="Thursday"  style="margin-bottom: 10px">Thurs
                                </label>

                                <label class="radio-inline">
                                <input type="checkbox" name="days[]" value="Friday"  style="margin-bottom: 10px">Fri
                                </label>

                                <label class="radio-inline">
                                <input type="checkbox" name="days[]" value="Saturday"  style="margin-bottom: 10px">Sat
                                </label>

                                <label class="radio-inline">
                                <input type="checkbox" name="days[]" value="Sunday"  style="margin-bottom: 10px">Sun
                                </label>


                              
                            </div>
                          </div>

                          
                        </div><!-- ./ end row -->


                        <button id="addeventbutton" class="btn btn-primary">Add Event</button>

                </form>
                
            </div>
        </div>

        <div class="col-md-8">
            <div>
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>







@endsection