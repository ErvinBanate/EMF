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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form class="row g-3" method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-2">
                    <label class="form-label" for="input-baranggay">Baranggay <span style="color:red">*</span></label>
                    <input class="form-control" type="text" name="input-baranggay" value="{{ old('input-baranggay') }}">
                    @error('input-baranggay')
                        <span class="invalidFeedback" role="alert" style="color:red">
                            {{ str_replace('input-baranggay', 'Baranggay', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-location">Exact Location of Fire Incident <span
                            style="color:red">*</span></label>
                    <input class="form-control" type="text" name="input-location" value="{{ old('input-location') }}">
                    @error('input-location')
                        <span class="invalidFeedback" role="alert" style="color:red">
                            {{ str_replace('input-location', 'Exact Location of Fire Incident', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-start-month">(Incident Started) Month <span
                            style="color:red">*</span></label>
                    <select class="form-control" name="input-start-month" value="{{ old('input-start-month') }}">
                        @foreach ($months as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                    @error('input-start-month')
                        <span class="invalidFeedback" role="alert">
                            {{ str_replace('input-start-month', 'Month', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-start-day">Day <span style="color:red">*</span></label>
                    <select class="form-control" name="input-start-day" value="{{ old('input-start-day') }}">
                        @for ($day = 1; $day <= 31; $day++)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endfor
                    </select>
                    @error('input-start-day')
                        <span class="invalidFeedback" role="alert">
                            {{ str_replace('input-start-day', 'Day', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-start-year">Year <span style="color:red">*</span></label>
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
                            {{ str_replace('input-start-year', 'Year', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-start-time">Time</label>
                    <input class="form-control" type="time" name="input-start-time"
                        value="{{ old('input-start-time') }}">
                    @error('input-start-time')
                        <span class="invalidFeedback" role="alert">
                            {{ str_replace('input-start-time', 'Time', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-fire-alarm-level">Highest Fire Alarm Level <span
                            style="color:red">*</span></label>
                    <select class="form-control" name="input-fire-alarm-level">
                        @foreach ($fireAlarmLevels as $fireAlarmLevel)
                            <option value="{{ $fireAlarmLevel }}">{{ $fireAlarmLevel }}</option>
                        @endforeach
                    </select>
                    @error('input-fire-alarm-level')
                        <span class="invalidFeedback" role="alert">
                            {{ str_replace('input-fire-alarm-level', 'Fire Alarm Level', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-cause-of-incident">Cause of Incident</label>
                    <input class="form-control" type="text" name="input-cause-of-incident"
                        value="{{ old('input-cause-of-incident') }}">
                    @error('input-cause-of-incident')
                        <span class="invalidFeedback" role="alert" style="color:red">
                            {{ str_replace('input-cause-of-incident', 'Cause of Incident', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-end-month">(Incident Ended) Month <span
                            style="color:red">*</span></label>
                    <select class="form-control" name="input-end-month" value="{{ old('input-end-month') }}">
                        @foreach ($months as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                    @error('input-end-month')
                        <span class="invalidFeedback" role="alert">
                            {{ str_replace('input-end-month', 'Month', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-end-day">Day <span style="color:red">*</span></label>
                    <select class="form-control" name="input-end-day" value="{{ old('input-end-day') }}">
                        @for ($day = 1; $day <= 31; $day++)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endfor
                    </select>
                    @error('input-end-day')
                        <span class="invalidFeedback" role="alert">
                            {{ str_replace('input-end-day', 'Day', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-end-year">Year <span style="color:red">*</span></label>
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
                            {{ str_replace('input-end-year', 'Year', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-end-time">Time</label>
                    <input class="form-control" type="time" name="input-end-time"
                        value="{{ old('input-end-time') }}">
                    @error('input-end-time')
                        <span class="invalidFeedback" role="alert">
                            {{ str_replace('input-end-time', 'Time', $message) }}
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
                            <input class="form-control" type="number" name="input-estimated-damage" min="1"
                                value="{{ old('input-estimated-damage') }}">
                            @error('input-estimated-damage')
                                <span class="invalidFeedback" role="alert" style="color:red">
                                    {{ str_replace('input-estimated-damage', 'Estimated Damage', $message) }}
                                </span>
                            @enderror
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
                    <input class="form-control" type="number" name="input-families-affected" min="1"
                        value="{{ old('input-families-affected') }}">
                    @error('input-families-affected')
                        <span class="invalidFeedback" role="alert" style="color:red">
                            {{ str_replace('input-families-affected', 'Families Affected', $message) }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="input-description">Narative Report</label>
                    <textarea class="form-control" type="text" name="input-description" rows="5" style="resize: none">{{ Request::old('input-description') }}</textarea>
                </div>
                <div class="col-md-12 justify-content-center mt-2">
                    <div class="image-preview-container">
                        <div class="preview">
                            <img id="preview-selected-image" />
                        </div>
                        <label for="file-upload">Upload Image</label>
                        <input type="file" id="file-upload" name="input-image" onchange="previewImage(event);"
                            value="{{ old('input-image') }}" accept="image/*">
                        @error('input-image')
                            <span class="invalidFeedback" role="alert">
                                {{ str_replace('input-image', 'Image', $message) }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    <button class="btn btn-primary" type="submit">Create</button>
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
