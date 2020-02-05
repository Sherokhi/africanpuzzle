<form id="form-edit-document" class="form-horizontal" method="post" action="<?php echo $this->html()->url('document/'.$document->id().'/edit'); ?>">

    <div class="control-group">
        <label class="control-label" for="security">Nom du document</label>
        <div class="controls">
            <input name="name" type="text" value="<?php echo $document->title(); ?>" required>
        </div>
    </div>

    <div class="control-group">
<!--        <label class="control-label" for="security">Visible par</label>-->
<!--        <div class="controls">-->
<!--            <select name="security" id="security">-->
<!--                <option value="1" --><?php //if ($document->right() == 1) { echo 'selected'; } ?><!-->Élève</option>-->
<!--                <option value="2" --><?php //if ($document->right() == 2) { echo 'selected'; } ?><!-->Enseignant</option>-->
<!--                <option value="3" --><?php //if ($document->right() == 3) { echo 'selected'; } ?><!-->Maître de classe</option>-->
<!--            </select>-->
<!--        </div>-->
    </div>

    <div class="control-group">
        <label class="control-label" for="type">Type</label>
        <div class="controls">
            <select name="type" id="type">
                <?php foreach ($types as $type): ?>
                    <?php if ($type->id() == $document->types_document_id()): ?>
                        <option value="<?php echo $type->id(); ?>" selected><?php echo $type->name(); ?></option>
                    <?php else: ?>
                        <option value="<?php echo $type->id(); ?>"><?php echo $type->name(); ?></option>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="description">Description</label>
        <div class="controls">
            <textarea name="description" id="description" class="uncheck" cols="30" rows="10" required><?php echo $document->description(); ?></textarea>
        </div>
    </div>

</form>


<a id="link-delete-document" style="display:none" href="<?php echo $this->html()->url('document/'.$document->id().'/delete'); ?>"></a>
