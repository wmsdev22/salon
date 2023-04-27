<!-- Id Field -->
<div class="form-group row col-6">
    {!! Form::label('id', 'Id:', ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $membership->id !!}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group row col-6">
    {!! Form::label('title', 'Title:', ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $membership->title !!}</p>
    </div>
</div>

<!-- Color Field -->
<div class="form-group row col-6">
    {!! Form::label('cost', 'Cost:', ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $membership->cost !!}</p>
    </div>
</div>

<!-- Description Field -->
<div class="form-group row col-6">
    {!! Form::label('value_offered', 'Value Offered:', ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $membership->value_offered !!}</p>
    </div>
</div>

<!-- Image Field -->
<div class="form-group row col-6">
    {!! Form::label('discount', 'Discount:', ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $membership->image !!}</p>
    </div>
</div>

<!-- Parent Id Field -->
<div class="form-group row col-6">
    {!! Form::label('validity_months', 'Validity Months:', ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $membership->parent_id !!}</p>
    </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
    {!! Form::label('created_at', 'Created At:', ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $membership->created_at !!}</p>
    </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
    {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $membership->updated_at !!}</p>
    </div>
</div>

