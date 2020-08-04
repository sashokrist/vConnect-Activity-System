@extends('layouts.app')


@section('content')
    <div class="header">
        <h1>Sign-Up for Massage</h1>
    </div>
    <div class="container book-massage">
        <div class="card">
            <div class="row">
                <div class="col-md-4">
                    <div class="left-tile">
                        @if (isset($m_date))
                            <h1>Massage on: {{ $m_date }}</h1>
                            @else
                            <h2 class="no-items">There are no massages available!</h2>
                        @endif
                        <ul class="massage-details">
                            @if (isset($duration))
                                <li>
                                    <i class="fal fa-clock"></i> Duration: <small>{{ $duration }}</small> min
                                </li>
                            @endif
                            @if (isset($price))
                                    <li>
                                        <i class="fal fa-hand-holding-usd"></i> Price: <small>{{ $price }}</small> BGN
                                    </li>
                            @endif
                        </ul>
                       {{-- @can('user')--}}
                            @if ($id !== null)
                                <form id="laravel_json" method="post" action="{{route('massage-user.store', $id)}}">
                                    @csrf
                                    {{ method_field('put') }}
                                    <div class="form-group">
                                        <select name="time-slot" id="time-slot" class="form-control">
                                            <option value="">Select time for massage</option>
                                            @foreach($slots[$today] as $slot)
                                                <option value="{{ $slot }}">{{ $slot }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control">Book {{ $price }} BGN</button>
                                    </div>
                                </form>
                            @endif
                       {{-- @endcan--}}
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-7">
                    <table class="schedule table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Time</th>
                                @cannot('manage-users')
                                    <th>Action</th>
                                @endcannot
                                @can('manage-users')
                                    <th>Action</th>
                                    <th>Status</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if ($results !== null)
                                @foreach ($results as $item)
                                    <tr>
                                        <td>
                                            {{ $item->user->name }}
                                        </td>
                                        @if($item->paid === 0)
                                            <td class="unpaid">{{ $item->time }}</td>
                                        @else
                                            <td class="paid">{{ $item->time }}</td>
                                        @endif
                                        <td>
                                            @if (auth()->user()->id ===  $item->user_id)
                                                <form action="{{ route('massage.delete') }}" method="post">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <input type="hidden" value="{{ $item->user_id }}" name="item">
                                                    <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                        @can('manage-users')
                                            <td>
                                                @if($item->paid === 1)
                                                    <span class="btn-default btn-xs">Paid</span>
                                                @else
                                                    <form action="{{ route('massage-paid') }}" method="post">
                                                        @csrf
                                                        {{ method_field('put') }}
                                                        <input type="hidden" name="paid" value="1">
                                                        <input type="hidden" name="user_id" value="{{ $item->user_id }}">
                                                        <input type="hidden" name="massage_id" value="{{ $item->massage_id }}">
                                                        <button type="submit" class="btn btn-primary btn-xs">Pay</button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
