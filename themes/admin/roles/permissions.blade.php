<div class="table-responsive">
    <div class="nav-vertical">
        <ul class="nav nav-tabs nav-left flex-column" role="tablist" style="height: 98px;">
            @foreach(config('permissions.permissions') as $name => $section)
                <li class="nav-item">
                    <a class="nav-link{{$loop->first?' active':''}}" id="{{$name}}-tab" data-toggle="tab" aria-controls="{{$name}}-content"
                       href="#{{$name}}-content" role="tab" aria-selected="false">
                        {{$section['title']}}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach(config('permissions.permissions') as $name => $section)
                <div class="tab-pane{{$loop->first?' active':''}}" id="{{$name}}-content" role="tabpanel" aria-labelledby="{{$name}}-tab">
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="2">
                                {{$section['title']}}<br/>
                                <small>{!! $section['description'] !!}</small>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($section['abilities'] as $ability=>$details)
                            <tr>
                                <td>
                                    {{$details['title']}}<br/>
                                    <small>{!! $details['description'] !!}</small>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               name="permissions[]"
                                               form="form-edit"
                                               value="{{$ability}}" id="{{\Illuminate\Support\Str::slug($ability)}}">
                                        <label class="custom-control-label"
                                               for="{{\Illuminate\Support\Str::slug($ability)}}"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>