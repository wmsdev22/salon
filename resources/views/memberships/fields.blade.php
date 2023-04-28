@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div class="d-flex flex-column col-sm-12 col-md-6">
  <!-- Membership Type Field -->   
 
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('type', trans("lang.membership_type"),['class' => 'col-md-3 control-label  text-md-right mx-1']) !!}
        <div class="col-md-9">
            <select class="select2 form-control" id="dropdown" onchange="changeMType()"> 
                <option value="">Select</option>
                <option value="Discount on Invoice">Discount on Invoice</option>
                <option value="Wallet Credits">Wallet Credits</option>
                {!! Form::select('type') !!}
            </select>
        </div>
    </div> 
   {{-- <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('parent_id', trans("lang.category_parent_id"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::select('parent_id', ['data-empty'=>trans("lang.category_parent_id_placeholder"), 'class' => 'select2 not-required form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.category_parent_id_help") }}</div>
        </div>
    </div>  --}}

  
    <!-- Title Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('title', trans("lang.membership_title"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('title', null, ['class' => 'form-control','placeholder'=>  trans("lang.membership_title_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.membership_title_help") }}
            </div>
        </div>
    </div>

    <!-- Cost Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('cost', trans("lang.membership_cost"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('cost', null,  ['class' => 'form-control','placeholder'=>  trans("lang.membership_cost_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.membership_cost_help") }}
            </div>
        </div>
    </div>


      <!-- Value Offered -->
  <div id="field1" style="display: none;">
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('value_offered', trans("lang.membership_value_offered"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('value_offered', null,  ['class' => 'form-control','placeholder'=>  trans("lang.membership_value_offered_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.membership_value_offered_help") }}
            </div>
        </div>
    </div>
 </div>

<!-- Discount -->
  <div id="field2" style="display: none;">
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('discount', trans("lang.membership_discount"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('discount', null,  ['class' => 'form-control','placeholder'=>  trans("lang.membership_discount_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.membership_discount_help") }}
            </div>
        </div>
    </div>
    </div>
     <!-- Description Field -->
     <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('validity_months', trans("lang.membership_validity_months"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('validity_months', null,  ['class' => 'form-control','placeholder'=>  trans("lang.membership_validity_months_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.membership_validity_months_help") }}
            </div>
        </div>
    </div> 

    
</div>
<div class="d-flex flex-column col-sm-12 col-md-6">

<div class="form-group align-items-start d-flex flex-column flex-md-row">
        {!! Form::label('thubmnail', trans("lang.membership_thumbnail"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            <div style="width: 100%" class="dropzone image" id="image" data-field="image">
                <input type="hidden" name="image">
            </div>
            <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.media_select')}}</a>
            <div class="form-text text-muted w-50">
                {{ trans("lang.membership_thumbnail_help") }}
            </div>
        </div>
    </div>


    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('order', trans("lang.membership_serial"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('order', null,  ['class' => 'form-control','placeholder'=>  trans("lang.membership_serial_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.membership_serial_help") }}
            </div>
        </div>
    </div>
  
    
    

    </div>
<!-- Submit Field -->
<div class="form-group col-12 d-flex flex-column flex-md-row justify-content-md-end justify-content-sm-center border-top pt-4">
    <div class="d-flex flex-row justify-content-between align-items-center">
        {!! Form::label('featured', trans("lang.membership_featured_help"),['class' => 'control-label my-0 mx-3'],false) !!} {!! Form::hidden('featured', 0, ['id'=>"hidden_featured"]) !!}
        <span class="icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('featured', 1, null) !!} <label for="featured"></label> </span>
    </div>
    <button type="submit" class="btn bg-{{setting('theme_color')}} mx-md-3 my-lg-0 my-xl-0 my-md-0 my-2">
        <i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.membership')}}
    </button>
    <a href="{!! route('memberships.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>

<script>
    var dropdown = document.getElementById('dropdown');
    var field_1 = document.getElementById('field1');
    var field_2 = document.getElementById('field2');

    dropdown.addEventListener('change', function() {
        changeMType();
    });
    function changeMType()
    {
        
        
        if (dropdown.value == 'Discount on Invoice') 
        {
            $(field_1).show();
            $(field_2).hide();

            
        }
         else if (dropdown.value == 'Wallet Credits') {
            $(field_1).hide();
            $(field_2).show();
        }
         else
          {
            $(field_1).hide();
            $(field_2).hide();
          }
    }
    
</script>