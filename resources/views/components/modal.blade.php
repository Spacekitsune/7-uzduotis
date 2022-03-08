<div class="modal fade" id="createArticleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ajaxForm">
                    <div class="form-group">
                        <label for="article_title">Article Name</label>
                        <input id="article_title" class="form-control" type="text" name="article_title" />
                    </div>
                    <div class="form-group">
                        <label for="article_typeId">Article Type Id</label>
                        <input id="article_typeId" class="form-control" type="text" name="article_typeId" />
                    </div>
                    <div class="form-group">
                        <label for="article_description">Article Description</label>
                        <input id="article_description" class="form-control" type="text" name="article_description" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="submit-ajax-form" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editArticleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ajaxForm">
                    <input type="hidden" id="edit_article_id" name="article_id" />
                    <div class="form-group">
                        <label for="article_title">Article Title</label>
                        <input id="edit_article_title" class="form-control" type="text" name="article_title" />
                    </div>
                    <div class="form-group">
                        <label for="article_typeId">Article Type Id</label>
                        <input id="edit_article_typeId" class="form-control" type="text" name="article_typeId" />
                    </div>
                    <div class="form-group">
                        <label for="article_description">Article Description</label>
                        <input id="edit_article_description" class="form-control" type="text" name="article_description" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="update-article" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showArticleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Show Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="show-article-id">
                </div>
                <div class="show-article-title">
                </div>
                <div class="show-article-typeId">
                </div>
                <div class="show-article-description">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>