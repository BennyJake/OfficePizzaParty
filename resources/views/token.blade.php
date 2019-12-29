// resources/views/tasks.blade.php

@extends('layouts.app')

@section('content')
<style>
    section.showcase {
        margin-top: 2.5rem;
    }
</style>
    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')
        <form action="" method="POST" class="form-horizontal">

        <section class="showcase">
        <div class="row">
            <div class="col-12">
                <section class="nes-container with-title">
                    <h3 class="title">Shareable URL</h3>
                    <p>Click on the URL to copy</p>
                    <span class="nes-text is-primary" style="font-size:1.5em">{{$url}}</span>
                </section>

               <!-- <a class="nes-btn" href="#">Normal</a>
                <button type="button" class="nes-btn is-primary">Primary</button>
                <button type="button" class="nes-btn is-success">Success</button>
                <button type="button" class="nes-btn is-warning">Warning</button>
                <button type="button" class="nes-btn is-error">Error</button>
                <button type="button" class="nes-btn is-disabled">Disabled</button>

                <label class="nes-btn">
                    <span>Select your file</span>
                    <input type="file">
                </label>-->
            </div>
            </div>
        </section>
        @if (isset($userName))
            <section class="showcase">
                <div class="form-group">
                    <section class="nes-container with-title">
                        <h3 class="title">Thanks!</h3>
                        <p>We already have your tastes, {{$userName}}. Check out the group stats below.</p>
                    </section>
                </div>
            </section>
        @else
            <section class="showcase">
            <div class="form-group">
                <section class="nes-container with-title">
                    <h3 class="title">Your name?</h3>
                    <!--<label for="task" class="col-sm-3 control-label">Your Name</label>-->

                    <div class="col-sm-6">
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </section>
            </div>
        </section>
        @endif
        @if (isset($groupOrgUserList))
            @include('common.group')
        @else
        <section class="showcase">
            <div class="form-group">
                <section class="nes-container with-title">
                    <h3 class="title">Your like these pizza toppings?</h3>
                        {{ csrf_field() }}
        @foreach ( $toppings as $toppingAlt => $toppingProper)
        <div class="row">
            <div class="col-3">
                <label>{{$toppingProper}}</label>
            </div>
            <div class="col-3">
                <label>
                    <input type="radio" value="-1" class="nes-radio" name="topping_{{$toppingAlt}}" checked />
                    <span>No</span>
                </label>
            </div>
            <div class="col-3">
                <label>
                    <input type="radio" value="0" class="nes-radio" name="topping_{{$toppingAlt}}" />
                    <span>Maybe...</span>
                </label>
            </div>
            <div class="col-3">
                <label>
                    <input type="radio" value="1" class="nes-radio" name="topping_{{$toppingAlt}}" />
                    <span>Yes</span>
                </label>
            </div>
        </div>
        @endforeach
                        <div class="row" style="margin-top:5rem">
                            <div class="col-9">
                            </div>
                            <div class="col-3">
                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                            </div>
                        </div>

                </section>
            </div>
        </section>
        @endif
        </form>
    </div>
    <!-- TODO: Current Tasks -->
@endsection
