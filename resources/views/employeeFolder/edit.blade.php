@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Edit Incident Reports</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('/incidentReport') }}">Incident Reports</a></li>
                <li class="breadcrumb-item active">Edit Incident Reports</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form class="row g-3" method="POST" action="{{ route('update', $report->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-2">
                    <label class="form-label" for="input-baranggay">Baranggay</label>
                    <input class="form-control" type="text" name="input-baranggay" value="{{ $report->baranggay }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-location">Exact Location of Fire Incident</label>
                    <input class="form-control" type="text" name="input-location" value="{{ $report->location }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-start-month">(Incident Started) Month</label>
                    <select class="form-control" name="input-start-month" value="{{ old('input-start-month') }}">
                        @foreach ($months as $month)
                            @if ($month == $report->start_month)
                                <option value="{{ $month }}" selected>{{ $month }}</option>
                            @else
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endif
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
                            @if ($day == $report->start_day)
                                <option value="{{ $day }}" selected>{{ $day }}</option>
                            @else
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endif
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
                            @if ($year == $report->start_year)
                                <option value="{{ $year }}" selected>{{ $year }}</option>
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
                    <input class="form-control" type="time" name="input-start-time" value="{{ $report->time_started }}">
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
                            @if ($fireAlarmLevel == $report->fire_alarm_level)
                                <option value="{{ $fireAlarmLevel }}" selected>{{ $fireAlarmLevel }}</option>
                            @else
                                <option value="{{ $fireAlarmLevel }}">{{ $fireAlarmLevel }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-cause-of-incident">Cause of Incident</label>
                    <input class="form-control" type="text" name="input-cause-of-incident"
                        value="{{ $report->cause_of_incident }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-end-month">(Incident Ended) Month</label>
                    <select class="form-control" name="input-end-month" value="{{ old('input-end-month') }}">
                        @foreach ($months as $month)
                            @if ($month == $report->end_month)
                                <option value="{{ $month }}" selected>{{ $month }}</option>
                            @else
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endif
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
                            @if ($day == $report->end_day)
                                <option value="{{ $day }}" selected>{{ $day }}</option>
                            @else
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endif
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
                            @if ($year == $report->end_year)
                                <option value="{{ $year }}" selected>{{ $year }}</option>
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
                    <input class="form-control" type="time" name="input-end-time" value="{{ $report->time_ended }}">
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
                            <input class="form-control" type="number" name="input-estimated-damage"
                                value="{{ $report->estimated_damage }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-reported-by">Reported By</label>
                    <input class="form-control" type="text" value="{{ Auth::user()->name }}" disabled>
                    <input class="form-control" type="hidden" name="input-reported-by" value="{{ Auth::user()->id }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-families-affected">Number of Families Affected</label>
                    <input class="form-control" type="number" name="input-families-affected"
                        value="{{ $report->families_affected }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="input-description">Narative Report</label>
                    <textarea class="form-control" type="text" name="input-description" rows="5" style="resize: none">{{ $report->description }}</textarea>
                </div>
                @if ($report->rejection_notes == null)
                    <div class="col-md-12 justify-content-center mt-2">
                        <div class="image-preview-container">
                            <div class="preview">
                                <img id="preview-selected-image" src="{{ asset('Image/' . $report->image) }}"
                                    style="display: block;" />
                            </div>
                            <label for="file-upload">Upload Image</label>
                            <input type="file" id="file-upload" name="input-image" onchange="previewImage(event);"
                                accept="image/*">
                            @error('input-image')
                                <span class="invalidFeedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                @else
                    <div class="col-md-6 justify-content-center mt-2">
                        <div class="image-preview-container">
                            <div class="preview">
                                <img id="preview-selected-image" src="{{ asset('Image/' . $report->image) }}"
                                    style="display: block;" />
                            </div>
                            <label for="file-upload">Upload Image</label>
                            <input type="file" id="file-upload" name="input-image" onchange="previewImage(event);"
                                accept="image/*">
                            @error('input-image')
                                <span class="invalidFeedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6" style="height: 150px">
                        <label class="form-label" for="input-description">Rejection Notes</label>
                        <textarea class="form-control" type="text" name="input-description" style="height: 75%; resize: none" disabled>{{ $report->rejection_notes }}</textarea>
                    </div>
                @endif
                <div class="col-12 mt-3">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const previewImage = (event) => {
            const imageFiles = event.target.files;
            const imageFilesLength = imageFiles.length;
            if (imageFilesLength > 0) {
                const imageSrc = URL.createObjectURL(imageFiles[0]);
                const imagePreviewElement = document.querySelector("#preview-selected-image");
                imagePreviewElement.src = imageSrc;
                imagePreviewElement.style.display = "block";
            }
        };
    </script>
@endsection
