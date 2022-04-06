<form method="post" action="{{route('roles.store')}}" >
                        @csrf
                        <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role Name</label>
                            <input type="text" class="form-control" name="role" id="role" placeholder="Enter Role Name">
                            @error('role')
                                <div class="error error-msg-red">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>