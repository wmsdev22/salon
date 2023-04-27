@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div class="d-flex flex-column col-sm-12 col-md-6">
    <!-- Name Field -->
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

      <!-- Created By -->
      <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('created_by', trans("lang.membership_created_by"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('created_by', null,  ['class' => 'form-control','placeholder'=>  trans("lang.membership_created_by_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.membership_created_by_help") }}
            </div>
        </div>
    </div>

    <!-- Updated By -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('updated_by', trans("lang.membership_updated_by"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('updated_by', null,  ['class' => 'form-control','placeholder'=>  trans("lang.membership_updated_by_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.membership_updated_by_help") }}
            </div>
        </div>
    </div>

   
    
</div>
<div class="d-flex flex-column col-sm-12 col-md-6">
    <!-- Value Offered -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('value_offered', trans("lang.membership_value_offered"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('value_offered', null,  ['class' => 'form-control','placeholder'=>  trans("lang.membership_value_offered_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.membership_value_offered_help") }}
            </div>
        </div>
    </div>

<!-- Discount -->

    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('discount', trans("lang.membership_discount"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('discount', null,  ['class' => 'form-control','placeholder'=>  trans("lang.membership_discount_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.membership_discount_help") }}
            </div>
        </div>
    </div>
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('order', trans("lang.membership_order"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('order', null,  ['class' => 'form-control','placeholder'=>  trans("lang.membership_order_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.membership_order_help") }}
            </div>
        </div>
    </div>

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
