@extends('../template_Dashboard')

@section('title')
    Alert Method - Alert Group
@endsection
@section('content')
    <div id="page-wrapper">
        <form id="destroyForm" role="form" method="POST" action="{{ route('destroyMethodofGroup') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="btn-group">
                        <a class="btn green btn-success" href="{{ asset('alert-method-of-group/create')}}"><span>Add New </span><i class="fa fa-plus"></i></a>
                        <button class="btn red btn btn-danger" id="SubmitDelete" disabled>Remove selected</button>
                    </div>
                </div>
            </div>
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th><input type="checkbox" id="select_all" name="checkbox[]" data-id="checkbox" value="option3"></th>
                    <th>Alert Group</th>
                    <th>Alert Method</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $key)
                    <tr>
                        <td><input class="checkbox" type="checkbox" name="chkCat[]" onclick="clickCheckbox();" value="{!! $key->id !!}"></td>
                        <td>{{ $key->alertGroup->name }}</td>
                        <td>{{ $key->alertMethod->name }}</td>
                        <td>{{ $key->created_at }}</td>
                        <td>{{ $key->updated_at }}</td>
                        <td>
                            <a type="button" class="btn btn-primary btn-sm"href="/alert-method-of-group/{!! $key->id !!}/edit">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
    <script>
        $('#select_all').change(function() {
            var checkboxes = $(this).closest('table').find('td').find(':checkbox');
            if($(this).is(':checked')) {
                checkboxes.not(this).prop('checked', this.checked);
                $('#SubmitDelete').prop('disabled', false);
            } else {
                checkboxes.not(this).prop('checked', false);
                $('#SubmitDelete').prop('disabled', true);
            }
        });
        function clickCheckbox(){
            if($('input[name="chkCat[]"]:checked').length > 0){
                $('#SubmitDelete').prop('disabled', false);
            }else{
                $('#SubmitDelete').prop('disabled', true);
            }
        }
        $('#SubmitDelete').on('click', function (e) {
            if (!confirm('Are you sure you want to delete?')) return;
            e.preventDefault();
            $('#destroyForm').submit();
        });

    </script>
@endsection