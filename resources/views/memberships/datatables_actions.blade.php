<div class='btn-group btn-group-sm'>
    @can('memberships.show')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.view_details')}}" href="{{ route('categories.show', $id) }}" class='btn btn-link'>
            <i class="fas fa-eye"></i> </a> @endcan

    @can('memberships.edit')
        <a data-toggle="" data-placement="left" title="{{trans('lang.membership_edit')}}" href="{{ route('memberships.edit', $id) }}" class='btn btn-link'>
            <i class="fas fa-edit"></i></a> @endcan

    @can('memberships.destroy') {!! Form::open(['route' => ['memberships.destroy', $id], 'method' => 'delete']) !!} {!! Form::button('<i class="fas fa-trash"></i>', [ 'type' => 'submit', 'class' => 'btn btn-link text-danger', 'onclick' => "return confirm('Are you sure?')" ]) !!} {!! Form::close() !!} @endcan
</div>
