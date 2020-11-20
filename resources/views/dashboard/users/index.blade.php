@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active"> @lang('site.users')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.users') <span
                            class="label pull-right bg-blue"> {{$users->total()}}</span></h3>


                    <form action="{{route('dashboard.users.index')}}" method="get">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <input type="text" name="search" placeholder="@lang('site.search')"
                                       value="{{request()->search}}"
                                       class="form-control">

                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-default"><i
                                        class="fa fa-search"> </i> @lang('site.search')</button>
                            </div>
                            <div class="col-md-4">

                                @if(auth()->user()->hasPermission('create_users'))
                                    <a class="btn btn-instagram"
                                       href="{{route('dashboard.users.create')}}"><i
                                            class="fa fa-plus"></i> @lang('site.add')  </a>
                                @else
                                    <a class="btn btn-instagram disabled"
                                       href="#"><i class="fa fa-plus"></i> @lang('site.add')  </a>
                                @endif

                            </div>
                        </div>
                    </form>

                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="">
                            <div class="box">

                                <!-- /.box-header -->
                                <div class="box-body">
                                    @if($users->count() > 0)
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('site.first_name')</th>
                                                <th>@lang('site.last_name')</th>
                                                <th>@lang('site.email')</th>
                                                <th>@lang('site.image')</th>
                                                <th>@lang('site.action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $index=>$user)
                                                <tr>
                                                    <td>{{$index + 1}}</td>
                                                    <td>{{$user->first_name}}</td>
                                                    <td>{{$user->last_name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td><img src="{{$user->image_path}}" alt="" width="10%"></td>

                                                    <td>
                                                        @if(auth()->user()->hasPermission('update_users'))
                                                            <a class="btn btn-info"
                                                               href="{{route('dashboard.users.edit', $user->id)}}"> <i
                                                                    class="fa fa-edit"></i> @lang('site.edit')</a>
                                                        @else
                                                            <a class="btn btn-info disabled"
                                                               href="#"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                                        @endif


                                                        @if(auth()->user()->hasPermission('delete_users'))

                                                            <form
                                                                action="{{route('dashboard.users.destroy', $user->id)}}"
                                                                style="display: inline-block"
                                                                method="post">
                                                                {{csrf_field()}}
                                                                {{method_field('delete')}}

                                                                <button type="submit"
                                                                        class="btn btn-danger delete"><i
                                                                        class="fa fa-trash"></i> @lang('site.delete')
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button
                                                                class="btn btn-danger disabled"><i
                                                                    class="fa fa-trash"></i> @lang('site.delete')
                                                            </button>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                        {{ $users->appends(request()->query())->links() }}

                                    @else
                                        <h2>@lang('site.no_data_found')</h2>
                                    @endif

                                </div>
                                <!-- /.box-body -->

                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                </form>
            </div>


        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
