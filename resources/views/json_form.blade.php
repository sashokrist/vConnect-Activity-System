@extends('layouts.app')

<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <div class="container">
                            {{--@if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                <br>
                            @endif--}}
                            <h2>Select a time slot you want to reserve</h2>
                            @foreach ($tests as  $item)
                                <form id="laravel_json" method="post" action="{{url('update-json', $item->id)}}">
                                    @csrf
                                    {{ method_field('put') }}
                                    <div class="form-group">
                                        <select name="time-slot" id="time-slot">
                                            <option value="">Select time slot</option>
                                            @foreach ($item->json as $hours)
                                                <option value="{{ $hours }}">{{ $hours }}</option>
                                            @endforeach
                                        </select>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Start-End</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tests as  $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>
                                                @foreach ($item->json as $hours)
                                                    {{ $hours }}<br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


