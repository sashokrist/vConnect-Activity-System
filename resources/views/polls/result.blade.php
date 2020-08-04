@extends('layouts.app')
@section('content')
    <div class="header">
        <a href="{{ route('polls.index') }}" class="btn-back"><i class="fas fa-arrow-alt-square-left"></i></a>
        <h1>Poll Results</h1>
    </div>
    <div class="container poll-results">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="border-container">
                            <h2 class="votes-title">Total votes:<span>{{ $allVotes->count() }}</span></h2>
                            <ul class="voting-by-option">
                                @foreach ($count as $k => $c)
                                    <li>
                                        <span>{{ $k }}</span><i class="fas fa-arrow-right"></i><small>{{ $c->count() }}</small>
                                    </li>
                                @endforeach
                            </ul>
                           {{-- <div class="results-chart">
                                {!! $chart->container() !!}
                            </div>--}}
                            <table class="results-table table">
                                <thead>
                                <tr>
                                    <th scope="col">User</th>
                                    <th scope="col">Question</th>
                                    <th scope="col">Answer</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allVotes as $vote)
                                    <tr>
                                        <td >{{ $vote->username }}</td>
                                        <td>{{ $vote->question }}</td>
                                        <td>{{ $vote->answer }}</td>
                                        <td>
                                            @if (auth()->user()->name ===  $vote->username)
                                                <form action="{{ route('polls.destroy', $vote->id ) }}" method="post">
                                                    @csrf
                                                    {{ method_field('delete') }}
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @else
                                                <p>No</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--@can('export')
                                <form method='post' action='{{ route('polls/export') }}'>
                                    @csrf
                                    <input type="submit" class="btn btn-success" name="exportexcel" value='Excel Export'>
                                    <input type="submit" class="btn btn-success" name="exportcsv" value='CSV Export'>
                                </form>
                            @endcan--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   {{-- {!! $chart->script() !!}--}}
@endsection
