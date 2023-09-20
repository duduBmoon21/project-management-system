<div class="container-fluid">
	<form action="" id="manage-progress">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<input type="hidden" name="task_id" value="<?php echo isset($_GET['tid']) ? $_GET['tid'] : '' ?>">
		<div class="col-lg-12">
			<div class="row">
				<div class="form-group">
					<label for="">Progress Description</label>
					<textarea name="progress" id="progress" cols="30" rows="10" class="summernote form-control" required=""><?php echo isset($progress) ? $progress : '' ?></textarea>
				</div>
				<div class="form-group clearfix">
					<div class="icheck-primary d-inline">
                        <input type="checkbox" name="is_complete" value="1" <?php echo isset($is_complete) && $is_complete == 1 ? 'checked' : '' ?> id="is_complete">
                        <label for="is_complete">
                        	Task Completed
                        </label>
                	</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
	$('.summernote').summernote({
        height: 200,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    })
    </script>  