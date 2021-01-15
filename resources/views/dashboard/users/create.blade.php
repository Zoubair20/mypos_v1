@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{route('dashboard.users.index')}}">@lang('site.users')</a></li>
                <li class="active"> @lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div>


                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{route('dashboard.users.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('post')}}

                        <div class="form-group">
                            <label for="">@lang('site.first_name')</label>
                            <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}">
                        </div>

                        <div class="form-group">
                            <label for="">@lang('site.last_name')</label>
                            <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}">
                        </div>

                        <div class="form-group">
                            <label for="">@lang('site.email')</label>
                            <input type="email" name="email" class="form-control" value="{{old('email')}}">
                        </div>

                        <div class="form-group">
                            <label for="">@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="{{asset('uploads/user_images/default.png')}}" style="width: 100px" alt="" class="img-thumbnail image-preview">
                        </div>


                        <div class="form-group">
                            <label for="">@lang('site.password')</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">@lang('site.password_confirmation')</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="form-group"><label>@lang('site.permissions')</label></div>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">

                                <li class="active">
                                    <a href="#users" data-toggle="tab" aria-expanded="true">@lang('site.users')</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="users">
                                    <label> <input type="checkbox" name="permissions[]"
                                                   value="create_users">@lang('site.create') </label>
                                    <label> <input type="checkbox" name="permissions[]"
                                                   value="read_users">@lang('site.read') </label>
                                    <label> <input type="checkbox" name="permissions[]"
                                                   value="update_users">@lang('site.update') </label>
                                    <label> <input type="checkbox" name="permissions[]"
                                                   value="delete_users">@lang('site.delete') </label>
                                </div>
                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')
                        </button>

                    </form>

                </div> {{--end of box-body --}}


                <div class="box-footer">
                </div>
            </div>


        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
