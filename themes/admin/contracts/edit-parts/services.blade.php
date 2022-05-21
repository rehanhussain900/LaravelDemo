<div id="services-offered" class="content">
    {{--<div class="content-header">
        <h5 class="mb-0">Services</h5>
        <small>Species and Services Selection</small>
    </div>--}}
    <form action="{{route('admin.contracts.store_services')}}" id="formServices">
        <div class="row">
            <div class="col-12">
                <div class="collapse-border collapse-icon">
                    @foreach($species as $specie)
                        @php
                            
                            $specie_total = 0;
                            
                        @endphp
                        <div class="card shadow-none">
                            <div class="card-header">
                                
                                <div class="collapse-title collapse-title-specie">
                                    <label class="lead">
                                        <input type="checkbox" name="species[]"
                                               data-target="#{{$specie->slug}}-content"
                                               class="contract-service-checkbox specie-checkbox"
                                               {!! $contract->species->contains($specie->id) ?'checked':'' !!}
                                               value="{{$specie->slug}}">
                                    </label>
                                    <div class="collapse-checkbox-label"
                                         aria-controls="{{$specie->slug}}-content"
                                         aria-expanded="false" data-target="#{{$specie->slug}}-content"
                                         data-toggle="collapse" role="button"
                                         id="{{$specie->slug}}-header">{{$specie->name}}</div>
                                </div>
                            </div>
                            <div id="{{$specie->slug}}-content" role="tabpanel"
                                 aria-labelledby="{{$specie->slug}}-header"
                                 class="collapse">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Service</th>
                                            <th>Price/Visit</th>
                                            <th>Tax</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                            <th>Annual</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($services as $service)
                                            @if($specie->name==='Additional Services'&&$service->name!=='Insect (insecticide) treatment')
                                                @continue
                                            @endif
                                            @if($specie->name!=='Additional Services'&&$service->name==='Insect (insecticide) treatment')
                                                @continue
                                            @endif
                                            @if(!empty($service->children[0]))
                                               
                                                <tr>
                                                    <td class="contract-service-column pl-2">
                                                        <strong class="contract-service-label">{{$service->name}}</strong>
                                                    </td>
                                                    <td colspan="5"></td>
                                                </tr>
                                                @foreach($service->children as $child)
                                                    @php
                                                        $selected_service = false;
                                                        if ($contract->services->contains($child->id)) {
                                                            $params['service_id'] = $child->id;
                                                            $params['specie_id'] = $specie->id;
                                                            $selected_service = $contract->services->filter(function($item) use($params) {
                                                                                return ($item->pivot->service_id == $params['service_id'] && $item->pivot->specie_id == $params['specie_id']);
                                                                            })->first();
                                                            if($selected_service){
                                                                $specie_total += $selected_service->pivot->total;
                                                            }
                                                        }

                                                    @endphp
                                                    <tr class="bg-contract-service">
                                                        <td class="contract-service-column pl-4">
                                                            <label class="contract-service-label">
                                                                <input type="checkbox"
                                                                       class="contract-service-checkbox"
                                                                       name="{{$specie->slug}}[{{$child->slug}}][enabled]"
                                                                       id="{{$specie->slug}}-{{$child->slug}}-enabled"
                                                                       {{$selected_service?'checked':''}}
                                                                       value="{{$child->name}}">
                                                                {{$child->name}}
                                                            </label>
                                                        </td>
                                                        <td class="contract-service-column">
                                                            <input type="number"
                                                                   name="{{$specie->slug}}[{{$child->slug}}][price]"
                                                                   id="{{$specie->slug}}-{{$child->slug}}-price"
                                                                   class="form-control"
                                                                   value="{{$selected_service?$selected_service->pivot->price:''}}"
                                                                   placeholder="Price/Visit" step=".1">
                                                        </td>
                                                        <td class="contract-service-column">
                                                            <input type="number"
                                                                   name="{{$specie->slug}}[{{$child->slug}}][tax]"
                                                                   id="{{$specie->slug}}-{{$child->slug}}-tax"
                                                                   class="form-control"
                                                                   value="{{$selected_service?$selected_service->pivot->tax:''}}"
                                                                   placeholder="Tax" step=".1">
                                                        </td>
                                                        <td class="contract-service-column">
                                                            <input type="number"
                                                                   name="{{$specie->slug}}[{{$child->slug}}][discount]"
                                                                   id="{{$specie->slug}}-{{$child->slug}}-discount"
                                                                   class="form-control"
                                                                   value="{{$selected_service?$selected_service->pivot->discount:''}}"

                                                                   placeholder="Discount" step=".1">
                                                        </td>
                                                        <td class="contract-service-column">
                                                            <input type="number"
                                                                   name="{{$specie->slug}}[{{$child->slug}}][total]"
                                                                   id="{{$specie->slug}}-{{$child->slug}}-total"
                                                                   data-check="{{$specie->slug}}-{{$child->slug}}-enabled"
                                                                   class="form-control {{$specie->slug}}-classtotal"
                                                                   value="{{$selected_service?$selected_service->pivot->total:'0'}}"
                                                                   placeholder="Total" step=".1" readonly>
                                                        </td>
                                                        <td class="contract-service-column">
                                                            <input type="number"
                                                                   name="{{$specie->slug}}[{{$child->slug}}][annual]"
                                                                   class="form-control"
                                                                   value="{{$selected_service?$selected_service->pivot->annual:''}}"

                                                                   placeholder="Annual" step=".1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">
                                                            <textarea name="{{$specie->slug}}[{{$child->slug}}][notes]"
                                                                      class="form-control" rows="2"
                                                                      data-auto-expand
                                                                      placeholder="Notes">{{$selected_service?$selected_service->pivot->notes:''}}</textarea>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                 @php
                                                    $selected_service = false;
                                                    if ($contract->services->contains($service->id)) {
                                                        $params['service_id'] = $service->id;
                                                        $params['specie_id'] = $specie->id;
                                                        $selected_service = $contract->services->filter(function($item) use($params) {
                                                                            return ($item->pivot->service_id == $params['service_id'] && $item->pivot->specie_id == $params['specie_id']);
                                                                        })->first();
                                                        if($selected_service){
                                                            $specie_total += $selected_service->pivot->total;
                                                        }
                                                    }

                                                 @endphp
                                                <tr class="bg-contract-service">
                                                    <td class="contract-service-column pl-2">
                                                        <label>
                                                            <input type="checkbox"
                                                                   class="contract-service-checkbox"
                                                                   name="{{$specie->slug}}[{{$service->slug}}][enabled]"
                                                                   id="{{$specie->slug}}-{{$service->slug}}-enabled"
                                                                   {{$selected_service?'checked':''}}
                                                                   value="{{$service->name}}">
                                                            <strong class="contract-service-label">{{$service->name}}</strong>
                                                        </label>
                                                    </td>
                                                    <td class="contract-service-column">
                                                        <input type="number"
                                                               name="{{$specie->slug}}[{{$service->slug}}][price]"
                                                               id="{{$specie->slug}}-{{$service->slug}}-price"
                                                               class="form-control"
                                                               value="{{$selected_service?$selected_service->pivot->price:''}}"
                                                               placeholder="Price/Visit" step=".1">
                                                    </td>
                                                    <td class="contract-service-column">
                                                        <input type="number"
                                                               name="{{$specie->slug}}[{{$service->slug}}][tax]"
                                                               id="{{$specie->slug}}-{{$service->slug}}-tax"
                                                               class="form-control"
                                                               value="{{$selected_service?$selected_service->pivot->tax:''}}"
                                                               placeholder="Tax" step=".1">
                                                    </td>
                                                    <td class="contract-service-column">
                                                        <input type="number"
                                                               name="{{$specie->slug}}[{{$service->slug}}][discount]"
                                                               id="{{$specie->slug}}-{{$service->slug}}-discount"
                                                               class="form-control"
                                                               value="{{$selected_service?$selected_service->pivot->discount:''}}"
                                                               placeholder="Discount" step=".1">
                                                    </td>
                                                    <td class="contract-service-column">
                                                        <input type="number"
                                                               name="{{$specie->slug}}[{{$service->slug}}][total]"
                                                               id="{{$specie->slug}}-{{$service->slug}}-total"
                                                               data-check="{{$specie->slug}}-{{$service->slug}}-enabled"
                                                               class="form-control {{$specie->slug}}-classtotal"
                                                               value="{{$selected_service?$selected_service->pivot->total:'0'}}"
                                                               placeholder="Total" step=".1" readonly>
                                                    </td>
                                                    <td class="contract-service-column">
                                                        <input type="number"
                                                               name="{{$specie->slug}}[{{$service->slug}}][annual]"
                                                               class="form-control"
                                                               value="{{$selected_service?$selected_service->pivot->annual:''}}"
                                                               placeholder="Annual" step=".1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">
                                                        <textarea name="{{$specie->slug}}[{{$service->slug}}][notes]"
                                                                  class="form-control" rows="2"
                                                                  data-auto-expand
                                                                  placeholder="Notes">{{$selected_service?$selected_service->pivot->notes:''}}</textarea>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label class="form-label" for="first-year-program">
                                                Total First Year for this Program
                                            </label>
                                            <input type="number" name="{{$specie->slug}}[fyp]" id="{{$specie->slug}}-fyp"
                                                   class="form-control valid specie-total"
                                                   value="{{$specie_total}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 col-12 offset-md-6">
                <label class="form-label" for="total-all-programs">
                    Total First Year for All Programs
                </label>
                <input type="number" name="total_all_programs" id="total-all-programs"
                       class="form-control valid"
                       value="{{$contract->total_all_programs??'0'}}" readonly>
            </div>
        </div>
    </form>
    <div class="d-flex justify-content-between mt-2">
        <button class="btn btn-primary btn-prev">
            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
        </button>
        <button class="btn btn-primary btn-next" data-action="confirm">
            <span class="align-middle d-sm-inline-block d-none">Confirm</span>
            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
        </button>
    </div>
</div>
