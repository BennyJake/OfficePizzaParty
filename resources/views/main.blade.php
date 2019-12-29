// resources/views/tasks.blade.php

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

        <div class="row">
            <div class="col-12">
                <form method="post" action="">
                    {{ csrf_field() }}
                    <input type="text" name="group-name" class="">
                    <input type="submit" name="form-submit" class="nes-btn is-primary" value="Generate New Poll">
                </form>
            </div>
        </div>
    </div>
@endsection
