<form class="form-horizontal"  id="condition_update"  method="post">
                      @csrf
                      <input type="hidden" name="id" id="id" value="{{$condition->id}}">
                      <div class="form-group row">
                        <label for="terms_and_condition" class="col-sm-3 col-form-label">Terms and Condition :</label>
                        <div class="col-sm-8">
                        <textarea rows="9" cols="55" name="terms_and_condition" id="terms_and_condition">
                        {{$condition->terms_and_condition}}</textarea>
                        <div class="error" id="error_terms_and_condition">
                         </div>
                         </div>
                        </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Submit</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
                    </form>