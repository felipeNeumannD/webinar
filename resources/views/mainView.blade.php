@extends('Layout.internPattern')

@section('content')

<div class="d-flex vh-100 justify-content-center align-items-center">
    <div class="col-md-4">
        <div id="main" name="main">
            <form action="/mainView" method="GET">
                <div id="emailInsert" name="insertEmail" class="form-group">
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection