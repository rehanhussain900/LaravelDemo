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
                        <div class="card shadow-none">
                            <div class="card-header">
                                <div class="collapse-title collapse-title-specie">
                                    <label class="lead">
                                        <input type="checkbox" name="species[]"
                                               data-target="#{{$specie->slug}}-content"
                                               class="contract-service-checkbox specie-checkbox"
                                               {!! in_array($specie->slug, $selected['species'], true)?'checked':'' !!}
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
                                                    <tr class="bg-contract-service">
                                                        <td class="contract-service-column pl-4">
                                                            <label class="contract-service-label">
                                                                <input type="checkbox"
                                                                       class="contract-service-checkbox"
                                                                       name="{{$specie->slug}}[{{$child->slug}}][enabled]"
                                                                       id="{{$specie->slug}}-{{$child->slug}}-enabled"
                                                                       {{!empty($selected['services'][$specie->slug][$child->slug]['enabled'])?'checked':''}}
                                                                       value="{{$child->name}}">
                                                                {{$child->name}}
                                                            </label>
                                                        </td>
                                                        <td class="contract-service-column">
                                                            <input type="number"
                                                                   name="{{$specie->slug}}[{{$child->slug}}][price]"
                                                                   id="{{$specie->slug}}-{{$child->slug}}-price"
                                                                   class="form-control"
                                                                   value="{{$selected['services'][$specie->slug][$child->slug]['price']??''}}"
                                                                   placeholder="Price/Visit" step=".1">
                                                        </td>
                                                        <td class="contract-service-column">
                                                            <input type="number"
                                                                   name="{{$specie->slug}}[{{$child->slug}}][tax]"
                                                                   id="{{$specie->slug}}-{{$child->slug}}-tax"
                                                                   class="form-control"
                                                                   value="{{$selected['services'][$specie->slug][$child->slug]['tax']??''}}"
                                                                   placeholder="Tax" step=".1">
                                                        </td>
                                                        <td class="contract-service-column">
                                                            <input type="number"
                                                                   name="{{$specie->slug}}[{{$child->slug}}][discount]"
                                                                   id="{{$specie->slug}}-{{$child->slug}}-discount"
                                                                   class="form-control"
                                                                   value="{{$selected['services'][$specie->slug][$child->slug]['discount']??''}}"

                                                                   placeholder="Discount" step=".1">
                                                        </td>
                                                        <td class="contract-service-column">
                                                            <input type="number"
                                                                   name="{{$specie->slug}}[{{$child->slug}}][total]"
                                                                   id="{{$specie->slug}}-{{$child->slug}}-total"
                                                                   data-check="{{$specie->slug}}-{{$child->slug}}-enabled"
                                                                   class="form-control {{$specie->slug}}-classtotal"
                                                                   value="{{$selected['services'][$specie->slug][$child->slug]['total']??'0'}}"
                                                                   placeholder="Total" step=".1" readonly>
                                                        </td>
                                                        <td class="contract-service-column">
                                                            <input type="number"
                                                                   name="{{$specie->slug}}[{{$child->slug}}][annual]"
                                                                   class="form-control"
                                                                   value="{{$selected['services'][$specie->slug][$child->slug]['annual']??''}}"

                                                                   placeholder="Annual" step=".1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">
                                                            <textarea name="{{$specie->slug}}[{{$child->slug}}][notes]"
                                                                      class="form-control" rows="2"
                                                                      data-auto-expand
                                                                      placeholder="Notes">{{$selected['services'][$specie->slug][$child->slug]['notes']??''}}</textarea>
                                                        </td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td colspan="">
                                                            <input name="{{$specie->slug}}[{{$child->slug}}][service_date]"
                                                                      class="form-control" 
                                                                      data-auto-expand
                                                                      placeholder="Service Date" 
                                                                      value="{{$selected['services'][$specie->slug][$child->slug]['service_date']??''}}"
                                                                      type="date"
                                                                      />
                                                        </td>
                                                        <td colspan="">
                                                            <input name="{{$specie->slug}}[{{$child->slug}}][service_time]"
                                                                      class="form-control" 
                                                                      data-auto-expand
                                                                      placeholder="Time of service" 
                                                                      value="{{$selected['services'][$specie->slug][$child->slug]['service_time']??''}}"
                                                                      type="time"
                                                                      />
                                                        </td>
                                                        <td colspan="">
                                                            <input name="{{$specie->slug}}[{{$child->slug}}][technician]"
                                                                      class="form-control" 
                                                                      data-auto-expand
                                                                      placeholder="Technician" 
                                                                      value="{{$selected['services'][$specie->slug][$child->slug]['technician']??''}}"
                                                                      type="text"
                                                                      />
                                                        </td>
                                                        <td colspan="">
                                                            <input name="{{$specie->slug}}[{{$child->slug}}][estimated_work_hours]"
                                                                      class="form-control" 
                                                                      data-auto-expand
                                                                      placeholder="Estimated Work Hours" 
                                                                      value="{{$selected['services'][$specie->slug][$child->slug]['estimated_work_hours']??''}}"
                                                                      type="number"
                                                                      />
                                                        </td>
                                                    </tr> --}}
                                                @endforeach
                                            @else
                                                <tr class="bg-contract-service">
                                                    <td class="contract-service-column pl-2">
                                                        <label>
                                                            <input type="checkbox"
                                                                   class="contract-service-checkbox"
                                                                   name="{{$specie->slug}}[{{$service->slug}}][enabled]"
                                                                   id="{{$specie->slug}}-{{$service->slug}}-enabled"
                                                                   {{!empty($selected['services'][$specie->slug][$service->slug]['enabled'])?'checked':''}}
                                                                   value="{{$service->name}}">
                                                            <strong class="contract-service-label">{{$service->name}}</strong>
                                                        </label>
                                                    </td>
                                                    <td class="contract-service-column">
                                                        <input type="number"
                                                               name="{{$specie->slug}}[{{$service->slug}}][price]"
                                                               id="{{$specie->slug}}-{{$service->slug}}-price"
                                                               class="form-control"
                                                               value="{{$selected['services'][$specie->slug][$service->slug]['price']??''}}"
                                                               placeholder="Price/Visit" step=".1">
                                                    </td>
                                                    <td class="contract-service-column">
                                                        <input type="number"
                                                               name="{{$specie->slug}}[{{$service->slug}}][tax]"
                                                               id="{{$specie->slug}}-{{$service->slug}}-tax"
                                                               class="form-control"
                                                               value="{{$selected['services'][$specie->slug][$service->slug]['tax']??''}}"
                                                               placeholder="Tax" step=".1">
                                                    </td>
                                                    <td class="contract-service-column">
                                                        <input type="number"
                                                               name="{{$specie->slug}}[{{$service->slug}}][discount]"
                                                               id="{{$specie->slug}}-{{$service->slug}}-discount"
                                                               class="form-control"
                                                               value="{{$selected['services'][$specie->slug][$service->slug]['discount']??''}}"
                                                               placeholder="Discount" step=".1">
                                                    </td>
                                                    <td class="contract-service-column">
                                                        <input type="number"
                                                               name="{{$specie->slug}}[{{$service->slug}}][total]"
                                                               id="{{$specie->slug}}-{{$service->slug}}-total"
                                                               data-check="{{$specie->slug}}-{{$service->slug}}-enabled"
                                                               class="form-control {{$specie->slug}}-classtotal"
                                                               value="{{$selected['services'][$specie->slug][$service->slug]['total']??'0'}}"
                                                               placeholder="Total" step=".1" readonly>
                                                    </td>
                                                    <td class="contract-service-column">
                                                        <input type="number"
                                                               name="{{$specie->slug}}[{{$service->slug}}][annual]"
                                                               class="form-control"
                                                               value="{{$selected['services'][$specie->slug][$service->slug]['annual']??''}}"
                                                               placeholder="Annual" step=".1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">
                                                        <textarea name="{{$specie->slug}}[{{$service->slug}}][notes]"
                                                                  class="form-control" rows="2"
                                                                  data-auto-expand
                                                                  placeholder="Notes">{{$selected['services'][$specie->slug][$service->slug]['notes']??''}}</textarea>
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td colspan="">
                                                        <input name="{{$specie->slug}}[{{$service->slug}}][service_date]"
                                                                  class="form-control" 
                                                                  data-auto-expand
                                                                  placeholder="Service Date" 
                                                                  value="{{$selected['services'][$specie->slug][$service->slug]['service_date']??''}}"
                                                                  type="date"
                                                                  ></input>
                                                    </td>
                                                    <td colspan="">
                                                        <input name="{{$specie->slug}}[{{$service->slug}}][service_time]"
                                                                  class="form-control" 
                                                                  data-auto-expand
                                                                  placeholder="Time of service" 
                                                                  value="{{$selected['services'][$specie->slug][$service->slug]['service_time']??''}}"
                                                                  type="time"
                                                                  ></input>
                                                    </td>
                                                    <td colspan="">
                                                        <input name="{{$specie->slug}}[{{$service->slug}}][technician]"
                                                                  class="form-control" 
                                                                  data-auto-expand
                                                                  placeholder="Technician" 
                                                                  value="{{$selected['services'][$specie->slug][$service->slug]['technician']??''}}"
                                                                  type="text"
                                                                  ></input>
                                                    </td>
                                                    <td colspan="">
                                                        <input name="{{$specie->slug}}[{{$service->slug}}][estimated_work_hours]"
                                                                  class="form-control" 
                                                                  data-auto-expand
                                                                  placeholder="Estimated Work Hours" 
                                                                  value="{{$selected['services'][$specie->slug][$service->slug]['estimated_work_hours']??''}}"
                                                                  type="number"
                                                                  ></input>
                                                    </td>
                                                </tr> --}}
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
                                                   value="{{$selected['services'][$specie->slug]['fyp']??'0'}}" readonly>
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
                       value="{{$selected['customer_info']['total_all_programs']??'0'}}" readonly>
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
