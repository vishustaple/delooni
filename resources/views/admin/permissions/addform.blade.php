
        <form method="post" action="{{route('permissions.store')}}" >
                        @csrf
                        <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Permission Name</label>
                            <input type="text" class="form-control" name="permission" id="permission" placeholder="Enter Permission Name">
                            @if ($errors->has('permission'))
                                <div class="alert alert-error">
                                    <strong>{{ $errors->first('permission') }}</strong>
                                </div>
                                @endif
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
