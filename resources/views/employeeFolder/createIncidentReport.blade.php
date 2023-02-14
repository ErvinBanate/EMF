@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Create Incident Reports</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('/incidentReport') }}">Incident Reports</a></li>
                <li class="breadcrumb-item active">Create Incident Reports</li>
            </ol>
        </nav>
    </div>
    {{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form class="row g-3" method="POST" action="{{ route('store') }}">
                @csrf
                <div class="col-md-2">
                    <label class="form-label" for="input-baranggay">Baranggay</label>
                    <input class="form-control" type="text" name="input-baranggay" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-location">Exact Location</label>
                    <input class="form-control" type="text" name="input-location">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-start-month">(Incident Started) Month</label>
                    <select class="form-control" name="input-start-month" value="{{ old('input-start-month') }}">
                        @foreach ($months as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                    @error('input-start-month')
                        <span class="invalidFeedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-start-day">Day</label>
                    <select class="form-control" name="input-start-day" value="{{ old('input-start-day') }}">
                        @for ($day = 1; $day <= 31; $day++)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endfor
                    </select>
                    @error('input-start-day')
                        <span class="invalidFeedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-start-year">Year</label>
                    <select class="form-control" name="input-start-year" value="{{ old('input-start-year') }}">
                        @for ($year = 1950; $year <= 2050; $year++)
                            @if ($year === now()->year)
                                <option value="{{ $year }}" selected>{{ $year }}
                                </option>
                            @else
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endif
                        @endfor
                    </select>
                    @error('input-start-year')
                        <span class="invalidFeedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-start-time">Time</label>
                    <input class="form-control" type="time" name="input-start-time"
                        value="{{ old('input-start-time') }}">
                    @error('input-start-time')
                        <span class="invalidFeedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-fire-alarm-level">Highest Fire Alarm Level</label>
                    <select class="form-control" name="input-fire-alarm-level">
                        @foreach ($fireAlarmLevels as $fireAlarmLevel)
                            <option value="{{ $fireAlarmLevel }}">{{ $fireAlarmLevel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-cause-of-incident">Cause of Incident</label>
                    <input class="form-control" type="text" name="input-cause-of-incident">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-end-month">(Incident Ended) Month</label>
                    <select class="form-control" name="input-end-month" value="{{ old('input-end-month') }}">
                        @foreach ($months as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                    @error('input-end-month')
                        <span class="invalidFeedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-end-day">Day</label>
                    <select class="form-control" name="input-end-day" value="{{ old('input-end-day') }}">
                        @for ($day = 1; $day <= 31; $day++)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endfor
                    </select>
                    @error('input-end-day')
                        <span class="invalidFeedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-end-year">Year</label>
                    <select class="form-control" name="input-end-year" value="{{ old('input-end-year') }}">
                        @for ($year = 1950; $year <= 2050; $year++)
                            @if ($year === now()->year)
                                <option value="{{ $year }}" selected>{{ $year }}
                                </option>
                            @else
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endif
                        @endfor
                    </select>
                    @error('input-end-year')
                        <span class="invalidFeedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-end-time">Time</label>
                    <input class="form-control" type="time" name="input-end-time"
                        value="{{ old('input-end-time') }}">
                    @error('input-end-time')
                        <span class="invalidFeedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="input-estimated-damage">Estimated Damage</label>
                    <div class="row">
                        <div class="col-1">
                            <p class="form-control"><strong>&#8369;</strong></p>
                        </div>
                        <div class="col-11">
                            <input class="form-control" type="number" name="input-estimated-damage" min="1">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-reported-by">Reported By</label>
                    <p class="form-control">{{ Auth::user()->name }}</p>
                    <input class="form-control" type="hidden" name="input-reported-by" value="{{ Auth::user()->id }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-families-affected">Number of Families Affected</label>
                    <input class="form-control" type="number" name="input-families-affected" min="1">
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="input-description">Description</label>
                    <textarea class="form-control" type="text" name="input-description" rows="10"></textarea>
                </div>
                <div class="col-12 mt-3">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
    {{-- </div> --}}
@endsection
