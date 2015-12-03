@extends('adoadomin::layouts.master')

@section('body-classes')
    sidebar-collapse
@stop

@section('content-header')
    <h1>
        {{ config('adoadomin-transleite.name') }}
        <small>{{ trans('adoadomin-transleite::messages.edit_title') }}</small>
    </h1>
@stop

@section('breadcrumb')
    {{--<ol class="breadcrumb">--}}
    {{--<li><a href="{{ route('adoadomin-transleite.edit') }}"><i class="fa fa-language"></i> {{ config('adoadomin-transleite.name') }}</a></li>--}}
    {{--<li class="active">{{ trans('adoadomin-transleite::messages.edit_title') }}</li>--}}
    {{--</ol>--}}
@stop

@section('content')
    @if(! empty($editLangs))
        <div class="nav-tabs-custom">
            <form method="post" action="" id="transleite-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">

                <ul class="nav nav-tabs">
                    @foreach (array_keys($editLangs) as $locale)
                        <li><a href="{{ '#' . $locale }}" role="tab" aria-controls="{{ $locale }}">{{ $locale }}</a>
                        </li>
                    @endforeach

                    <li class="pull-right">
                        <button type="submit" class="btn btn-primary"><i
                                    class="fa fa-save"></i> {{ trans('adoadomin-transleite::messages.save_button') }}
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    @foreach($editLangs as $langKey => $langLines)
                        <div role="tabpanel" class="tab-pane" id="{{ $langKey }}">
                            <div class="form-horizontal">
                                @foreach ($langLines as $lineKey => $line)
                                    @if(is_array($line))
                                        @include('transleite::atoms.form.transleite-group', [
                                            'groupTitle' => $lineKey,
                                            'group' => $line,
                                            'formElementID' => "translations[$langKey]"
                                        ])
                                    @else
                                        <div class="form-group transleite-group">
                                            <label for="translations[{{ $langKey }}][{{ $lineKey }}]"
                                                   class="control-label col-lg-4">{{ $lineKey }}</label>

                                        <textarea id="translations[{{ $langKey }}][{{ $lineKey }}]"
                                                  name="translations[{{ $langKey }}][{{ $lineKey }}]"
                                                  class="form-control col-lg-8">{!! $line !!}</textarea>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="box-footer clearfix">
                                <button type="submit" class="btn btn-primary pull-right"><i
                                            class="fa fa-save"></i> {{ trans('adoadomin-transleite::messages.save_button') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    @endif
@stop

{{--@section('footer-scripts')--}}
{{--@parent--}}

{{--    <script src="{{ asset('vendor/adoadomin-transleite/js/app.js') }}" type="text/javascript"></script>--}}
{{--@stop--}}