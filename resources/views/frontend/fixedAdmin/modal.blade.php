<div class="modal modal-edit-tag-category" style="display: none;" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close ik-close-modal" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name=""  id="editTitle" class="form-control mt-4">
                <div id="errorTitle"></div>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <textarea type="text" rows="8" name="" id="editContent" class="form-control mt-4">

                </textarea>
                @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div id="errorContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary ik-save-modal">Save changes</button>
                <button type="button" class="btn btn-secondary ik-close-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
