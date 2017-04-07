<button type="button" class="btn btn-info btn-xs" data-toggle='modal' data-target="#myModal{{$id}}" 
data-invenId="{{ $id }}" data-name="{{ $name }}" data-discount="{{ $discount }}" data-validuntil="{{ $valid_until }}">
  Edit
</button>

<!-- Modal -->
<div class="modal fade" id="myModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Inventory</h4>
      </div>

     <form class="form-horizontal" role="form" method="POST" action="{{action('InventoryController@editInventory')}}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>                            
        <input id="id" type="hidden" name="id" value="{{$id}}">
         <div class="modal-body">
            <div class="row">
                <label for="name" class="col-md-2">Name</label>
                <div class="col-md-10">
                    <input id="name" class="form-control" type="text" name="name" value="{{$name}}"/>
                </div>
            </div>

            <div class="row">
                <label for="discount" class="col-md-2">Discount</label>
                <div class="col-md-10">
                    <input id="discount" class="form-control" type="number" name="discount" value="{{$discount}}"/>
                </div>
            </div>

            <div class="row">
                <label for="valid_until" class="col-md-2">Valid Until</label>
                <div class="col-md-10">
                    <input id="valid_until" class="form-control" type="datetime" name="valid_until" value="{{$valid_until}}"/>
                </div>
            </div>

         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Edit Inventory"/>
          </div>
      </form>
    </div>
  </div>
</div>

