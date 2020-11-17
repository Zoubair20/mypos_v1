@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.dashboard')</h1>

            <ol class="breadcrumb">
                <li class="active"><a href="{{route('dashboard.index')}}"></a><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>

            </ol>
        </section>

        <section class="content">

            <h1>This is dashboard</h1>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
